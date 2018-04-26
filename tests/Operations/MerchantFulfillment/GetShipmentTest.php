<?php

namespace Tests\Operations\MerchantFulfillmentTest;

use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Operations\MerchantFulfillment\GetShipment;
use Tests\Operations\MerchantFulfillment\MerchantFulfillmentTest;

class GetShipmentTest extends MerchantFulfillmentTest
{

    public function testGetShipment()
    {

        $this->apiObject .= "GetShipment";

        $requestParameters = GetShipment::$exampleGetShipment;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("ShipmentId", $curlParameters);
        $this->assertArrayHasKey("SellerId", $curlParameters);

    }

}