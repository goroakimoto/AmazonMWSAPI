<?php

namespace Tests\Setup;

use Tests\TestCase;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Operations\Feeds\CancelFeedSubmissions;

class SetupTest extends TestCase
{

    public function testAmazonCountryHasBeenSet()
    {

        $feeds = new CancelFeedSubmissions();

        $this->assertEquals("US", $feeds->getCountryCode());

    }

    public function testAmazonMarketplaceIdHasBeenSet()
    {

        $feeds = new CancelFeedSubmissions();

        $this->assertEquals("ATVPDKIKX0DER" , $feeds->getMarketplaceId());

    }

}