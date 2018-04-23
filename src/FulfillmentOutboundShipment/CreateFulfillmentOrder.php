<?php

namespace AmazonMWSAPI\FulfillmentOutboundShipment;

class CreateFulfillmentOrder extends FulfillmentOutboundShipment
{

    protected static $requestQuota = 30;
    protected static $restoreRate = 2;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_outbound/FBAOutbound_CreateFulfillmentOrder.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "notIncremented"
        ],
        "SellerFulfillmentOrderId" => [
            "maximumLength" => 40,
            "required"
        ],
        "FulfillmentAction" => [
            "validWith" => [
                "Ship",
                "Hold"
            ]
        ],
        "DisplayableOrderId" => [
            "minimumLength" => 1,
            "maximumLength" => 40,
            "required"
        ],
        "DisplayableOrderDateTime" => [
            "format" => "dateTime",
            "required"
        ],
        "DisplayableOrderComment" => [
            "maximumLength" => 1000,
            "required"
        ],
        "ShippingSpeedCategory" => [
            "required",
            "validWith" => [
                "Standard",
                "Expedited",
                "Priority",
                "ScheduledDelivery"
            ]
        ],
        "DestinationAddress" => [
            "format" => "Address",
            "required"
        ],
        "FulfillmentPolicy" => [
            "validWith" => [
                "FillOrKill",
                "FillAll",
                "FillAllAvailable"
            ]
        ],
        "NotificationEmailList" => [
            "maximumLength" => 64
        ],
        "CODSettings" => [
            "format" => "CODSettings",
            "validIf" => [
                "country" => [
                    "CN",
                    "JP"
                ]
            ]
        ],
        "Items" => [
            "format" => "CreateFulfillmentOrderItem",
            "required"
        ],
        "DeliveryWindow" => [
            "requiredIf" => [
                "ShippingSpeedCategory" => "ScheduledDelivery"
            ],
            "validIf" => [
                "country" => [
                    "JP"
                ]
            ]
        ],
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleCreateFulfillmentOrder = [
        "SellerFulfillmentOrderId" => "1234567890",
        "DisplayableOrderId" => "123456",
        "DisplayableOrderDateTime" => "now",
        "DisplayableOrderComment" => "Sent this morning",
        "ShippingSpeedCategory" => "Standard",
        "DestinationAddress" => [
            "Name" => "Ben Parker",
            "Line1" => "123 Main St",
            "City" => "New York",
            "StateOrProvinceCode" => "NY",
            "CountryCode" => "US"
        ],
        "CODSettings" => [
            "CODCharge" => [
                "CurrencyCode" => "USD",
                "Value" => "2.99"
            ]
        ],
        "NotificationEmailList" => [
            "joe@example.com",
            "bob@example.com"
        ],
        "Items" => [
            [
                "SellerSKU" => "M150",
                "SellerFulfillmentOrderItemId" => "1",
                "Quantity" => 2,
                "PerUnitPrice" => [
                    "CurrencyCode" => "USD",
                    "Value" => "4.95"
                ]
            ],
            [
                "SellerSKU" => "M180",
                "SellerFulfillmentOrderItemId" => "2",
                "Quantity" => 10
            ]
        ]
    ];

    public static $exampleCreateFulfillmentOrderFailing = [
        "SellerFulfillmentOrderId" => "1234567890",
        "DisplayableOrderId" => "123456",
        "DisplayableOrderDateTime" => "now",
        "DisplayableOrderComment" => "Sent this morning",
        "ShippingSpeedCategory" => "Standard",
        "DestinationAddress" => [
            "Name" => "Ben Parker",
            "Line1" => "123 Main St",
            "City" => "New York",
            "StateOrProvinceCode" => "NY",
            "CountryCode" => "US"
        ],
        "CODSettings" => [
            "CODCharge" => [
                "CurrencyCode" => "USD",
                "Value" => "2.99"
            ]
        ],
        "NotificationEmailList" => [
            "joe@example.com",
            "bob@example.com"
        ],
        "Items" => [
            [
                // "SellerSKU" => "M150",
                "SellerFulfillmentOrderItemId" => "1",
                "Quantity" => 2,
                "PerUnitPrice" => [
                    "CurrencyCode" => "USD",
                    "Value" => "4.95"
                ]
            ],
            [
                "SellerSKU" => "M180",
                "SellerFulfillmentOrderItemId" => "2",
                "Quantity" => 10
            ]
        ]
    ];

}