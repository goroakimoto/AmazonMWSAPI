<?php

namespace AmazonMWSAPI\Operations\FulfillmentOutboundShipment;

use AmazonMWSAPI\Sections\FulfillmentOutboundShipment;

class UpdateFulfillmentOrder extends FulfillmentOutboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_outbound/FBAOutbound_UpdateFulfillmentOrder.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "MarketplaceId",
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
            "minimumLength" => 7,
            "maximumLength" => 40
        ],
        "DisplayableOrderDateTime" => [
            "format" => "dateTime"
        ],
        "DisplayableOrderComment" => [
            "maximumLength" => 1000
        ],
        "ShippingSpeedCategory" => [
            "validWith" => [
                "Standard",
                "Expedited",
                "Priority"
            ]
        ],
        "DestinationAddress" => [
            "format" => "Address"
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
        "Items" => [
            "format" => "UpdateFulfillmentOrderItem"
        ],
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleUpdateFulfillmentOrder = [
        "DisplayableOrderId" => "12345678",
        "SellerFulfillmentOrderId" => "113-8652632-9749050",
        "DestinationAddress" => [
            "Name" => "Ben Parker",
            "Line1" => "123 Main St",
            "City" => "Blah",
            "StateOrProvinceCode" => "ID",
            "CountryCode" => "US"
        ],
        "Items" => [
            [
                "SellerFulfillmentOrderItemId" => "192938",
                "Quantity" => 1,
                "PerUnitDeclaredValue" => [
                    "CurrencyCode" => "USD",
                    "Value" => "1.99"
                ],
                "PerUnitPrice" => [
                    "CurrencyCode" => "USD",
                    "Value" => "1.99"
                ],
                "PerUnitTax" => [
                    "CurrencyCode" => "USD",
                    "Value" => "0.12"
                ]
            ],
            [
                "SellerFulfillmentOrderItemId" => "M180",
                "Quantity" => 10,
                "PerUnitDeclaredValue" => [
                    "CurrencyCode" => "USD",
                    "Value" => "10.99"
                ],
                "PerUnitPrice" => [
                    "CurrencyCode" => "USD",
                    "Value" => "10.99"
                ],
                "PerUnitTax" => [
                    "CurrencyCode" => "USD",
                    "Value" => "0.66"
                ]
            ]
        ]
    ];

    public static $exampleUpdateFulfillmentOrderFailing = [
        "DisplayableOrderId" => "12345678",
        "SellerFulfillmentOrderId" => "113-8652632-9749050",
        "DestinationAddress" => [
            // "Name" => "Ben Parker",
            "Line1" => "123 Main St",
            "City" => "Blah",
            "StateOrProvinceCode" => "ID",
            "CountryCode" => "US"
        ],
        "Items" => [
            [
                "SellerFulfillmentOrderItemId" => "192938",
                "Quantity" => 1,
                "PerUnitDeclaredValue" => [
                    "CurrencyCode" => "USD",
                    "Value" => "1.99"
                ],
                "PerUnitPrice" => [
                    "CurrencyCode" => "USD",
                    "Value" => "1.99"
                ],
                "PerUnitTax" => [
                    "CurrencyCode" => "USD",
                    "Value" => "0.12"
                ]
            ],
            [
                "SellerFulfillmentOrderItemId" => "M180",
                "Quantity" => 10,
                "PerUnitDeclaredValue" => [
                    "CurrencyCode" => "USD",
                    "Value" => "10.99"
                ],
                "PerUnitPrice" => [
                    "CurrencyCode" => "USD",
                    "Value" => "10.99"
                ],
                "PerUnitTax" => [
                    "CurrencyCode" => "USD",
                    "Value" => "0.66"
                ]
            ]
        ]
    ];

}