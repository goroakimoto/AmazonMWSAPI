<?php

namespace AmazonMWSAPI\Operations\Products;

use AmazonMWSAPI\Sections\Products;

class GetMatchingProduct extends Products
{

    protected $requestQuota = 20;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 7200;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetMatchingProduct.html";
    protected $requiredParameters = [];
    protected $parameters = [
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