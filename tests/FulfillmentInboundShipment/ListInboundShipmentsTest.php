<?php

namespace Tests\FulfillmentInboundShipment;

use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\FulfillmentInboundShipment\ListInboundShipments;
use Tests\FulfillmentInboundShipment\FulfillmentInboundShipmentTest;

class ListInboundShipmentsTest extends FulfillmentInboundShipmentTest
{

    public function testListInboundShipmentShipmentStatusList()
    {

        $this->apiObject .= "ListInboundShipments";

        $requestParameters = ListInboundShipments::$exampleListInboundShipments;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("ShipmentStatusList.member.1", $curlParameters);

    }

    // public function testListInboundShipmentShipmentIdList()
    // {

    //     $this->apiObject .= "ListInboundShipments";

    //     $requestParameters = ListInboundShipments::$exampleListInboundShipments;

    //     $this->testObject = Helpers::test(
    //         $this->apiObject,
    //         $requestParameters,
    //         $this->print,
    //         $this->testPerformance,
    //         $this->iterations
    //     );

    //     $curlParameters = $this->testObject->getCurlParameters();

    //     $this->assertArrayHasKey("ShipmentIdList.member.1", $curlParameters);
    //     $this->assertArrayHasKey("LastUpdateAfter", $curlParameters);
    //     $this->assertArrayHasKey("LastUpdatedBefore", $curlParameters);

    // }

}