<?php

namespace AmazonMWSAPI\Operations\Finances;

use AmazonMWSAPI\Sections\Finances;

class ListFinancialEvents extends Finances
{

    protected static $requestQuota = 30;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 2;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 1800;
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/finances/Finances_ListFinancialEvents.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "AmazonOrderId" => [
            "incompatibleWith" => [
                "FinancialEventGroupId",
                "PostedAfter",
                "PostedBefore"
            ],
            "notIncremented"
        ],
        "FinancialEventGroupId" => [
            "incompatibleWith" => [
                "AmazonOrderId",
                "PostedAfter",
                "PostedBefore"
            ]
        ],
        "MaxResultsPerPage" => [
            "rangeWithin" => [
                "min" => 1,
                "max" => 100
            ]
        ],
        "PostedAfter" => [
            "earlierThan" => [
                "PostedBefore",
                "Timestamp"
            ],
            "format" => "dateTime",
            "incompatibleWith" => [
                "AmazonOrderId",
                "FinancialEventGroupId"
            ]
        ],
        "PostedBefore" => [
            "earlierThan" => "Timestamp",
            "format" => "dateTime",
            "incompatibleWith" => [
                "AmazonOrderId",
                "FinancialEventGroupId"
            ],
            "laterThan" => "PostedAfter",
            "notFartherApartThan" => [
                "days" => 180,
                "from" => "FinancialEventGroupStartedAfter",
            ]
        ],
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleListFinancialEvents = [

        "AmazonOrderId" => "113-1234567-0987654"

    ];

}