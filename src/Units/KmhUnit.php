<?php

namespace Mniik\PhpRaceGame\Units;

use Mniik\PhpRaceGame\Units\IUnit;

class KmhUnit implements IUnit
{
    protected float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function toKmsPerHour(): float|int
    {
        return $this->value * 1;
    }
}
