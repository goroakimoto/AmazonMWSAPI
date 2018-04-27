<?php

namespace AmazonMWSAPI\Operations\Reports;


class GetReportRequestListByNextToken extends Reports
{

    protected $requestQuota = 30;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 1800;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportRequestListByNextToken.html";
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