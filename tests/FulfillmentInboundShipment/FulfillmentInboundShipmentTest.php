<?php

namespace Tests\FulfillmentInboundShipment;

use Tests\TestCase;
use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Exception\RequiredException;
use AmazonMWSAPI\FulfillmentInboundShipment;
use AmazonMWSAPI\FulfillmentInboundShipment\CreateInboundShipment;

class FulfillmentInboundShipmentTest extends TestCase
{

    public function setup()
    {

        parent::setup();

        $this->testPerformance = false;

        $this->iterations = 1;

        $this->print = false;

        $this->apiObject = "\AmazonMWSAPI\FulfillmentInboundShipment\\";

    }

    public function teardown()
    {

        unset($this->AmazonClient);

    }

    public function testCreateInboundShipment()
    {

        $this->apiObject .= "CreateInboundShipment";

        $example = CreateInboundShipment::$exampleCreateInboundShipment;

        $inboundShipment = Helpers::test(
            $this->apiObject,
            $example,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $inboundShipment->getCurlParameters();

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

    public function testRequiredParameterMissingFromCreateInboundShipment()
    {

        $regex = '/must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "CreateInboundShipment";

        $failingExample = CreateInboundShipment::$exampleCreateInboundShipmentFailing;

        $inboundShipment = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

}