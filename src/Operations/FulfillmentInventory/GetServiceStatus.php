<?php

namespace AmazonMWSAPI\Operations\FulfillmentInventory;

use AmazonMWSAPI\Sections\FulfillmentInventory;

class GetServiceStatus extends FulfillmentInventory
{

    protected $requestQuote = 2;
    protected $restoreRate = 1;
    protected $restoreRateTime = 5;
    protected $restoreRateTimePeriod = "minute";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inventory/MWS_GetServiceStatus.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

}