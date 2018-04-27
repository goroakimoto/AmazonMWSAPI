<?php

namespace AmazonMWSAPI\Operations\MerchantFulfillment;

use AmazonMWSAPI\Sections\MerchantFulfillment;

class GetEligibleShippingServices extends MerchantFulfillment
{

    protected $requestQuota = 10;
    protected $restoreRate = 5;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/merch_fulfill/MerchFulfill_GetEligibleShippingServices.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ShipmentRequestDetails" => [
            "format" => "ShipmentRequestDetails",
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}