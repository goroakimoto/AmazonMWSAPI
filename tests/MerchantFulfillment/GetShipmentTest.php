<?php

namespace Tests\MerchantFulfillmentTest;

use AmazonMWSAPI\Helpers\Helpers;
use Tests\MerchantFulfillment\MerchantFulfillmentTest;
use AmazonMWSAPI\MerchantFulfillment\GetShipment;

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