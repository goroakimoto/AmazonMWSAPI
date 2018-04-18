<?php

namespace Tests\Setup;

use Tests\TestCase;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;

class SetupTest extends TestCase
{

    public function testAmazonAPIInformationHasBeenSet()
    {
        AmazonClient::instance();
        $this->expectOutputString(AmazonClient::getMerchantId());
        print getenv("AMAZON_MERCHANTID");
    }

}