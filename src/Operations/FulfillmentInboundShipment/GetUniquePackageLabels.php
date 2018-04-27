<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class GetUniquePackageLabels extends FulfillmentInboundShipment
{

    protected $requestQuota = 30;
    protected $restoreRate = 2;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetUniquePackageLabels.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "ShipmentId" => [
            "required"
        ],
        "PageType" => [
            "required",
            "validWith" => [
                "PackageLabel_Letter_2",
                "PackageLabel_letter_6",
                "PackageLabel_A4_2",
                "PackageLabel_A4_4",
            ]
        ],
        "PackageLabelsToPrint" => [
            "maximumCount" => 999,
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}