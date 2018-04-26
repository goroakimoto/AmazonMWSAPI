<?php

namespace AmazonMWSAPI\Operations\MerchantFulfillment;

use AmazonMWSAPI\Sections\MerchantFulfillment;

class GetShipment extends MerchantFulfillment
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 5;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/merch_fulfill/MerchFulfill_GetShipment.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "ShipmentId" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleGetShipment = [
        "ShipmentId" => "6f77095e-9f75-47eb-aaab-a42d5428fa1a"
    ];

}