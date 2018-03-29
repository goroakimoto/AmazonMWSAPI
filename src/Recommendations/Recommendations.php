<?php

namespace AmazonMWSAPI\Recommendations;

use AmazonMWSAPI\{APIMethods, APIParameters, APIParameterValidation, APIProperties};

class Recommendations
{

    use APIMethods;
    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected static $feedType = "";
    protected static $feedContent = "";
    protected static $feed = "Recommendations";
    protected static $versionDate = "2013-04-01";
    private static $overviewUrl = "http://docs.developer.amazonservices.com/en_US/recommendations/Recommendations_Overview.html";
    private static $libraryUpdateUrl = "http://docs.developer.amazonservices.com/en_US/recommendations/Recommendations_ClientLibraries.html";
    protected static $dataTypes = [
        "AdvertisingRecommendation" => [
            "RecommendationId",
            "RecommendationReason",
            "LastUpdated" => [
                "format" => "date"
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
                    "format" => "date"
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
                    "format" => "date"
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
                    "format" => "date"
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
                    "format" => "date"
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

    public function __construct($parametersToSet = null)
    {

        static::setParameters($parametersToSet);

        static::verifyParameters();

    }

}