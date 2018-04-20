<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Dotenv\Dotenv;
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\AmazonClient;

use AmazonMWSAPI\Exception\{RequiredException};

abstract class TestCase extends BaseTestCase
{

    public function setup()
    {

        $env = new Dotenv(__DIR__);

        $env->load();

        $this->AmazonClient = AmazonClient::instance();

    }

}
