<?php

/**
 * A class for creating Hop value objects.
 * @var string $name      - the name of the hop
 * @var Amount $amount    - the amount of the hop
 * @var string $add       - the point at which the hop is added in the brewing
 *                          process
 * @var string $attribute - flavour attribute of the hop
 */

namespace Zleet\PunkAPI;
use http\Exception\InvalidArgumentException;

class Hop
{
    private $name;
    private $amount;
    private $add;
    private $attribute;

    /**
     * Hop constructor.
     * @param string $name      - the name of the Hop
     * @param Amount $amount    - the amount of the hop to use
     * @param string $add       - when to add the hop in the brewing process
     * @param string $attribute - an attribute of the hop
     */
    public function __construct(
        string $name,
        Amount $amount,
        string $add,
        string $attribute
    ) {
        $this->name = $this->validateName($name);
        $this->add = $this->validateAdd($add);
        $this->attribute = $this->validateAttribute($attribute);

        // no validation required for value object
        $this->amount = $amount;
    }

    /**
     * @param $name
     */
    private function validateName($name)
    {
        if (strlen($name) === 0) throw new \InvalidArgumentException("Name must be a non-empty string.");

        return $name;
    }

    /**
     * @param $add
     */
    private function validateAdd($add)
    {
        if (strlen($add) === 0) throw new \InvalidArgumentException("Add must be a non-empty string.");

        return $add;
    }

    /**
     * @param $attribute
     */
    private function validateAttribute($attribute)
    {
        if (strlen($attribute) === 0) throw new \InvalidArgumentException("Attribute must be a non-empty string.");

        return $attribute;
    }

    /**
     * @return string
     */
    public function getName() {

        return $this->name;
    }

    /**
     * @return Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getAdd()
    {
        return $this->add;
    }

    /**
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name'      => $this->name,
            'amount'    => $this->amount,
            'add'       => $this->add,
            'attribute' => $this->attribute
        ];
    }

}