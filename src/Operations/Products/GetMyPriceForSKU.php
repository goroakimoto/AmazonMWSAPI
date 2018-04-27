<?php

namespace AmazonMWSAPI\Operations\Products;

use AmazonMWSAPI\Sections\Products;

class GetMyPriceForSKU extends Products
{

    protected $requestQuota = 20;
    protected $restoreRate = 10;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 36000;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetMyPriceForSKU.html";
    protected $requiredParameters = [];
    protected $parameters = [
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