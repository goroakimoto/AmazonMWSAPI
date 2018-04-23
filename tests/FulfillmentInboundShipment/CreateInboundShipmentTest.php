<?php

namespace Tests\FulfillmentInboundShipment;

use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\FulfillmentInboundShipment\CreateInboundShipment;
use Tests\FulfillmentInboundShipment\FulfillmentInboundShipmentTest;

class CreateInboundShipmentTest extends FulfillmentInboundShipmentTest
{

    public function testCreateInboundShipment()
    {

        $this->apiObject .= "CreateInboundShipment";

        $example = CreateInboundShipment::$exampleCreateInboundShipment;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $example,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("InboundShipmentHeader.ShipmentName", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentHeader.ShipFromAddress.Name", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentHeader.ShipFromAddress.AddressLine1", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentHeader.ShipFromAddress.City", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentHeader.ShipFromAddress.CountryCode", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentHeader.DestinationFulfillmentCenterId", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentHeader.LabelPrepPreference", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentHeader.AreCasesRequired", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentHeader.ShipmentStatus", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.1.SellerSKU", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.1.QuantityShipped", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.1.ReleaseDate", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.1.PrepDetailsList.member.1.PrepInstruction", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.1.PrepDetailsList.member.1.PrepOwner", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.2.SellerSKU", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.2.QuantityShipped", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.2.ReleaseDate", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.2.PrepDetailsList.member.1.PrepInstruction", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.2.PrepDetailsList.member.1.PrepOwner", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.2.PrepDetailsList.member.2.PrepInstruction", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentItems.member.2.PrepDetailsList.member.2.PrepOwner", $curlParameters);

    }

    public function testCreateInboundShipmentPrepInstruction()
    {

        $regex = '/InboundShipmentItems.member.1.PrepDetailsList.member.1.PrepInstruction must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "CreateInboundShipment";

        $failingExample = CreateInboundShipment::$exampleCreateInboundShipmentFailing;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

    public function testCreateInboundShipmentSellerSKU()
    {

        $regex = '/InboundShipmentItems.member.2.SellerSKU must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "CreateInboundShipment";

        $failingExample = CreateInboundShipment::$exampleCreateInboundShipmentFailing;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

}