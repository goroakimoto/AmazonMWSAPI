<?php

namespace AmazonMWSAPI\Operations\Products;

use AmazonMWSAPI\Sections\Products;

class GetLowestPricedOffersForASIN extends Products
{

    protected $requestQuota = 10;
    protected $restoreRate = 5;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 200;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetLowestPricedOffersForASIN.html";
    protected $requiredParameters = [];
    protected $parameters = [
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