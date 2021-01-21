<?php

namespace Zleet\PunkAPI;

/**
 * Volume.php
 *
 * A class for creating Volume objects.
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
class Volume
{
    private $value;
    private $unit;

    /**
     * Volume constructor.
     *
     * @param int    $value the amount
     * @param string $unit  the unit the value is measured in
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
     * Validate the value.
     *
     * @param int $value the value
     *
     * @return int
     */
    private function validateValue($value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException(
                "Value must be zero or greater."
            );
        }

        return $value;
    }

    /**
     * Validate the unit.
     *
     * @param string $unit the unit
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
     * Get an array representation of the Volume object.
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

    /**
     * Build a new Volume object from an array.
     *
     * @param array $volumeInfo The information required for building a new
     *                          Volume object
     *
     * @return Volume
     */
    public static function fromArray($volumeInfo)
    {
        return new Volume($volumeInfo["value"], $volumeInfo["unit"]);
    }
}
