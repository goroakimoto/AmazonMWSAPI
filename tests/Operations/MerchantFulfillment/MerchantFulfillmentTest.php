<?php

namespace Tests\Operations\MerchantFulfillment;

use Tests\TestCase;

abstract class MerchantFulfillmentTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\\AmazonMWSAPI\Operations\MerchantFulfillment\\";

    }

}