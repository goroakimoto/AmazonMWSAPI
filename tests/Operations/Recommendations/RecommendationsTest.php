<?php

namespace Tests\Operations\Recommendations;

use Tests\TestCase;

abstract class RecommendationsTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\AmazonMWSAPI\Operations\Recommendations\\";

    }

}