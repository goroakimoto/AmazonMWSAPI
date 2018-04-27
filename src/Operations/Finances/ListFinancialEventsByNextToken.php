<?php

namespace AmazonMWSAPI\Operations\Finances;

use AmazonMWSAPI\Sections\Finances;

class ListFinancialEventsByNextToken extends Finances
{

    protected $requestQuota = 30;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 1800;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/finances/Finances_ListFinancialEventsByNextToken.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "NextToken" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}