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
        $this->id = $this->validateId($id);
        $this->name = $this->validateName($name);
        $this->tagline = $this->validateTagline($tagline);
        $this->firstBrewed = $this->validateFirstBrewed($firstBrewed);
        $this->description = $this->validateDescription($description);
        $this->imageUrl = $this->validateImageUrl($imageUrl);
        $this->abv = $this->validateAbv($abv);
        $this->ibu = $this->validateIbu($ibu);
        $this->targetFg = $this->validateTargetFg($targetFg);
        $this->targetOg = $this->validateTargetOg($targetOg);
        $this->ebc = $this->validateEbc($ebc);
        $this->srm = $this->validateSrm($srm);
        $this->ph = $this->validatePh($ph);
        $this->attenuationLevel = $this->validateAttenuationLevel($attenuationLevel);
        $this->volume = $volume;
        $this->boilVolume = $boilVolume;
        $this->method = $method;
        $this->ingredients = $ingredients;
        $this->foodPairing = $this->validateFoodPairing($foodPairing);
        $this->brewersTips = $this->validateBrewersTips($brewersTips);
        $this->contributedBy = $this->validateContributedBy($contributedBy);
    }

    /**
     * =============================================
     * BUNCH OF VALIDATION FUNCTIONS FOR THE VARIOUS
     * PARAMETERS PASSED INTO THE BEER CONSTRUCTOR
     * =============================================
     */
    private function validateId($id)
    {
        if (!is_integer($id)) {
            throw new \InvalidArgumentException("id is not an integer.");
        }
        return $id;
    }

    private function validateName($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException("name is not a string.");
        }
        return $name;
    }

    private function validateTagline($tagline)
    {
        if (!is_string($tagline)) {
            throw new \InvalidArgumentException("tagline is not a string.");
        }
        return $tagline;
    }

    private function validateFirstBrewed($firstBrewed)
    {
        if (!is_string($firstBrewed)) {
            throw new \InvalidArgumentException("firstBrewed is not a string.");
        }
        return $firstBrewed;
    }

    private function validateDescription($description)
    {
        if (!is_string($description)) {
            throw new \InvalidArgumentException("description is not a string.");
        }
        return $description;
    }

    private function validateImageUrl($imageUrl)
    {
        if (!is_string($imageUrl)) {
            throw new \InvalidArgumentException("imageUrl is not a string.");
        }
        return $imageUrl;
    }

    private function validateAbv($abv)
    {
        if (!is_float($abv)) {
            throw new \InvalidArgumentException("abv is not a float.");
        }
        return $abv;
    }

    private function validateIbu($ibu)
    {
        if (!is_integer($ibu)) {
            throw new \InvalidArgumentException("ibu is not an integer.");
        }
        return $ibu;
    }

    private function validateTargetFg($targetFg)
    {
        if (!is_integer($targetFg)) {
            throw new \InvalidArgumentException("targetFg is not an integer.");
        }
        return $targetFg;
    }

    private function validateTargetOg($targetOg)
    {
        if (!is_integer($targetOg)) {
            throw new \InvalidArgumentException("targetOg is not an integer.");
        }
        return $targetOg;
    }

    private function validateEbc($abc)
    {
        if (!is_integer($abc)) {
            throw new \InvalidArgumentException("abc is not an integer.");
        }
        return $abc;
    }

    private function validateSrm($srm)
    {
        if (!is_integer($srm)) {
            throw new \InvalidArgumentException("srm is not an integer.");
        }
        return $srm;
    }

    private function validatePh($ph)
    {
        if (!is_float($ph)) {
            throw new \InvalidArgumentException("ph is not a float.");
        }
        return $ph;
    }

    private function validateAttenuationLevel($attenuationLevel)
    {
        if (!is_integer($attenuationLevel)) {
            throw new \InvalidArgumentException("attenuationLevel is not an integer.");
        }
        return $attenuationLevel;
    }

    private function validateFoodPairing($foodPairing)
    {
        // check that $foodPairing is an array
        if (!is_array($foodPairing)) {
            throw new \InvalidArgumentException("foodPairing is not an array.");
        }

        // check that all the elements in the array $foodPairing are strings
        foreach ($foodPairing as $foodPairingItem) {
            if (!is_string($foodPairingItem)) {
                throw new \InvalidArgumentException("Not all elements in the foodPairing array are strings.");
            }
        }

        return $foodPairing;
    }

    private function validateBrewersTips($brewersTips)
    {
        if (!is_string($brewersTips)) {
            throw new \InvalidArgumentException("brewersTips is not a string.");
        }
        return $brewersTips;
    }

    private function validateContributedBy($contributedBy)
    {
        if (!is_string($contributedBy)) {
            throw new \InvalidArgumentException("contributedBy is not a string.");
        }
        return $contributedBy;
    }
    
    /**
     * =======================
     * BUNCH OF GETTER METHODS
     * =======================
     */
