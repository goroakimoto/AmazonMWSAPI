<?php

namespace Tests\Products;

use Tests\TestCase;

abstract class ProductsTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\\AmazonMWSAPI\Products\\";

    }

}