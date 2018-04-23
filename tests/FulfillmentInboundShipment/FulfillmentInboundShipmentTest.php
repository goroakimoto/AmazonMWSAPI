<?php

namespace Tests\FulfillmentInboundShipment;

use Tests\TestCase;

abstract class FulfillmentInboundShipmentTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\AmazonMWSAPI\FulfillmentInboundShipment\\";

    }

}