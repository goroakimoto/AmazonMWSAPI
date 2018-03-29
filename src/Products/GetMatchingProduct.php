<?php

namespace AmazonMWSAPI\Products;

class GetMatchingProduct extends Products
{

    protected static $requestQuota = 20;
    protected static $restoreRate = 2;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 7200;
    protected static $method = "POST";
    private static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetMatchingProduct.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "required"
        ],
        "ASINList" => [
            "maximumCount" => 10,
            "requird"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}