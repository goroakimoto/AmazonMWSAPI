<?php

namespace AmazonMWSAPI\Operations\Products;

class GetServiceStatus extends Products
{

    protected static $requestQuota = 2;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 5;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetServiceStatus.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}