<?php

namespace Zleet\PunkAPI;

/**
 * Class HopTest
 * @package Zleet\PunkAPI
 *
 * Tests for the Hop class
 */
class HopTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test creating a class
     */
    public function testClassCreation()
    {
        $amount = new Amount(14, "grams");
        $hop = new Hop("Zleet's Tasty Hop", $amount, "start",
            "bitter");

        $this->assertInstanceOf(Hop::class, $hop);
    }

    /**
     * Test getting the name property
     */
    public function testGettingTheName()
    {
        $amount = new Amount(14, "grams");
        $hop = new Hop("Zleet's Tasty Hop", $amount, "start",
            "bitter");

        $this->assertEquals("Zleet's Tasty Hop", $hop->getName(), 'getName() does not return correct hop name.');
    }

    /**
     * Test getting the amount
     */
    public function testGettingTheAmount()
    {
        $amount = new Amount(14, "grams");
        $hop = new Hop("Zleet's Tasty Hop", $amount, "start",
            "bitter");

        // test that the amount returned is an Amount object
        $this->assertInstanceOf(Amount::class, $hop->getAmount(),'hop->getAmount() does not return an Amount object.');
        // test that the two values in the amount returned are correct
        $this->assertEquals(14, $hop->getAmount()->getValue(), 'The value value returned by hop->getAmount() is incorrect.');
        $this->assertEquals("grams", $hop->getAmount()->getUnit(), 'The unit value returned by hop->getAmount is incorrect.');
    }

    /**
     * Test getting the add
     */
    public function testGettingTheAdd()
    {
        $amount = new Amount(14, "grams");
        $hop = new Hop("Zleet's Tasty Hop", $amount, "start",
            "bitter");

        $this->assertEquals("start", $hop->getAdd(), "The add returned from the hop is incorrect.");
    }

    /**
     * Test getting the attribute
     */
    public function testGettingTheAttribute()
    {
        $amount = new Amount(14, "grams");
        $hop = new Hop("Zleet's Tasty Hop", $amount, "start",
            "bitter");

        $this->assertEquals("bitter", $hop->getAttribute(), "The attribute returned from the hop is incorrect.");
    }

    /**
     *  Test getting the hop as an array
     */
    public function testGettingHopAsArray()
    {
        $amount = new Amount(14, "grams");
        $hop = new Hop("Zleet's Tasty Hop", $amount, "start",
            "bitter");

        $this->assertIsArray($hop->toArray(), 'Hop->toArray() does not return an array.');
    }

}