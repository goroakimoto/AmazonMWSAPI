<?php

namespace AmazonMWSAPI\Operations\Products;

use AmazonMWSAPI\Sections\Products;

class GetMyFeesEstimate extends Products
{

    protected $requestQuota = 20;
    protected $restoreRate = 10;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 36000;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetMyFeesEstimate.html";
    protected $requiredParameters = [];
    protected $parameters = [
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