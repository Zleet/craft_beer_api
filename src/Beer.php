<?php

/**
 * A class for use with the Punk API for accessing beer information.
 * A Beer object represents a single beer.
 */
namespace Zleet\PunkAPI;

use GuzzleHttp\Client;
use http\Exception\InvalidArgumentException;

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
     * @param int $id
     * @param string $name
     * @param string $tagline
     * @param string $firstBrewed
     * @param string $description
     * @param string $imageUrl
     * @param float $abv
     * @param int $ibu
     * @param int $targetFg
     * @param int $targetOg
     * @param int $ebc
     * @param int $srm
     * @param float $ph
     * @param int $attenuationLevel
     * @param Volume $volume
     * @param BoilVolume $boilVolume
     * @param Method $method
     * @param Ingredients $ingredients
     * @param array $foodPairing
     * @param string $brewersTips
     * @param string $contributedBy
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
     * @param array $foodPairing
     * @return array
     * Check that all the elements in the array $foodPairing are strings
     */
    private function validateFoodPairing($foodPairing)
    {
        foreach ($foodPairing as $foodPairingItem) {
            if (!is_string($foodPairingItem)) {
                throw new \InvalidArgumentException("Not all elements in the foodPairing array are strings.");
            }
        }

        return $foodPairing;
    }

    /**
     * =======================
     * BUNCH OF GETTER METHODS
     * =======================
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * @return string
     */
    public function getFirstBrewed()
    {
        return $this->firstBrewed;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @return float
     */
    public function getAbv()
    {
        return $this->abv;
    }

    /**
     * @return int
     */
    public function getIbu()
    {
        return $this->ibu;
    }

    /**
     * @return int
     */
    public function getTargetFg()
    {
        return $this->targetFg;
    }

    /**
     * @return int
     */
    public function getTargetOg()
    {
        return $this->targetOg;
    }

    /**
     * @return int
     */
    public function getEbc()
    {
        return $this->ebc;
    }

    /**
     * @return int
     */
    public function getSrm()
    {
        return $this->srm;
    }

    /**
     * @return float
     */
    public function getPh()
    {
        return $this->ph;
    }

    /**
     * @return int
     */
    public function getAttenuationLevel()
    {
        return $this->attenuationLevel;
    }

    /**
     * @return Volume
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @return BoilVolume
     */
    public function getBoilVolume()
    {
        return $this->boilVolume;
    }

    /**
     * @return Method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return Ingredients
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @return array
     */
    public function getFoodPairing()
    {
        return $this->foodPairing;
    }

    /**
     * @return string
     */
    public function getBrewersTips()
    {
        return $this->brewersTips;
    }

    /**
     * @return string
     */
    public function getContributedBy()
    {
        return $this->contributedBy;
    }

    //static function fromArray(array $beerInfo) {

    // }

}