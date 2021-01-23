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
class BeerCollection implements \Countable, \Iterator, \ArrayAccess
{
    /**
     * @var array $beers  an array to hold all the Beer objects
     * @var int $position current position we're at in the BeerCollection
     */
    private $beers = [];
    private $position = 0;

    /**
     * BeerCollection constructor.
     * If no array is passed into the constructor, create a BeerCollection
     * with zero Beers in it. If an array of Beers is passed into the
     * constructor, create a BeerCollection using the Beer objects in the array.
     *
     * @param array $mightBeBeers
     */
    public function __construct(array $mightBeBeers = [])
    {
        $beers = $this->validateBeers($mightBeBeers);

        foreach ($mightBeBeers as $beer) {
            $this->offsetSet('', $beer);
        }
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

    /**
     * Implementation of method declared in \Countable
     *
     * @return int
     */
    public function count()
    {
        return count($this->beers);
    }

    /**
     * Implementation of method declared in \Iterator
     * Resets the internal cursor to the beginning of the array
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Implementation of method declared in \Iterator
     * Used to get the current key (as for instance in a foreach()-structure
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Implementation of method declared in \Iterator
     * Used to get the value at the current cursor position
     */
    public function current()
    {
        return $this->beers[$this->position];
    }

    /**
     * Implementation of method declared in \Iterator
     * Used to move the cursor to the next position
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * Implementation of method declared in \Iterator
     * Checks if the current cursor position is valid
     */
    public function valid()
    {
        return isset($this->beers[$this->position]);
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used to be able to use functions like isset()
     */
    public function offsetExists($offset)
    {
        return isset($this->beers[$offset]);
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for direct access array-like ($collection[$offset]);
     */
    public function offsetGet($offset)
    {
        return $this->beers[$offset];
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for direct setting of values
     */
    public function offsetSet($offset, $mightBeBeer)
    {
        if (get_class($mightBeBeer) != 'Zleet\PunkAPI\Beer') {
            throw new \InvalidArgumentException(
                "The second parameter passed to "
                . "BeerCollection->offsetSet() must be a Beer object."
            );
        }

        if (empty($offset)) { //this happens when you do $BeerCollection[] = 1;
            $this->beers[] = $mightBeBeer;
        } else {
            $this->beers[$offset] = $mightBeBeer;
        }
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for unset()
     */
    public function offsetUnset($offset)
    {
        unset($this->beers[$offset]);
    }
}
