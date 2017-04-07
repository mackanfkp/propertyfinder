<?php
/**
 * Just some simple tests for the Port class
 *
 */

use PHPUnit\Framework\TestCase;
use PropertyFinder\Port;

class PortTest extends TestCase
{
    protected $port;

    public function __construct()
    {
        $this->port = new Port(
            'Madrid',
            'Gate',
            'Info'
        );

        parent::__construct();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(
            Port::class,
            $this->port
        );
    }
/*
    public function testTimeType()
    {
        $time = $this->port->getTime();
        $curr = new \DateTime;

        $this->assertInstanceOf(
            \DateTime::class,
            $this->port->getTime()
        );
    }

    public function testTimeIsInFuture()
    {
        $time = $this->port->getTime();
        $curr = new \DateTime;

        $this->assertTrue($time > $curr);
    }
*/
}
