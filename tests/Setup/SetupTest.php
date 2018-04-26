<?php

namespace Tests\Setup;

use Tests\TestCase;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Sections\Feeds;

class SetupTest extends TestCase
{

    public function testAmazonCountryHasBeenSet()
    {

        $this->assertEquals("US", Feeds::getCountryCode());

    }

    public function testAmazonMarketplaceIdHasBeenSet()
    {

        $this->assertEquals("ATVPDKIKX0DER" , Feeds::getMarketplaceId());

    }

}