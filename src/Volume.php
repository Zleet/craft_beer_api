<?php

/**
 * A class for creating Volume value objects.
 * @var integer/float $value - the amount of stuff to include
 * @var string $unit - the units in which $value is mesaured
*/

namespace Zleet\PunkAPI;

use http\Exception\InvalidArgumentException;

class Volume
{
    private $value;
    private $unit;

    public function __construct($value, string $unit) {

        // test for non-numeric $value
        if (
            (!(is_integer($value)))
            &&
            (!(is_float($value)))
        ) {
            throw new InvalidArgumentException(
                "Value must be numeric (integer or float)");
        }
        // test for negative $value
        if ($value < 0) {
            throw new InvalidArgumentException(
                "Value must be zero or greater.");
        }

        // if we've fallen through, $value is ok
        $this->value = $value;

        // test for string $unit
        if (!is_string($unit)) {
            throw new InvalidArgumentException(
                "Unit must be a string.");
        }

        // test for non-empty string
        if (strlen($unit) === 0) {
            throw new InvalidArgumentException(
                "Unit must be non-empty string.");
        }

        // if we've fallen through, $unit is ok
        $this->unit = $unit;
    }

    public function getValue() {

        return $this->value;
    }

    public function getUnit() {

        return $this->unit;
    }

    public function toArray()
    {
        return [
            'value' => $this->value,
            'unit'  => $this->unit
        ];
    }

}