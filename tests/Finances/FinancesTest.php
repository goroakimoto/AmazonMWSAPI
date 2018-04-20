<?php

namespace Tests\Finances;

use Tests\TestCase;
use AmazonMWSAPI\Finances;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;

use AmazonMWSAPI\Exception\RequiredException;
use AmazonMWSAPI\Finances\ListFinancialEventGroups;

class FinancesTest extends TestCase
{

    public function setup()
    {

        parent::setup();

        $this->testPerformance = false;

        $this->iterations = 1;

        $this->print = false;

        $this->objectToNewUp = "\AmazonMWSAPI\Finances\\";

    }

    public function teardown()
    {

        unset($this->AmazonClient);

    }

    public function testFinancialEventGroupsInListFinancialEventGroups()
    {

        $this->objectToNewUp .= "ListFinancialEventGroups";

        $example = ListFinancialEventGroups::$exampleFinancialEventGroups;

        $financialEventGroups = Helpers::test(
            $this->objectToNewUp,
            $example,
            $this->print,
            $this->testPerformance
        );

        $curlParameters = $financialEventGroups->getCurlParameters();

        $this->assertArrayHasKey("FinancialEventGroupStartedBefore", $curlParameters);
        $this->assertArrayHasKey("FinancialEventGroupStartedAfter", $curlParameters);

    }

    public function testRequiredParameterMissingFromListFinancialEventGroups()
    {

        $this->expectException(\AmazonMWSAPI\Exception\RequiredException::class);

        $this->objectToNewUp .= "ListFinancialEventGroups";

        $failingExample = ListFinancialEventGroups::$exampleFinancialEventGroupsFailing;

        $listFinancialEventGroups = Helpers::test(
            $this->objectToNewUp,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

}