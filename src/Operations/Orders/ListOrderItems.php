<?php

namespace AmazonMWSAPI\Operations\Orders;

use AmazonMWSAPI\Sections\Orders;

class ListOrderItems extends Orders
{

    protected $requestQuota = 30;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrderItems.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "AmazonOrderId" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}