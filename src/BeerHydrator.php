<?php

/**
 * A class which hydrates a beer object with the information in an associative
 * array.
 * @param Beer $beer  - a beer object
 * @param Object $info - an object (created from a local json file using)
 *                       json_decode() to return an object) containing the
 *                       information with which to fill the beer object
 */
namespace Zleet\PunkAPI;

use GuzzleHttp\Client;

class BeerHydrator
{
    public function __construct()
    {

    }

    public static function hydrate($beer, $info)
    {
        // test print
        echo "\nbeer:\n";
        print_r($beer);
        echo "\ninfo:\n";
        print_r($info);

        // get a list of all the methods in the beer object
        $beerMethods = get_class_methods($beer);
        // test print
        echo "\nbeer methods:\n";
        print_r($beerMethods);

        // get a list of all the methods in the info object
        $infoMethods = get_class_methods($info);
        // test print
        echo "\ninfo methods:\n";
        print_r($infoMethods);

        // test print the info object
        echo "\ninfo object:\n";
        print_r($info);

//
//        // build a lookup array containing key/value pairs in the form:
//        // <beer object property name>/<json key>
//        // e.g. 'attenuationLevel' => 'attenuation_level'
//        $jsonKeysAndValues = get_object_vars($info);
//        $jsonKeys = array_keys($jsonKeysAndValues);
//
//        // test print
//        echo "\njsonKeys:\n";
//        print_r($jsonKeys);
//
//        $beerObjectPropertiesAndJsonKeys = [];
//        foreach ($jsonKeys as $jsonKey) {
//            if (strpos($jsonKey, '_') !== false) {
//                // split json key along underscores
//                $words = explode('_', $jsonKey);
//                // build $beerObjectProperty from first word plus remaining
//                // words with all first letters uppercase
//                $beerObjectProperty = $words[0];
//                $totalWords = count($words);
//                for ($i = 1; $i < $totalWords; ++$i) {
//                    $word = $words[$i];
//                    $firstLetterUppercase = strtoupper(substr($word, 0, 1));        $restOfWord = substr($word, 1);
//                    $rebuiltWord = $firstLetterUppercase . $restOfWord;
//                    $beerObjectProperty .= $rebuiltWord;
//                }
//            } else {
//                $beerObjectProperty = $jsonKey;
//            }
//            $beerObjectPropertiesAndJsonKeys[$beerObjectProperty] = $jsonKey;
//        }
//
//        // test print
//        echo "\nbeerObjectPropertiesAndJsonKeys\n";
//        print_r($beerObjectPropertiesAndJsonKeys);
//
//        // loop through all the beer object properties and set them all
//        $beerObjectProperties = array_keys($beerObjectPropertiesAndJsonKeys);
//        foreach ($beerObjectProperties as $beerObjectProperty) {
//            // find the name of the json key that corresponds to $beerMethod
//            $jsonKey = $beerObjectPropertiesAndJsonKeys[$beerObjectProperty];
//            // look up the value in the $info array
//            $infoValue = $info->$jsonKey; // new
//            // work out the name of the setter method that sets the property
//            // in the beer object
//            $setterName = 'set';
//            $firstLetter = substr($beerObjectProperty, 0, 1);
//            $setterName .= strtoupper($firstLetter);
//            if (strlen($beerObjectProperty) > 1) {
//                $setterName .= substr($beerObjectProperty, 1);
//            }
//            // use the setter method to set the value of the property in the
//            // beer object
//            $beer->$setterName($infoValue);
//        }
//
//        echo "\nAfter hydrating, beer object is:\n";
//        print_r($beer);


        return $beer;
    }

}