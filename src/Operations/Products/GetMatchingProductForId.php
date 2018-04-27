<?php

namespace AmazonMWSAPI\Operations\Products;

use AmazonMWSAPI\Sections\Products;

class GetMatchingProductForId extends Products
{

    protected $requestQuota = 20;
    protected $restoreRate = 5;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_GetMatchingProductForId.html";
    protected $requiredParameters = [];
    protected $parameters = [
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