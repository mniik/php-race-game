<?php

namespace Mniik\PhpRaceGame\Commands;


use Mniik\PhpRaceGame\Models\Vehicle;
use Mniik\PhpRaceGame\Services\RaceService;

class RaceGameCommand
{
    private array $vehicles;

    public function handle()
    {
        $this->vehicles = Vehicle::all();

        $players = $this->promptForVehicles();
        $distance = $this->promptForDistance();

        $racerService = new RaceService(array_values($players), $distance);
        $result = $racerService->run();

        $table = new \cli\Table();
        $table->setHeaders(['player','vehicle','lapTime (hours)']);
        $table->setRows($result);
        $table->display();

    }

    private function promptForVehicles(): array
    {
        foreach (range(1, 2) as $player) {
            $selectedIndex = \cli\menu(
                array_map(fn($item) => $item->getName(), $this->vehicles),
                null,
                "choose Player #{$player} vehicle",
            );
            $players[$player] = $this->vehicles[$selectedIndex];
        }
        return $players;
    }

    private function promptForDistance():int
    {
        $distance = \cli\prompt('provide race distance in KM');

        if (!is_numeric($distance) || (int)$distance < 0) {
            return $this->promptForDistance('The distance must be an positive integer?');
        }

        return (int)$distance;
    }

}