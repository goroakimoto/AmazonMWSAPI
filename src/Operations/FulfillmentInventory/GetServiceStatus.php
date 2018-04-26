<?php

namespace AmazonMWSAPI\Operations\FulfillmentInventory;

use AmazonMWSAPI\Sections\FulfillmentInventory;

class GetServiceStatus extends FulfillmentInventory
{

    protected static $requestQuote = 2;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 5;
    protected static $restoreRateTimePeriod = "minute";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inventory/MWS_GetServiceStatus.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}