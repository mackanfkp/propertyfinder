<?php
/**
 * A simple Train class
 *
 */
namespace PropertyFinder;

class Train extends Vehicle
{
    /**
     * Get name (type) of vehicle
     *
     * @return string
     */
    public function getName()
    {
        return 'train';
    }
}
