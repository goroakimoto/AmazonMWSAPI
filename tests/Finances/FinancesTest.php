<?php

namespace Tests\Finances;

use Tests\TestCase;

abstract class FinancesTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->testPerformance = false;

        $this->iterations = 1;

        $this->print = false;

        $this->apiObject = "\AmazonMWSAPI\Finances\\";

    }

}