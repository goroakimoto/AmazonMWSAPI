<?php

namespace AmazonMWSAPI\Operations\Products;

use AmazonMWSAPI\Sections\Products;

class GetMyPriceForSKU extends Products
{

    protected static $requestQuota = 20;
    protected static $restoreRate = 10;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 36000;
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetMyPriceForSKU.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "notIncremented",
            "required"
        ],
        "SellerSKUList" => [
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