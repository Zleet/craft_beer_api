<?php

namespace Zleet\PunkAPI;

/**
 * BoilVolume.php
 *
 * A class for creating BoilVolume value objects.
 *
 * PHP version 7.3
 *
 * @category Components
 * @package  Punk_API
 * @author   Michael McLarnon <michaelmclarnon@hotmail.co.uk>
 * @license  MIT License
 * @version  GIT: @0.1
 * @link     https://www.usedcarsni.com
 */

class BoilVolume
{
    private $value;
    private $unit;

    /**
     * Volume constructor.
     *
     * @param int    $value - the amount
     * @param string $unit  - the unit the value is measured in
     */
    public function __construct(int $value, string $unit)
    {
        $this->value = $this->validateValue($value);
        $this->unit = $this->validateUnit($unit);
    }

    /**
     * Get the value.
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the unit.
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Validate a value. If invalid, throw an exception.
     *
     * @param $value - the amount of stuff to include
     *
     * @return int
     */
    private function validateValue($value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException("Value must be zero or greater.");
        }

        return $value;
    }

    /**
     * Validate a unit. If the unit is invalid, throw an exception.
     *
     * @param $unit - the unit
     *
     * @return string
     */
    private function validateUnit($unit)
    {
        if (strlen($unit) === 0) {
            throw new \InvalidArgumentException("Unit must be non-empty string.");
        }

        return $unit;
    }

    /**
     * Get an array representation of a BoilVolume object
     *
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