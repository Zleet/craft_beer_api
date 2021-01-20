<?php

namespace Zleet\PunkAPI;

// bookmark



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
     * @param $malts
     * @return mixed
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
     * @param $hops
     * @return mixed
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
     * @return array - an array of Malt objects
     */
    public function getMalts()
    {
        return $this->listOfMalts;
    }

    /**
     * @return array - an arrya of Hop objects
     */
    public function getHops()
    {
        return $this->listOfHops;
    }

    /**
     * @return string
     */
    public function getYeast()
    {
        return $this->yeast;
    }

    /**
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
}
