<?php

namespace Tests\Recommendations;

use AmazonMWSAPI\Helpers\Helpers;
use Tests\Recommendations\RecommendationsTest;
use AmazonMWSAPI\Operations\Recommendations\ListRecommendations;

class ListRecommendationsTest extends RecommendationsTest
{

    public function testInventoryRecommendationInListRecommendations()
    {

        $this->apiObject .= "ListRecommendations";

        $requestParameters = ListRecommendations::$exampleInventoryRecommendation;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
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