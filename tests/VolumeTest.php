<?php

use Zleet\PunkAPI\Volume;

class VolumeTest extends \PHPUnit\Framework\TestCase
{
    public function testClassCreation() {

        $volume = new Volume(15, "litres");

        $this->assertInstanceOf(Volume::class, $volume);
    }

    public function testGetValue() {

        $volume = new Volume(99, "millilitres");

        $this->assertEquals(99, $volume->getValue(),
            "Value returned from volume object was incorrect.");
    }

    public function testGetUnit() {

        $volume = new Volume(82, "litres");

        $this->assertEquals('litres', $volume->getUnit(),
            "Unit returned from volume object was incorrect.");
    }

    public function testConvertVolumeToArray() {

        $volume = new Volume(34, "litres");

        $arrayVolume = $volume->toArray();

        // check that arrayVolume is an array
        $this->assertIsArray($arrayVolume,
            "volume->toArray() does not return an array.");

        // check that arrayVolume["value"] is 34
        $this->assertEquals(34, $arrayVolume["value"],
            "Value in array representation of Volume object is incorrect.");

        // check that arrayVolume["unit"] is "litres"
        $this->assertEquals("litres", $arrayVolume["unit"],
    "Unit in array representation of Volume object is incorrect.");
    }

}