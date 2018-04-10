<?php

namespace AmazonMWSAPI;

use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Helpers\Helpers;
use DateTime;
use DateTimeZone;

trait APIParameters
{

    // dependentOn
    // !divisorOf
    // earlierThan -- Timestamp default interval is "PT2M"
    // format
    // !greaterThan
    // incompatibleWith
    // laterThan -- Timestamp default interval is "PT2M"
    // !length
    // maximumLength
    // maximumCount
    // minimumLength
    // notIncremented
    // notFartherApartThan
    // !onlyIfOperationIs
    // rangeWithin
    // required
    // !requiredIf
    // requiredIfNotSet
    // !validIf
    // validWith
    // parent - Key => value || value

    private static $curlParameters = [];

    private static $requiredParameters = [
        "AWSAccessKeyId",
        "Action",
        // "MWSAuthToken", //For Developer Access
        "SignatureMethod",
        "SignatureVersion",
        "Timestamp",
        "Version"
    ];

    public static function getOrderNumberFormat()
    {

        return static::$orderNumberFormat;

    }

    public static function getAllowedParameters()
    {

        return static::$allowedParameters;

    }

    public static function getParameters()
    {

        return static::$parameters;

    }

    public static function setClassParameterByKey($key, $value)
    {

        static::$parameters[$key] = $value;

    }

    protected static function getIncrementors()
    {

        return static::$incrementors;

    }

    public static function getParameterByKey($key)
    {

        return self::$curlParameters[$key] ?? null;

    }

    public static function getCurlParameters()
    {

        return self::$curlParameters;

    }

    private static function getSignatureMethod()
    {

        return self::$signatureMethod;

    }

    private static function getSignatureVersion()
    {

        return self::$signatureVersion;

    }

    public static function unsetClassParameterByKey($key)
    {

        unset(static::$parameters[$key]);

    }

    protected static function resetCurlParameters()
    {

        self::$curlParameters = [];

    }

    public static function setSignatureMethodParameter()
    {

        self::setParameterByKey("SignatureMethod", self::getSignatureMethod());

    }

    public static function setSignatureVersionParameter()
    {

        self::setParameterByKey("SignatureVersion", self::getSignatureVersion());

    }

    protected static function setTimestampParameter()
    {

        $date = new DateTime(date("Y-m-d H:i:s"));

        self::setParameterByKey("Timestamp", $date->format("Y-m-d\TH:i:s\Z"));

    }

    protected static function setAwsAccessKeyParameter()
    {

        self::setParameterByKey("AWSAccessKeyId", AmazonClient::getAwsAccessKey());

    }

    protected static function setActionParameter()
    {

        self::setParameterByKey("Action", Helpers::getCalledClass(get_called_class()));

    }

    protected static function setMerchantIdParameter($key)
    {

        self::setParameterByKey($key, AmazonClient::getMerchantId());

    }

    protected static function setPurgeAndReplaceParameter()
    {

        self::setParameterByKey("PurgeAndReplace", "false");

    }

    protected static function setMarketplaceIdParameter()
    {

        static::incrementParameter("MarketplaceId", self::getMarketplaceId());

    }

    protected static function setDateParameter($parameter, $date, $format = "Y-m-d\TH:i:s\Z")
    {

        $newDate = new DateTime($date);

        self::$curlParameters[$parameter] = $newDate->format($format);

    }

    protected static function setRequiredParameter($parameter, $value = null, $isArray = false)
    {

        if (!$isArray)
        {

            static::$requiredParameters[$parameter] = $value;

        } else {

            static::$requiredParameters[$parameter] = $value;

        }

    }

    protected static function setVersionDateParameter()
    {

        self::setParameterByKey("Version", static::getVersionDate());

    }

