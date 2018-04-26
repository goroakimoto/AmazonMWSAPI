<?php
namespace AmazonMWSAPI\Operations\Recommendations;


class ListRecommendations extends Recommendations
{

    protected static $requestQuota = 8;
    protected static $restoreRate = 1;
    protected static $restoreRateTime = 2;
    protected static $restoreRateTimePeriod = "second";
    protected static $method = "POST";
    protected static $curlParameters = [];
    private static $apiUrl = "http://docs.developer.amazonservices.com/en_US/recommendations/Recommendations_ListRecommendations.html";
    protected static $requiredParameters = [];
    protected static $allowedParameters = [];
    protected static $parameters = [
        "MarketplaceId" => [
            "notIncremented",
            "required"
        ],
        "RecommendationCategory" => [
            "validWith" => [
                "Inventory",
                "Selection",
                "Pricing",
                "Fulfillment",
                "ListingQuality",
                "GlobalSelling",
                "Advertising"
            ]
        ],
        "CategoryQueryList" => [
            "format" => "CategoryQuery"
        ],
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleInventoryRecommendation = [
        "RecommendationCategory" => "Inventory",
        "CategoryQueryList" => [
            [
                "RecommendationCategory" => "ListingQuality",
                "FilterOptions" => [
                    "QualitySet=Defect",
                    "ListingStatus=Active"
                ]
            ],
            [
                "RecommendationCategory" => "Selection",
                "FilterOptions" => [
                    "IncludeCommonRecommendations=false"
                ]
            ]
        ]
    ];

    public static $exampleInventoryRecommendationFailing = [
        "RecommendationCategory" => "Inventory",
        "CategoryQueryList" => [
            [
                "RecommendationCategory" => "ListingQuality",
                "FilterOptions" => [
                    // "QualitySet=Defect",
                    // "ListingStatus=Active"
                ]
            ],
            [
                "RecommendationCategory" => "Selection",
                "FilterOptions" => [
                    "IncludeCommonRecommendations=false"
                ]
            ]
        ]
    ];

}