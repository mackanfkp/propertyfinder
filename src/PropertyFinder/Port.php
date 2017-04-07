<?php
/**
 * Port class
 *
 */
namespace PropertyFinder;

class Port
{
    protected $name;
    protected $gate;
    protected $info;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $gate
     * @param string $info
     */
    public function __construct($name, $gate = '', $info = '')
    {
        $this
            ->setName($name)
            ->setGate($gate)
            ->setInfo($info);
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return Port
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Info
     *
     * @param string $info
     * @return Port
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get Info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set Gate
     *
     * @param string $gate
     * @return Port
     */
    public function setGate($gate)
    {
        $this->gate = $gate;

        return $this;
    }

    /**
     * Get Gate
     *
     * @return string
     */
    public function getGate()
    {
        return $this->gate;
    }
}
