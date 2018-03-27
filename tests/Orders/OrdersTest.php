<?php

namespace Tests\Orders;

use Tests\TestCase;
use michaeljberry\AmazonMWSAPI\Orders;

class OrdersTest extends TestCase
{

    public function testBasic()
    {
        $this->assertInstanceOf('\michaeljberry\AmazonMWSAPI\Orders', new Orders());
    }

}