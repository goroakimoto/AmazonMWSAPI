<?php

namespace AmazonMWSAPI\Orders;

class GetOrder extends Orders
{

    protected static $requestQuota = 6;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "minute";
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_GetOrder.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "AmazonOrderId" => [
            "maximumLength" => 50,
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}