<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

class PutTransportContent extends FulfillmentInboundShipment
{

    protected static $requestQuota = 30;
    protected static $restoreRate = 2;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_PutTransportContent.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "ShipmentId" => [
            "required"
        ],
        "IsPartnered" => [
            "required",
            "validWith" => [
                "false",
                "true"
            ]
        ],
        "ShipmentType" => [
            "required",
            "validWith" => [
                "LTL",
                "SP"
            ]
        ],
        "TransportDetails" => [
            "format" => "TransportDetailInput",
            "required"
        ],
        "SellerId" => [
            "required"
        ],
        "MarketplaceId" => [
            "notIncremented",
            "required"
        ]
    ];

    public static $examplePutTransportContent = [
        "ShipmentId" => "1234567890",
        "IsPartnered" => "false",
        "ShipmentType" => "SP",
        "TransportDetails" => [
            "PartneredSmallParcelData" => [
                "CarrierName" => "UNITED_PARCEL_SERVICE_INC",
                "PackageList" => [
                    [
                        "Dimensions" => [
                            "Unit" => "inches",
                            "Length" => 12,
                            "Width" => 12,
                            "Height" => 12
                        ],
                        "Weight" => [
                            "Unit" => "pounds",
                            "Value" => 20
                        ]
                    ],
                    [
                        "Dimensions" => [
                            "Unit" => "inches",
                            "Length" => 12,
                            "Width" => 12,
                            "Height" => 12
                        ],
                        "Weight" => [
                            "Unit" => "pounds",
                            "Value" => 100
                        ]
                    ]
                ]
            ],
        ]
    ];

    public static $examplePutTransportContentFailing = [
        "ShipmentId" => "1234567890",
        "IsPartnered" => "false",
        "ShipmentType" => "SP",
        "TransportDetails" => [
            "PartneredSmallParcelData" => [
                "CarrierName" => "UNITED_PARCEL_SERVICE_INC",
                "PackageList" => [
                    [
                        "Dimensions" => [
                            // "Unit" => "inches",
                            "Length" => 12,
                            "Width" => 12,
                            "Height" => 12
                        ],
                        "Weight" => [
                            "Unit" => "pounds",
                            "Value" => 20
                        ]
                    ],
                    [
                        "Dimensions" => [
                            "Unit" => "inches",
                            "Length" => 12,
                            "Width" => 12,
                            "Height" => 12
                        ],
                        "Weight" => [
                            "Unit" => "pounds",
                            "Value" => 100
                        ]
                    ]
                ]
            ],
        ]
    ];

}