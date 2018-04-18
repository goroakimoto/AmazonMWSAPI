<?php

namespace Tests\Recommendations;

use Tests\TestCase;
use AmazonMWSAPI\Recommendations;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Recommendations\ListRecommendations;

class RecommendationsTest extends TestCase
{

    public function setup()
    {

        parent::setup();

        $this->testPerformance = false;

        $this->iterations = 1;

        $this->print = false;
        $this->objectToNewUp = "\AmazonMWSAPI\Recommendations\\";

    }

    public function teardown()
    {

        unset($this->AmazonClient);

    }

    public function testListRecommendations()
    {

        $this->objectToNewUp .= "ListRecommendations";

        $example = ListRecommendations::$example;

        $listRecommendation = Helpers::test($this->objectToNewUp, $example, $this->print, $this->testPerformance, $this->iterations);

        $curlParameters = $listRecommendation->getCurlParameters();

        $this->assertArrayHasKey("RecommendationCategory", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.1.RecommendationCategory", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.1.FilterOptions.FilterOption.1", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.1.FilterOptions.FilterOption.2", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.2.RecommendationCategory", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.2.FilterOptions.FilterOption.1", $curlParameters);

    }

}