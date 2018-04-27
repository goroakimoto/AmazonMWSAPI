<?php

namespace AmazonMWSAPI\Operations\Products;

use AmazonMWSAPI\Sections\Products;

class GetProductCategoriesForSKU extends Products
{

    protected $requestQuota = 20;
    protected $restoreRate = 1;
    protected $restoreRateTime = 5;
    protected $restoreRateTimePeriod = "seconds";
    protected $hourlyRequestQuota = 720;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetProductCategoriesForSKU.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "MarketplaceId" => [
            "required"
        ],
        "SellerSKU" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}