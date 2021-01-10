<?php

/**
 * A class for use with the Punk API for accessing beer information.
 * A Beer object represents a single beer.
 */
namespace Zleet\PunkAPI;

use GuzzleHttp\Client;

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

    public function __construct() {
        // code here
    }

    public function setId($id)
    {
        if (is_integer($id)) {
            $this->id = $id;
        }
    }

    public function getId()
    {

        return $this->id;
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    public function getName()
    {

        return $this->name;
    }

    public function setTagline($tagline)
    {
        if (is_string($tagline)) {
            $this->tagline = $tagline;
        }
    }

    public function getTagline()
    {

        return $this->tagline;
    }

    public function setFirstBrewed($firstBrewed)
    {
        if (is_string($firstBrewed)) {
            $this->firstBrewed = $firstBrewed;
        }
    }

    public function getFirstBrewed()
    {

        return $this->firstBrewed;
    }

    public function setDescription($description)
    {
        if (is_string($description)) {
            $this->description = $description;
        }
    }

    public function getDescription()
    {

        return $this->description;
    }

    public function setImageUrl($imageUrl)
    {
        if (is_string($imageUrl)) {
            $this->imageUrl = $imageUrl;
        }
    }

    public function getImageUrl()
    {

        return $this->imageUrl;
    }

    public function setAbv($abv)
    {
        if (is_float($abv)) {
            $this->abv = $abv;
        }
    }

    public function getAbv()
    {

        return $this->abv;
    }

    public function setIbu($ibu)
    {
        if (is_integer($ibu)) {
            $this->ibu = $ibu;
        }
    }

    public function getIbu()
    {

        return $this->ibu;
    }

    public function setTargetFg($targetFg)
    {
        if (is_integer($targetFg)) {
            $this->targetFg = $targetFg;
        }
    }

    public function getTargetFg()
    {

        return $this->targetFg;
    }

    public function setTargetOg($targetOg)
    {
        if (is_integer($targetOg)) {
            $this->targetOg = $targetOg;
        }
    }

    public function getTargetOg()
    {

        return $this->targetOg;
    }

    public function setEbc($ebc)
    {
        if (is_integer($ebc)) {
            $this->ebc = $ebc;
        }
    }

    public function getEbc()
    {

        return $this->ebc;
    }

    public function setSrm($srm)
    {
        if (is_integer($srm)) {
            $this->srm = $srm;
        }
    }

    public function getSrm()
    {

        return $this->srm;
    }

    public function setPh($ph)
    {
        if (is_float($ph)) {
            $this->ph = $ph;
        }
    }

    public function getPh()
    {

        return $this->ph;
    }

    public function setAttenuationLevel($attenuationLevel)
    {
        if (is_integer($attenuationLevel)) {
            $this->attenuationLevel = $attenuationLevel;
        }
    }

    public function getAttenuationLevel()
    {

        return $this->attenuationLevel;
    }

    public function setVolume($volume)
    {
        if (is_array($volume)) {
            $this->volume = $volume;
        }
    }

    public function getVolume()
    {

        return $this->volume;
    }

    public function setBoilVolume($boilVolume)
    {
        if (is_array($boilVolume)) {
            $this->boilVolume = $boilVolume;
        }
    }

    public function getBoilVolume()
    {

        return $this->boilVolume;
    }

    public function setMethod($method)
    {
        if (is_array($method)) {
            $this->method = $method;
        }
    }

    public function getMethod()
    {

        return $this->method;
    }

    public function setIngredients($ingredients)
    {
        if (is_array($ingredients)) {
            $this->ingredients = $ingredients;
        }
    }

    public function getIngredients()
    {

        return $this->ingredients;
    }

    public function setFoodPairing($foodPairing)
    {
        if (is_array($foodPairing)) {
            $this->foodPairing = $foodPairing;
        }
    }

    public function getFoodPairing()
    {

        return $this->foodPairing;
    }

    public function setBrewersTips($brewersTips)
    {
        if (is_string($brewersTips)) {
            $this->brewersTips = $brewersTips;
        }
    }

    public function getBrewersTips()
    {

        return $this->brewersTips;
    }

    public function setContributedBy($contributedBy)
    {
        if (is_string($contributedBy)) {
            $this->contributedBy = $contributedBy;
        }
    }

    public function getContributedBy()
    {

        return $this->contributedBy;
    }

}