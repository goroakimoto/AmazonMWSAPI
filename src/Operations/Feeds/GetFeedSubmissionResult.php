<?php

namespace AmazonMWSAPI\Operations\Feeds;

use AmazonMWSAPI\Sections\Feeds;

class GetFeedSubmissionResult extends Feeds
{

    protected static $requestQuota = 15;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "minute";
    protected static $hourlyRequestQuota = 60;
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/feeds/Feeds_GetFeedSubmissionResult.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "FeedSubmissionId" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}