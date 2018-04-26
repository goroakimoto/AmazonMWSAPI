<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class ListInboundShipments extends FulfillmentInboundShipment
{

    protected static $requestQuota = 30;
    protected static $restoreRate = 2;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipments.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "ShipmentStatusList" => [
            "requiredIfNotSet" => "ShipmentIdList",
            "validWith" => [
                "WORKING",
                "SHIPPED",
                "IN_TRANSIT",
                "DELIVERED",
                "CHECKED_IN",
                "RECEIVING",
                "CLOSED",
                "CANCELLED",
                "DELETED",
                "ERROR"
            ]
        ],
        "ShipmentIdList" => [
            "requiredIfNotSet" => "ShipmentStatusList"
        ],
        "LastUpdatedAfter" => [
            "format" => "dateTime",
            "earlierThan" => "LastUpdatedBefore",
            "requiredIfSet" => "LastUpdatedBefore"
        ],
        "LastUpdatedBefore" => [
            "format" => "dateTime",
            "laterThan" => "LastUpdatedAfter",
            "requiredIfSet" => "LastUpdatedAfter"
        ]
    ];

    public static $exampleListInboundShipments = [
        "ShipmentStatusList" => [
            "WORKING"
        ]
    ];

    public static $exmpleListInboundShipmentsShipmentIdList = [
        "ShipmentIdList" => [
            "FBA44JV8R"
        ],
        "LastUpdateAfter" => "",
        "LastUpdatedBefore" => ""
    ];

}