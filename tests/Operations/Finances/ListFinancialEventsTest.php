<?php

namespace Tests\Operations\Finances;

use AmazonMWSAPI\Helpers\Helpers;
use Tests\Operations\Finances\FinancesTest;
use AmazonMWSAPI\Operations\Finances\ListFinancialEvents;

class ListFinancialEventsTest extends FinancesTest
{

    public function testListFinancialEvents()
    {

        $this->apiObject .= "ListFinancialEventGroups";

        $requestParameters = ListFinancialEvents::$exampleListFinancialEvents;

        $this->testObject = new ListFinancialEvents($requestParameters);
        Helpers::dd($this->testObject);

        Helpers::dd($this->testObject->getAllowedParameters());

    }

}