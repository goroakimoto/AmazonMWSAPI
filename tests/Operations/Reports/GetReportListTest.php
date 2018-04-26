<?php

namespace Tests\Operations\Reports;

use AmazonMWSAPI\Helpers\Helpers;
use Tests\Operations\Reports\ReportsTest;
use AmazonMWSAPI\Operations\Reports\GetReportList;

class GetReportListTest extends ReportsTest
{

    public function testGetReportList()
    {

        $this->apiObject .= "GetReportList";

        $requestParameters = GetReportList::$exampleGetReportList;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("SellerId", $curlParameters);

    }

}