<?php

namespace Tests\Reports;

use Tests\Reports\ReportsTest;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Reports\GetReportList;

class GetReportListTest extends ReportsTest
{

    public function testGetReportList()
    {

        $this->apiObject .= "GetReportList";

        $example = GetReportList::$exampleGetReportList;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $example,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("SellerId", $curlParameters);

    }

}