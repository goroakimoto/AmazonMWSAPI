<?php

namespace AmazonMWSAPI\Sellers;

use AmazonMWSAPI\{APIMethods, APIParameters, APIParameterValidation, APIProperties};
use AmazonMWSAPI\Parameters\Parameter;

class Sellers extends Parameter
{

    use APIMethods;
    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected static $feedType = "";
    protected static $feedContent = "";
    protected static $feed = "Sellers";
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

    public function __construct($parametersToSet = null)
    {

        static::setParameters($parametersToSet);

        static::verifyParameters();

    }

}