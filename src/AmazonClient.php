<?php

namespace AmazonMWSAPI;

use Dotenv\Dotenv;

class AmazonClient
{

    use AmazonClientCurl;

    private static $amazonInfo;
    private static $amazonMerchantID;
    private static $amazonMarketplaceID;
    private static $amazonAWSAccessKey;
    private static $amazonSecretKey;
    private static $amazonStoreID;
    public static $env;
    protected static $instance = null;


    public static function __callStatic($method, $args)
    {

        return call_user_func_array([static::instance(), $method], $args);

    }

    public static function instance()
    {

        if (static::$instance === null)
        {

            static::$instance = new AmazonClient();

        }

        return static::$instance;

    }

    public function __construct()
    {

        if(!getenv("AMAZON_MERCHANTID"))
        {

            $env = new Dotenv(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src');
            $env->load();

        }

        static::setMerchantId();

        static::setMarketplaceId();

        static::setAwsAccessKey();

        static::setSecretKey();


    }

    private static function setMerchantId()
    {

        static::$amazonMerchantID = getenv("AMAZON_MERCHANTID");

    }

    private static function setMarketplaceId()
    {

        static::$amazonMarketplaceID = getenv("AMAZON_MARKETPLACEID");

    }

    private static function setAwsAccessKey()
    {

        static::$amazonAWSAccessKey = getenv("AMAZON_AWSACCESSKEY");

    }

    private static function setSecretKey()
    {

        static::$amazonSecretKey = getenv("AMAZON_SECRETKEY");

    }

    public static function getMerchantId()
    {

        return static::$amazonMerchantID;

    }

    public static function getMarketplaceId()
    {

        return static::$amazonMarketplaceID;

    }

    public static function getAwsAccessKey()
    {

        return static::$amazonAWSAccessKey;

    }

    public static function getSecretKey()
    {

        return static::$amazonSecretKey;

    }

}
