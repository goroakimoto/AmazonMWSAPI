<?php

namespace AmazonMWSAPI\Operations\Recommendations;

use AmazonMWSAPI\Sections\Recommendations;

class GetLastUpdatedTimeForRecommendations extends Recommendations
{

    protected static $requestQuota = 8;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 2;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/recommendations/Recommendations_GetLastUpdatedTimeForRecommendations.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "notIncremented",
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}