<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Dotenv\Dotenv;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;

use AmazonMWSAPI\Exception\{RequiredException};

abstract class TestCase extends BaseTestCase
{

    protected $amazonClient;

    protected $testObject;

    protected $testPerformance;

    protected $iterations;

    protected $print;

    protected $apiObject;

    public function setUp()
    {

        $env = new Dotenv(__DIR__);

        $env->load();

        $this->amazonClient = new AmazonClient();

        $this->testPerformance = false;

        $this->iterations = 1;

        $this->print = false;

    }

    public function tearDown()
    {

        unset($this->amazonClient);

        unset($this->testObject);

    }

}
