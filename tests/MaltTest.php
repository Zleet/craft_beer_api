<?php

use Zleet\PunkAPI\Malt;
use Zleet\PunkAPI\Amount;

class MaltTest extends \PHPUnit\Framework\TestCase
{
    public function testClassCreation()
    {
        $amount = new Amount(15, "grams");
        $malt = new Malt("Zleet's Tasty Malt", $amount);

        $this->assertInstanceOf(Malt::class, $malt);
    }

    public function testGetName()
    {
        $amount = new Amount(15, "grams");
        $malt = new Malt("Zleet's Tasty Malt", $amount);

        $this->assertEquals("Zleet's Tasty Malt", $malt->getName(), "Name returned from Malt is incorrect.");
    }

    public function testGetAmount()
    {
        $amount = new Amount(15, "grams");
        $malt = new Malt("Zleet's Tasty Malt", $amount);

        $this->assertInstanceOf(Amount::class, $malt->getAmount(), "getAmount() does not return an Amount object from the Malt object.");
    }

    public function testConvertMaltToArray()
    {
        $amount = new Amount(15, "grams");
        $malt = new Malt("Zleet's Tasty Malt", $amount);

        $arrayMalt = $malt->toArray();

        // check that $arrayMalt is an array
        $this->assertIsArray($arrayMalt, "malt->toArray() does not return an array.");
    }
    
}