<?php

namespace AmazonMWSAPI\Operations\Reports;

use AmazonMWSAPI\Sections\Reports;

class GetReportRequestCount extends Reports
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 45;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 80;
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportRequestCount.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "ReportTypeList" => [
            "format" => "ReportType"
        ],
        "ReportProcessingStatusList" => [
            "validWith" => [
                "_SUBMITTED_",
                "_IN_PROGRESS_",
                "_CANCELLED_",
                "_DONE_",
                "_DONE_NO_DATA_"
            ]
        ],
        "RequestedFromDate" => [
            "format" => "dateTime"
        ],
        "RequestedToDate" => [
            "format" => "dateTime"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}