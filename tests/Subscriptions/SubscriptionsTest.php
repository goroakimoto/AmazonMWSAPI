<?php

namespace Tests\Subscriptions;

use Tests\TestCase;

abstract class SubscriptionsTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\\AmazonMWSAPI\Operations\Subscriptions\\";

    }

}