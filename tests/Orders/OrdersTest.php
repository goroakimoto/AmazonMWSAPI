<?php

namespace Tests\Orders;

use Tests\TestCase;
use AmazonMWSAPI\Orders;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;

class OrdersTest extends TestCase
{

    public function testAmazonAPIInformationHasBeenSet()
    {
        AmazonClient::instance();
        $this->expectOutputString(AmazonClient::getMerchantId());
        print getenv("AMAZON_MERCHANTID");
    }

}