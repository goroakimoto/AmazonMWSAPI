<?php

namespace AmazonMWSAPI\Operations\MerchantFulfillment;

use AmazonMWSAPI\Sections\MerchantFulfillment;

class CreateShipment extends MerchantFulfillment
{

    protected $requestQuota = 10;
    protected $restoreRate = 5;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/merch_fulfill/MerchFulfill_CreateShipment.html";
    protected $requiredParameters = [];
    protected $parameters = [
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