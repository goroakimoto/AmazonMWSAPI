<?php

namespace AmazonMWSAPI\Operations\Subscriptions;

use AmazonMWSAPI\Sections\Subscriptions;

class DeleteSubscription extends Subscriptions
{

    protected $requestQuota = 25;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 7200;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/subscriptions/Subscriptions_DeleteSubscription.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "MarketplaceId" => [
            "notIncremented",
            "required"
        ],
        "NotificationType" => [
            "format" => "NotificationType",
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