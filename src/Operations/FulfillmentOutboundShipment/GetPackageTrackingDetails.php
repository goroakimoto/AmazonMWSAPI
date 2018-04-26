<?php

namespace AmazonMWSAPI\Operations\FulfillmentOutboundShipment;

use AmazonMWSAPI\Sections\FulfillmentOutboundShipment;

class GetPackageTrackingDetails extends FulfillmentOutboundShipment
{

    protected static $requestQuota = 30;
    protected static $restoreRate = 2;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_outbound/FBAOutbound_GetPackageTrackingDetails.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "PackageNumber" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}