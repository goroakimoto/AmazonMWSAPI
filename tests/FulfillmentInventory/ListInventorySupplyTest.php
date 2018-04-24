<?php

namespace Tests\FulfillmentInventory;

use AmazonMWSAPI\Helpers\Helpers;
use Tests\FulfillmentInventory\FulfillmentInventoryTest;
use AmazonMWSAPI\FulfillmentInventory\ListInventorySupply;

class ListInventorySupplyTest extends FulfillmentInventoryTest
{

    public function testListInventorySupply()
    {

        $this->apiObject .= "ListInventorySupply";

        $example = ListInventorySupply::$exampleListInventorySupply;

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