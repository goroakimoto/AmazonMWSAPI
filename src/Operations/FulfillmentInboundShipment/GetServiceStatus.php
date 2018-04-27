<?php

namespace AmazonMWSAPI\Operations\FulfillmentInboundShipment;

use AmazonMWSAPI\Sections\FulfillmentInboundShipment;

class GetServiceStatus extends FulfillmentInboundShipment
{

    protected $requestQuota = 2;
    protected $restoreRate = 1;
    protected $restoreRateTime = 5;
    protected $restoreRateTimePeriod = "minute";
    protected $method = "POST";
    private $apiUrl = "http://docs.developer.amazonservices.com/en_US/fba_inbound/MWS_GetServiceStatus.html";
    protected $requiredParameters = [];
    protected $parameters = [];

}