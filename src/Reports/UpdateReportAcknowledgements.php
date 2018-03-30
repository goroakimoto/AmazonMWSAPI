<?php

namespace AmazonMWSAPI\Reports;

class UpdateReportAcknowledgements extends Reports
{

    protected static $requestQuota = 10;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 45;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 80;
    protected static $method = "POST";
    private static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_UpdateReportAcknowledgements.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "ReportIdList" => [
            "required"
        ],
        "Acknowledged",
        "SellerId" => [
            "required"
        ]
    ];

}