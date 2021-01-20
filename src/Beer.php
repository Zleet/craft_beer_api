<?php

namespace Zleet\PunkAPI;

/**
 * Beer.php
 *
 * A class for use with the Punk API for accessing beer information.
 * A Beer object represents a single beer.
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
class Beer
{
    private $id;
    private $name;
    private $tagline;
    private $firstBrewed;
    private $description;
    private $imageUrl;
    private $abv;
    private $ibu;
    private $targetFg;
    private $targetOg;
    private $ebc;
    private $srm;
    private $ph;
    private $attenuationLevel;
    private $volume;
    private $boilVolume;
    private $method;
    private $ingredients;
    private $foodPairing;
    private $brewersTips;
    private $contributedBy;

    /**
     * Beer constructor.
     *
     * @param int         $id               unique beer ID number
     * @param string      $name             the name of the beer
     * @param string      $tagline          the beer tagline
     * @param string      $firstBrewed      date when beer was first brewed
     * @param string      $description      a short description of the beer
     * @param string      $imageUrl         the url of a photo of the beer
     * @param float       $abv              alcoholic strength of the beer
     * @param int         $ibu              beer ibu
     * @param int         $targetFg         beer target FG
     * @param int         $targetOg         beer target OG
     * @param int         $ebc              beer ebc
     * @param int         $srm              beer srm
     * @param float       $ph               beer ph
     * @param int         $attenuationLevel beer attenuation level
     * @param Volume      $volume           beer volume
     * @param BoilVolume  $boilVolume       boil volume
     * @param Method      $method           description of the beer brewing
     *                                      method
     * @param Ingredients $ingredients      list of ingredients used to brew
     *                                      the beer
     * @param array       $foodPairing      list of foods to enjoy with the
     *                                      beer
     * @param string      $brewersTips      tips for brewers
     * @param string      $contributedBy    contributor who submitted the beer
     *                                      information
     */
    public function __construct(
        int $id,
        string $name,
        string $tagline,
        string $firstBrewed,
        string $description,
        string $imageUrl,
        float $abv,
        int $ibu,
        int $targetFg,
        int $targetOg,
        int $ebc,
        int $srm,
        float $ph,
        int $attenuationLevel,
        Volume $volume,
        BoilVolume $boilVolume,
        Method $method,
        Ingredients $ingredients,
        array $foodPairing,
        string $brewersTips,
        string $contributedBy
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->tagline = $tagline;
        $this->firstBrewed = $firstBrewed;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->abv = $abv;
        $this->ibu = $ibu;
        $this->targetFg = $targetFg;
        $this->targetOg = $targetOg;
        $this->ebc = $ebc;
        $this->srm = $srm;
        $this->ph = $ph;
        $this->attenuationLevel = $attenuationLevel;
        $this->volume = $volume;
        $this->boilVolume = $boilVolume;
        $this->method = $method;
        $this->ingredients = $ingredients;
        $this->foodPairing = $this->validateFoodPairing($foodPairing);
        $this->brewersTips = $brewersTips;
        $this->contributedBy = $contributedBy;
    }

    /**
     * Check that all the elements in the array $foodPairing are strings
     *
     * @param array $foodPairing a list of foods that can be enjoyed with
     *                           the beer
     *
     * @return array
     */
    private function validateFoodPairing($foodPairing)
    {
        foreach ($foodPairing as $foodPairingItem) {
            if (!is_string($foodPairingItem)) {
                throw new \InvalidArgumentException(
                    "Not all elements in the foodPairing array are strings."
                );
            }
        }

        return $foodPairing;
    }

    /**
     * Get the ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the tagline.
     *
     * @return string
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * Get the date when the beer was first brewed.
     *
     * @return string
     */
    public function getFirstBrewed()
    {
        return $this->firstBrewed;
    }

    /**
     * Get the beer description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the url for the photo of the beer.
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Get the beer ABV.
     *
     * @return float
     */
    public function getAbv()
    {
        return $this->abv;
    }

    /**
     * Get the beer IBU.
     *
     * @return int
     */
    public function getIbu()
    {
        return $this->ibu;
    }

    /**
     * Get the beer target FG
     *
     * @return int
     */
    public function getTargetFg()
    {
        return $this->targetFg;
    }

    /**
     * Get the beet target OG
     *
     * @return int
     */
    public function getTargetOg()
    {
        return $this->targetOg;
    }

    /**
     * Get the beer EBC
     *
     * @return int
     */
    public function getEbc()
    {
        return $this->ebc;
    }

    /**
     * Get the beer SRM
     *
     * @return int
     */
    public function getSrm()
    {
        return $this->srm;
    }

    /**
     * Get the beer PH
     *
     * @return float
     */
    public function getPh()
    {
        return $this->ph;
    }

    /**
     * Get the beer attenuation level
     *
     * @return int
     */
    public function getAttenuationLevel()
    {
        return $this->attenuationLevel;
    }

    /**
     * Get the beer volume
     *
     * @return Volume
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Get the boil volume for brewing the beer
     *
     * @return BoilVolume
     */
    public function getBoilVolume()
    {
        return $this->boilVolume;
    }

    /**
     * Get the beer brewing method
     *
     * @return Method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get an array containing the beer ingredients
     *
     * @return Ingredients
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Get an array containing a list of foods that can be enjoyed with the
     * beer.
     *
     * @return array
     */
    public function getFoodPairing()
    {
        return $this->foodPairing;
    }

    /**
     * Get the brewers tips.
     *
     * @return string
     */
    public function getBrewersTips()
    {
        return $this->brewersTips;
    }

    /**
     * Get information about the person who contributed the beer information.
     *
     * @return string
     */
    public function getContributedBy()
    {
        return $this->contributedBy;
    }

    //static function fromArray(array $beerInfo) {

    // }
}
