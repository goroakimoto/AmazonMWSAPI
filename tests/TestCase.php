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

    public function setUp()
    {

        $env = new Dotenv(__DIR__);

        $env->load();

        $this->amazonClient = new AmazonClient();

    }

    public function tearDown()
    {

        unset($this->amazonClient);

        unset($this->testObject);

    }

}
