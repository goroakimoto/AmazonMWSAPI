<?php

namespace AmazonMWSAPI\Operations\Feeds;

use AmazonMWSAPI\Sections\Feeds;

class CancelFeedSubmissions extends Feeds
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 45;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 80;
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/feeds/Feeds_CancelFeedSubmissions.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "FeedSubmissionIdList",
        "FeedTypeList" => [
            "format" => "FeedType"
        ],
        "SellerId" => [
            "required"
        ],
        "SubmittedFromDate" => [
            "format" => "dateTime"
        ],
        "SubmittedToDate" => [
            "format" => "dateTime"
        ]
    ];

}