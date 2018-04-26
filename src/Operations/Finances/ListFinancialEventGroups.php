<?php

namespace AmazonMWSAPI\Operations\Finances;

use AmazonMWSAPI\Sections\Finances;

class ListFinancialEventGroups extends Finances
{

    protected static $requestQuota = 30;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 2;
    protected static $restoreRateTimePeriod = "second";
    protected static $hourlyRequestQuota = 1800;
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/finances/Finances_ListFinancialEventGroups.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "FinancialEventGroupStartedAfter" => [
            "earlierThan" => [
                "Timestamp",
                "FinancialEventGroupStartedBefore"
            ],
            "format" => "dateTime",
            "required"
        ],
        "FinancialEventGroupStartedBefore" => [
            "earlierThan" => "Timestamp",
            "format" => "dateTime",
            "laterThan" => "FinancialEventGroupStartedAfter",
            "notFartherApartThan" => [
                "days" => 180,
                "from" => "FinancialEventGroupStartedAfter",
            ]
        ],
        "MaxResultsPerPage" => [
            "rangeWithin" => [
                "min" => 1,
                "max" => 100
            ]
        ],
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleFinancialEventGroups = [
        "FinancialEventGroupStartedBefore" => "-1 day",
        "FinancialEventGroupStartedAfter" => "-2 day"
    ];

    public static $exampleFinancialEventGroupsFailing = [
        "FinancialEventGroupStartedBefore" => "-1 day",
        // "FinancialEventGroupStartedAfter" => "-2 day"
    ];

}