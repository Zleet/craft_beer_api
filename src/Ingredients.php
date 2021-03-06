<?php

namespace Zleet\PunkAPI;

/**
 * Ingredients.php
 *
 * A class for creating Ingredients objects.
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
class Ingredients
{
    private $listOfMalts;
    private $listOfHops;
    private $yeast;

    /**
     * Ingredients constructor.
     * @param array  $malts an array containing all the malts used in brewing
     *                      the beer (each malt is represented by a Malt object)
     * @param array  $hops  an array containing all the hops used in brewing the
     *                      beer (each hop is represented by a Hop object)
     * @param string $yeast the yeast used in brewing the beer
     */
    public function __construct(array $malts, array $hops, string $yeast)
    {
        // check that all of the elements in the $malts array are Malt objects
        $this->listOfMalts = $this->validateMalts($malts);
        // check that all of the elements in the $hops array are Hop objects
        $this->listOfHops = $this->validateHops($hops);
        $this->yeast = $yeast;
    }

    /**
     * Check that the $malts parameter passed to the Ingredients constructor
     * is an array of Malt objects
     *
     * @param array $malts
     *
     * @return array
     */
    private function validateMalts($malts)
    {
        foreach ($malts as $malt) {
            if (get_class($malt) != 'Zleet\PunkAPI\Malt') {
                throw new \InvalidArgumentException("Not all elements in the malts array are malts objects.");
            }
        }

        return $malts;
    }

    /**
     * Check that the $hops parameter passed to the Ingredients constructor
     * is an array of Hop objects
     *
     * @param array $hops
     *
     * @return array
     */
    private function validateHops($hops)
    {
        foreach ($hops as $hop) {
            if (get_class($hop) != 'Zleet\PunkAPI\Hop') {
                throw new \InvalidArgumentException('Not all elements in the hops array are hops objects.');
            }
        }

        return $hops;
    }

    /**
     * Get the malts used to brew the beer.
     *
     * @return array - an array of Malt objects
     */
    public function getMalts()
    {
        return $this->listOfMalts;
    }

    /**
     * Get the hops used to brew the beer.
     *
     * @return array - an array of Hop objects
     */
    public function getHops()
    {
        return $this->listOfHops;
    }

    /**
     * Get the yeast used to brew the beer.
     *
     * @return string
     */
    public function getYeast()
    {
        return $this->yeast;
    }

    /**
     * Get an array representation of the ingredients used to brew the beer.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            "malt"  => $this->listOfMalts,
            "hops"  => $this->listOfHops,
            "yeast" => $this->yeast
        ];
    }

    /**
     * Build a new Ingredients object from an array.
     *
     * @param array $ingredientsArray
     *
     * @return Ingredients
     */
    public static function fromArray($ingredientsArray)
    {
        // build an array of Malt objects from the subarray
        $maltsSubarray = $ingredientsArray["malt"];
        $maltObjects = [];
        foreach ($maltsSubarray as $singleMaltInfo) {
            $malt = Malt::fromArray($singleMaltInfo);
            $maltObjects[] = $malt;
        }

        // build an array of Hop objects from the subarray
        $hopsSubarray = $ingredientsArray["hops"];
        $hopObjects = [];
        foreach ($hopsSubarray as $singleHopInfo) {
            $hop = Hop::fromArray($singleHopInfo);
            $hopObjects[] = $hop;
        }

        return new Ingredients(
            $maltObjects,
            $hopObjects,
            $ingredientsArray["yeast"]
        );
    }
}
