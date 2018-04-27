<?php
namespace AmazonMWSAPI\Operations\Recommendations;

use AmazonMWSAPI\Sections\Recommendations;


class ListRecommendations extends Recommendations
{

    protected $requestQuota = 8;
    protected $restoreRate = 1;
    protected $restoreRateTime = 2;
    protected $restoreRateTimePeriod = "second";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/recommendations/Recommendations_ListRecommendations.html";
    protected $requiredParameters = [];
    protected $parameters = [
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