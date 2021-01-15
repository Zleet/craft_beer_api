<?php

/**
 * A class for creating BoilVolume value objects.
 * @var integer/float $value - the amount of stuff to include
 * @var string $unit - the units in which $value is mesaured
 */

namespace Zleet\PunkAPI;
use http\Exception\InvalidArgumentException;

class BoilVolume
{
    private $value;
    private $unit;

    /**
     * Volume constructor.
     * @param numeric $value    - the amount
     * @param string $unit      - the unit the value is measured in
     */
    public function __construct($value, string $unit)
    {
        $this->value = $this->validateValue($value);
        $this->unit = $this->validateUnit($unit);
    }

    /**
     * @return int|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param $value
     * @return int|string
     */
    private function validateValue($value)
    {
        if (!is_numeric($value)) throw new InvalidArgumentException("Value must be numeric (integer or float)");
        if ($value < 0) throw new InvalidArgumentException("Value must be zero or greater.");

        return $value;
    }

    /**
     * @param $unit
     * @return string
     */
    private function validateUnit($unit)
    {
        if (!is_string($unit)) throw new InvalidArgumentException("Unit must be a string.");
        if (strlen($unit) === 0) throw new InvalidArgumentException("Unit must be non-empty string.");

        return $unit;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'value' => $this->value,
            'unit'  => $this->unit
        ];
    }

}