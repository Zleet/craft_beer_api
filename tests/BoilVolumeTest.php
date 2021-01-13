<?php

use Zleet\PunkAPI\BoilVolume;

class BoilVolumeTest extends \PHPUnit\Framework\TestCase
{
    public function testClassCreation() {

        $boilVolume = new BoilVolume(15, "litres");

        $this->assertInstanceOf(BoilVolume::class, $boilVolume);
    }

    public function testGetValue() {

        $boilVolume = new BoilVolume(99, "millilitres");

        $this->assertEquals(99, $boilVolume->getValue(), "Value returned from BoilVolume object was incorrect.");
    }

    public function testGetUnit() {

        $boilVolume = new BoilVolume(82, "litres");
        $this->assertEquals('litres', $boilVolume->getUnit(), "Unit returned from BoilVolume object was incorrect.");
    }

    public function testConvertBoilVolumeToArray() {

        $boilVolume = new BoilVolume(34, "litres");

        $arrayBoilVolume = $boilVolume->toArray();

        // check that arrayBoilVolume is an array
        $this->assertIsArray($arrayBoilVolume, "BoilVolume->toArray() does not return an array.");

        // check that arrayBoilVolume["value"] is 34
        $this->assertEquals(34, $arrayBoilVolume["value"], "Value in array representation of BoilVolume object is incorrect.");

        // check that arrayBoilVolume["unit"] is "litres"
        $this->assertEquals("litres", $arrayBoilVolume["unit"], "Unit in array representation of BoilVolume object is incorrect.");
    }

}