<?php

namespace AmazonMWSAPI\FulfillmentOutboundShipment;

use AmazonMWSAPI\{APIMethods, APIParameters, APIParameterValidation, APIProperties};

class FulfillmentOutboundShipment
{

    use APIMethods;
    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected static $feedType = "";
    protected static $feedContent = "";
    protected static $feed = "Finances";
    protected static $versionDate = "2015-05-01";
    private static $overviewUrl = "http://docs.developer.amazonservices.com/en_US/fba_inventory/MWS_GetServiceStatus.html";
    private static $libraryUpdateUrl = "http://docs.developer.amazonservices.com/en_US/finances/Finances_ClientLibraries.html";
    protected static $dataTypes = [
        "Address" => [
            "Name" => [
                "maximumLength" => 50,
                "required"
            ],
            "Line1" => [
                "maximumLength" => 60,
                "required"
            ],
            "Line2" => [
                "maximumLength" => 60
            ],
            "Line3" => [
                "maximumLength" => 60
            ],
            "DistrictOrCounty" => [
                "maximumLength" => 150
            ],
            "City" => [
                "maximumLength" => 50,
                "requiredIf" => [
                    "notIn" => "JP"
                ]
            ],
            "StateOrProvinceCode" => [
                "maximumLength" => 150,
                "required"
            ],
            "CountryCode" => [
                "length" => 2,
                "required"
            ],
            "PostalCode" => [
                "maximumLength" => 20
            ],
            "PhoneNumber" => [
                "maximumLength" => 20
            ]
        ],
        "CODSettings" => [
            "IsCODRequired" => [
                "validIf" => [
                    "country" => [
                        "CN" => [
                            "true"
                        ],
                        "JP" => [
                            "true"
                        ]
                    ]
                ]
            ],
            "CODCharge" => [
                "format" => "Currency",
                "validIf" => [
                    "country" => [
                        "CN",
                        "JP"
                    ]
                ]
            ],
            "CODChargeTax" => [
                "format" => "Currency",
                "validIf" => [
                    "country" => [
                        "CN",
                        "JP"
                    ]
                ]
            ],
            "ShippingCharge" => [
                "format" => "Currency",
                "validIf" => [
                    "country" => [
                        "CN",
                        "JP"
                    ]
                ]
            ],
            "ShippingChargeTax" => [
                "format" => "Currency",
                "validIf" => [
                    "country" => [
                        "CN",
                        "JP"
                    ]
                ]
            ]
        ],
        "CreateFulfillmnetOrderItem" => [
            "SellerSKU" => [
                "maximumLength" => 50,
                "required"
            ],
            "SellerFulfillmentOrderItemId" => [
                "maximumLength" => 50,
                "required"
            ],
            "Quantity" => [
                "required"
            ],
            "GiftMessage" => [
                "maximumLength" => 512
            ],
            "DisplayableComment" => [
                "maximumLength" => 250
            ],
            "FulfillmentNetworkSKU",
            "PerUnitDeclaredValue" => [
                "format" => "Currency",
                "requiredIf" => [
                    "destinationCountryIsNot" => "originatingCountry"
                ]
            ],
            "PerUnitPrice" => [
                "format" => "Currency",
                "requiredIfSet" => [
                    "IsCODRequired" => "true"
                ],
                "validIf" => [
                    "country" => [
                        "CN",
                        "JP"
                    ]
                ]
            ],
            "PerUnitTax" => [
                "format" => "Currency",
                "validIf" => [
                    "country" => [
                        "CN",
                        "JP"
                    ]
                ]
            ]
        ],
        "CreateReturnItem" => [
            "SellerReturnItemId" => [
                "maximumLength" => 80,
                "required"
            ],
            "SellerFulfillmentOrderItemId" => [
                "required"
            ],
            "AmazonShipmentId" => [
                "required"
            ],
            "ReturnReasonCode" => [
                "required"
            ],
            "ReturnComment" => [
                "maximumLength" => 1000
            ]
        ],
        "Currency" => [
            "CurrencyCode" => [
                "length" => 3,
                "required"
            ],
            "Value" => [
                "required"
            ]
        ],
        "DeliveryWindow" => [
            "StartDateTime" => [
                "format" => "dateTime",
                "required"
            ],
            "EndDateTime" => [
                "format" => "dateTime",
                "required"
            ]
        ],
        "Fee" => [
            "Name" => [
                "required",
                "validWith" => [
                    "FBAPerUnitFulfillmentFee",
                    "FBAPerOrderFulfillmentFee",
                    "FBATransportationFee",
                    "FBAFulfillmentCODFee"
                ]
            ],
            "Amount" => [
                "format" => "Currency",
                "required"
            ]
        ],
        "FulfillmentOrder" => [
            "SellerFulfillmentOrderId" => [
                "required"
            ],
            "MarketplaceId" => [
                "required"
            ],
            "DisplayableOrderId" => [
                "required"
            ],
            "DisplayableOrderComment" => [
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
            "DeliveryWindow" => [
                "format" => "DeliveryWindow"
            ],
            "DestinationAddress" => [
                "format" => "Address",
                "required"
            ],
            "FulfillmentAction" => [
                "validWith" => [
                    "Ship",
                    "Hold"
                ]
            ],
            "FulfillmentPolicy" => [
                "validWith" => [
                    "FillOrKill",
                    "FillAll",
                    "FillAllAvailable"
                ]
            ],
            "ReceivedDateTime" => [
                "format" => "dateTime",
                "required"
            ],
            "FulfillmentOrderStatus" => [
                "required",
                "validWith" => [
                    "RECEIVED",
                    "INVALID",
                    "PLANNING",
                    "PROCESSING",
                    "CANCELLED",
                    "COMPLETE_PARTIALLED",
                    "UNFULFILLABLE"
                ]
            ],
            "StatusUpdatedDateTime" => [
                "format" => "dateTime",
                "required"
            ],
            "NotificationEmailList",
            "CODSettings"
        ],
        "FulfillmentOrderItem" => [
            "SellerSKU" => [
                "required"
            ],
            "SellerFulfillmentOrderItemId" => [
                "required"
            ],
            "Quantity" => [
                "required"
            ],
            "GiftMessage",
            "DisplayableComment",
            "FulfillmentNetworkSKU",
            "CancelledQuantity" => [
                "required"
            ],
            "UnfulfillableQuantity" => [
                "required"
            ],
            "EstimatedShipDateTime" => [
                "format" => "dateTime"
            ],
            "EstimatedArrivalDateTime" => [
                "format" => "dateTime"
            ],
            "PerUnitDeclaredValue" => [
                "format" => "Currency"
            ],
            "PerUnitPrice" => [
                "format" => "Currency"
            ],
            "PerUnitTax" => [
                "format" => "Currency"
            ]
        ],
        "FulfillmentPreview" => [
            "ShippingSpeedCategory" => [
                "required",
                "validWith" => [
                    "Standard",
                    "Expedited",
                    "Priority",
                    "ScheduledDelivery"
                ]
            ],
            "IsFulfillable" => [
                "required",
                "validWith" => [
                    "true",
                    "false"
                ]
            ],
            "IsCODCapable" => [
                "required",
                "validWith" => [
                    "true",
                    "false"
                ]
            ],
            "MarketplaceId" => [
                "required"
            ],
            "EstimatedShippingWeight" => [
                "format" => "weight"
            ],
            "EstimatedFees" => [
                "format" => "fee"
            ],
            "FulfillmentPreviewShipments" => [
                "format" => "FulfillmentPreviewShipment"
            ],
            "UnfulfillablePreviewItems" => [
                "format" => "UnfulfillablePreviewItem"
            ],
            "OrderUnfulfillableReasons",
            "ScheduledDeliveryInfo" => [
                "format" => "ScheduledDeliveryInfo"
            ]
        ],
        "FulfillmentPreviewItem" => [
            "SellerSKU" => [
                "required"
            ],
            "SellerFulfillmentOrderItemId" => [
                "required"
            ],
            "Quantity" => [
                "required"
            ],
            "EstimatedShippingWeight" => [
                "format" => "Weight"
            ],
            "ShippingWeightCalculationMethod" => [
                "validWith" => [
                    "Package",
                    "dimensional"
                ]
            ]
        ],
        "FulfillmentPreviewShipment" => [
            "EarliestShipDate" => [
                "format" => "dateTime",
                "required"
            ],
            "LatestShipDate" => [
                "format" => "dateTime",
                "required"
            ],
            "EarliestArrivalDate" => [
                "format" => "dateTime",
                "required"
            ],
            "LatestArrivalDate" => [
                "format" => "dateTime",
                "required"
            ],
            "FulfillmentPreviewItems" => [
                "format" => "FulfillmentPreviewItem",
                "required"
            ]
        ],
        "FulfillmentShipment" => [
            "AmazonShipmentId" => [
                "required"
            ],
            "FulfillmentCenterId" => [
                "required"
            ],
            "FulfillmentShipmentStatus" => [
                "required",
                "validWith" => [
                    "PENDING",
                    "SHIPPED",
                    "CANCELLED_BY_FULFILLER",
                    "CANCELLED_BY_SELLER"
                ]
            ],
            "ShippingDateTime" => [
                "format" => "dateTime"
            ],
            "EstimatedArrivalDateTime" => [
                "format" => "dateTime"
            ],
            "FulfillmentShipmentItem" => [
                "format" => "FulfillmentShipmentItem",
                "required"
            ],
            "FulfillmentShipmentPackage" => [
                "format" => "FulfillmentShipmentPackage"
            ]
        ],
        "FulfillmentShipmentItem" => [
            "SellerSKU",
            "SellerFulfillmentOrderItemId" => [
                "required"
            ],
            "Quantity" => [
                "required"
            ],
            "PackageNumber"
        ],
        "FulfillmentShipmentPackage" => [
            "PackageNumber" => [
                "required"
            ],
            "CarrierCode" => [
                "required"
            ],
            "TrackingNumber",
            "EstimatedArrivalDateTime" => [
                "format" => "dateTime"
            ]
        ],
        "GetFulfillmentPreviewItem" => [
            "SellerSKU" => [
                "maximumLength" => 50,
                "required"
            ],
            "SellerFulfillmentOrderItemId" => [
                "maximumLength" => 50,
                "required"
            ],
            "Quantity" => [
                "required"
            ]
        ],
        "InvalidItemReason" => [
            "InvalidItemReasonCode" => [
                "format" => "InvalidItemReasonCode",
                "required"
            ],
            "Description" => [
                "required"
            ]
        ],
        "InvalidItemReasonCode" => [
            "validWith" => [
                "InvalidValues",
                "DuplicateRequest",
                "NoCompletedShipItems",
                "NoReturnableQuantity"
            ]
        ],
        "InvalidReturnItem" => [
            "SellerReturnItemId" => [
                "required"
            ],
            "SellerFulfillmentOrderItemId" => [
                "required"
            ],
            "InvalidItemReason" => [
                "format" => "InvalidItemReason",
                "required"
            ]
        ],
        "ReasonCodeDetails" => [
            "ReturnReasonCode" => [
                "required"
            ],
            "Description" => [
                "required"
            ],
            "TranslatedDescription"
        ],
        "ReturnAuthorization" => [
            "ReturnAuthorizationId" => [
                "required"
            ],
            "FulfillmentCenterId" => [
                "required"
            ],
            "ReturnToAddress" => [
                "format" => "Address",
                "required"
            ],
            "AmazonRmaId" => [
                "required"
            ],
            "RmaPageURL" => [
                "required"
            ]
        ],
        "ReturnItem" => [
            "SellerReturnItemId" => [
                "required"
            ],
            "SellerFulfillmentOrderItemId" => [
                "required"
            ],
            "AmazonShipmentId" => [
                "required"
            ],
            "SellerReturnReasonCode" => [
                "required"
            ],
            "ReturnComment",
            "AmazonReturnReasonCode",
            "Status" => [
                "format" => "Status",
                "required"
            ],
            "StatusChangedDate" => [
                "format" => "dateTime",
                "required"
            ],
            "ReturnAuthorizationId",
            "ReturnReceivedCondition" => [
                "format" => "ReturnReceivedCondition"
            ],
            "FulfillmentCenterId"
        ],
        "ReturnReceivedCondition" => [
            "validWith" => [
                "CarrierDamaged",
                "CustomerDamaged",
                "Defective",
                "FulfillerDamaged",
                "Sellable"
            ]
        ],
        "ScheduledDeliveryInfo" => [
            "DeliveryTimeZone" => [
                "required"
            ],
            "DeliveryWindows" => [
                "format" => "DeliveryWindow",
                "required"
            ]
        ],
        "Status" => [
            "validWith" => [
                "New",
                "Processed"
            ]
        ],
        "TrackingAddress" => [
            "City" => [
                "maximumLength" => 150,
                "required"
            ],
            "State" => [
                "maximumLength" => 150,
                "required"
            ],
            "Country" => [
                "maximumLength" => 6,
                "required"
            ]
        ],
        "TrackingEvent" => [
            "EventDate" => [
                "format" => "dateTime",
                "required"
            ],
            "EventAddress" => [
                "format" => "TrackingAddress",
                "required"
            ],
            "EventCode" => [
                "required",
                "validWith" => [
                    "EVENT_101",
                    "EVENT_102",
                    "EVENT_201",
                    "EVENT_202",
                    "EVENT_203",
                    "EVENT_204",
                    "EVENT_205",
                    "EVENT_206",
                    "EVENT_301",
                    "EVENT_302",
                    "EVENT_304",
                    "EVENT_306",
                    "EVENT_307",
                    "EVENT_308",
                    "EVENT_309",
                    "EVENT_401",
                    "EVENT_402",
                    "EVENT_403",
                    "EVENT_404",
                    "EVENT_405",
                    "EVENT_406",
                    "EVENT_407",
                    "EVENT_408",
                    "EVENT_409",
                    "EVENT_411",
                    "EVENT_412",
                    "EVENT_413",
                    "EVENT_414",
                    "EVENT_415",
                    "EVENT_416",
                    "EVENT_417",
                    "EVENT_418",
                    "EVENT_419"
                ]
            ]
        ],
        "UnfulfillablePreviewItem" => [
            "SellerSKU" => [
                "maximumLength" => 50,
                "required"
            ],
            "SellerFulfillmentOrderItemId" => [
                "maximumLength" => 50,
                "required"
            ],
            "Quantity" => [
                "required"
            ],
            "ItemUnfulfillableReasons"
        ],
        "UpdateFulfillmentOrderItem" => [
            "SellerFulfillmentOrderItemId" => [
                "maximumLength" => 50,
                "required"
            ],
            "Quantity" => [
                "greaterThan" => 0,
                "required"
            ],
            "GiftMessage" => [
                "maximumLength" => 512
            ],
            "DisplayableComment" => [
                "maximumLength" => 250
            ],
            "PerUnitDeclaredValue" => [
                "format" => "Currency"
            ],
            "PerUnitPrice" => [
                "format" => "Currency"
            ],
            "PerUnitTax" => [
                "format" => "Currency"
            ]
        ],
        "Weight" => [
            "Unit" => [
                "required",
                "validWith" => [
                    "KG",
                    LB
                ]
            ],
            "Value" => [
                "required"
            ]
        ]
    ];

    public function __construct($parametersToSet = null)
    {

        static::setParameters($parametersToSet);

        static::verifyParameters();

    }

}