<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class GetInboundGuidanceForASIN extends FulfillmentInboundShipment
{

    protected $requestQuota = 200;
    protected $restoreRate = 200;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetInboundGuidanceForASIN.html";
    protected $requiredParameters = [];
    protected $parameters = [
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