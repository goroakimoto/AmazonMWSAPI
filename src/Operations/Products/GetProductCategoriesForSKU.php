<?php

namespace AmazonMWSAPI\Operations\Products;

class GetProductCategoriesForSKU extends Products
{

    protected static $requestQuota = 20;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 5;
    protected static $restoreRateTimePeriod = "seconds";
    protected static $hourlyRequestQuota = 720;
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetProductCategoriesForSKU.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
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