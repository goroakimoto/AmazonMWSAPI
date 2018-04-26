<?php

namespace Tests\Operations\FulfillmentOutboundShipment;

use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Operations\FulfillmentOutboundShipment\CreateFulfillmentOrder;
use Tests\Operations\FulfillmentOutboundShipment\FulfillmentOutboundShipmentTest;

class CreateFulfillmentOrderTest extends FulfillmentOutboundShipmentTest
{

    public function testCreateFulfillmentOrder()
    {

        $this->apiObject .= "CreateFulfillmentOrder";

        $requestParameters = CreateFulfillmentOrder::$exampleCreateFulfillmentOrder;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("SellerFulfillmentOrderId", $curlParameters);
        $this->assertArrayHasKey("DisplayableOrderId", $curlParameters);
        $this->assertArrayHasKey("DisplayableOrderDateTime", $curlParameters);
        $this->assertArrayHasKey("ShippingSpeedCategory", $curlParameters);
        $this->assertArrayHasKey("DestinationAddress.Name", $curlParameters);
        $this->assertArrayHasKey("DestinationAddress.Line1", $curlParameters);
        $this->assertArrayHasKey("DestinationAddress.StateOrProvinceCode", $curlParameters);
        $this->assertArrayHasKey("DestinationAddress.CountryCode", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.SellerSKU", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.SellerFulfillmentOrderItemId", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.Quantity", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.PerUnitPrice.CurrencyCode", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.PerUnitPrice.Value", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.SellerSKU", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.SellerFulfillmentOrderItemId", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.Quantity", $curlParameters);

    }

    public function testCreateFulfillmentOrderFailing()
    {

        $regex = '/Items.member.1.SellerSKU must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "CreateFulfillmentOrder";

        $failingExample = CreateFulfillmentOrder::$exampleCreateFulfillmentOrderFailing;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

}