<?php
/**
 * A simple Plane class
 *
 */
namespace PropertyFinder;

class Plane extends Vehicle
{
    /**
     * Get name (type) of vehicle
     *
     * @return string
     */
    public function getName()
    {
        return 'flight';
    }
}
