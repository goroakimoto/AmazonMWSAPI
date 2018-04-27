<?php

namespace AmazonMWSAPI\Operations\Feeds;

use AmazonMWSAPI\Sections\Feeds;

class GetFeedSubmissionListByNextToken extends Feeds
{

    protected $requestQuota = 30;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 1800;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/feeds/Feeds_GetFeedSubmissionListByNextToken.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "MarketplaceId" => [
            "required"
        ],
        "NextToken" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}