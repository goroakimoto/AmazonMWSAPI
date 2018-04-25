<?php

namespace Tests\Products;

use Tests\Products\ProductsTest;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Products\ListMatchingProducts;

class ListMatchingProductsTest extends ProductsTest
{

    public function testListMatchingProducts()
    {

        $this->apiObject .= "ListMatchingProducts";

        $requestParameters = ListMatchingProducts::$exampleListMatchingProducts;

        $this->testObject = Helpers::test(
            $this->apiObject,
            $requestParameters,
            $this->print,
            $this->testPerformance,
            $this->iterations
        );

        $curlParameters = $this->testObject->getCurlParameters();

        $this->assertArrayHasKey("MarketplaceId", $curlParameters);
        $this->assertArrayHasKey("SellerId", $curlParameters);
        $this->assertArrayHasKey("Query", $curlParameters);

    }

}