    protected static function recursiveArrayFilterReturnBoolean($method, $array, $arg = null, $inArray = false, $class = "static")
    {

        foreach ($array as $key => $value)
        {

            if (!is_numeric($key) && call_user_func_array([$class, $method], [$value, $key, $arg]) === true)
            {

                $inArray = true;
                break;

            } elseif (is_array($value)) {

                static::recursiveArrayFilterReturnBoolean($method, $value, $arg, $inArray);

            }

        }

        return $inArray;

    }

    protected static function recursiveArrayFilterReturnArray($method, $array, $removeEmptyArrays = false, $arg = null, $lookingFor = "key", $callback = false, $class = "static")
    {

        foreach ($array as $key => $value)
        {

            if (is_array($value) && $lookingFor === "value")
            {

                $array[$key] = static::recursiveArrayFilterReturnArray($method, $value, $removeEmptyArrays, $arg, $lookingFor, call_user_func_array([$class, $method], [$value, $key, $arg]));


                if ($removeEmptyArrays && !(bool)$array[$key])
                {

                    unset($array[$key]);

                }

            } elseif (is_array($value) && $lookingFor === "key" && !call_user_func_array([$class, $method], [$value, $key, $arg])) {

                $array[$key] = static::recursiveArrayFilterReturnArray($method, $value, $removeEmptyArrays, $arg, $lookingFor, call_user_func_array([$class, $method], [$value, $key, $arg]));


                if ($removeEmptyArrays && !(bool)$array[$key]) {

                    unset($array[$key]);

                }

            } elseif (!call_user_func_array([$class, $method], [$value, $key, $arg])) {

                unset($array[$key]);

            } elseif (!(bool)$value && $value !== 0) {

                unset($array[$key]);

            }

        }

        unset($value);

        return $array;

    }

    protected static function recursiveArrayFilterUnsetParameter($method, $array, $arg, $callback = false, $class = "static")
    {


        foreach ($array as $key => $value)
        {

            if (is_array($value) && !call_user_func_array([$class, $method], [$value, $key, $arg]))
            {

                $array[$key] = static::recursiveArrayFilterUnsetParameter($method, $value, $arg, call_user_func_array([$class, $method], [$value, $key, $arg]));

            } elseif (call_user_func_array([$class, $method], [$value, $key, $arg])) {

                unset($array[$key]);

            }

        }

        return $array;

    }

    protected static function findRequiredParameters()
    {

        $parameters = static::getParameters();

        return static::recursiveArrayFilterReturnArray("required", $parameters, true, null, "value");

    }

    protected static function getRequiredParameters($parent = null)
    {

        if (!$parent)
        {

            return static::$requiredParameters;

        }

        return self::$requiredParameters;

    }

    protected static function getIncrementorByKey($parameterToCheck)
    {

        if (array_key_exists($parameterToCheck, static::$incrementors))
        {

            return static::$incrementors[$parameterToCheck];

        }

        return false;

    }

