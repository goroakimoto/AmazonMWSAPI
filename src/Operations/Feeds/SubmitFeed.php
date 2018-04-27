<?php

namespace AmazonMWSAPI\Operations\Feeds;

use AmazonMWSAPI\Sections\Feeds;

class SubmitFeed extends Feeds
{

    protected $requestQuota = 15;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "minute";
    protected $hourlyRequestQuota = 30;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/feeds/Feeds_SubmitFeed.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ContentMD5Value",
        "FeedContent" => [
            "required"
        ],
        "FeedType" => [
            "required",
            "format" => "FeedType"
        ],
        "MarketplaceIdList",
        "PurgeAndReplace",
        "SellerId" => [
            "required"
        ]
    ];

}