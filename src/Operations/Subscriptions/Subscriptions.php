<?php

namespace AmazonMWSAPI\Operations\Subscriptions;

use AmazonMWSAPI\{APIMethods, APIParameters, APIParameterValidation, APIProperties};

class Subscriptions
{

    use APIMethods;
    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected static $feedType = "";
    protected static $feedContent = "";
    protected static $feed = "Subscriptions";
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

    public function __construct($parametersToSet = null)
    {

        static::setParameters($parametersToSet);

        static::verifyParameters();

    }

}