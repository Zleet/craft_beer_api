<?php

use Zleet\PunkAPI\Amount;

class AmountTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test creating a class
     */
    public function testClassCreation() {

        $amount = new Amount(15, "litres");

        $this->assertInstanceOf(Amount::class, $amount);
    }

    /**
     * Test getting the value property
     */
    public function testGetValue() {

        $amount = new Amount(99, "millilitres");

        $this->assertEquals(99, $amount->getValue(), "Value returned from Amount object was incorrect.");
    }

    /**
     * Test getting the unit property
     */
    public function testGetUnit() {

        $amount = new Amount(82, "litres");

        $this->assertEquals('litres', $amount->getUnit(), "Unit returned from Amount object was incorrect.");
    }

    /**
     * Test outputting an Amount object as an array
     */
    public function testConvertAmountToArray() {

        $amount = new Amount(34, "kilograms");

        $arrayAmount = $amount->toArray();

        // check that arrayAmount is an array
        $this->assertIsArray($arrayAmount, "amount->toArray() does not return an array.");

        // check that arrayAmount["value"] is 34
        $this->assertEquals(34, $arrayAmount["value"], "Value in array representation of Amount object is incorrect.");

        // check that arrayAmount["unit"] is "kilograms"
        $this->assertEquals("kilograms", $arrayAmount["unit"], "Unit in array representation of Amount object is incorrect.");
    }

}