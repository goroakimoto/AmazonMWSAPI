<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\{APIParameters, APIParameterValidation, APIProperties};
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Parameter\RequiredParameter;
use AmazonMWSAPI\Parameter\AllowedParameter;

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
    protected static $curlParameters = [];
    protected static $p = [];
    protected static $allowedParameters = [];
    protected static $parametersRequiredForAllCalls = [
        "AWSAccessKeyId",
        "Action",
        // "MWSAuthToken", //For Developer Access
        "SignatureMethod",
        "SignatureVersion",
        "Timestamp",
        "Version"
    ];

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

        static::initializeParameters(static::getParametersRequiredForAllCalls());

        static::initializeParameters();

    }

    protected static function initializeParameters($parameters = null)
    {

        $parameters = !$parameters ? static::getParameters() : $parameters;

        foreach ($parameters as $key => $value) {

            if (is_array($value)) {

                $parameter = $key;

                static::setAllowedParameter($parameter);

            } else {

                $parameter = $value;

                static::setAllowedParameter($parameter);

            }

        }

    }

    protected static function getParametersRequiredForAllCalls()
    {

        return static::$parametersRequiredForAllCalls;

    }

    protected static function getParameters()
    {

        return static::$parameters;

    }

    protected static function setAllowedParameter($parameter)
    {

        static::$p["allowedParameters"][] = new AllowedParameter($parameter);

    }

    public static function getAllowedParameters()
    {

        return static::$p["allowedParameters"];

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

    public static function getVersionDate()
    {

        return static::$versionDate;

    }

}
