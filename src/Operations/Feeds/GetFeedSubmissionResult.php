<?php

namespace AmazonMWSAPI\Operations\Feeds;

use AmazonMWSAPI\Sections\Feeds;

class GetFeedSubmissionResult extends Feeds
{

    protected $requestQuota = 15;
    protected $restoreRate = 1;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "minute";
    protected $hourlyRequestQuota = 60;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/feeds/Feeds_GetFeedSubmissionResult.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "FeedSubmissionId" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}