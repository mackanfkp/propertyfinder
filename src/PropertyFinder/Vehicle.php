<?php
/**
 * Vehicle class
 *
 */
namespace PropertyFinder;

abstract class Vehicle
{
    protected $number;

    /**
     * Abstract method for the differen vehicles to implement
     * to get the name (type) of vehicle back
     *
     * @return string
     */
    abstract public function getName();

    /**
     * Constructor
     *
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->setNumber($number);
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Vehicle
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Has seat
     *
     * Just dummy method to check if seat exists
     *
     * @param string $number
     * @return bool
     */
    public function hasSeat()
    {
        return true;
    }

    /**
     * Check if seat is available
     *
     * Just dummy method to check if seat available
     *
     * @param string $number
     * @return bool
     */
    public function isSeatAvailable()
    {
        return $this->hasSeat();
    }
}
