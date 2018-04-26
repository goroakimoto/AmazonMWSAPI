<?php

namespace Tests\Operations\Orders;

use Tests\TestCase;

abstract class OrdersTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\\AmazonMWSAPI\Operations\Orders\\";

    }

}