//    public function setId($id)
//    {
//        if (is_integer($id)) {
//            $this->id = $id;
//        }
//    }
//
//    public function getId()
//    {
//
//        return $this->id;
//    }
//
//    public function setName($name)
//    {
//        if (is_string($name)) {
//            $this->name = $name;
//        }
//    }
//
//    public function getName()
//    {
//
//        return $this->name;
//    }
//
//    public function setTagline($tagline)
//    {
//        if (is_string($tagline)) {
//            $this->tagline = $tagline;
//        }
//    }
//
//    public function getTagline()
//    {
//
//        return $this->tagline;
//    }
//
//    public function setFirstBrewed($firstBrewed)
//    {
//        if (is_string($firstBrewed)) {
//            $this->firstBrewed = $firstBrewed;
//        }
//    }
//
//    public function getFirstBrewed()
//    {
//
//        return $this->firstBrewed;
//    }
//
//    public function setDescription($description)
//    {
//        if (is_string($description)) {
//            $this->description = $description;
//        }
//    }
//
//    public function getDescription()
//    {
//
//        return $this->description;
//    }
//
//    public function setImageUrl($imageUrl)
//    {
//        if (is_string($imageUrl)) {
//            $this->imageUrl = $imageUrl;
//        }
//    }
//
//    public function getImageUrl()
//    {
//
//        return $this->imageUrl;
//    }
//
//    public function setAbv($abv)
//    {
//        if (is_float($abv)) {
//            $this->abv = $abv;
//        }
//    }
//
//    public function getAbv()
//    {
//
//        return $this->abv;
//    }
//
//    public function setIbu($ibu)
//    {
//        if (is_integer($ibu)) {
//            $this->ibu = $ibu;
//        }
//    }
//
//    public function getIbu()
//    {
//
//        return $this->ibu;
//    }
//
//    public function setTargetFg($targetFg)
//    {
//        if (is_integer($targetFg)) {
//            $this->targetFg = $targetFg;
//        }
//    }
//
//    public function getTargetFg()
//    {
//
//        return $this->targetFg;
//    }
//
//    public function setTargetOg($targetOg)
//    {
//        if (is_integer($targetOg)) {
//            $this->targetOg = $targetOg;
//        }
//    }
//
//    public function getTargetOg()
//    {
//
//        return $this->targetOg;
//    }
//
//    public function setEbc($ebc)
//    {
//        if (is_integer($ebc)) {
//            $this->ebc = $ebc;
//        }
//    }
//
//    public function getEbc()
//    {
//
//        return $this->ebc;
//    }
//
//    public function setSrm($srm)
//    {
//        if (is_integer($srm)) {
//            $this->srm = $srm;
//        }
//    }
//
//    public function getSrm()
//    {
//
//        return $this->srm;
//    }
//
//    public function setPh($ph)
//    {
//        if (is_float($ph)) {
//            $this->ph = $ph;
//        }
//    }
//
//    public function getPh()
//    {
//
//        return $this->ph;
//    }
//
//    public function setAttenuationLevel($attenuationLevel)
//    {
//        if (is_integer($attenuationLevel)) {
//            $this->attenuationLevel = $attenuationLevel;
//        }
//    }
//
//    public function getAttenuationLevel()
//    {
//
//        return $this->attenuationLevel;
//    }
//
//    public function setVolume($volume)
//    {
//        if (is_array($volume)) {
//            $this->volume = $volume;
//        }
//    }
//
//    public function getVolume()
//    {
//
//        return $this->volume;
//    }
//
//    public function setBoilVolume($boilVolume)
//    {
//        if (is_array($boilVolume)) {
//            $this->boilVolume = $boilVolume;
//        }
//    }
//
//    public function getBoilVolume()
//    {
//
//        return $this->boilVolume;
//    }
//
//    public function setMethod($method)
//    {
//        if (is_array($method)) {
//            $this->method = $method;
//        }
//    }
//
//    public function getMethod()
//    {
//
//        return $this->method;
//    }
//
//    public function setIngredients($ingredients)
//    {
//        if (is_array($ingredients)) {
//            $this->ingredients = $ingredients;
//        }
//    }
//
//    public function getIngredients()
//    {
//
//        return $this->ingredients;
//    }
//
//    public function setFoodPairing($foodPairing)
//    {
//        if (is_array($foodPairing)) {
//            $this->foodPairing = $foodPairing;
//        }
//    }
//
//    public function getFoodPairing()
//    {
//
//        return $this->foodPairing;
//    }
//
//    public function setBrewersTips($brewersTips)
//    {
//        if (is_string($brewersTips)) {
//            $this->brewersTips = $brewersTips;
//        }
//    }
//
//    public function getBrewersTips()
//    {
//
//        return $this->brewersTips;
//    }
//
//    public function setContributedBy($contributedBy)
//    {
//        if (is_string($contributedBy)) {
//            $this->contributedBy = $contributedBy;
//        }
//    }
//
//    public function getContributedBy()
//    {
//
//        return $this->contributedBy;
//    }

    static function fromArray(array $beerInfo) {

        // validation code here




    }

}