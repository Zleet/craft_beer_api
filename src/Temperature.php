<?php

namespace Zleet\PunkAPI;

/**
 * Temperature.php
 *
 * A class for creating Temperature value objects.
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
class Temperature
{
    private $value;
    private $unit;

    /**
     * Temperature constructor
     *
     * @param int|null $value the amount
     * @param string   $unit  the unit the value is measured in
     */
    public function __construct($value, string $unit)
    {
        $this->value = $this->validateValue($value);
        $this->unit = $this->validateUnit($unit);
    }

    /**
     * Validate the date. If it's invalid, throw an exception.
     *
     * @param int|null $value
     *
     * @return int|null
     */
    private function validateValue($value)
    {
        if ((!is_numeric($value)) && (!is_null($value))) {
            throw new \InvalidArgumentException(
                "Value must be either null or an integer."
                . " Instead, " . $value . " is a " . gettype($value)
            );
        }

        $value = (int)$value;

        if ((is_integer($value)) && ($value < 0)) {
            throw new \InvalidArgumentException(
                "Integer value must be zero or greater."
            );
        }

        return $value;
    }

    /**
     * Validate the unit. If it's an empty string, throw an exception.
     *
     * @param $unit
     *
     * @return string
     */
    private function validateUnit($unit)
    {
        if (strlen($unit) === 0) {
            throw new \InvalidArgumentException(
                "Unit must be non-empty string."
            );
        }

        return $unit;
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
     * Get an array representation of the Temperature object.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            "value" => $this->value,
            "unit"  => $this->unit
        ];
    }

    /**
     * Build a Temperature object from an array in the format:
     * [
     *  "value" => 19,
     *  "unit"  => "celsius"
     * ]
     *
     * @param $temperatureArray
     *
     * @return Temperature
     */
    public static function fromArray($temperatureArray)
    {
        return new Temperature(
            $temperatureArray["value"],
            $temperatureArray["unit"]
        );
    }
}
