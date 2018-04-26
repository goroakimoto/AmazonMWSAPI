<?php

namespace Tests\Operations\FulfillmentOutboundShipment;

use Tests\TestCase;

abstract class FulfillmentOutboundShipmentTest extends TestCase
{

    public function setUp()
    {

        parent::setUp();

        $this->apiObject = "\AmazonMWSAPI\Operations\FulfillmentOutboundShipment\\";

    }

}