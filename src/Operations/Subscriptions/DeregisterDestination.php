<?php

namespace AmazonMWSAPI\Operations\Subscriptions;

use AmazonMWSAPI\Sections\Subscriptions;

class DeregisterDestination extends Subscriptions
{

    protected static $requestQuota = 25;
    protected static $restoreRate = 2;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 7200;
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/subscriptions/Subscriptions_DeregisterDestination.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "notIncremented",
            "required"
        ],
        "Destination" => [
            "format" => "Destination",
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}