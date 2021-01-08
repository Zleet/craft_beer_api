<?php

use Zleet\PunkAPI;

class PunkAPITest extends \PHPUnit\Framework\TestCase
{
    public function testClassCreation()
    {
        $punkAPI = new PunkAPI();

        $this->assertInstanceOf(PunkAPI::class, $punkAPI);
    }








}