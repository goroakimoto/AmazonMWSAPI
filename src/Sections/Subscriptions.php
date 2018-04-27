<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\Sections\Sections;

class Subscriptions extends Sections
{

    protected $feedType = "";
    protected $feedContent = "";
    protected $versionDate = "2013-07-01";
    private $overviewUrl = "http://docs.developer.amazonservices.com/en_US/subscriptions/Subscriptions_Overview.html";
    private $libraryUpdateUrl = "http://docs.developer.amazonservices.com/en_US/subscriptions/Subscriptions_ClientLibraries.html";
    protected $dataTypes = [
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