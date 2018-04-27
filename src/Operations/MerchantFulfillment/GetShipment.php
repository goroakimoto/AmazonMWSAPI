<?php

namespace AmazonMWSAPI\Operations\MerchantFulfillment;

use AmazonMWSAPI\Sections\MerchantFulfillment;

class GetShipment extends MerchantFulfillment
{

    protected $requestQuota = 10;
    protected $restoreRate = 5;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/merch_fulfill/MerchFulfill_GetShipment.html";
    protected $requiredParameters = [];
    protected $parameters = [
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