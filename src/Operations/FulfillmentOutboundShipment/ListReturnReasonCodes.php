<?php

namespace AmazonMWSAPI\Operations\FulfillmentOutboundShipment;

use AmazonMWSAPI\Sections\FulfillmentOutboundShipment;

class ListReturnReasonCodes extends FulfillmentOutboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_outbound/FBAOutbound_ListReturnReasonCodes.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "MarketplaceId",
        "SellerFulfillmentOrderId" => [
            "requiredIfNotSet" => "MarketplaceId"
        ],
        "SellerSKU" => [
            "required"
        ],
        "Language"
    ];

}