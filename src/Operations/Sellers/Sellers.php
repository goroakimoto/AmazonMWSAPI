<?php

namespace AmazonMWSAPI\Operations\Sellers;

use AmazonMWSAPI\Operations\Operations;

class Sellers extends Operations
{

    protected static $feedType = "";
    protected static $feedContent = "";
    protected static $versionDate = "2011-07-01";
    private static $overviewUrl = "http://docs.developer.amazonservices.com/en_US/sellers/Sellers_Overview.html";
    private static $libraryUpdateUrl = "http://docs.developer.amazonservices.com/en_US/sellers/Sellers_ClientLibraries.html";
    protected static $dataTypes = [
        "Marketplace" => [
            "MarketplaceId",
            "Name",
            "DefaultCountryCode",
            "DefaultCurrencyCode" => [
                "format" => "dateTime"
            ],
            "DefaultLanguageCode" => [
                "length" => 5
            ],
            "DomainName"
        ],
        "Participation" => [
            "MarketplaceId",
            "SellerId",
            "HasSellerSuspendedListings"
        ]
    ];

}