    public static function getDateTimeParameters()
    {

        return array_filter(

            static::getParameters(),

            function ($v, $k)
            {

                return is_array($v) && array_key_exists("format", $v) && $v["format"] === "dateTime";

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    public static function getDateParameters()
    {

        return array_filter(

            static::getParameters(),

            function ($v, $k)
            {


                return is_array($v) && array_key_exists("format", $v) && $v["format"] === "date";

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    public static function getParametersWithFormat($parameters = null)
    {

        if (!$parameters)
        {

            $parameters = static::getParameters();

        }

        return array_filter(

            $parameters,

            function ($v, $k)
            {

                return is_array($v) && array_key_exists("format", $v) && $v["format"] !== "date";

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    public static function combineFormatWithParameters($array, $find = null, $replace = null)
    {

        $dataTypes = static::$dataTypes;

        $parametersWithFormats = static::getParametersWithFormat($replace);

        foreach ($array as $key => $value)
        {

            if (array_key_exists($key, $parametersWithFormats) && $value["format"] !== "dateTime" && $value["format"] !== "date")
            {

                $format = $value["format"];

                $dataType = $dataTypes[$format];

                $newValue = array_merge($array[$key], $dataType);

                $array[$key] = $newValue;

                unset($array[$key]["format"]);

                if (is_array($array[$key]))
                {

                    $array[$key] = static::combineFormatWithParameters($array[$key], $key, $dataType);

                }

            }

        }

        return $array;

    }

    public static function setParameterByKey($key, $value)
    {

        if (isset($value))
        {

            if (array_key_exists($key, static::getDateTimeParameters()) && !in_array($key, self::$curlParameters))
            {

                static::setDateParameter($key, $value);

            } elseif (array_key_exists($key, static::getDateParameters()) && !in_array($key, self::$curlParameters)) {

                static::setDateParameter($key, $value);

            } else {

                self::$curlParameters[$key] = $value;

            }

        }

    }

    protected static function notIncremented($v, $k, $arg)
    {

        if (is_array($v) && in_array("notIncremented", $v) && $k === $arg)
        {

            return true;

        }

        return false;

    }

    public static function incrementParameter($parameter, $value, $parentParameter = null)
    {

        $parameters = static::getParameters();

        $notIncremented = static::recursiveArrayFilterReturnBoolean("notIncremented", $parameters, $parameter);

        $incrementor = static::getIncrementorByKey($parameter);

        if (is_array($incrementor))
        {

            $calledClass = Helpers::getCalledClass(get_called_class());

            if (array_key_exists($calledClass, $incrementor))
            {

                $incrementor = $incrementor[$calledClass];

            } else {

                $incrementor = $incrementor["default"];

            }

        }

        if ($notIncremented)
        {

            static::setParameterByKey($parameter, $value);

        } elseif (is_array($value)) {

            foreach ($value as $key => $val)
            {

                if ($parentParameter && $incrementor)
                {

                    if (is_numeric($key))
                    {

                        $key++;
                        static::incrementParameter($key, $val, "$parentParameter.$parameter.$incrementor.$key");

                    } else {

                        static::incrementParameter($key, $val, "$parentParameter.$parameter.$incrementor");

                    }

                } elseif ($parentParameter) {

                    if (is_numeric($parameter)) {

                        if (is_array($val))
                        {

                            static::incrementParameter($key, $val, "$parentParameter");

                        } else{

                            static::incrementParameter($key, $val, "$parentParameter.$key");

                        }

                    } else {

                        static::setParameterByKey("$parentParameter.$parameter.$key", $val);

                    }

                } elseif ($incrementor) {

                    $key++;

                    static::incrementParameter($key, $val, "$parameter.$incrementor.$key");

                }

            }

        } else {

            if ($parentParameter)
            {

                static::setParameterByKey($parentParameter, $value);

            } else {

                static::setParameterByKey($parameter, $value);

            }

        }

    }

    public static function setPassedParameters($parametersToSet, $parentParameter = null)
    {

        foreach ($parametersToSet as $parameter => $value)
        {

            if (static::getIncrementorByKey($parameter))
            {

                static::incrementParameter($parameter, $value, $parentParameter);

            } elseif (is_array($value)) {


                foreach ($value as $parameterSubKey => $subKeyValue)
                {

                    if (is_array($subKeyValue))
                    {

                        static::setPassedParameters($subKeyValue, $parameter . "." . $parameterSubKey);

                    } else {

                        static::setParameterByKey($parameter . "." . $parameterSubKey, $subKeyValue);

                    }

                }

            } else {

                if ($parentParameter)
                {
                    static::setParameterByKey($parentParameter . "." . $parameter, $value);

                } else {

                    static::setParameterByKey($parameter, $value);

                }

            }

        }

    }

    protected static function searchParameters($v, $k, $parameterToCheck)
    {

        $explodedKey = explode(".", $k);

        $parentParameter = $explodedKey[0];

        $last = last($explodedKey);

        if (strpos($k, ".") !== false || strpos($parameterToCheck, ".") !== false)
        {

            return strpos($parameterToCheck, $k) !== false || strpos($k, $parameterToCheck) !== false;

        } else {

            return $parameterToCheck === $last;

        }

    }

    public static function searchCurlParameters($parameterToCheck, $parameters = null)
    {

        if (!$parameters)
        {

            $parameters = static::getCurlParameters();

        }

        return static::recursiveArrayFilterReturnBoolean("searchParameters", $parameters, $parameterToCheck);

    }

    public static function searchCurlParametersReturnResults($parameterToCheck, $parameters = null)
    {

        if (!$parameters)
        {

            $parameters = static::getCurlParameters();

        }

        return static::recursiveArrayFilterReturnArray("searchParameters", $parameters, true, $parameterToCheck);

    }

    protected static function combineRequiredParameters()
    {

        $parentRequiredParameters = array_flip(static::getRequiredParameters(true));

        $requiredParameters = static::findRequiredParameters();

        foreach ($parentRequiredParameters as $parameter => $value)
        {

            static::setRequiredParameter($parameter, $value);

        }

        foreach ($requiredParameters as $parameter => $value)
        {

            if (is_array($value))
            {

                static::setRequiredParameter($parameter, $value, true);

            } else {

                static::setRequiredParameter($parameter, $value);

            }

        }

    }

    protected static function combineRequiredAndAllowedParameters()
    {

        static::$allowedParameters = array_merge
        (

            static::getRequiredParameters(),

            static::getParameters()

        );

    }

    protected static function validWith($v, $k, $arg)
    {

        if (is_array($v) && array_key_exists("validWith", $v))
        {

            static::ensureParameterValuesAreValidWith($k, $v["validWith"]);

            return true;

        }

        return false;

    }

    protected static function validif ($v, $k)
    {

        if (is_array($v) && array_key_exists("validIf", $v))
        {

            static::ensureParameterValuesAreValidif($k, $v{"validIf"});

            return true;

        }

        return false;

    }

    protected static function required($v, $k)
    {

        if (is_array($v) && in_array("required", $v))
        {

            return true;

        } elseif ($v === "required") {

            return true;

        }

        return false;

    }

    protected static function countIsLessThanMaximum($v, $k)
    {

        if (is_array($v) && array_key_exists("maximumCount", $v))
        {

            static::ensureParameterCountIsLessThanMaximum($k, $v["maximumCount"]);

            return true;

        }

        return false;

    }

    protected static function noLongerThanMaximum($v, $k)
    {

        if (is_array($v) && array_key_exists("maximumLength", $v))
        {

            static::ensureParameterIsNoLongerThanMaximum($k, $v["maximumLength"]);

            return true;

        }

        return false;

    }

    protected static function noShorterThanMinimum($v, $k)
    {

        if (is_array($v) && array_key_exists("minimumLength", $v))
        {

            static::ensureParameterIsNoShorterThanMinimum($k, $v["minimumLength"]);

            return true;

        }

        return false;

    }

    protected static function areWithinRange($v, $k)
    {

        if (is_array($v) && array_key_exists("rangeWithin", $v))
        {

            static::ensureParameterIsNotGreaterThanMaximum($k, $v["rangeWithin"]["max"]);

            static::ensureParameterIsNotLessThanMinimum($k, $v["rangeWithin"]["min"]);

            return true;

        }

        return false;

    }

    protected static function oneIsSet($v, $k)
    {

        if (is_array($v) && array_key_exists("requiredIfNotSet", $v))
        {

            if (is_array($v["requiredIfNotSet"]))
            {

                static::ensureOnlyOneIsSet($k, $v["requiredIfNotSet"]);

            } else {

                static::ensureOneOrTheOtherIsSet($k, $v["requiredIfNotSet"]);

            }

            return true;

        }

        return false;

    }

    protected static function removeConditionallyRequiredParameters($v, $k, $parameter)
    {

        if ($k === $parameter)
        {

            return true;

        }

        return false;

    }

    protected static function withIncompatibilities($v, $k)
    {

        if (is_array($v) && array_key_exists("incompatibleWith", $v))
        {

            static::ensureIncompatibleParametersNotSet($k, $v["incompatibleWith"]);

            return true;

        }

        return false;

    }

    protected static function datesNotOutsideInterval($v, $k)
    {

        if (is_array($v) && array_key_exists("notFartherApartThan", $v))
        {

            static::ensureDatesNotOutsideInterval($k, $v["notFartherApartThan"]["from"], $v["notFartherApartThan"]["days"]);

            return true;

        }

        return false;

    }

    protected static function dateTimesAreInProperFormat($v, $k)
    {

        static::ensureDateTimesAreInProperFormat($k);

    }

    protected static function datesAreInProperFormat($v, $k)
    {

        static::ensureDatesAreInProperFormat($k);

    }

    protected static function datesAreLaterThan($v, $k)
    {

        if (is_array($v) && array_key_exists("laterThan", $v))
        {

            static::ensureIntervalBetweenDates($k, $v["laterThan"], "later");

            return true;

        }

        return false;

    }

    protected static function datesAreEarlierThan($v, $k)
    {

        if (is_array($v) && array_key_exists("earlierThan", $v))
        {

            if (is_array($v["earlierThan"]))
            {

                array_filter(

                    $v["earlierThan"],

                    function ($vv, $kk) use ($k)
                    {

                        static::ensureIntervalBetweenDates($k, $vv);

                    },

                    ARRAY_FILTER_USE_BOTH
                );

            } else {

                static::ensureIntervalBetweenDates($k);

            }

        }

    }

    protected static function divisorOf($v, $k)
    {

        if (is_array($v) && array_key_exists("divisorOf", $v))
        {

            static::ensureDivisorOf($k, $v["divisorOf"]);

            return true;

        }

        return false;

    }

    protected static function testParametersAreValidWith()
    {

        $parameters = static::getParameters();

        $validWithParameters = static::recursiveArrayFilterReturnArray("validWith", $parameters, true);

    }

    protected static function testParametersAreValidif ()
    {

        $parameters = static::getParameters();

        $validIfParameters = static::recursiveArrayFilterReturnArray("validIf", $parameters, false);

    }

    protected static function testParameterCountIsLessThanMaximum()
    {

        $parameters = static::getParameters();

        $countIsLessThanMaximumParameters = static::recursiveArrayFilterReturnArray("countIsLessThanMaximum", $parameters, false);

    }

    protected static function testParametersAreNoLongerThanMaximum()
    {

        $parameters = static::getParameters();

        $noLongerThanMaximumParameters = static::recursiveArrayFilterReturnArray("noLongerThanMaximum", $parameters, false);

    }

    protected static function testParametersAreNoShorterThanMinimum()
    {

        $parameters = static::getParameters();

        $noShorterThanMinimumParameters = static::recursiveArrayFilterReturnArray("noShorterThanMinimum", $parameters, false);

    }

    protected static function testDatesNotOutsideInterval()
    {

        $parameters = static::getParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("datesNotOutsideInterval", $parameters, false);

    }

    protected static function testDateTimesAreInProperFormat()
    {

        $dateTimeParameters = static::getDateTimeParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("dateTimesAreInProperFormat", $dateTimeParameters, false);

    }

    protected static function testDatesAreInProperFormat()
    {

        $dateParameters = static::getDateParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("datesAreInProperFormat", $dateParameters, false);

    }

    protected static function testDatesAreLaterThan()
    {

        $parameters = static::getParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("datesAreLaterThan", $parameters, false);

    }

    protected static function testDatesAreEarlierThan()
    {

        $parameters = static::getParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("datesAreEarlierThan", $parameters, false);

    }

    protected static function testParametersAreWithinGivenRange()
    {

        $parameters = static::getParameters();

        $rangeWithinParameters = static::recursiveArrayFilterReturnArray("areWithinRange", $parameters, false);

    }

    protected static function testOneIsSet()
    {

        $parameters = static::getParameters();

        $oneIsSetParameters = static::recursiveArrayFilterReturnArray("oneIsSet", $parameters, true);

        static::$requiredParameters = static::removeConditionallyRequiredParametersNotUsed($oneIsSetParameters, static::$requiredParameters);

    }

    protected static function testParametersWithIncompatibilities()
    {

        $parameters = static::getParameters();

        $withIncompatibilitiesParameters = static::recursiveArrayFilterReturnArray("withIncompatibilities", $parameters, false);

    }

    protected static function testDivisorOf()
    {

        $parameters = static::getParameters();

        $divisorOf = static::recursiveArrayFilterReturnArray("divisorOf", $parameters, false);

    }

    protected static function removeConditionallyRequiredParametersNotUsed($arrayToRemoveConditionallyRequiredParameters, &$requiredParameters)
    {

        foreach ($arrayToRemoveConditionallyRequiredParameters as $parameter => $value)
        {

            if (is_array($value) && !array_key_exists("requiredIfNotSet", $value))
            {

                static::removeConditionallyRequiredParametersNotUsed($value, $requiredParameters);

            } elseif (is_array($value) && array_key_exists("requiredIfNotSet", $value)) {

                $matchingCurlParameters = static::searchCurlParameters($parameter);

                if (!$matchingCurlParameters)
                {

                    $requiredParameters = static::recursiveArrayFilterUnsetParameter("removeConditionallyRequiredParameters", $requiredParameters, $parameter);

                }

            }

        }

        return $requiredParameters;

    }

    public static function setParameters($parametersToSet = null)
    {

        static::resetCurlParameters();

        static::$parameters = static::combineFormatWithParameters(static::$parameters);

        static::combineRequiredParameters();

        static::combineRequiredAndAllowedParameters();

        static::setAwsAccessKeyParameter();

        static::setActionParameter();

        if (array_key_exists("Merchant", static::getRequiredParameters()))
        {

            static::setMerchantIdParameter("Merchant");

        }

        if (array_key_exists("SellerId", static::getRequiredParameters()))
        {

            static::setMerchantIdParameter("SellerId");

        }

        if (array_key_exists("MarketplaceId", static::getRequiredParameters()))
        {

            static::setMarketplaceIdParameter();

        }

        if (array_key_exists("PurgeAndReplace", static::getRequiredParameters()))
        {

            static::setPurgeAndReplaceParameter();

        }

        static::setSignatureMethodParameter();

        static::setSignatureVersionParameter();

        static::setTimestampParameter();

        static::setVersionDateParameter();

        if ($parametersToSet)
        {

            static::setPassedParameters($parametersToSet);

        }

    }

    public static function verifyParameters()
    {
        Helpers::dd(static::getCurlParameters());
        // Helpers::dd(static::getParameters());

        static::testOneIsSet();

        static::ensureRequiredParametersAreSet();

        static::ensureSetParametersAreAllowed();

        static::ensureParameterIsInFormat("AmazonOrderId", self::getOrderNumberFormat());

        static::testParametersWithIncompatibilities();

        static::testParametersAreValidWith();

        static::testParametersAreValidif ();

        static::testParametersAreWithinGivenRange();

        static::testParametersAreNoLongerThanMaximum();

        static::testParametersAreNoShorterThanMinimum();

        static::testParameterCountIsLessThanMaximum();

        static::testDatesAreEarlierThan();

        static::testDatesAreLaterThan();

        static::testDatesAreInProperFormat();

        static::testDateTimesAreInProperFormat();

        static::testDatesNotOutsideInterval();

        static::testDivisorOf();

        // static::testGreaterThan();

    }

}