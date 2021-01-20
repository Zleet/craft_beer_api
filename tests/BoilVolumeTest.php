<?php

namespace Zleet\PunkAPI;

/**
 * BoilVolumeTest.php
 *
 * A class for testing BoilVolume value objects.
 *
 * PHP version 7.3
 *
 * @category Tests
 * @package  Punk_API
 * @author   Michael McLarnon <michaelmclarnon@hotmail.co.uk>
 * @license  MIT License
 * @version  GIT: @0.1
 * @link     https://www.usedcarsni.com
 */
class BoilVolumeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test creating a BoilVolume object.
     */
    public function testClassCreation()
    {

        $boilVolume = new BoilVolume(15, "litres");

        $this->assertInstanceOf(BoilVolume::class, $boilVolume);
    }

    /**
     * Test getting the value from a BoilVolume object
     */
    public function testGetValue()
    {

        $boilVolume = new BoilVolume(99, "millilitres");

        $this->assertEquals(99, $boilVolume->getValue(), "Value returned from BoilVolume object was incorrect.");
    }

    /**
     * Test getting the unit from a BoilVolume object
     */
    public function testGetUnit()
    {

        $boilVolume = new BoilVolume(82, "litres");
        $this->assertEquals('litres', $boilVolume->getUnit(), "Unit returned from BoilVolume object was incorrect.");
    }

    /**
     * Test getting an array representation of a BoilVolume object.
     */
    public function testConvertBoilVolumeToArray()
    {

        $boilVolume = new BoilVolume(34, "litres");

        $arrayBoilVolume = $boilVolume->toArray();

        // check that arrayBoilVolume is an array
        $this->assertIsArray($arrayBoilVolume, "BoilVolume->toArray() does not return an array.");

        // check that arrayBoilVolume["value"] is 34
        $this->assertEquals(
            34,
            $arrayBoilVolume["value"],
            "Value in array representation of BoilVolume object is"
            . " incorrect."
        );

        // check that arrayBoilVolume["unit"] is "litres"
        $this->assertEquals(
            "litres",
            $arrayBoilVolume["unit"],
            "Unit in array representation of BoilVolume object is"
            . " incorrect."
        );
    }

    /**
     * Test creating a BoilVolume object from an array.
     *
     */
    public function testCreatingABoilVolumeFromAnArray()
    {
        $boilVolumeArray = [
            "value" => 25,
            "unit"  => "litres"
        ];

        $boilVolumeObject = BoilVolume::fromArray($boilVolumeArray);

        $this->assertInstanceOf(
            BoilVolume::class,
            $boilVolumeObject,
            "BoilVolume::fromArray() does not return a BoilVolume object."
        );
    }
}
