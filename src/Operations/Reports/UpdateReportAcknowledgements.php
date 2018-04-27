<?php

namespace AmazonMWSAPI\Operations\Reports;

use AmazonMWSAPI\Sections\Reports;

class UpdateReportAcknowledgements extends Reports
{

    protected $requestQuota = 10;
    protected $restoreRate = 1;
    protected $restoreRateTime = 45;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 80;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_UpdateReportAcknowledgements.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ReportIdList" => [
            "required"
        ],
        "Acknowledged",
        "SellerId" => [
            "required"
        ]
    ];

}