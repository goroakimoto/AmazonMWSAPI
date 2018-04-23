<?php

namespace Tests\FulfillmentInboundShipment;

use Tests\TestCase;

abstract class FulfillmentInboundShipmentTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->testPerformance = false;

        $this->iterations = 1;

        $this->print = false;

        $this->apiObject = "\AmazonMWSAPI\FulfillmentInboundShipment\\";

    }

}