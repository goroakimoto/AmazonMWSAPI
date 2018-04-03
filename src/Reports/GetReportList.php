<?php

namespace AmazonMWSAPI\Reports;

class GetReportList extends Reports
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "minute";
    protected static $hourlyRequestQuota = 60;
    protected static $method = "POST";
    private static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportList.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "MaxCount" => [
            "rangeWithin" => [
                "min" => 1,
                "max" => 100
            ]
        ],
        "ReportTypeList" => [
            "format" => "ReportType"
        ],
        "Acknowledged",
        "ReportRequestIdList",
        "AvailableFromDate" => [
            "format" => "dateTime"
        ],
        "AvailableToDate" => [
            "format" => "dateTime"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}