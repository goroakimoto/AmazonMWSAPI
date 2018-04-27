<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class GetInboundGuidanceForASIN extends FulfillmentInboundShipment
{

    protected static $requestQuota = 200;
    protected static $restoreRate = 200;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetInboundGuidanceForASIN.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "ASINList" => [
            "maximumCount" => 50,
            "required"
        ],
        "MarketplaceId" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}