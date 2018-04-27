<?php

namespace AmazonMWSAPI\Operations\Sellers;

use AmazonMWSAPI\Sections\Sellers;

class ListMarketplaceParticipations extends Sellers
{

    protected $requestQuota = 15;
    protected $restoreRate = 1;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "minute";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/sellers/Sellers_ListMarketplaceParticipations.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "SellerId" => [
            "required"
        ]
    ];

    public static $exampleListMarketplaceParticipations = [

    ];

}