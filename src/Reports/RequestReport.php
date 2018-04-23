<?php

namespace AmazonMWSAPI\Reports;

class RequestReport extends Reports
{

    protected static $requestQuota = 15;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "minute";
    protected static $hourlyRequestQuota = 60;
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_RequestReport.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "ReportType" => [
            "format" => "ReportType",
            "required"
        ],
        "StartDate" => [
            "format" => "dateTime"
        ],
        "EndDate" => [
            "format" => "dateTime"
        ],
        "ReportOptions",
        "MarketplaceIdList",
        "SellerId" => [
            "required"
        ]
    ];

}