<?php
/**
 * Just some simple tests for the boarding card class
 *
 */
use PHPUnit\Framework\TestCase;
use PropertyFinder\BoardingCard;
use PropertyFinder\Vehicle;
use PropertyFinder\Train;
use PropertyFinder\Port;

class BoardingCardTest extends TestCase
{
    public function __construct()
    {
        $this->vehicle = new Train('T100', '30A');

        $this->portDeparture = new Port(
            'Departure',
            'GateDeparture',
            'InfoDeparture'
        );

        $this->portArrival = new Port(
            'Arrival',
            'GateArrival',
            'InfoArrival'
        );
    }

    public function testNewBoardingCard()
    {
        $bc = new BoardingCard($this->vehicle, $this->portDeparture, $this->portArrival);

        $this->assertInstanceOf(
            BoardingCard::class,
            $bc
        );
    }

    public function testSetSeat()
    {
        $bc = new BoardingCard($this->vehicle, $this->portDeparture, $this->portArrival);
        $bc->setSeat('23A');

        $this->assertEquals('23A', $bc->getSeat());
    }

    public function testInvalidBoardingCard()
    {
        $this->portDeparture->setName('A');
        $this->portArrival->setName('A');

        $bc = new BoardingCard($this->vehicle, $this->portDeparture, $this->portArrival);

        $this->assertTrue(! $bc->isValid());
    }
}
