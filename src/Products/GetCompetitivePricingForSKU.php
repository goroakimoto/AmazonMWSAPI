<?php

namespace AmazonMWSAPI\Products;

class GetCompetitivePricingForSKU extends Products
{

    protected static $requestQuota = 20;
    protected static $restoreRate = 10;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 36000;
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetCompetitivePricingForSKU.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "required"
        ],
        "SellerSKUList" => [
            "maximumCount" => 20,
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}