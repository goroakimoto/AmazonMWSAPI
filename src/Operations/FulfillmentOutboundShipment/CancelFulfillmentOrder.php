<?php

namespace AmazonMWSAPI\Operations\FulfillmentOutboundShipment;

use AmazonMWSAPI\Sections\FulfillmentOutboundShipment;

class CancelFulfillmentOrder extends FulfillmentOutboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "docs.developer.amazonservices.com/en_US/fba_outbound/FBAOutbound_CancelFulfillmentOrder.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "SellerFulfillmentOrderId" => [
            "maximumLength" => 40,
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}