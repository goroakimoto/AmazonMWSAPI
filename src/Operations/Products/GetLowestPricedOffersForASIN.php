<?php

namespace AmazonMWSAPI\Operations\Products;

use AmazonMWSAPI\Sections\Products;

class GetLowestPricedOffersForASIN extends Products
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 5;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 200;
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetLowestPricedOffersForASIN.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "required"
        ],
        "ASIN" => [
            "required"
        ],
        "ItemCondition" => [
            "required",
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