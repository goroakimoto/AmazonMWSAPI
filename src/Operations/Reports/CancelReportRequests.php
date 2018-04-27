<?php

namespace AmazonMWSAPI\Operations\Reports;

use AmazonMWSAPI\Sections\Reports;

class CancelReportRequests extends Reports
{

    protected $requestQuota = 10;
    protected $restoreRate = 1;
    protected $restoreRateTime = 45;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 80;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_CancelReportRequests.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ReportRequestIdList",
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