<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\{APIParameters, APIParameterValidation, APIProperties};
use AmazonMWSAPI\Helpers\Helpers;

class Sections
{

    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected static $feed;
    protected static $method;
    protected static $country;
    protected static $countryCode;
    protected static $endpoint;
    protected static $marketplaceId;
    protected static $region;

    public function __construct($parametersToSet = null)
    {

        static::setSectionName();

        static::setCountry();

        static::setCountryCode();

        static::setEndpoint();

        static::setMarketplaceId();

        static::setRegion();

        static::setParameters($parametersToSet);

        static::verifyParameters();

    }

    protected static function setSectionName()
    {

        static::$feed = Helpers::getCalledClassParentNameOnly(get_called_class());

    }
    protected static function setCountry()
    {

        static::$country = getenv("AMAZON_COUNTRY");

    }

    public static function getCountry()
    {

        return static::$country;

    }

    protected static function setCountryCode()
    {

        static::$countryCode = self::$marketplaceTypes[static::getCountry()]["countryCode"];

    }

    public static function getCountryCode()
    {

        return static::$countryCode;

    }

    protected static function setEndpoint()
    {

        static::$endpoint = self::$marketplaceTypes[static::getCountry()]["endpoint"];

    }

    public static function getEndpoint()
    {

        return static::$endpoint;

    }

    protected static function setMarketplaceId()
    {

        static::$marketplaceId = self::$marketplaceTypes[static::getCountry()]["marketplaceId"];

    }

    public static function getMarketplaceId()
    {

        return static::$marketplaceId;

    }

    protected static function setRegion()
    {

        static::$region = self::$marketplaceTypes[static::getCountry()]["region"];

    }

    public static function getRegion()
    {

        return static::$region;

    }

    public static function getMethod()
    {

        return static::$method;

    }

    public static function getFeed()
    {

        return static::$feed;

    }

    public static function getFeedType()
    {

        return static::$feedType;

    }

    public static function getFeedContent()
    {

        return static::$feedContent;

    }

    public static function getAction()
    {

        return static::$action;

    }

    public static function getVersionDate()
    {

        return static::$versionDate;

    }

}
