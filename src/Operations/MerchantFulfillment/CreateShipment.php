<?php

namespace AmazonMWSAPI\Operations\MerchantFulfillment;

use AmazonMWSAPI\Sections\MerchantFulfillment;

class CreateShipment extends MerchantFulfillment
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 5;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/merch_fulfill/MerchFulfill_CreateShipment.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "ShipmentREquestDetails" => [
            "format" => "ShipmentRequestDetails",
            "required"
        ],
        "ShippingServiceId" => [
            "required"
        ],
        "ShippingServiceOfferId",
        "HazmatType" => [
            "format" => "HazmatType"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}