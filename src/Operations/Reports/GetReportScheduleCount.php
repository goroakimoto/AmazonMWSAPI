<?php

namespace AmazonMWSAPI\Operations\Reports;

class GetReportScheduleCount extends Reports
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 45;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 80;
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportScheduleCount.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "ReportTypeList" => [
            "format" => "ReportType"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}