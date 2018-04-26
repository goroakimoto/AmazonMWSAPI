<?php

namespace Tests\Finances;

use AmazonMWSAPI\Helpers\Helpers;
use Tests\Finances\FinancesTest;
use AmazonMWSAPI\Operations\Finances\ListFinancialEventGroups;

class ListFinancialEventGroupsTest extends FinancesTest
{

    public function testListFinancialEventGroups()
    {

        $this->apiObject .= "ListFinancialEventGroups";

        $requestParameters = ListFinancialEventGroups::$exampleFinancialEventGroups;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("FinancialEventGroupStartedBefore", $curlParameters);
        $this->assertArrayHasKey("FinancialEventGroupStartedAfter", $curlParameters);

    }

    public function testRequiredParameterMissingFromListFinancialEventGroups()
    {

        $regex = '/FinancialEventGroupStartedAfter must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "ListFinancialEventGroups";

        $failingExample = ListFinancialEventGroups::$exampleFinancialEventGroupsFailing;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

}