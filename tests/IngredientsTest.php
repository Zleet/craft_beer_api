<?php

namespace Zleet\PunkAPI;

/**
 * Class IngredientsTest
 * @package Zleet\PunkAPI
 *
 * Tests for the Hop class
 */
class IngredientsTest extends \PHPUnit\Framework\TestCase
{
    // private property to hold an Ingredients object for testing
    private $ingredientsObject;

    /**
     * Set up the Ingredients object for testing
     */
    protected function setUp(): void
    {
        // build an array of Malt objects
        $bunchOfMalts = [
            new Malt('Spicy Malt', new Amount(3.4, 'kilograms')),
            new Malt('Odd Malt', new Amount(500, 'grams')),
            new Malt('Curious Malt', new Amount(9, 'kilograms'))
        ];

        // build an array of Hop objects
        $bunchOfHops = [
            new Hop('Stinky Hop', new Amount(25, 'grams'), 'start', 'bitter'),
            new Hop('Tasty Hop', new Amount(39, 'grams'), 'middle', 'flavour'),
            new Hop('Horrible Hop', new Amount(42, 'grams'), 'middle', 'flavour')
        ];

        // create a new Ingredients object for testing
        $this->ingredientsObject = new Ingredients(
            $bunchOfMalts, $bunchOfHops, "Golden yeast");
    }

    /**
     * Test creating an Ingredients class
     */
    public function testClassCreation()
    {
        $this->assertInstanceOf(Ingredients::class, $this->ingredientsObject);
    }

    /**
     * Test getting the list of malts from an Ingredients object
     */
    public function testGettingMalts()
    {
        $malts = $this->ingredientsObject->getMalts();

        // check that $malts is an array
        $this->assertIsArray($malts, "Ingredients->getMalts() does not return an array");

        // check that all the elements in the array $malts are Malt objects
        foreach ($malts as $malt) {
            $this->assertInstanceOf(Malt::class, $malt, 'Not all elements in the array returned by Ingredients->getMalts() are Malt objects.');
        }
    }

    /**
     * Test getting the hops from an Ingredients object
     */
    public function testGettingTheHops()
    {
        $hops = $this->ingredientsObject->getHops();

        // check that $hops is an array
        $this->assertIsArray($hops, "Ingredients->getHops() does not return an array");

        // check that all the elements in the array $hops are Hop objects
        foreach ($hops as $hop) {
            $this->assertInstanceOf(Hop::class, $hop, 'Not all elements in the array returned by Ingredients->getHops() are Hop objects.');
        }
    }

    /**
     * Test getting the yeast from an Ingredients object
     */
    public function testGettingTheYeast()
    {
        // check that getYeast() returns a string
        $this->assertIsString($this->ingredientsObject->getYeast(), 'Ingredients->getYeast() does not return a string.');
        // check that getYeast() returns a non-empty string
        $this->assertNotEmpty($this->ingredientsObject->getYeast(), 'Ingredients->getYeast() returns an empty string.');
    }

    /**
     * Test getting an array representation of an Ingredients object
     */
    public function testGettingIngredientsAsArray()
    {
        // check array is returned
        $this->assertIsArray($this->ingredientsObject->toArray(), 'Ingredients->toArray() does not return an array.');

        // check that the array returned is not empty
        $this->assertNotEmpty($this->ingredientsObject->toArray(), "Ingredients->toArray() returns an empty array.");

        // test print
        echo "\nIngredients:\n";
        print_r($this->ingredientsObject->toArray());
        echo "\n";
    }

}