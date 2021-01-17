<?php

/**
 * A class for creating Malt value objects.
 * @var string $name - the name of the malt
 * @var Amount $amount - an amount object representing the amount of the
 *                       malt to be included as an ingredient
 */

namespace Zleet\PunkAPI;
use http\Exception\InvalidArgumentException;

class Malt
{
    private $name;
    private $amount;

    /**
     * Malt constructor.
     * @param string $name   - the name of the malt
     * @param Amount $amount - the amount of the malt
     */
    public function __construct(string $name, Amount $amount)
    {
        $this->name = $this->validateName($name);
        $this->amount = $amount;
    }

    /**
     * @param $name  - malt name to validate
     * @return string
     */
    private function validateName($name)
    {
        if (!is_string($name)) throw new \InvalidArgumentException("Name must be a string.");
        if (strlen($name) === 0) throw new \InvalidArgumentException("Name must not be an empty string.");

        return $name;
    }

    /**
     * @return string - the name of the malt
     */

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Amount - the amount of the Malt
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
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