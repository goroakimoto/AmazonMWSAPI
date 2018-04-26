<?php

namespace AmazonMWSAPI\Operations\Orders;

use AmazonMWSAPI\Sections\Orders;

class ListOrders extends Orders
{

    protected static $requestQuota = 6;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "minute";
    protected static $method = "POST";
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrders.html";
    protected static $requiredParameters = [];
    protected static $parameters = [
        "BuyerEmail" => [
            "incompatibleWith" => [
                "FulfillmentChannel",
                "LastUpdatedAfter",
                "LastUpdatedBefore",
                "OrderStatus",
                "PaymentMethod",
                "SellerOrderId"
            ]
        ],
        "CreatedAfter" => [
            "earlierThan" => [
                "CreatedBefore",
                "Timestamp"
            ],
            "format" => "dateTime",
            "incompatibleWith" => "LastUpdatedAfter",
            "requiredIfNotSet" => "LastUpdatedAfter"
        ],
        "CreatedBefore" => [
            "earlierThan" => "Timestamp",
            "format" => "dateTime",
            "laterThan" => "CreatedAfter"
        ],
        "FulfillmentChannel" => [
            "validWith" => [
                "AFN",
                "MFN"
            ]
        ],
        "LastUpdatedAfter" => [
            "earlierThan" => [
                "LastUpdatedBefore",
                "Timestamp"
            ],
            "format" => "dateTime",
            "incompatibleWith" => [
                "BuyerEmail",
                "CreatedAfter",
                "SellerOrderId"
            ],
            "requiredIfNotSet" => "CreatedAfter"
        ],
        "LastUpdatedBefore" => [
            "earlierThan" => "Timestamp",
            "format" => "dateTime",
            "laterThan" => "LastUpdatedAfter"
        ],
        "MarketplaceId" => [
            "maximumLength" => 50,
            "required"
        ],
        "MaxResultsPerPage" => [
            "rangeWithin" => [
                "min" => 1,
                "max" => 100
            ]
        ],
        "OrderStatus" => [
            "validWith" => [
                "PendingAvailability",
                "Pending",
                "Unshipped" => [
                    "dependentOn" => "PartiallyShipped"
                ],
                "PartiallyShipped" => [
                    "dependentOn" => "Unshipped"
                ],
                "InvoiceUnconfirmed",
                "Canceled",
                "Unfulfillable"
            ]
        ],
        "PaymentMethod" => [
            "validWith" => [
                "COD",
                "CVS",
                "Other"
            ]
        ],
        "SellerId" => [
            "required"
        ],
        "SellerOrderId" => [
            "incompatibleWith" => [
                "FulfillmentChannel",
                "OrderStatus",
                "PaymentMethod",
                "LastUpdatedAfter",
                "LastUpdatedBefore",
                "BuyerEmail"
            ]
        ],
        "TFMShipmentStatus" => [
            "validWith" => [
                "PendingPickUp",
                "LabelCanceled",
                "PickedUp",
                "AtDestinationFC",
                "Delivered",
                "RejectedByBuyer",
                "Undeliverable",
                "ReturnedToSeller",
                "Lost"
            ]
        ]
    ];

    public static $exampleListOrders = [
        "BuyerEmail" => "blah@example.com",
        "CreatedAfter" => "-3 days"
    ];

    public static $exampleListOrdersFailing = [
        // "BuyerEmail" => "blah@example.com",
        // "CreatedAfter" => "-3 days"
    ];

}