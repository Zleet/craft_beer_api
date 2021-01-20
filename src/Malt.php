<?php

namespace Zleet\PunkAPI;

/**
 * Malt.php
 *
 * A class for creating Malt value objects.
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
class Malt
{
    private $name;
    private $amount;

    /**
     * Malt constructor.
     *
     * @param string $name   the name of the malt
     * @param Amount $amount the amount of the malt to be included when
     *                       brewing the beer
     */
    public function __construct(string $name, Amount $amount)
    {
        $this->name = $this->validateName($name);
        $this->amount = $amount;
    }

    /**
     * Validate the name.
     *
     * @param string $name malt name to validate
     *
     * @return string
     */
    private function validateName($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException("Name must be a string.");
        }
        if (strlen($name) === 0) {
            throw new \InvalidArgumentException(
                "Name must not be an empty string."
            );
        }

        return $name;
    }

    /**
     * Get the name of the malt.
     *
     * @return string the name of the malt
     */

    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the amount of the malt.
     *
     * @return Amount - the amount of the Malt
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get an array representation of the Malt object.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name'      => $this->name,
            'amount'    => $this->amount
        ];
    }
}
