<?php

namespace AmazonMWSAPI\Operations\Finances;

use AmazonMWSAPI\Sections\Finances;

class ListFinancialEventGroups extends Finances
{

    protected $requestQuota = 30;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 1800;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/finances/Finances_ListFinancialEventGroups.html";
    protected $requiredParameters = [];
    protected $parameters = [
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