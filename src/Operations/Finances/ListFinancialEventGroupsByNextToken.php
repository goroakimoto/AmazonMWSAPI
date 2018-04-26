<?php

namespace AmazonMWSAPI\Operations\Finances;

class ListFinancialGroupsByNextToken extends Finances
{

    protected static $requestQuota = 30;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 2;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 1800;
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/finances/Finances_ListFinancialEventGroupsByNextToken.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "NextToken" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}