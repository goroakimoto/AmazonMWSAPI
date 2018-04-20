<?php

namespace Tests\Finances;

use Tests\TestCase;
use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Exception\RequiredException;
use AmazonMWSAPI\Finances;
use AmazonMWSAPI\Finances\ListFinancialEventGroups;

class FinancesTest extends TestCase
{

    public function setup()
    {

        parent::setup();

        $this->testPerformance = false;

        $this->iterations = 1;

        $this->print = false;

        $this->apiObject = "\AmazonMWSAPI\Finances\\";

    }

    public function teardown()
    {

        unset($this->AmazonClient);

    }

    public function testListFinancialEventGroups()
    {

        $this->apiObject .= "ListFinancialEventGroups";

        $example = ListFinancialEventGroups::$exampleFinancialEventGroups;

        $listFinancialEventGroups = Helpers::test(
            $this->apiObject,
            $example,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $listFinancialEventGroups->getCurlParameters();

        $this->assertArrayHasKey("FinancialEventGroupStartedBefore", $curlParameters);
        $this->assertArrayHasKey("FinancialEventGroupStartedAfter", $curlParameters);

    }

    public function testRequiredParameterMissingFromListFinancialEventGroups()
    {

        $regex = '/must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "ListFinancialEventGroups";

        $failingExample = ListFinancialEventGroups::$exampleFinancialEventGroupsFailing;

        $listFinancialEventGroups = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

}