<?php

namespace AmazonMWSAPI\Operations\Sellers;

use AmazonMWSAPI\Sections\Sellers;

class GetServiceStatus extends Sellers
{

    protected static $requestQuota = 2;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 5;
    protected static $restoreRateTimePeriod = "minute";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/sellers/Sellers_GetServiceStatus.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}