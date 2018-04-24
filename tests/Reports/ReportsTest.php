<?php

namespace Tests\Reports;

use Tests\TestCase;

abstract class ReportsTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\\AmazonMWSAPI\Reports\\";

    }

}