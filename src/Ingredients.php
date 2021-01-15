<?php

/**
 * A class for creating an Ingredients object.
 * An ingredients value object consists of:
 * @var array $listOfMalts - an array containing all the malts used in brewing
 * the beer (each malt is represented by a Malt object)
 * @var array $listOfHops - an array containing all the hops used in brewing the
 * beer (each hop is represented by a Hop object)
 */

namespace Zleet\PunkAPI;
use http\Exception\InvalidArgumentException;

class Ingredients
{
    private listOfMalts;
    private listOfHops;

    public function __construct(array $malts, array $hops)
    {
        // check that all of the elements in the $malts array are Malt objects
        $this->listOfMalts = validateMalts($malts);

        // check that all of the elements in the $hops array are Hop objects
        $this->listOfHops = validateHops($hops);

        // bookmark (15/1/21 at 1653)

    }

    // get malts
    // CODE HERE

    // get hops
    // CODE HERE

    // return array representation of ingredients
    // CODE HERE


}