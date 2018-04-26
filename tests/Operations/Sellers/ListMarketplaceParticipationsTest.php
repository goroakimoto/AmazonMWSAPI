<?php

namespace Tests\Operations\Sellers;

use AmazonMWSAPI\Helpers\Helpers;
use Tests\Operations\Sellers\SellersTest;
use AmazonMWSAPI\Operations\Sellers\ListMarketplaceParticipations;

class ListMarketplaceParticipationsTest extends SellersTest
{

    protected $requestName = "ListMarketplaceParticipations";

    public function testListMarketplaceParticipations()
    {

        $this->apiObject .= $this->requestName;

        $requestParameters = ListMarketplaceParticipations::$exampleListMarketplaceParticipations;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("SellerId", $curlParameters);

    }

}