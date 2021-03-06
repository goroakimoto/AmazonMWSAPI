<?php

namespace AmazonMWSAPI\MerchantFulfillment;

class GetEligibleShippingServices extends MerchantFulfillment
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 5;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/merch_fulfill/MerchFulfill_GetEligibleShippingServices.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
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