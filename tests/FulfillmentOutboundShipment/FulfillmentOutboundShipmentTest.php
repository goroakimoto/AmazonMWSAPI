<?php

namespace Tests\FulfillmentOutboundShipment;

use Tests\TestCase;

abstract class FulfillmentOutboundShipmentTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\AmazonMWSAPI\FulfillmentOutboundShipment\\";

    }

}