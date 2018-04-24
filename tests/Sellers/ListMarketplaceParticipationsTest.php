<?php

namespace Tests\Sellers;

use Tests\Sellers\SellersTest;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Sellers\ListMarketplaceParticipations;

class ListMarketplaceParticipationsTest extends SellersTest
{

    public function testListMarketplaceParticipations()
    {

        $this->apiObject .= "ListMarketplaceParticipations";

        $example = ListMarketplaceParticipations::$exampleListMarketplaceParticipations;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $example,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("SellerId", $curlParameters);

    }

}