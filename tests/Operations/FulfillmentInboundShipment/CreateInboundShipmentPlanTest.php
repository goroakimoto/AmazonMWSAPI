<?php

namespace Tests\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Helpers\Helpers;
use Tests\Operations\FulfillmentInboundShipment\FulfillmentInboundShipmentTest;
use AmazonMWSAPI\Operations\FulfillmentInboundShipment\CreateInboundShipmentPlan;

class CreateInboundShipmentPlanTest extends FulfillmentInboundShipmentTest
{

    public function testCreateInboundShipmentPlan()
    {

        $this->apiObject .= "CreateInboundShipmentPlan";

        $requestParameters = CreateInboundShipmentPlan::$exampleCreateInboundShipmentPlan;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("ShipFromAddress.Name", $curlParameters);
        $this->assertArrayHasKey("ShipFromAddress.AddressLine1", $curlParameters);
        $this->assertArrayHasKey("ShipFromAddress.City", $curlParameters);
        $this->assertArrayHasKey("ShipFromAddress.CountryCode", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentPlanRequestItems.member.1.SellerSKU", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentPlanRequestItems.member.1.Quantity", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentPlanRequestItems.member.1.PrepDetailsList.member.1.PrepInstruction", $curlParameters);
        $this->assertArrayHasKey("InboundShipmentPlanRequestItems.member.1.PrepDetailsList.member.1.PrepOwner", $curlParameters);

    }

    public function testCreateInboundShipmentPlanFailingCountryCode()
    {

        $regex = '/ShipFromAddress.CountryCode must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "CreateInboundShipmentPlan";

        $failingExample = CreateInboundShipmentPlan::$exampleCreateInboundShipmentPlanFailing;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

    public function testCreateInboundShipmentPlanFailingPrepInstruction()
    {

        $regex = '/InboundShipmentPlanRequestItems.member.1.PrepDetailsList.member.1.PrepInstruction must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "CreateInboundShipmentPlan";

        $failingExample = CreateInboundShipmentPlan::$exampleCreateInboundShipmentPlanFailing;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

}