<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\Sections\Sections;

class Subscriptions extends Sections
{

    protected static $feedType = "";
    protected static $feedContent = "";
    protected static $versionDate = "2013-07-01";
    private static $overviewUrl = "http://docs.developer.amazonservices.com/en_US/subscriptions/Subscriptions_Overview.html";
    private static $libraryUpdateUrl = "http://docs.developer.amazonservices.com/en_US/subscriptions/Subscriptions_ClientLibraries.html";
    protected static $dataTypes = [
        "AttributeKeyValue" => [
            "Key" => [
                "required",
                "valueWith" => [
                    "sqsQueueUrl"
                ]
            ],
            "Value" => [
                "required"
            ]
        ],
        "Destination" => [
            "DeliveryChannel" => [
                "required",
                "validWith" => [
                    "SQS"
                ]
            ],
            "AttributeList" => [
                "format" => "AttributeKeyValue",
                "required"
            ]
        ],
        "Subscription" => [
            "NotificationType" => [
                "format" => "NotificationType",
                "required"
            ],
            "Destination" => [
                "format" => "Destination",
                "required"
            ],
            "IsEnabled" => [
                "required"
            ]
        ],
        "NotificationType" => [
            "AnyOfferChanged",
            "FulfillmentOrderStatus",
            "FeePromotion"
        ]
    ];

}