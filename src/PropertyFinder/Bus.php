<?php
/**
 * A simple Bus class
 *
 */
namespace PropertyFinder;

class Bus extends Vehicle
{
    /**
     * Get name (type) of vehicle
     *
     * @return string
     */
    public function getName()
    {
        return 'bus';
    }
}
