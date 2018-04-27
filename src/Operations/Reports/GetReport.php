<?php

namespace AmazonMWSAPI\Operations\Reports;

use AmazonMWSAPI\Sections\Reports;

class GetReport extends Reports
{

    protected $requestQuota = 15;
    protected $restoreRate = 1;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "minute";
    protected $hourlyRequestQuota = 60;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReport.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ReportId" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}