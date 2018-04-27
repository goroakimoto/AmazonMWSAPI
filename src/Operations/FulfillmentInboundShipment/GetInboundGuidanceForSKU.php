<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class GetInboundGuidanceForSKU extends FulfillmentInboundShipment
{

    protected $requestQuota = 200;
    protected $restoreRate = 200;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetInboundGuidanceForSKU.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "MarketplaceId" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ],
        "SellerSKUList" => [
            "maximumCount" => 50,
            "required"
        ]
    ];

}