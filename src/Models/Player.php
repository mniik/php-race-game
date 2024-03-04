<?php

namespace Mniik\PhpRaceGame\Models;

class Player
{
    private $vehicle;
    private float $lapTime;

    /**
     * @param $vehicle
     */
    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function setLapTime($lapTime)
    {
        $this->lapTime = $lapTime;
    }

    public function getLapTime(): float
    {
        return $this->lapTime;
    }
}