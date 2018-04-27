<?php

namespace AmazonMWSAPI\Operations\Finances;

use AmazonMWSAPI\Sections\Finances;

class ListFinancialEvents extends Finances
{

    protected $requestQuota = 30;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "second";
    protected $hourlyRequestQuota = 1800;
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/finances/Finances_ListFinancialEvents.html";
    protected $requiredParameters = [];
    protected $parameters = [
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