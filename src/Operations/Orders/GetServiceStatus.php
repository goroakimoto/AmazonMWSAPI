<?php

namespace AmazonMWSAPI\Operations\Orders;

use AmazonMWSAPI\Sections\Orders;

class GetServiceStatus extends Orders
{

    protected static $requestQuota = 2;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 5;
    protected static $restoreRateTimePeriod = "minute";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/MWS_GetServiceStatus.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}