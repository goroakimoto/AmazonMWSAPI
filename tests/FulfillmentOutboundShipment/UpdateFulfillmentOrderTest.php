<?php

namespace Tests\FulfillmentOutboundShipment;

use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\FulfillmentOutboundShipment\UpdateFulfillmentOrder;
use Tests\FulfillmentOutboundShipment\FulfillmentOutboundShipmentTest;

class UpdateFulfillmentOrderTest extends FulfillmentOutboundShipmentTest
{

    public function testUpdateFulfillmentOrder()
    {

        $this->apiObject .= "UpdateFulfillmentOrder";

        $example = UpdateFulfillmentOrder::$exampleUpdateFulfillmentOrder;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $example,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("SellerFulfillmentOrderId", $curlParameters);
        $this->assertArrayHasKey("DestinationAddress.Name", $curlParameters);
        $this->assertArrayHasKey("DestinationAddress.Line1", $curlParameters);
        $this->assertArrayHasKey("DestinationAddress.StateOrProvinceCode", $curlParameters);
        $this->assertArrayHasKey("DestinationAddress.CountryCode", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.SellerFulfillmentOrderItemId", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.Quantity", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.PerUnitDeclaredValue.CurrencyCode", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.PerUnitDeclaredValue.Value", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.PerUnitPrice.CurrencyCode", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.PerUnitPrice.Value", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.PerUnitTax.CurrencyCode", $curlParameters);
        $this->assertArrayHasKey("Items.member.1.PerUnitTax.Value", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.SellerFulfillmentOrderItemId", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.Quantity", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.PerUnitDeclaredValue.CurrencyCode", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.PerUnitDeclaredValue.Value", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.PerUnitPrice.CurrencyCode", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.PerUnitPrice.Value", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.PerUnitTax.CurrencyCode", $curlParameters);
        $this->assertArrayHasKey("Items.member.2.PerUnitTax.Value", $curlParameters);

    }

    public function testUpdateFulfillmentOrderFailing()
    {

        $regex = '/DestinationAddress.Name must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "UpdateFulfillmentOrder";

        $failingExample = UpdateFulfillmentOrder::$exampleUpdateFulfillmentOrderFailing;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

}