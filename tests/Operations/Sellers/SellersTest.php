<?php

namespace Tests\Operations\Sellers;

use Tests\TestCase;

abstract class SellersTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\\AmazonMWSAPI\Operations\Sellers\\";

    }

}