<?php

namespace Tests\Operations\FulfillmentInventory;

use Tests\TestCase;

abstract class FulfillmentInventoryTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\\AmazonMWSAPI\Operations\FulfillmentInventory\\";

    }

}