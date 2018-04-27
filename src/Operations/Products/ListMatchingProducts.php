<?php

namespace AmazonMWSAPI\Operations\Products;

use AmazonMWSAPI\Sections\Products;

class ListMatchingProducts extends Products
{

    protected $requestQuota = 20;
    protected $restoreRate = 1;
    protected $restoreRateTime = 5;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 720;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_ListMatchingProducts.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "MarketplaceId" => [
            "notIncremented",
            "required"
        ],
        "Query" => [
            "required"
        ],
        "QueryContextId" => [
            "format" => "QueryContextId"
        ],
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleListMatchingProducts = [
        "Query" => "0439708184"
    ];

}