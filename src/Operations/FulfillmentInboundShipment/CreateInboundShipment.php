<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class CreateInboundShipment extends FulfillmentInboundShipment
{

    protected static $requestQuota = 30;
    protected static $restoreRate = 2;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipment.htmll";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "ShipmentId" => [
            "required"
        ],
        "InboundShipmentHeader" => [
            "format" => "InboundShipmentHeader",
            "required"
        ],
        "InboundShipmentItems" => [
            "format" => "InboundShipmentItem",
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];
    public static $exampleCreateInboundShipment = [
        "ShipmentId" => "1234567890",
        "InboundShipmentHeader" => [
            "ShipmentName" => "Blah",
            "ShipFromAddress" => [
                "Name" => "Ben Parker",
                "AddressLine1" => "1234 Main St.",
                "City" => "New York",
                "CountryCode" => "US"
            ],
            "DestinationFulfillmentCenterId" => "987654321",
            "LabelPrepPreference" => "SELLER_LABEL",
            "AreCasesRequired" => "false",
            "ShipmentStatus" => "WORKING",
        ],
        "InboundShipmentItems" => [
            [
                "SellerSKU" => "M150",
                "QuantityShipped" => 5,
                "QuantityInCase" => 10,
                "ReleaseDate" => "2018-01-05",
                "PrepDetailsList" => [
                    [
                        "PrepInstruction" => "Labeling",
                        "PrepOwner" => "SELLER"
                    ]
                ]
            ],
            [
                "SellerSKU" => "M180",
                "QuantityShipped" => 2,
                "QuantityInCase" => 4,
                "ReleaseDate" => "2018-01-05",
                "PrepDetailsList" => [
                    [
                        "PrepInstruction" => "Labeling",
                        "PrepOwner" => "SELLER"
                    ],
                    [
                        "PrepInstruction" => "Polybagging",
                        "PrepOwner" => "SELLER"
                    ]
                ]
            ]
        ]
    ];

    public static $exampleCreateInboundShipmentFailing = [
        "ShipmentId" => "1234567890",
        "InboundShipmentHeader" => [
            "ShipmentName" => "Blah",
            "ShipFromAddress" => [
                "Name" => "Ben Parker",
                "AddressLine1" => "1234 Main St.",
                "City" => "New York",
                "CountryCode" => "US"
            ],
            "DestinationFulfillmentCenterId" => "987654321",
            "LabelPrepPreference" => "SELLER_LABEL",
            "AreCasesRequired" => "false",
            "ShipmentStatus" => "WORKING",
        ],
        "InboundShipmentItems" => [
            [
                "SellerSKU" => "M150",
                "QuantityShipped" => 5,
                "QuantityInCase" => 10,
                "ReleaseDate" => "2018-01-05",
                "PrepDetailsList" => [
                    [
                        // "PrepInstruction" => "Labeling",
                        "PrepOwner" => "SELLER"
                    ]
                ]
            ],
            [
                // "SellerSKU" => "M180",
                "QuantityShipped" => 2,
                "QuantityInCase" => 4,
                "ReleaseDate" => "2018-01-05",
                "PrepDetailsList" => [
                    [
                        "PrepInstruction" => "Labeling",
                        "PrepOwner" => "SELLER"
                    ],
                    [
                        "PrepInstruction" => "Polybagging",
                        "PrepOwner" => "SELLER"
                    ]
                ]
            ]
        ]
    ];

}