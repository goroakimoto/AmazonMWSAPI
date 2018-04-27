<?php

namespace AmazonMWSAPI\Operations\MerchantFulfillment;

use AmazonMWSAPI\Sections\MerchantFulfillment;

class GetServiceStatus extends MerchantFulfillment
{

    protected $requestQuota = 2;
    protected $restoreRate = 1;
    protected $restoreRateTime = 5;
    protected $restoreRateTimePeriod = "minute";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/merch_fulfill/MWS_GetServiceStatus.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}