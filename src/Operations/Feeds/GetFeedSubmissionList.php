<?php

namespace AmazonMWSAPI\Operations\Feeds;

use AmazonMWSAPI\Sections\Feeds;

class GetFeedSubmissionList extends Feeds
{

    protected $requestQuota = 10;
    protected $restoreRate = 1;
    protected $restoreRateTime = 45;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 80;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/feeds/Feeds_GetFeedSubmissionList.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "FeedProcessingStatusList" => [
            "format" => "FeedProcessingStatus"
        ],
        "FeedSubmissionIdList" => [
            "maximumCount" => 100
        ],
        "FeedTypeList" => [
            "format" => "FeedType"
        ],
        "MaxCount" => [
            "maximumCount" => 100
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

    public static $exampleGetFeedSubmissionList = [

    ];

}