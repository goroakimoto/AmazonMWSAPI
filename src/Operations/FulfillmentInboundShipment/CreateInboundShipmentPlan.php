<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class CreateInboundShipmentPlan extends FulfillmentInboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipmentPlan.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ShipFromAddress" => [
            "format" => "Address",
            "required"
        ],
        "ShipToCountryCode" => [
            "incompatibleWith" => "ShipToCountrySubdivisionCode",
            "maximumLength" => 2,
            "validIf" => [
                "region" => [
                    "North America" => [
                        "CA",
                        "MX",
                        "US"
                    ],
                    "Europe" => [
                        "DE",
                        "ES",
                        "FR",
                        "GB",
                        "IT"
                    ]
                ]
            ]
        ],
        "ShipToCountrySubdivisionCode" => [
            "incompatibleWith" => "ShipToCountryCode",
            "maximumLength" => 2
        ],
        "LabelPrepPreference" => [
            "validWith" => [
                "AMAZON_LABEL_ONLY",
                "AMAZON_LABEL_PREFERRED",
                "SELLER_LABEL"
            ]
        ],
        "InboundShipmentPlanRequestItems" => [
            "format" => "InboundShipmentPlanRequestItem",
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleCreateInboundShipmentPlan = [
        "InboundShipmentPlanRequestItems" => [
            [
                "SellerSKU" => "SKU2",
                "Quantity" => 1,
                "PrepDetailsList" => [
                    [
                        "PrepInstruction" => "Taping",
                        "PrepOwner" => "AMAZON"
                    ]
                ]
            ]
        ],
        "ShipFromAddress" => [
            "Name" => "Ben Parker",
            "AddressLine1" => "123 Main St.",
            "City" => "New York",
            "CountryCode" => "IN"
        ],
        "LabelPrepPreference" => "SELLER_LABEL",
        "ShipToCountryCode" => "US"
    ];

    public static $exampleCreateInboundShipmentPlanFailing = [
        "InboundShipmentPlanRequestItems" => [
            [
                "SellerSKU" => "SKU2",
                "Quantity" => 1,
                "PrepDetailsList" => [
                    [
                        // "PrepInstruction" => "Taping",
                        "PrepOwner" => "AMAZON"
                    ]
                ]
            ]
        ],
        "ShipFromAddress" => [
            "Name" => "Ben Parker",
            "AddressLine1" => "123 Main St.",
            "City" => "New York",
            // "CountryCode" => "IN"
        ],
        "LabelPrepPreference" => "SELLER_LABEL",
        "ShipToCountryCode" => "US"
    ];

}