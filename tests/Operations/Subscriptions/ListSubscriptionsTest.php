<?php

namespace Tests\Operations\Subscriptions;

use AmazonMWSAPI\Helpers\Helpers;
use Tests\Operations\Subscriptions\SubscriptionsTest;
use AmazonMWSAPI\Operations\Subscriptions\ListSubscriptions;

class ListSubscriptionsTest extends SubscriptionsTest
{

    public function testListSubscriptions()
    {

        $this->apiObject .= "ListSubscriptions";

        $requestParameters = ListSubscriptions::$exampleListSubscriptions;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("MarketplaceId", $curlParameters);
        $this->assertArrayHasKey("SellerId", $curlParameters);

    }

}