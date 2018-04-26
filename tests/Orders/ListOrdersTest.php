<?php

namespace Tests\Orders;

use Tests\Orders\OrdersTest;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Operations\Orders\ListOrders;

class ListOrdersTest extends OrdersTest
{

    public function testListOrders()
    {

        $this->apiObject .= "ListOrders";

        $requestParameters = ListOrders::$exampleListOrders;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("MarketplaceId.Id.1", $curlParameters);
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