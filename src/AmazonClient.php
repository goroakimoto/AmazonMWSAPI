<?php

namespace AmazonMWSAPI;

class AmazonClient
{

    use AmazonClientCurl;

    private static $amazonInfo;
    private static $amazonMerchantID;
    private static $amazonMarketplaceID;
    private static $amazonAWSAccessKey;
    private static $amazonSecretKey;
    private static $amazonStoreID;
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

        static::setInfo();

        static::setMerchantId();

        static::setMarketplaceId();

        static::setAwsAccessKey();

        static::setSecretKey();

        static::setStoreId();

    }

    private static function setInfo()
    {

        static::$amazonInfo = Channel::getAppInfo(Amazon::getUserId(), AmazonClient::getApiTable(), AmazonClient::getChannelName(), AmazonClient::getApiColumns());

    }

    private static function setMerchantId()
    {

        static::$amazonMerchantID = decrypt(static::$amazonInfo['merchantid']);

    }

    private static function setMarketplaceId()
    {

        static::$amazonMarketplaceID = decrypt(static::$amazonInfo['marketplaceid']);

    }

    private static function setAwsAccessKey()
    {

        static::$amazonAWSAccessKey = decrypt(static::$amazonInfo['aws_access_key']);

    }

    private static function setSecretKey()
    {

        static::$amazonSecretKey = decrypt(static::$amazonInfo['secret_key']);

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
