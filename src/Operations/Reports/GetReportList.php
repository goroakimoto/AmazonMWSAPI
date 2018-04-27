<?php

namespace AmazonMWSAPI\Operations\Reports;

use AmazonMWSAPI\Sections\Reports;

class GetReportList extends Reports
{

    protected $requestQuota = 10;
    protected $restoreRate = 1;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "minute";
    protected $hourlyRequestQuota = 60;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportList.html";
    protected $requiredParameters = [];
    protected $parameters = [
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

    public static $exampleGetReportList = [

    ];

}