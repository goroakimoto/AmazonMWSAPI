<?php

namespace AmazonMWSAPI\Operations\Orders;

use AmazonMWSAPI\Sections\Orders;

class GetOrder extends Orders
{

    protected $requestQuota = 6;
    protected $restoreRate = 1;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "minute";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_GetOrder.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "AmazonOrderId" => [
            "maximumLength" => 50,
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}