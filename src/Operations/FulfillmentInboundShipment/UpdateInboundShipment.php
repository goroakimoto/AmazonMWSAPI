<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class UpdateInboundShipment extends FulfillmentInboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_UpdateInboundShipment.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ShipmentId" => [
            "required"
        ],
        "InboundShipmentHeader" => [
            "format" => "InboundShipmentHeader",
            "required"
        ],
        "InboundShipmentItems" => [
            "format" => "InboundShipmentItem",
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}