<?php

namespace Tests\MerchantFulfillment;

use Tests\TestCase;

abstract class MerchantFulfillmentTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\\AmazonMWSAPI\MerchantFulfillment\\";

    }

}