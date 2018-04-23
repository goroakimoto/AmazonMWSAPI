<?php

namespace Tests\FulfillmentInboundShipment;

use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\FulfillmentInboundShipment\PutTransportContent;
use Tests\FulfillmentInboundShipment\FulfillmentInboundShipmentTest;

class PutTransportContentTest extends FulfillmentInboundShipmentTest
{

    public function testCreateInboundShipment()
    {

        $this->apiObject .= "PutTransportContent";

        $example = PutTransportContent::$examplePutTransportContent;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $example,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("SellerId", $curlParameters);
        $this->assertArrayHasKey("MarketplaceId", $curlParameters);
        $this->assertArrayHasKey("ShipmentId", $curlParameters);
        $this->assertArrayHasKey("IsPartnered", $curlParameters);
        $this->assertArrayHasKey("ShipmentType", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.1.Dimensions.Unit", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.1.Dimensions.Length", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.1.Dimensions.Width", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.1.Dimensions.Height", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.1.Weight.Unit", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.1.Weight.Value", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.2.Dimensions.Unit", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.2.Dimensions.Length", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.2.Dimensions.Width", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.2.Dimensions.Height", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.2.Weight.Unit", $curlParameters);
        $this->assertArrayHasKey("TransportDetails.PartneredSmallParcelData.PackageList.member.2.Weight.Value", $curlParameters);

    }

    public function testCreateInboundShipmentFailing()
    {

        $regex = '/TransportDetails.PartneredSmallParcelData.PackageList.member.1.Dimensions.Unit must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "PutTransportContent";

        $failingExample = PutTransportContent::$examplePutTransportContentFailing;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

    // public function testCreateInboundShipmentPrepInstruction()
    // {

    //     $regex = '/^((?!TransportDetails.NonPartneredSmallParcelData.CarrierName must be set to complete this request).)*$/';

    //     $this->expectOutputRegex($regex);

    //     $this->apiObject .= "PutTransportContent";

    //     $example = PutTransportContent::$examplePutTransportContent;

    //     $this->testObject = Helpers::test(
    //         $this->apiObject,
    //         $example,
    //         $this->print,
    //         $this->testPerformance,
    //         $this->iterations
    //     );

    // }

}