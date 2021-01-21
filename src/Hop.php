<?php

namespace Zleet\PunkAPI;

/**
 * Hop.php
 *
 * A class for creating Hop value objects
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
class Hop
{
    private $name;
    private $amount;
    private $add;
    private $attribute;

    /**
     * Hop constructor.
     *
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
     * Validate the name. If invalid, throw an exception.
     *
     * @param string $name the name of the hop
     *
     * @return string
     */
    private function validateName($name)
    {
        if (strlen($name) === 0) {
            throw new \InvalidArgumentException(
                "Name must be a non-empty string."
            );
        }
        return $name;
    }

    /**
     * Validate the add. If invalid, throw an exception.
     *
     * @param string $add The add to be used in brewing the beer
     *
     * @return string
     */
    private function validateAdd($add)
    {
        if (strlen($add) === 0) {
            throw new \InvalidArgumentException(
                "Add must be a non-empty string."
            );
        }

        return $add;
    }

    /**
     * Get the attribute.
     *
     * @param string $attribute
     *
     * @return string
     */
    private function validateAttribute($attribute)
    {
        if (strlen($attribute) === 0) {
            throw new \InvalidArgumentException(
                "Attribute must be a non-empty string."
            );
        }

        return $attribute;
    }

    /**
     * Get the name of the hop.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the amount of the hop.
     *
     * @return Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the add.
     *
     * @return string
     */
    public function getAdd()
    {
        return $this->add;
    }

    /**
     * Get the attribute.
     *
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Get an array representation of the Hop value object.
     *
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

    /**
     * Build a Hop object from an array in the form:
     * [
     *  "name"      => "Fuggles",
     *  "amount"    => [
     *      "value" => 25,
     *      "unit"  => "grams"
     *   ],
     *  "add"       => "start",
     *  "attribute" => "bitter"
     * ]
     *
     * @param $hopInfo
     *
     * @return Hop
     */
    public static function fromArray($hopInfo)
    {
        // build an Amount object from the subarray in $hopInfo
        $amountObject = Amount::fromArray($hopInfo["amount"]);
        // build a Hop object and return it
        return new Hop(
            $hopInfo["name"],
            $amountObject,
            $hopInfo["add"],
            $hopInfo["attribute"]
        );
    }
}
