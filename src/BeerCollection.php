<?php

namespace Zleet\PunkAPI;

/**
* BeerCollection.php
*
* A class for creating Beer collection objects.
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
class BeerCollection
{
    /**
     * @var array an array to hold all the Beer objects
     */
    private $beers = [];

    /**
     * BeerCollection constructor.
     *
     * @param array $mightBeBeers
     */
    public function __construct(array $mightBeBeers)
    {
        $this->beers = $this->validateBeers($mightBeBeers);
    }

    /**
     * Check that all of the elements in the array $mightBeBeers
     * are Beer objects. If not, throw an exception.
     *
     * @param array $mightBeBeers
     *
     * @return array
     */
    private function validateBeers(array $mightBeBeers)
    {
        foreach ($mightBeBeers as $potentialBeer) {
            // test print the class of $potentialBeer
            if (get_class($potentialBeer) != 'Zleet\PunkAPI\Beer') {
                throw new InvalidArgumentException(
                    'Not all elements in the array mightBeBeers are Beer objects.'
                );
            }
        }

        return $mightBeBeers;
    }




}