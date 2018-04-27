<?php

namespace AmazonMWSAPI\Operations\Subscriptions;

use AmazonMWSAPI\Sections\Subscriptions;

class GetServiceStatus extends Subscriptions
{

    protected $requestQuota = 2;
    protected $restoreRate = 1;
    protected $restoreRateTime = 5;
    protected $restoreRateTimePeriod = "minute";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/subscriptions/Subscriptions_GetServiceStatus.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}