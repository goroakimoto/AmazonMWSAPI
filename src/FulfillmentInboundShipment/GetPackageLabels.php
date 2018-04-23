<?php

namespace AmazonMWSAPI\FulfillmentInboundShipment;

class GetPackageLabels extends FulfillmentInboundShipment
{

    protected static $requestQuota = 30;
    protected static $restoreRate = 2;
    protected static $restoreRateTime = 1;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPackageLabels.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "ShipmentId" => [
            "required"
        ],
        "PageType" => [
            "required",
            "validWith" => [
                "PackageLabel_Letter_2",
                "PackageLabel_Letter_6",
                "PackageLabel_A4_2",
                "PackageLabel_A4_4",
                "PackageLabel_Plain_Paper"
            ]
        ],
        "NumberOfPackages",
        "SellerId" => [
            "required"
        ]
    ];

}