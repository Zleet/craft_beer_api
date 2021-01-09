<?php

use Zleet\PunkAPI\PunkAPI;
use GuzzleHttp\Client;

class PunkAPITest extends \PHPUnit\Framework\TestCase
{
    public function testClassCreation()
    {
        $punkAPI = new PunkAPI();

        $this->assertInstanceOf(PunkAPI::class, $punkAPI);
    }

    public function testDefaultPropertiesAreCorrect()
    {
        $punkAPI = new PunkAPI();

        // check default ABV upper and lower bounds are correct
        $this->assertEquals("0", $punkAPI->getAbvLowerBound(),
            'Default ABV lower bound is not zero!');
        $this->assertEquals("100", $punkAPI->getAbvUpperBound(),
            'Default ABV upper bound is not 100!');

        // check default IBU upper and lower bounds are correct
        $this->assertEquals("0", $punkAPI->getIbuLowerBound(),
            'Default IBU lower bound is not zero!');
        $this->assertEquals("100", $punkAPI->getIbuUpperBound(),
            'Default IBU upper bound is not 100!');

        // check default EBC upper and lower bounds are correct
        $this->assertEquals("2", $punkAPI->getEbcLowerBound(),
            'Default EBC lower bound is not 2!');
        $this->assertEquals("27", $punkAPI->getEbcUpperBound(),
            'Default EBC upper bound is not 27!');

        // check default beer
        $this->assertEquals("", $punkAPI->getBeer(),
                'Default beer is not an empty string.');

        // check default yeast
        $this->assertEquals("", $punkAPI->getYeast(),
            'Default yeast is not an empty string.');

        // check default hops
        $this->assertEquals("", $punkAPI->getHops(),
            'Default hops is not an empty string.');

        // check default malt
        $this->assertEquals("", $punkAPI->getMalt(),
            'Default malt is not an empty string.');

        // check default food
        $this->assertEquals("", $punkAPI->getFood(),
            'Default food is not an empty string.');

        // check default ids
        $this->assertEquals("", $punkAPI->getIds(),
            'Default IDs is not an empty string.');

        // check brewedAfter
        $this->assertMatchesRegularExpression(
            "/[0-9]{2}-[0-9]{4}/",
            $punkAPI->getBrewedAfter());

        // check brewedBefore
        $this->assertMatchesRegularExpression(
            "/[0-9]{2}-[0-9]{4}/",
            $punkAPI->getBrewedBefore());
    }

    public function testGetOneBeer() {

        $punkAPI = new PunkAPI();

        $singleBeerInfo = $punkAPI->single(1);

        // test print
        echo "\nSingle Beer Info:\n";
        print_r($singleBeerInfo);
    }


    // more tests here
    // CODE HERE


}
