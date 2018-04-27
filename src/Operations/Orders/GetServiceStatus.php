<?php

namespace AmazonMWSAPI\Operations\Orders;

use AmazonMWSAPI\Sections\Orders;

class GetServiceStatus extends Orders
{

    protected $requestQuota = 2;
    protected $restoreRate = 1;
    protected $restoreRateTime = 5;
    protected $restoreRateTimePeriod = "minute";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/MWS_GetServiceStatus.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}