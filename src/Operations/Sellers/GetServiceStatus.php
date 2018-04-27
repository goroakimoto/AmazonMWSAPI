<?php

namespace AmazonMWSAPI\Operations\Sellers;

use AmazonMWSAPI\Sections\Sellers;

class GetServiceStatus extends Sellers
{

    protected $requestQuota = 2;
    protected $restoreRate = 1;
    protected $restoreRateTime = 5;
    protected $restoreRateTimePeriod = "minute";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/sellers/Sellers_GetServiceStatus.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}