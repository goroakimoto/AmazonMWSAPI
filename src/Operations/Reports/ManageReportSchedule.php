<?php

namespace AmazonMWSAPI\Operations\Reports;

use AmazonMWSAPI\Sections\Reports;

class ManageReportSchedule extends Reports
{

    protected $requestQuota = 10;
    protected $restoreRate = 1;
    protected $restoreRateTime = 45;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 80;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_ManageReportSchedule.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ReportType" => [
            "format" => "ReportType",
            "required"
        ],
        "Schedule" => [
            "format" => "Schedule",
            "required"
        ],
        "ScheduleDate" => [
            "format" => "dateTime",
            "notFartherApartThan" => [
                "from" => "now",
                "days" => 365
            ]
        ],
        "SellerId" => [
            "required"
        ]
    ];

}