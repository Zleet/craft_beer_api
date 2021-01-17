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

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTagline()
    {
        return $this->tagline;
    }

    public function getFirstBrewed()
    {
        return $this->firstBrewed;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function getAbv()
    {
        return $this->abv;
    }

    public function getIbu()
    {
        return $this->ibu;
    }

    public function getTargetFg()
    {
        return $this->targetFg;
    }

    public function getTargetOg()
    {
        return $this->targetOg;
    }

    public function getEbc()
    {
        return $this->ebc;
    }

    public function getSrm()
    {
        return $this->srm;
    }

    public function getPh()
    {
        return $this->ph;
    }

    public function getAttenuationLevel()
    {
        return $this->attenuationLevel;
    }

    public function getVolume()
    {
        return $this->volume;
    }

    public function getBoilVolume()
    {
        return $this->boilVolume;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function getFoodPairing()
    {
        return $this->foodPairing;
    }
    public function getBrewersTips()
    {
        return $this->brewersTips;
    }

    public function getContributedBy()
    {
        return $this->contributedBy;
    }

    //static function fromArray(array $beerInfo) {

    // }

}