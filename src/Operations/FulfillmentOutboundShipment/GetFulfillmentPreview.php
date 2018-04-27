<?php

namespace AmazonMWSAPI\Operations\FulfillmentOutboundShipment;

use AmazonMWSAPI\Sections\FulfillmentOutboundShipment;

class GetFulfillmentPreview extends FulfillmentOutboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_outbound/FBAOutbound_GetFulfillmentPreview.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "MarketplaceId",
        "Address" => [
            "format" => "Address",
            "required"
        ],
        "Items" => [
            "format" => "GetFulfillmentPreviewItem",
            "required"
        ],
        "ShippingSpeedCategories" => [
            "validWith" => [
                "Standard",
                "Expedited",
                "Priority",
                "ScheduledDelivery"
            ]
        ],
        "IncludeCODFulfillmentPreview" => [
            "validWith" => [
                "true",
                "false"
            ]
        ],
        "IncludeDeliveryWindows" => [
            "validWith" => [
                "true",
                "false"
            ]
        ],
        "SellerId" => [
            "required"
        ]
    ];

}