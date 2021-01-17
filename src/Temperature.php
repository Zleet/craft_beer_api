<?php

/**
 * A class for creating Temperature value objects.
 * @var integer/float $value - the amount of heat
 * @var string $unit - the units in which the temperature is measured
 */

namespace Zleet\PunkAPI;
use http\Exception\InvalidArgumentException;

class Temperature
{
    private $value;
    private $unit;

    /**
     * Temperature constructor
     * @param int $value    - the amount
     * @param string $unit  - the unit the value is measured in
     */
    public function __construct(int $value, string $unit)
    {
        $this->value = $this->validateValue($value);
        $this->unit = $this->validateUnit($unit);
    }

    /**
     * @param $value
     * @return int|string
     */
    private function validateValue($value)
    {
        if ($value < 0) throw new \InvalidArgumentException("Value must be zero or greater.");

        return $value;
    }

    /**
     * @param $unit
     * @return string
     */
    private function validateUnit($unit)
    {
        if (strlen($unit) === 0) throw new \InvalidArgumentException("Unit must be non-empty string.");

        return $unit;
    }

    /**
     * @return int
     */
    public function getValue() {

        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnit() {

        return $this->unit;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            "value" => $this->value,
            "unit"  => $this->unit
        ];
    }

}