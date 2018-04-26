<?php

namespace AmazonMWSAPI\Operations\Products;

class GetMyFeesEstimate extends Products
{

    protected static $requestQuota = 20;
    protected static $restoreRate = 10;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 36000;
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetMyFeesEstimate.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "FeesEstimateRequestList" => [
            "format" => "FeesEstimateRequest",
            "maximumCount" => 20,
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}