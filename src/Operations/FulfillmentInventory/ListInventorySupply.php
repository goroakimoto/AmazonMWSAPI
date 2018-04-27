<?php

namespace AmazonMWSAPI\Operations\FulfillmentInventory;

use AmazonMWSAPI\Sections\FulfillmentInventory;

class ListInventorySupply extends FulfillmentInventory
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inventory/FBAInventory_ListInventorySupply.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "SellerSkus" => [
            "incompatibleWith" => "QueryStartDateTime",
            "maximumCount" => 50,
            "requiredIfNotSet" => "QueryStartDateTime"
        ],
        "QueryStartDateTime" => [
            "format" => "dateTime",
            "incompatibleWith" => "SellerSkus"
        ],
        "ResponseGroup" => [
            "validWith" => [
                "Basic",
                "Detailed"
            ]
        ],
        "MarketplaceId",
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleListInventorySupply = [];

}