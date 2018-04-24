<?php

namespace AmazonMWSAPI\Products;

class ListMatchingProducts extends Products
{

    protected static $requestQuota = 20;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 5;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 720;
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_ListMatchingProducts.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
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