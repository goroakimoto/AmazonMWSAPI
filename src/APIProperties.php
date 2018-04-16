<?php

namespace AmazonMWSAPI;

trait APIProperties
{

    protected static $signatureMethod = 'HmacSHA256';
    protected static $signatureVersion = "2";
    protected static $orderNumberFormat = "/^[0-9]{3}\-[0-9]{7}\-[0-9]{7}$/";
    protected static $marketplaceTypes = [
        "US" => [
            "endpoint" => "https://mws.amazonservices.com",
            "marketplaceId" => "ATVPDKIKX0DER",
            "countryCode" => "US",
            "region" => "North America"
        ],
        "Canada" => [
            "endpoint" => "https://mws.amazonservices.com",
            "marketplaceId" => "A2EUQ1WTGCTBG2",
            "countryCode" => "CA",
            "region" => "North America"
        ],
        "Mexico" => [
            "endpoint" => "https://mws.amazonservices.com",
            "marketplaceId" => "A1AM78C64UM0Y8",
            "countryCode" => "MX",
            "region" => "North America"
        ],
        "Spain" => [
            "endpoint" => "https://mws-eu.amazonservices.com",
            "marketplaceId" => "A1RKKUPIHCS9HS",
            "countryCode" => "ES",
            "region" => "Europe"
        ],
        "UK" => [
            "endpoint" => "https://mws-eu.amazonservices.com",
            "marketplaceId" => "A1F83G8C2ARO7P",
            "countryCode" => "UK",
            "region" => "Europe"
        ],
        "France" => [
            "endpoint" => "https://mws-eu.amazonservices.com",
            "marketplaceId" => "A13V1IB3VIYZZH",
            "countryCode" => "FR",
            "region" => "Europe"
        ],
        "Germany" => [
            "endpoint" => "https://mws-eu.amazonservices.com",
            "marketplaceId" => "A1PA6795UKMFR9",
            "countryCode" => "DE",
            "region" => "Europe"
        ],
        "Italy" => [
            "endpoint" => "https://mws-eu.amazonservices.com",
            "marketplaceId" => "APJ6JRA9NG5V4",
            "countryCode" => "IT",
            "region" => "Europe"
        ],
        "Brazil" => [
            "endpoint" => "https://mws.amazonservices.com",
            "marketplaceId" => "A2Q3Y263D00KWC",
            "countryCode" => "BR",
            "region" => "Brazil"
        ],
        "India" => [
            "endpoint" => "https://mws.amazonservices.in",
            "marketplaceId" => "A21TJRUUN4KGV",
            "countryCode" => "IN",
            "region" => "India"
        ],
        "China" => [
            "endpoint" => "https://mws.amazonservices.com.cn",
            "marketplaceId" => "AAHKV2X7AFYLW",
            "countryCode" => "CN",
            "region" => "China"
        ],
        "Japan" => [
            "endpoint" => "https://mws.amazonservices.jp",
            "marketplaceId" => "A1VC38T7YXB528",
            "countryCode" => "JP",
            "region" => "Japan"
        ],
        "Australia" => [
            "endpoint" => "https://mws.amazonservices.com.au",
            "marketplaceId" => "A39IBJ37TRP1C6",
            "countryCode" => "AU",
            "region" => "Australia"
        ]
    ];
    protected static $incrementors = [
        "AmazonOrderId" => "Id",
        "ASINList" => [
            "default" => "Id",
            "GetMyPriceForASIN" => "ASIN"
        ],
        "AttributeList" => "member",
        "CategoryQueryList" => "CategoryQuery",
        "FeedProcessingStatusList" => "Status",
        "FeedSubmissionIdList" => "Id",
        "FeedTypeList" => "Type",
        "FeesEstimateRequestList" => "FeesEstimateRequest",
        "FilterOptions" => "FilterOption",
        "FulfillmentChannel" => "Channel",
        "IdList" => "Id",
        "InboundShipmentItems" => "member",
        "InboundShipmentPlanRequest" => "member",
        "InboundShipmentPlanRequestItems" => "member",
        "ItemList" => "Item",
        "Items" => "member",
        "MarketplaceId" => "Id",
        "MarketplaceIdList" => "Id",
        "NotificationEmailList" => "member",
        "OrderStatus" => "Status",
        "PackageLabelsToPrint" => "member",
        "PackageList" => "member",
        "PalletList" => "member",
        "PaymentMethod" => "Method",
        "PrepDetailsList" => "member",
        "ReportProcessingStatusList" => "Status",
        "ReportRequestIdList" => "Id",
        "ReportTypeList" => "Type",
        "SellerSKUList" => [
            "default" => "Id",
            "GetMyPriceForSKU" => "SellerSKU"
        ],
        "SellerSkus" => "member",
        "ShipmentIdList" => "member",
        "ShipmentStatusList" => "member"
    ];

}