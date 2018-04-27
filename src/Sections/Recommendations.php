<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\Sections\Sections;

class Recommendations extends Sections
{

    protected $feedType = "";
    protected $feedContent = "";
    protected $versionDate = "2013-04-01";
    private $overviewUrl = "http://docs.developer.amazonservices.com/en_US/recommendations/Recommendations_Overview.html";
    private $libraryUpdateUrl = "http://docs.developer.amazonservices.com/en_US/recommendations/Recommendations_ClientLibraries.html";
    protected $dataTypes = [
        "AdvertisingRecommendation" => [
            "RecommendationId",
            "RecommendationReason",
            "LastUpdated" => [
                "format" => "dateTime"
            ],
            "ItemIdentifier" => [
                "format" => "ProductIdentifier"
            ],
            "ItemName",
            "BrandName",
            "ProductCategory",
            "SalesRank",
            "YourPricePlusShipping" => [
                "format" => "Price"
            ],
            "LowestPricePlusShipping" => [
                "format" => "Price"
            ],
            "AvailableQuantity",
            "SalesForTheLast30Days"
        ],
        "CategoryQuery" => [
            "RecommendationCategory" => [
                "required",
                "validWith" => [
                    "Selection",
                    "Fulfillment",
                    "ListingQuality",
                    "GlobalSelling",
                    "Advertising"
                ]
            ],
            "FilterOptions" => [
                "required",
                "validIf" => [
                    "RecommendationCategory" => [
                        "ListingQuality" => [
                            "QualitySet=Defect",
                            "QualitySet=Quarantine",
                            "ListingStatus=Active",
                            "ListingStatus=Inactive"
                        ],
                        "Selection" => [
                            "BrandName=",
                            "ProductCategory=",
                            "IncludeCommonRecommendations=true",
                            "IncludeCommonRecommendations=false"
                        ],
                        "Fulfillment" => [
                            "BrandName=",
                            "ProductCategory="
                        ],
                        "GlobalSelling" => [
                            "BrandName=",
                            "ProductCategory="
                        ],
                        "Advertising" => [
                            "BrandName=",
                            "ProductCategory="
                        ],
                    ]
                ]
            ],
            "DimensionMeasure" => [
                "Value",
                "Unit"
            ],
            "FulfillmentRecommendation" => [
                "RecommendationId",
                "RecommendationReason",
                "LastUpdated" => [
                    "format" => "dateTime"
                ],
                "ItemIdentifier" => [
                    "format" => "ProductIdentifier"
                ],
                "ItemName",
                "BrandName",
                "ProductCategory",
                "SalesRank",
                "BuyboxPrice" => [
                    "format" => "Price"
                ],
                "NumberOfOffers",
                "NumberOfOffersFulfilledByAmazon",
                "AverageCustomerReview",
                "NumberOfCustomerReviews",
                "ItemDimensions" => [
                    "format" => "ItemDimensions"
                ]
            ],
            "GlobalSellingRecommendation" => [
                "RecommendationId",
                "RecommendationReason",
                "LastUpdated" => [
                    "format" => "dateTime"
                ],
                "ItemIdentifier" => [
                    "format" => "ProductIdentifier"
                ],
                "ItemName",
                "BrandName",
                "ProductCategory",
                "SalesRank",
                "BuyboxPrice" => [
                    "format" => "Price"
                ],
                "NumberOfOffers",
                "NumberOfOffersFulfilledByAmazon",
                "AverageCustomerReview",
                "NumberOfCustomerReviews",
                "ItemDimensions" => [
                    "format" => "ItemDimensions"
                ]
            ],
            "InventoryRecommendation" => [
                "RecommendationId",
                "RecommendationReason",
                "LastUpdated" => [
                    "format" => "dateTime"
                ],
                "ItemIdentifier" => [
                    "format" => "ProductIdentifier"
                ],
                "ItemName",
                "FulfillmentChannel" => [
                    "validWith" => [
                        "MFN",
                        "AFN"
                    ]
                ],
                "SalesForTheLast14Days",
                "SalesForTheLast30Days",
                "AvailableQuantity",
                "DaysUntilStockRunsOut",
                "InboundQuantity",
                "RecommendedInboundQuantity",
                "DaysOutOfStockLast30Days",
                "LostSalesInLast30Days"
            ],
            "ItemDimensions" => [
                "Height" => [
                    "format" => "DimensionMeasure"
                ],
                "Width" => [
                    "format" => "DimensionMeasure"
                ],
                "Length" => [
                    "format" => "DimensionMeasure"
                ],
                "Weight" => [
                    "format" => "WeightMeasure"
                ]
            ],
            "ListingQualityRecommendation" => [
                "RecommendationId",
                "RecommendationReason",
                "QualitySet" => [
                    "validWith" => [
                        "Defect",
                        "Quarantine"
                    ]
                ],
                "DefectGroup",
                "DefectAttribute",
                "ItemIdentifier" => [
                    "format" => "ProductIdentifier"
                ],
                "ItemName"
            ],
            "Price" => [
                "CurrencyCode" => [
                    "length" => 3
                ],
                "Amount"
            ],
            "PricingRecommendation" => [
                "RecommendationId",
                "RecommendationReason",
                "LastUpdated" => [
                    "format" => "dateTime"
                ],
                "ItemIdentifier" => [
                    "format" => "ProductIdentifier"
                ],
                "ItemName",
                "Condition",
                "SubCondition",
                "FulfillmentChannel" => [
                    "validWith" => [
                        "MFN",
                        "AFN"
                    ]
                ],
                "YourPricePlusShipping" => [
                    "format" => "Price"
                ],
                "LowestPricePlusShipping" => [
                    "format" => "Price"
                ],
                "PriceDifferneceToLowPrice" => [
                    "format" => "Price"
                ],
                "MedianPricePlusShipping" => [
                    "format" => "Price"
                ],
                "LowestMerchantFulfilledOfferPrice" => [
                    "format" => "Price"
                ],
                "LowestAmazonFulfilledOfferPrice" => [
                    "format" => "Price"
                ],
                "NumberOfOffers",
                "NumberOfMerchantFulfilledOffers",
                "NumberOfAmazonFulfilledOffers"
            ],
            "ProductIdentifier" => [
                "Asin",
                "Sku",
                "Upc"
            ],
            "SelectionRecommendation" => [
                "RecommendationId",
                "RecommendationReason",
                "LastUpdated",
                "ItemIdentifier" => [
                    "format" => "ProductIdentifier"
                ],
                "ItemName",
                "BrandName",
                "ProductCategory",
                "SalesRank",
                "BuyboxPrice" => [
                    "format" => "Price"
                ],
                "NumberOfOffers",
                "AverageCustomerReview",
                "NumberOfCustomerReviews"
            ],
            "WeightMeasure" => [
                "Value",
                "Unit"
            ]
        ]
    ];

}