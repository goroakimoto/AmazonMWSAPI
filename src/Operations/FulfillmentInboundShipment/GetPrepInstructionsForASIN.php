<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class GetPrepInstructionsForASIN extends FulfillmentInboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForASIN.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ASINList" => [
            "maximumCount" => 50,
            "required"
        ],
        "ShipToCountryCode" => [
            "length" => 2,
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}