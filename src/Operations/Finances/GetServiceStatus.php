<?php

namespace AmazonMWSAPI\Operations\Finances;

use AmazonMWSAPI\Sections\Finances;

class GetServiceStatus extends Finances
{

    protected static $requestQuota = 2;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 5;
    protected static $restoreRateTimePeriod = "minute";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/finances/Finances_GetServiceStatus.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}