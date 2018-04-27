<?php

namespace AmazonMWSAPI\Operations\Sellers;

use AmazonMWSAPI\Sections\Sellers;

class ListMarketplaceParticipationsByNextToken extends Sellers
{

    protected $requestQuota = 15;
    protected $restoreRate = 1;
    protected $restoreRateTime = 1;
    protected $restoreRateTimePeriod = "minute";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/sellers/Sellers_ListMarketplaceParticipationsByNextToken.html";
    protected $requiredParameters = [];
    protected $parameters = [
        "NextToken" => [
            "required"
        ],
        "SellerId" => [
            "required"
        ]
    ];

}