<?php

namespace Tests\Operations\Finances;

use Tests\TestCase;

abstract class FinancesTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\AmazonMWSAPI\Operations\Finances\\";

    }

}