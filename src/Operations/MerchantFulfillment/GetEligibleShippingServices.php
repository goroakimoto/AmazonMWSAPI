<?php

namespace AmazonMWSAPI\Operations\MerchantFulfillment;

use AmazonMWSAPI\Sections\MerchantFulfillment;

class GetEligibleShippingServices extends MerchantFulfillment
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 5;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/merch_fulfill/MerchFulfill_GetEligibleShippingServices.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "ShipmentRequestDetails" => [
            "format" => "ShipmentRequestDetails",
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}