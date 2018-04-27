<?php

namespace AmazonMWSAPI\Operations\Recommendations;

use AmazonMWSAPI\Sections\Recommendations;

class ListRecommendationsByNextToken extends Recommendations
{

    protected $requestQuota = 8;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/recommendations/Recommendations_ListRecommendationsByNextToken.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "NextToken" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}