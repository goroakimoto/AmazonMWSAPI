<?php

namespace Tests\Sellers;

use Tests\Sellers\SellersTest;
use AmazonMWSAPI\Helpers\Helpers;
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