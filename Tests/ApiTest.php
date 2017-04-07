<?php

use PHPUnit\Framework\TestCase;
use PropertyFinder\BoardingCard;
use PropertyFinder\Port;
use PropertyFinder\Vehicle;
use PropertyFinder\Train;
use PropertyFinder\Plane;
use PropertyFinder\Bus;
use PropertyFinder\Api;

class ApiTest extends TestCase
{

    public function testDummy()
    {
        $this->assertTrue(true);
    }

    /**
     * @dataProvider boardingCardProvider
     */
    public function testIsArrayOfFour(... $boardingCardsArray)
    {
        $this->assertCount(4, $boardingCardsArray);
    }

    /**
     * @dataProvider boardingCardProvider
     */
    public function testSortedString(... $boardingCardsArray)
    {
        $api = new Api;

        $stirng = $api->getSortedBoardingCardsItinerary($boardingCardsArray);

        $this->assertTrue(true);
    }

    /**
     * @dataProvider boardingCardProvider
     */
    public function testSortedArray(... $boardingCardsArray)
    {
        $api = new Api;

        $sorted = $api->getSortedBoardingCards($boardingCardsArray);

        $this->assertCount(count($boardingCardsArray), $sorted);
        $this->assertEquals($boardingCardsArray, $sorted);
    }

    /**
     * @dataProvider boardingCardProvider
     */
    public function testUnsortedArray(... $boardingCardsArray)
    {
        $api = new Api;

        shuffle($boardingCardsArray);
        shuffle($boardingCardsArray);
        shuffle($boardingCardsArray);
        shuffle($boardingCardsArray);

        $sorted = $api->getSortedBoardingCards($boardingCardsArray);

        $count = count($boardingCardsArray);
        $this->assertCount($count, $sorted);
        $this->assertNotEquals($boardingCardsArray, $sorted);
        $this->assertEquals('Madrid', $sorted[0]->getPortDeparture()->getName());
        $this->assertEquals('Barcelona', $sorted[0]->getPortArrival()->getName());

        $this->assertEquals('Stockholm', $sorted[$count - 1]->getPortDeparture()->getName());
        $this->assertEquals('New York', $sorted[$count - 1]->getPortArrival()->getName());
    }

    public static function boardingCardProvider()
    {
        $retval = [];
        $array = [
            [
                'Madrid', // departure
                '', // gate
                '', // info
                (new \DateTime)->modify('+1 hour'),
                'Barcelona', // arrival
                '', // gate
                '', // info
                (new \DateTime)->modify('+2 hour'),
                new Train('78A'),
                '45B' // seat
            ],
            [
                'Barcelona', // departure
                '', // gate
                '', // info
                (new \DateTime)->modify('+3 hour'),
                'Gerona Airport', // arrival
                '', // gate
                '', // info
                (new \DateTime)->modify('+4 hour'),
                new Bus(''),
                '' // seat
            ],
            [
                'Gerona Airport',
                '45B',
                'Bagage drop at ticket counter 344',
                (new \DateTime)->modify('+5 hour'),
                'Stockholm',
                '',
                '',
                (new \DateTime)->modify('+6 hour'),
                new Plane('SK455'),
                '3A'
            ],
            [
                'Stockholm',
                '22',
                'Baggage will we automatically transferred from your last leg',
                (new DateTime)->modify('+7 hour'),
                'New York',
                '',
                '',
                (new DateTime)->modify('+8 hour'),
                new Plane('SK22'),
                '7B'
            ],
        ];

        foreach ($array as $data) {
            $d = new Port($data[0], $data[1], $data[2]);
            $a = new Port($data[4], $data[5], $data[6]);
            $v =& $data[8];

            $b = new BoardingCard($v, $d, $a);
            $b->setTimeDeparture($data[3]);
            $b->setTimeArrival($data[7]);
            $b->setSeat($data[9]);

            $retval[] = $b;
        }

        return [$retval];
    }
}
