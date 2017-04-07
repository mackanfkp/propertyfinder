<?php
/**
 * Api class
 *
 * For now, only to get a sorted itinerary or a sorted array of boarding cards
 */
namespace PropertyFinder;

use PropertyFinder\BoardingCard;

class Api
{
    /**
     * Get a sorted array of boarding cards
     *
     * @param array $boardingCards
     * @return array
     */
    public function getSortedBoardingCards(array $boardingCards)
    {
        $parsed = $this->getParsedBoardingCards($boardingCards);

        return $parsed;
    }

    /**
     * Get a string of the sorted itinerary
     *
     * @param array $boardingCards
     * @return string
     */
    public function getSortedBoardingCardsItinerary(array $boardingCards)
    {
        $parsed = $this->getParsedBoardingCards($boardingCards);

        return $this->getItinerary($parsed);
    }

    /**
     * Get a string of the unsorted itinerary
     *
     * @param array $boardingCards
     * @return string
     */
    public function getItinerary(array $boardingCards)
    {
        $retval = [];

        foreach ($boardingCards as $bc) {
            $vehicle = $bc->getVehicle();
            $departure = $bc->getPortDeparture();
            $arrival = $bc->getPortArrival();

            $vehicleName = $vehicle->getName();
            if ($number = $vehicle->getNumber()) {
                $vehicleName .= ' no. '. $number;
            }

            $string = [];

            $string[] = sprintf(
                'Take %s from %s to %s.',
                $vehicleName,
                $departure->getName(),
                $arrival->getName()
            );

            if ($gate = $bc->getPortDeparture()->getGate()) {
                $string[] = sprintf('Gate %s.', $gate);
            }

            if ($seat = $bc->getSeat()) {
                $string[] = sprintf('Sit in seat %s.', $seat);
            } else {
                $string[] = sprintf('No seat assignment.');
            }

            if ($info = $departure->getInfo()) {
                $string[] = sprintf("\n\t%s.", $info);
            }

            $retval[] = implode(' ', $string);
        }

        $retval[] = 'You have arrived at your final destination.';

        return implode("\n", $retval);
    }

    /**
     * Do the sorting
     *
     * @param array $boardingCards
     * @return array
     */
    protected function getParsedBoardingCards(array $boardingCards)
    {
        $retval = [];

        $d_ports = [];
        $a_ports = [];

        // Create array for departure and arrival, having name as key
        foreach ($boardingCards as $index => $boardingCard) {
            if (! $boardingCard->isValid()) {
                $msg = sprintf(
                    'ERROR: Boarding card is not valid',
                    $boardingCard->getName()
                );

                throw new \Exception($msg);
            }

            $d_ports[$boardingCard->getPortDeparture()->getName()] = $index;
            $a_ports[$boardingCard->getPortArrival()->getName()] = $index;
        }

        // Get the first departure by comparing against the above arrays
        foreach ($d_ports as $name => $index) {
            if (! isset($a_ports[$name])) {
                $retval[] = $current = $boardingCards[$index];
                unset($d_ports[$name]);
                break;
            }
        }

        // If there is no first departure - i.e error, as not a valid trip
        if (! $retval) {
            throw new \Exception('ERROR: cannot find a valid stack, due to no start destination');
        }

        // No loop unti we added the rest of the cards in correct order
        while (! empty($d_ports)) {
            $name = $current->getPortArrival()->getName();

            // Is current boarding card's arrival in arrivals array?
            if (! isset($d_ports[$name])) {
                throw new Exception('ERROR: cannot find a valid stack, due to missing arrival point');
            } else {
                $retval[] = $current = $boardingCards[$d_ports[$name]];
                unset($d_ports[$name]);
            }

            // We have the same arrival as last added port arrival
            if ($name === $current->getPortArrival()->getName()) {
                throw new Exception('ERROR: cannot find a valid stack, due to same departure port');
            }
        }

        return $retval;
    }
}
