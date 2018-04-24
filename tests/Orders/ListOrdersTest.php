<?php

namespace Tests\Orders;

use Tests\Orders\OrdersTest;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Orders\ListOrders;

class ListOrdersTest extends OrdersTest
{

    public function testListOrders()
    {

        $this->apiObject .= "ListOrders";

        $example = ListOrders::$exampleListOrders;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $example,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("MarketplaceId", $curlParameters);
        $this->assertArrayHasKey("SellerId", $curlParameters);

    }

    // public function testListOrdersFailing()
    // {

    //     $regex = '/ must be set to complete this request/';

    //     $this->expectOutputRegex($regex);

    //     $this->apiObject .= "ListOrders";

    //     $failingExample = ListOrders::$exampleListOrdersFailing;

    //     $this->testObject = Helpers::test(
    //         $this->apiObject,
    //         $failingExample,
    //         $this->print,
    //         $this->testPerformance,
    //         $this->iterations
    //     );

    // }

}