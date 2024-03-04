<?php

namespace Mniik\PhpRaceGame\Services;

use Mniik\PhpRaceGame\Models\Player;

class RaceService
{
    private array $vehicles;
    private int $distance;
    public array $players = [];
    public $winner = null;

    public function __construct(array $vehicles, int $distance)
    {
        $this->vehicles = $vehicles;
        $this->distance = $distance;

        $this->setPlayers();
    }

    private function setPlayers()
    {
        foreach ($this->vehicles as $vehicle) {
            $this->players[] = new Player($vehicle);
        }
    }

    public function run()
    {
        $result = [];
        foreach ($this->players as $index=>$player) {
            $player->setLapTime($this->calculateLapTime($player->getVehicle()));

            if (is_null($this->winner) || $this->players[$this->winner]->getLapTime() > $player->getLapTime()) {
                $this->winner = $index;
            }

            $result[] = [$index + 1, $player->getVehicle()->getName(), $player->getLapTime()];
        }

        $result[] = ["Player " . $this->winner + 1 . " is Winner"];

        return $result;
    }

    public function calculateLapTime($vehicle)
    {
        return $this->distance / $vehicle->getSpeed()->toKmsPerHour();
    }

}