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
}