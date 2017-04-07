<?php
/**
 * Just some simple tests for the Vehicle class
 *
 */

use PHPUnit\Framework\TestCase;
use PropertyFinder\Vehicle;
use PropertyFinder\Train;

class VehicleTest extends TestCase
{
    protected $vehicle;

    public function __construct()
    {
        $this->vehicle = new Train('NR1');
    }

    public function testInstance()
    {
        $this->assertInstanceOf(
            Vehicle::class,
            $this->vehicle
        );

        $this->assertInstanceOf(
            Train::class,
            $this->vehicle
        );
    }

    public function testGetNumber()
    {
        $nr = $this->vehicle->getNumber();

        $this->assertEquals('NR1', $nr);
    }

    public function testHasSeat()
    {
        $this->assertTrue($this->vehicle->hasSeat());
    }
}
