<?php

namespace AmazonMWSAPI\Products;

use AmazonMWSAPI\{APIMethods, APIParameters, APIParameterValidation, APIProperties};

class Products
{

    use APIMethods;
    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected static $feedType = "";
    protected static $feedContent = "";
    protected static $feed = "Products";
    protected static $versionDate = "2011-10-01";
    private static $overviewUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_Overview.html";
    private static $libraryUpdateUrl = "http://docs.developer.amazonservices.com/en_US/products/Products_ClientLibraries.html";
    protected static $dataTypes = [
        "AvailabilityType" => [
            "validWith" => [
                "NOW",
                "FUTURE_WITHOUT_DATE",
                "FUTURE_WITH_DATE"
            ]
        ],
        "BuyBoxPrice" => [
            "condition" => [
                "required"
            ],
            "LandedPrice" => [
                "format" => "MoneyType",
                "required"
            ],
            "ListingPrice" => [
                "format" => "MoneyType",
                "required"
            ],
            "Shipping" => [
                "format" => "MoneyType",
                "required"
            ],
            "Points" => [
                "format" => "Points"
            ]
        ],
        "DetailedShippingTimeType" => [
            "minimumHours",
            "maximumHours",
            "availableDate" => [
                "format" => "date"
            ],
            "availabilityType" => [
                "format" => "AvailabilityType"
            ]
        ],
        "FeeDetail" => [
            "FeeType" => [
                "format" => "FeeType",
                "required"
            ],
            "FeeAmount" => [
                "format" => "MoneyType",
                "required"
            ],
            "FeePromotion" => [
                "format" => "MoneyType"
            ],
            "TaxAmount" => [
                "format" => "MoneyType"
            ],
            "FinalFee" => [
                "format" => "MoneyType",
                "required"
            ],
            "IncludedFeeDetailList" => [
                "format" => "FeeDetail"
            ]
        ],
        "FeesEstimate" => [
            "TotalFeesEstimate" => [
                "format" => "MoneyType",
                "required"
            ],
            "FeeDetailList" => [
                "format" => "FeeDetail",
                "required"
            ]
        ],
        "FeesEstimateIdentifier" => [
            "MarketplaceId" => [
                "format" => "MarketplaceType",
                "required"
            ],
            "IdType" => [
                "required",
                "validWith" => [
                    "ASIN",
                    "SellerSKU"
                ]
            ],
            "IdValue" => [
                "required"
            ],
            "PriceToEstimateFees" => [
                "format" => "PriceToEstimateFees",
                "required"
            ],
            "IsAmazonFulfilled" => [
                "required"
            ],
            "SellerInputIdentifier" => [
                "required"
            ],
            "TimeOfFeesEstimation" => [
                "required"
            ]
        ],
        "FeesEstimateRequest" => [
            "MarketplaceId" => [
                "format" => "MarketplaceType",
                "required"
            ],
            "IdType" => [
                "required",
                "valueWith" => [
                    "ASIN",
                    "SellerSKU"
                ]
            ],
            "IdValue" => [
                "required"
            ],
            "PriceToEstimateFees" => [
                "format" => "PriceToEstimateFees",
                "required"
            ],
            "Identifier" => [
                "required"
            ],
            "IsAmazonFulfilled" => [
                "required"
            ]
        ],
        "FeesEstimateResult" => [
            "FeesEstimateIdentifier" => [
                "format" => "FeesEstimateIdentifier",
                "required"
            ],
            "FeesEstimate" => [
                "format" => "FeesEstimate"
            ],
            "Status" => [
                "required",
                "validWith" => [
                    "Success",
                    "ClientError",
                    "ServiceError"
                ]
            ],
            "Error"
        ],
        "FeeType" => [
            "validWith" => [
                "ReferralFee",
                "VariableClosingFee",
                "PerItemFee",
                "FBAFees",
                "FBAPickAndPack",
                "FBAWeightHandling",
                "FBAOrderHandling",
                "FBADeliveryServicesFee"
            ]
        ],
        "FulfillmentChannelType" => [
            "validWith" => [
                "Amazon",
                "Merchant"
            ]
        ],
        "LowestPrice" => [
            "condition" => [
                "required"
            ],
            "fulfillmentChannel" => [
                "format" => "FulfillmentChannelType",
                "required"
            ],
            "LandedPrice" => [
                "format" => "MoneyType",
                "required"
            ],
            "ListingPrice" => [
                "format" => "MoneyType",
                "required"
            ],
            "Shipping" => [
                "format" => "MoneyType",
                "required"
            ],
            "Points" => [
                "format" => "Points"
            ]
        ],
        "MarketplaceType",
        "MoneyType" => [
            "Amount" => [
                "greaterThan" => 0
            ],
            "CurrencyCode" => [
                "validWith" => [
                    "USD",
                    "EUR",
                    "GBP",
                    "RMB",
                    "INR",
                    "JPY",
                    "CAD",
                    "MXN"
                ]
            ]
        ],
        "OfferCount" => [
            "condition" => [
                "required"
            ],
            "fulfillmentChannel" => [
                "format" => "FulfillmentChannelType",
                "required"
            ]
        ],
        "OfferCountType" => [
            "OfferCount" => [
                "format" => "OfferCount"
            ]
        ],
        "Points" => [
            "PointsNumber" => [
                "required"
            ]
        ],
        "PriceToEstimateFees" => [
            "ListingPrice" => [
                "format" => "MoneyType",
                "required"
            ],
            "Shipping" => [
                "format" => "MoneyType"
            ],
            "Points" => [
                "format" => "Points"
            ]
        ],
        "QueryContextId" => [
            "validWith" => [
                "CA" => [
                    "All",
                    "Books",
                    "Classical",
                    "DVD",
                    "Electronics",
                    "ForeignBooks",
                    "Kitchen",
                    "Music",
                    "Software",
                    "VHS",
                    "Video",
                    "VideoGames"
                ],
                "CN" => [
                    "All",
                    "Apparel",
                    "Appliances",
                    "Automotive",
                    "Baby",
                    "Beauty",
                    "Books",
                    "Electronics",
                    "Grocery",
                    "HealthPersonalCare",
                    "Home",
                    "HomeImprovement",
                    "Jewelry",
                    "Misc",
                    "Music",
                    "OfficeProducts",
                    "Photo",
                    "Shoes",
                    "Software",
                    "SportingGoods",
                    "Toys",
                    "Video",
                    "VideoGames",
                    "Watches"
                ],
                "DE" => [
                    "All",
                    "Apparel",
                    "Automotive",
                    "Baby",
                    "Beauty",
                    "Books",
                    "Classical",
                    "DVD",
                    "Electronics",
                    "ForeignBooks",
                    "Grocery",
                    "HealthPersonalCare",
                    "HomeGarden",
                    "Jewelry",
                    "KindleStore",
                    "Kitchen",
                    "Lighting",
                    "Magazines",
                    "MP3Downloads",
                    "Music",
                    "MusicalInstruments",
                    "MusicTracks",
                    "OfficeProducts",
                    "OutdoorLiving",
                    "Outlet",
                    "PCHardware",
                    "Photo",
                    "Software",
                    "SportingGoods",
                    "Tools",
                    "Toys",
                    "VHS",
                    "Video",
                    "VideoGames",
                    "Watches"
                ],
                "ES" => [
                    "All",
                    "Books",
                    "DVD",
                    "Electronics",
                    "ForeignBooks",
                    "Kitchen",
                    "Music",
                    "Software",
                    "Toys",
                    "VideoGames",
                    "Watches"
                ],
                "FR" => [
                    "All",
                    "Apparel",
                    "Baby",
                    "Beauty",
                    "Books",
                    "Classical",
                    "DVD",
                    "Electronics",
                    "ForeignBooks",
                    "HealthPersonalCare",
                    "Jewelry",
                    "Kitchen",
                    "Lighting",
                    "MP3Downloads",
                    "Music",
                    "MusicalInstruments",
                    "MusicTracks",
                    "OfficeProducts",
                    "Shoes",
                    "Software",
                    "VHS",
                    "Video",
                    "VideoGames",
                    "Watches"
                ],
                "IT" => [
                    "All",
                    "Books",
                    "DVD",
                    "Electronics",
                    "ForeignBooks",
                    "Garden",
                    "Kitchen",
                    "Music",
                    "Shoes",
                    "Software",
                    "Toys",
                    "VideoGames",
                    "Watches"
                ],
                "MX" => [
                    "All",
                    "Baby",
                    "Books",
                    "DVD",
                    "Electronics",
                    "HealthPersonalCare",
                    "HomeImprovement",
                    "Kitchen",
                    "KindleStore",
                    "Music",
                    "OfficeProducts",
                    "PetSupplies",
                    "Software",
                    "SportingGoods",
                    "Toys",
                    "VideoGames",
                    "Watches"
                ],
                "JP" => [
                    "All",
                    "Apparel",
                    "Automotive",
                    "Baby",
                    "Beauty",
                    "Books",
                    "Classical",
                    "DVD",
                    "Electronics",
                    "ForeignBooks",
                    "Grocery",
                    "HealthPersonalCare",
                    "Hobbies",
                    "HomeImprovement",
                    "Jewelry",
                    "Kitchen",
                    "MP3Downloads",
                    "Music",
                    "MusicalInstruments",
                    "MusicTracks",
                    "OfficeProducts",
                    "Shoes",
                    "Software",
                    "SportingGoods",
                    "Toys",
                    "VHS",
                    "Video",
                    "VideoGames",
                    "Watches"
                ],
                "UK" => [
                    "All",
                    "Apparel",
                    "Automotive",
                    "Baby",
                    "Beauty",
                    "Books",
                    "Classical",
                    "DVD",
                    "Electronics",
                    "Grocery",
                    "HealthPersonalCare",
                    "HomeGarden",
                    "Jewelry",
                    "Kitchen",
                    "Lighting",
                    "MP3Downloads",
                    "Music",
                    "MusicalInstruments",
                    "MusicTracks",
                    "OfficeProducts",
                    "OutdoorLiving",
                    "Outlet",
                    "Shoes",
                    "Software",
                    "SoftwareVideoGames",
                    "Toys",
                    "VHS",
                    "Video",
                    "VideoGames",
                    "Watches"
                ],
                "US" => [
                    "All",
                    "Apparel",
                    "Appliances",
                    "ArtsAndCrafts",
                    "Automotive",
                    "Baby",
                    "Beauty",
                    "Books",
                    "Classical",
                    "DigitalMusic",
                    "DVD",
                    "Electronics",
                    "Grocery",
                    "HealthPersonalCare",
                    "HomeGarden",
                    "Industrial",
                    "Jewelry",
                    "KindleStore",
                    "Kitchen",
                    "Magazines",
                    "Miscellaneous",
                    "MobileApps",
                    "MP3Downloads",
                    "Music",
                    "MusicalInstruments",
                    "OfficeProducts",
                    "PCHardware",
                    "PetSupplies",
                    "Photo",
                    "Shoes",
                    "Software",
                    "SportingGoods",
                    "Tools",
                    "Toys",
                    "UnboxVideo",
                    "VHS",
                    "Video",
                    "VideoGames",
                    "Watches",
                    "Wireless",
                    "WirelessAccessories"
                ]
            ]
        ],
        "SellerFeedbackRating" => [
            "SellerPositiveFeedbackRating",
            "FeedbackCount" => [
                "required"
            ]
        ],
        "ShipsFrom" => [
            "State",
            "Country"
        ]
    ];

    public function __construct($parametersToSet = null)
    {

        static::setParameters($parametersToSet);

        static::verifyParameters();

    }

}