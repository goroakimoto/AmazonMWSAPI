<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class ListInboundShipmentItems extends FulfillmentInboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItems.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ShipmentId" => [
            "requiredIfNotSet" => [
                "LastUpdatedAfter",
                "LastUpdatedBefore"
            ]
        ],
        "LastUpdatedAfter" => [
            "earlierThan" => "LastUpdatedBefore",
            "format" => "dateTime",
            "requiredIfSet" => "LastUpdatedBefore",
            "requiredIfNotSet" => "ShipmentId"
        ],
        "LastUpdatedBefore" => [
            "format" => "dateTime",
            "laterThan" => "LastUpdatedAfter",
            "requiredIfSet" => "LastUpdatedAfter",
            "requiredIfNotSet" => "ShipmentId"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}