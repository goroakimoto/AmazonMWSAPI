<?php

namespace AmazonMWSAPI\Operations\Feeds;

use AmazonMWSAPI\Sections\Feeds;

class CancelFeedSubmissions extends Feeds
{

    protected $requestQuota = 10;
    protected $restoreRate = 1;
    protected $restoreRateTime = 45;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 80;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/feeds/Feeds_CancelFeedSubmissions.html";
    protected $requiredParameters = [];
    protected $parameters = [
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