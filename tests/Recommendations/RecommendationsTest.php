<?php

namespace Tests\Recommendations;

use Tests\TestCase;
use AmazonMWSAPI\Recommendations;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Recommendations\ListRecommendations;

class RecommendationsTest extends TestCase
{

    public function testListRecommendations()
    {

        $objectToNewUp = "\AmazonMWSAPI\Recommendations\ListRecommendations";

        $testPerformance = false;

        $iterations = 1;

        $example = ListRecommendations::$example;

        $listRecommendation = Helpers::test($objectToNewUp, $example, $testPerformance, $iterations);

        $listRecommendation->getCurlParameters();

    }

}