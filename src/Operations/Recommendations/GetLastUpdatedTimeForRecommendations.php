<?php

namespace AmazonMWSAPI\Operations\Recommendations;

use AmazonMWSAPI\Sections\Recommendations;

class GetLastUpdatedTimeForRecommendations extends Recommendations
{

    protected $requestQuota = 8;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/recommendations/Recommendations_GetLastUpdatedTimeForRecommendations.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "MarketplaceId" => [
            "notIncremented",
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}