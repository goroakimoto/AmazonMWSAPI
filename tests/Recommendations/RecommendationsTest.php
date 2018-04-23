<?php

namespace Tests\Recommendations;

use Tests\TestCase;
use AmazonMWSAPI\Recommendations;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Recommendations\ListRecommendations;
use AmazonMWSAPI\Exception\{RequiredException};

class RecommendationsTest extends TestCase
{

    protected $amazonClient;

    public function setUp()
    {

        parent::setUp();

        $this->testPerformance = false;

        $this->iterations = 1;

        $this->print = false;

        $this->apiObject = "\AmazonMWSAPI\Recommendations\\";

    }

    public function testInventoryRecommendationInListRecommendations()
    {

        $this->apiObject .= "ListRecommendations";

        $example = ListRecommendations::$exampleInventoryRecommendation;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $example,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("RecommendationCategory", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.1.RecommendationCategory", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.1.FilterOptions.FilterOption.1", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.1.FilterOptions.FilterOption.2", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.2.RecommendationCategory", $curlParameters);
        $this->assertArrayHasKey("CategoryQueryList.CategoryQuery.2.FilterOptions.FilterOption.1", $curlParameters);

    }

    public function testRequiredParameterMissingFromListRecommendations()
    {

        $regex = '/CategoryQueryList.CategoryQuery.1.FilterOptions.FilterOption.1 must be set to complete this request/';

        $this->expectOutputRegex($regex);

        $this->apiObject .= "ListRecommendations";

        $failingExample = ListRecommendations::$exampleInventoryRecommendationFailing;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $failingExample,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

    }

}