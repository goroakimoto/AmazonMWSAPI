<?php

namespace Tests\Recommendations;

use Tests\TestCase;

abstract class RecommendationsTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->testPerformance = false;

        $this->iterations = 1;

        $this->print = false;

        $this->apiObject = "\AmazonMWSAPI\Recommendations\\";

    }

}