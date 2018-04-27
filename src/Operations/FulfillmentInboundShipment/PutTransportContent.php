<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class PutTransportContent extends FulfillmentInboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_PutTransportContent.html";
    protected $requiredParameters = [];
    protected $parameters = [
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