<?php

namespace Mniik\PhpRaceGame\Models;

use Mniik\PhpRaceGame\Exceptions\InvalidUnitException;
use Mniik\PhpRaceGame\Units\IUnit;
use Mniik\PhpRaceGame\Units\KmhUnit;
use Mniik\PhpRaceGame\Units\KnotsUnit;

class Vehicle
{
    protected string $name;
    protected float $speed;
    protected string $speedUnit;
    const VEHICLE_PATH = '/assets/vehicles.json';

    public function __construct(string $name, float $maxSpeed, string $speedUnit)
    {
        $this->name = $name;
        $this->speed = $maxSpeed;
        $this->speedUnit = $speedUnit;
    }

    public function setName(string $value): void
    {
        $this->name = $value;
    }

    public function setSpeed(float $value, string $unit): void
    {
        $this->speed = $value;
        $this->speedUnit = $unit;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws InvalidUnitException
     */
    public function getSpeed(): IUnit
    {
        return match ($this->speedUnit) {
            'knots', 'Kts' => new KnotsUnit($this->speed),
            'Km/h' => new KmhUnit($this->speed),
            default => throw new InvalidUnitException("Invalid Unit."),
        };
    }

    public static function getFilesPath(): string
    {
        return dirname(__DIR__,2) . self::VEHICLE_PATH;
    }

    public static function all(): array
    {
        $vehicleObjects = [];
        $vehicles = json_decode(file_get_contents(self::getFilesPath()),true);

        foreach ($vehicles as $vehicle) {
            $vehicleObjects[] = new Vehicle($vehicle['name'],$vehicle['maxSpeed'],$vehicle['unit']);
        }
        return $vehicleObjects;
    }


}