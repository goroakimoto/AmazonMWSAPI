<?php

namespace AmazonMWSAPI\Products;

class GetMyPriceForASIN extends Products
{

    protected static $requestQuota = 20;
    protected static $restoreRate = 10;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 36000;
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetMyPriceForASIN.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "required"
        ],
        "ASINList" => [
            "maximumCount" => 20,
            "required"
        ],
        "ItemCondition" => [
            "validWith" => [
                "New",
                "Used",
                "Collectible",
                "Refurbished",
                "Club"
            ]
        ],
        "SellerId" => [
            "required"
        ]
    ];

}