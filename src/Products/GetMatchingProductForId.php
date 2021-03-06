<?php

namespace AmazonMWSAPI\Products;

class GetMatchingProductForId extends Products
{

    protected static $requestQuota = 20;
    protected static $restoreRate = 5;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetMatchingProductForId.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "format" => "MarketplaceType",
            "required"
        ],
        "IdType" => [
            "required",
            "validWith" => [
                "ASIN",
                "GCID",
                "SellerSKU",
                "UPC",
                "EAN",
                "ISBN",
                "JAN"
            ]
        ],
        "IdList" => [
            "maximumCount" => 5,
            "required"
        ]
    ];

}