<?php

/**
 * Amount.php
 *
 * A class for creating Amount value objects.
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

namespace Zleet\PunkAPI;

/**
 * A class for creating Amount value objects.
 *
 * @category Components
 * @package  Punk_API
 * @author   Michael McLarnon <michaelmclarnon@hotmail.co.uk>
 * @license  MIT License
 * @version  GIT: @0.1
 * @link     https://www.usedcarsni.com
 *
 * @var integer/float $value - the amount of stuff to include
 * @var string $unit - the units in which $value is measured
 */
class Amount
{
    private $value;
    private $unit;

    /**
     * Amount constructor
     *
     * @param numeric $value - the amount
     * @param string  $unit  - the unit the value is measured in
     */
    public function __construct($value, string $unit)
    {
        $this->value = $this->validateValue($value);
        $this->unit = $this->validateUnit($unit);
    }

    /**
     * Get the value.
     *
     * @return int|string
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
     * Validate the value. If invalid, throw an exception.
     *
     * @param $value - the number of units present in the Amount
     *
     * @return int|string
     */
    private function validateValue($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException(
                "Value must be numeric (integer or float)"
            );
        }
        if ($value < 0) {
            throw new \InvalidArgumentException(
                "Value must be zero or greater."
            );
        }

        return $value;
    }

    /**
     * Validate the unit. If invalid, throw an exception.
     *
     * @param $unit - the unit in which the Amount in measured
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
     * Return an array representation of the Amount value object.
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