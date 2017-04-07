<?php
/**
 * Boarding class
 *
 * For now, only to get a sorted itinerary or a sorted array of boarding cards
 */
namespace PropertyFinder;

class BoardingCard
{
    protected $vehicle;
    protected $portDeparture;
    protected $portArrival;
    protected $timeDeparture;
    protected $timeArrival;
    protected $seat;

    /**
     * Constructor
     *
     * @param Vehicle $vehicle
     * @param Port $portDeparture
     * @param Port $portArrival
     */
    public function __construct(Vehicle $vehicle, Port $portDeparture, Port $portArrival)
    {
        $this
            ->setVehicle($vehicle)
            ->setPortDeparture($portDeparture)
            ->setPortArrival($portArrival);
    }

    /**
     * Set Vehicle
     *
     * @param Vehicle $vehicle
     * @return BoardingCard
     */
    public function setVehicle(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get Vehicle
     *
     * @return Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Set Port of Departure
     *
     * @param Port $port
     * @return BoardingCard
     */
    public function setPortDeparture(Port $port)
    {
        $this->portDeparture = $port;

        return $this;
    }

    /**
     * Get Port of Departure
     *
     * @return Port
     */
    public function getPortDeparture()
    {
        return $this->portDeparture;
    }

    /**
     * Set Port of Arrival
     *
     * @param Port $port
     * @return BoardingCard
     */
    public function setPortArrival(Port $port)
    {
        $this->portArrival = $port;

        return $this;
    }

    /**
     * Get Port of Arrival
     *
     * @return Port
     */
    public function getPortArrival()
    {
        return $this->portArrival;
    }

    /**
     * Set Departure Time
     *
     * @param DateTime $time
     * @return BoardingCard
     */
    public function setTimeDeparture(\DateTime $time)
    {
        $this->timeDeparture = $time;

        return $this;
    }

    /**
     * Get Departure Time
     *
     * @return DateTime
     */
    public function getTimeDeparture()
    {
        return $this->timeDeparture;
    }

    /**
     * Set Arrival Time
     *
     * @param DateTime $time
     * @return BoardingCard
     */
    public function setTimeArrival(\DateTime $time)
    {
        $this->timeArrival = $time;

        return $this;
    }

    /**
     * Get Arrival Time
     *
     * @return DateTime
     */
    public function getTimeArrival()
    {
        return $this->timeArrival;
    }

    /**
     * Set Seat
     *
     * @param string $seat
     * @return BoardingCard
     */
    public function setSeat(string $seat)
    {
        // Check if seat is available
        // Book/assign seat at the vehicle
        // And finally set seat on boarding card
        if ($this->vehicle->isSeatAvailable()) {
            $this->seat = $seat;
        } else {
            throw new Exception('Cannot assign seat that is not available');
        }

        return $this;
    }

    /**
     * Get Seat
     *
     * @return string
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * Check if valid
     *
     * Would not check against names in real application,
     * but most likely so that their unique id's isn't same.
     * Also a lot of more checks...
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->getPortDeparture()->getName() != $this->getPortArrival()->getName();
    }
}
