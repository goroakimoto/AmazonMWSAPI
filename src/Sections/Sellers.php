<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\Sections\Sections;

class Sellers extends Sections
{

    protected $feedType = "";
    protected $feedContent = "";
    protected $versionDate = "2011-07-01";
    private $overviewUrl = "http://docs.developer.amazonservices.com/en_US/sellers/Sellers_Overview.html";
    private $libraryUpdateUrl = "http://docs.developer.amazonservices.com/en_US/sellers/Sellers_ClientLibraries.html";
    protected $dataTypes = [
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