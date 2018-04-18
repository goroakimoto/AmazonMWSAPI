<?php

namespace Tests\Helper;

use Tests\TestCase;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;

class HelperTest extends TestCase
{

    public function testArrayToString()
    {

        $array = [
            "This",
            "is",
            "a",
            "comma",
            "delimited",
            "list"
        ];

        $this->assertEquals("This, is, a, comma, delimited, list. ", Helpers::arrayToString($array));

    }

}