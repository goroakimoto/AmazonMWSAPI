<?php

namespace AmazonMWSAPI;

use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Helpers\Helpers;
use DateTime;
use DateTimeZone;

trait APIParameters
{

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

    public static function getIncrementors()
    {

        return static::$incrementors;

    }

    public static function getParameterByKey($key)
    {

        return static::$curlParameters[$key] ?? null;

    }

    private static function getSignatureMethod()
    {

        return self::$signatureMethod;

    }

    private static function getSignatureVersion()
    {

        return self::$signatureVersion;

    }

    public static function getCurlParameters()
    {

        return static::$curlParameters;

    }

    public static function getRequiredParameters($parent = null)
    {

        if (!$parent) {

            return static::$requiredParameters;

        }

        return self::$requiredParameters;

    }

    public static function unsetClassParameterByKey($key)
    {

        unset(static::$parameters[$key]);

    }

    public static function resetCurlParameters()
    {

        static::$curlParameters = [];

    }

    public static function resetRequiredParameters()
    {

        static::$requiredParameters = [];

    }

    public static function setSignatureMethodParameter()
    {

        self::setParameterByKey("SignatureMethod", self::getSignatureMethod());

    }

    public static function setSignatureVersionParameter()
    {

        self::setParameterByKey("SignatureVersion", self::getSignatureVersion());

    }

    public static function setTimestampParameter()
    {

        $date = new DateTime(date("Y-m-d H:i:s"));

        self::setParameterByKey("Timestamp", $date->format("Y-m-d\TH:i:s\Z"));

    }

    public static function setAwsAccessKeyParameter()
    {

        self::setParameterByKey("AWSAccessKeyId", AmazonClient::getAwsAccessKey());

    }

    public static function setActionParameter()
    {

        self::setParameterByKey("Action", Helpers::getCalledClassNameOnly(get_called_class()));

    }

    public static function setMerchantIdParameter($key)
    {

        self::setParameterByKey($key, AmazonClient::getMerchantId());

    }

    public static function setPurgeAndReplaceParameter()
    {

        self::setParameterByKey("PurgeAndReplace", "false");

    }

    public static function setMarketplaceIdParameter()
    {

        static::incrementParameterWithValue("MarketplaceId", self::getMarketplaceId());

    }

    public static function setDateParameter($parameter, $date, $format = "Y-m-d\TH:i:s\Z")
    {

        $newDate = new DateTime($date);

        static::$curlParameters[$parameter] = $newDate->format($format);

    }

    public static function setEachRequiredParentParameter()
    {

        $parentRequiredParameters = array_flip(static::getRequiredParameters(true));

        foreach ($parentRequiredParameters as $parameter => $value) {

            static::setRequiredParameter($parameter, $value);

        }

    }

    public static function getNumberOfObjectsAtLevel($parameterToCheck, $incrementor, $arrayToCheck)
    {

        $count = [];

        foreach ($arrayToCheck as $parameter)
        {

            $explodedParameter = explode(".", $parameter);

            $baseParameter = current($explodedParameter);

            $incrementorParameter = next($explodedParameter);

            $numberParameter = next($explodedParameter);

            $reconstructed = "$baseParameter.$incrementorParameter.$numberParameter";

            $count[$reconstructed] = 1;

        }

        return count($count);

    }

    public static function setEachRequiredParameter($requiredParameters = null, $requiredParentParameter = null)
    {

        if (!$requiredParameters)
        {

            $requiredParameters = static::findRequiredParameters();

        }

        static::setRequiredParameters($requiredParameters);

        foreach ($requiredParameters as $parameter => $value)
        {

            static::setRequiredParameter($parameter, $value);

        }

    }

    public static function incrementRequiredParameter($parameter, $value, &$requiredParameters, $parentParameter = null)
    {

        $requiredArray = ["required"];

        $parameters = static::getParameters();

        $curlParameters = static::getCurlParameters();

        $notIncremented = static::recursiveArrayFilterReturnBoolean("notIncremented", $parameters, $parameter);

        $incrementor = static::assembleIncrementor($parameter);

        if ($notIncremented)
        {

            static::setRequiredParameter($parameter, 1);

        } elseif (is_array($value) && $value !== $requiredArray) {

            $currentKey = 0;

            foreach ($value as $key => $val)
            {

                if ($parentParameter && $incrementor)
                {

                    if (is_numeric($key))
                    {

                        $currentKey++;

                    } else {

                        $matchingParameters = static::searchBackupParametersReturnResults("$parentParameter.$parameter.$incrementor", $curlParameters);

                        $numberOfObjects = static::getNumberOfObjectsAtLevel("$parentParameter.$parameter", $incrementor, array_keys($matchingParameters));

                        if($numberOfObjects)
                        {

                            for ($x = 1; $x <= $numberOfObjects; $x++)
                            {

                                static::incrementRequiredParameter($key, $val, $requiredParameters, "$parentParameter.$parameter.$incrementor.$x");

                            }

                        }

                    }

                } elseif ($parentParameter) {

                    if (is_numeric($parameter))
                    {

                        if (is_array($val) && $val !== $requiredArray)
                        {

                            static::incrementRequiredParameter($key, $val, $requiredParameters, "$parentParameter");

                        } else {

                            static::incrementRequiredParameter($key, $val, $requiredParameters, "$parentParameter.$key");

                        }

                    } else {

                        if (!is_numeric($key))
                        {

                            static::setRequiredParameter("$parentParameter.$parameter.$key", 1);

                        }

                    }

                } elseif ($incrementor) {

                    $matchingParameters = static::searchBackupParametersReturnResults("$parameter.$incrementor", $curlParameters);

                    $numberOfObjects = static::getNumberOfObjectsAtLevel($parameter, $incrementor, array_keys($matchingParameters));

                    if(is_numeric($key))
                    {

                        $currentKey++;

                    } else {

                        if ($numberOfObjects)
                        {

                            for ($x = 1; $x <= $numberOfObjects; $x++) {

                                static::incrementRequiredParameter($key, $val, $requiredParameters, "$parameter.$incrementor.$x");

                            }

                        }

                    }

                }

            }

        } else {

            if ($parentParameter && $incrementor)
            {

                $matchingParameters = static::searchBackupParametersReturnResults("$parentParameter.$parameter.$incrementor", $curlParameters);

                $numberOfObjects = static::getNumberOfObjectsAtLevel("$parentParameter.$parameter", $incrementor, array_keys($matchingParameters));

                if($numberOfObjects)
                {

                    for ($x = 1; $x <= $numberOfObjects; $x++)
                    {

                        static::setRequiredParameter("$parentParameter.$parameter.$incrementor.$x", 1);

                    }

                } else {

                    static::setRequiredParameter("$parentParameter.$parameter.$incrementor.1", 1);

                }

            } elseif($parentParameter) {

                static::setRequiredParameter("$parentParameter.$parameter", 1);

            } else {

                static::setRequiredParameter($parameter, 1);

            }

        }

    }

    public static function setRequiredParameters($requiredParameters, $parentParameter = null)
    {

        $requiredArray = ["required"];

        foreach ($requiredParameters as $parameter => $value)
        {

            if(static::getIncrementorByKey($parameter))
            {

                static::incrementRequiredParameter($parameter, $value, $requiredParameters , $parentParameter);

            } elseif (is_array($value) && $value !== $requiredArray) {

                foreach ($value as $parameterSubKey => $subKeyValue)
                {

                    if (is_array($subKeyValue) && $subKeyValue !== $requiredArray)
                    {

                        if($parentParameter)
                        {

                            static::setRequiredParameters($subKeyValue, "$parentParameter.$parameter.$parameterSubKey");

                        } else {

                            static::setRequiredParameters($subKeyValue, "$parameter.$parameterSubKey");

                        }


                    } else {

                        if ($parentParameter && !is_numeric($parameterSubKey))
                        {

                            static::setRequiredParameter("$parentParameter.$parameter.$parameterSubKey", 1);

                        } elseif ($parentParameter) {

                            static::setRequiredParameter("$parentParameter.$parameter", 1);

                        } elseif(!is_numeric($parameterSubKey)) {

                            static::setRequiredParameter("$parameter.$parameterSubKey", 1);
                        }

                    }

                }

            } else {

                if ($parentParameter)
                {

                    if (!is_numeric($parameter))
                    {

                        static::setRequiredParameter("$parentParameter.$parameter", 1);

                    }

                } else {

                    static::setRequiredParameter($parameter, 1);

                }

            }

        }

    }

    public static function setRequiredParameter($parameter, $value = null)
    {

        static::$requiredParameters[$parameter] = $value;

    }

    public static function setVersionDateParameter()
    {

        self::setParameterByKey("Version", static::getVersionDate());

    }

    public static function recursiveArrayFilterReturnBoolean($method, $array, $arg = null, $inArray = false, $class = "static")
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

    public static function recursiveArrayFilterReturnArray($method, $array, $removeEmptyArrays = false, $arg = null, $lookingFor = "key", $callback = false, $class = "static")
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

    public static function recursiveArrayFilterUnsetParameter($method, $array, $arg, $callback = false, $class = "static")
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

    public static function findRequiredParameters()
    {

        $parameters = static::getParameters();

        return static::recursiveArrayFilterReturnArray("required", $parameters, true, null, "value");

    }

    public static function getIncrementorByKey($parameterToCheck)
    {

        if (is_string($parameterToCheck) && array_key_exists($parameterToCheck, static::$incrementors))
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

            if (array_key_exists($key, static::getDateTimeParameters()) && !in_array($key, static::getCurlParameters()))
            {

                static::setDateParameter($key, $value);

            } elseif (array_key_exists($key, static::getDateParameters()) && !in_array($key, static::getCurlParameters())) {

                static::setDateParameter($key, $value);

            } else {

                static::$curlParameters[$key] = $value;

            }

        }

    }

    public static function notIncremented($v, $k, $arg)
    {

        if (is_array($v) && in_array("notIncremented", $v) && $k === $arg)
        {

            return true;

        }

        return false;

    }

    public static function assembleIncrementor($parameter)
    {

        $incrementor = static::getIncrementorByKey($parameter);

        if (is_array($incrementor)) {

            $calledClass = Helpers::getCalledClassNameOnly(get_called_class());

            if (array_key_exists($calledClass, $incrementor)) {

                $incrementor = $incrementor[$calledClass];

            } else {

                $incrementor = $incrementor["default"];

            }

        }

        return $incrementor;

    }

    public static function incrementParameterWithValue($parameter, $value, $parentParameter = null)
    {

        $parameters = static::getParameters();

        $notIncremented = static::recursiveArrayFilterReturnBoolean("notIncremented", $parameters, $parameter);

        $incrementor = static::assembleIncrementor($parameter);

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
                        static::incrementParameterWithValue($key, $val, "$parentParameter.$parameter.$incrementor.$key");

                    } else {

                        static::incrementParameterWithValue($key, $val, "$parentParameter.$parameter.$incrementor");

                    }

                } elseif ($parentParameter) {

                    if (is_numeric($parameter))
                    {

                        if (is_array($val))
                        {

                            static::incrementParameterWithValue($key, $val, "$parentParameter");

                        } else {

                            static::incrementParameterWithValue($key, $val, "$parentParameter.$key");

                        }

                    } else {

                        static::setParameterByKey("$parentParameter.$parameter.$key", $val);

                    }

                } elseif ($incrementor) {

                    $key++;

                    static::incrementParameterWithValue($key, $val, "$parameter.$incrementor.$key");

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

                static::incrementParameterWithValue($parameter, $value, $parentParameter);

            } elseif (is_array($value)) {

                foreach ($value as $parameterSubKey => $subKeyValue)
                {

                    if (is_array($subKeyValue))
                    {

                        static::setPassedParameters($subKeyValue, "$parameter.$parameterSubKey");

                    } else {

                        static::setParameterByKey("$parameter.$parameterSubKey", $subKeyValue);

                    }

                }

            } else {

                if ($parentParameter)
                {

                    static::setParameterByKey("$parentParameter.$parameter", $value);

                } else {

                    static::setParameterByKey($parameter, $value);

                }

            }

        }

    }

    public static function searchForBackupParameter($v, $k, $parameterToCheck)
    {

        $explodedKey = explode(".", $k);

        $parentParameter = $explodedKey[0];
        $last = end($explodedKey);

        if (strpos($k, ".") !== false || strpos($parameterToCheck, ".") !== false)
        {

            return strpos($parameterToCheck, $k) !== false || strpos($k, $parameterToCheck) !== false;

        } else {

            return $parameterToCheck === $last;

        }

    }

    public static function keyEqualsParameter($v, $k, $parameterToCheck)
    {

        if ($k === $parameterToCheck)
        {

            return true;

        }

        return false;

    }

    public static function searchParameters($parameterToCheck, $parameters = null)
    {

        if (!$parameters) {

            $parameters = static::getCurlParameters();

        }

        return static::recursiveArrayFilterReturnBoolean("keyEqualsParameter", $parameters, $parameterToCheck);

    }

    public static function searchBackupParameters($parameterToCheck, $parameters = null)
    {

        if (!$parameters)
        {

            $parameters = static::getCurlParameters();

        }

        return static::recursiveArrayFilterReturnBoolean("searchForBackupParameter", $parameters, $parameterToCheck);

    }

    public static function searchParametersReturnResults($parameterToCheck, $parameters = null)
    {

        if (!$parameters) {

            $parameters = static::getCurlParameters();

        }

        return static::recursiveArrayFilterReturnArray("keyEqualsParameter", $parameters, true, $parameterToCheck);

    }

    public static function searchBackupParametersReturnResults($parameterToCheck, $parameters = null)
    {

        if (!$parameters)
        {

            $parameters = static::getCurlParameters();

        }

        return static::recursiveArrayFilterReturnArray("searchForBackupParameter", $parameters, true, $parameterToCheck);

    }

    public static function combineRequiredParameters()
    {

        static::setEachRequiredParentParameter();

        static::setEachRequiredParameter();

    }

    public static function combineRequiredAndAllowedParameters()
    {

        static::$allowedParameters = array_merge
        (

            static::getRequiredParameters(),

            static::getParameters()

        );

        // Helpers::dd(static::$allowedParameters);

    }

    public static function requiredIf($v, $k, $arg)
    {

        if (is_array($v) && array_key_exists("requiredIf", $v))
        {

            static::ensureRequiredIfParametersAreSet($k, $v["requiredIf"]);

            return true;

        }

        return false;

    }

    public static function validWith($v, $k, $arg)
    {

        if (is_array($v) && array_key_exists("validWith", $v))
        {

            static::ensureParameterValuesAreValidWith($k, $v["validWith"]);

            return true;

        }

        return false;

    }

    public static function validif ($v, $k)
    {

        if (is_array($v) && array_key_exists("validIf", $v))
        {

            static::ensureParameterValuesAreValidif($k, $v{"validIf"});

            return true;

        }

        return false;

    }

    public static function required($v, $k)
    {

        if (is_array($v) && in_array("required", $v))
        {

            return true;

        } elseif ($v === "required") {

            return true;

        }

        return false;

    }

    public static function countIsLessThanMaximum($v, $k)
    {

        if (is_array($v) && array_key_exists("maximumCount", $v))
        {

            static::ensureParameterCountIsLessThanMaximum($k, $v["maximumCount"]);

            return true;

        }

        return false;

    }

    public static function noLongerThanMaximum($v, $k)
    {

        if (is_array($v) && array_key_exists("maximumLength", $v))
        {

            static::ensureParameterIsNoLongerThanMaximum($k, $v["maximumLength"]);

            return true;

        }

        return false;

    }

    public static function noShorterThanMinimum($v, $k)
    {

        if (is_array($v) && array_key_exists("minimumLength", $v))
        {

            static::ensureParameterIsNoShorterThanMinimum($k, $v["minimumLength"]);

            return true;

        }

        return false;

    }

    public static function areWithinRange($v, $k)
    {

        if (is_array($v) && array_key_exists("rangeWithin", $v))
        {

            static::ensureParameterIsNotGreaterThanMaximum($k, $v["rangeWithin"]["max"]);

            static::ensureParameterIsNotLessThanMinimum($k, $v["rangeWithin"]["min"]);

            return true;

        }

        return false;

    }

    public static function oneIsSet($v, $k)
    {

        if (is_array($v) && array_key_exists("requiredIfNotSet", $v))
        {

            if (is_array($v["requiredIfNotSet"]))
            {

                static::ensureOnlyOneParameterIsSet($k, $v["requiredIfNotSet"]);

            } else {

                static::ensureOneParameterOrTheOtherIsSet($k, $v["requiredIfNotSet"]);

            }

            return true;

        }

        return false;

    }

    public static function withIncompatibilities($v, $k)
    {

        if (is_array($v) && array_key_exists("incompatibleWith", $v))
        {

            static::ensureIncompatibleParametersNotSet($k, $v["incompatibleWith"]);

            return true;

        }

        return false;

    }

    public static function datesNotOutsideInterval($v, $k)
    {

        if (is_array($v) && array_key_exists("notFartherApartThan", $v))
        {

            static::ensureDatesNotOutsideInterval($k, $v["notFartherApartThan"]["from"], $v["notFartherApartThan"]["days"]);

            return true;

        }

        return false;

    }

    public static function dateTimesAreInProperFormat($v, $k)
    {

        static::ensureDateTimesAreInProperFormat($k);

    }

    public static function datesAreInProperFormat($v, $k)
    {

        static::ensureDatesAreInProperFormat($k);

    }

    public static function datesAreLaterThan($v, $k)
    {

        if (is_array($v) && array_key_exists("laterThan", $v))
        {

            static::ensureIntervalBetweenDates($k, $v["laterThan"], "later");

            return true;

        }

        return false;

    }

    public static function datesAreEarlierThan($v, $k)
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

    public static function divisorOf($v, $k)
    {

        if (is_array($v) && array_key_exists("divisorOf", $v))
        {

            static::ensureParameterIsAnEvenDivisorOf($k, $v["divisorOf"]);

            return true;

        }

        return false;

    }

    public static function greaterThanParameters($v, $k)
    {

        if (is_array($v) && array_key_exists("greaterThan", $v))
        {

            static::ensureParameterIsGreaterThan($k, $v["greaterThan"]);

            return true;

        }

        return false;

    }

    public static function length($v, $k)
    {

        if (is_array($v) && array_key_exists("length", $v))
        {

            static::ensureParameterIsThisLength($k, $v["length"]);

            return true;

        }

        return false;

    }

    public static function getSiblingParameters($parameterToCheck, $arrayToCheck = null)
    {

        if (!$arrayToCheck) {

            $arrayToCheck = static::getCurlParameters();

        }

        $level = static::getLevel($parameterToCheck);

        if ($level) {

            $siblingParameters = array_filter(

                $arrayToCheck,

                function ($k) use ($level) {

                    return strpos($k, $level) !== false;

                },

                ARRAY_FILTER_USE_KEY

            );

            return $siblingParameters;

        }

    }

    public static function getLevel($parameterToCheck)
    {

        $level = explode(".", $parameterToCheck);

        $temporary = array_pop($level);

        return implode(".", $level);

    }

    public static function testRequiredIfParametersAreSet()
    {

        $parameters = static::getParameters();

        $requiredIfParameters = static::recursiveArrayFilterReturnArray("requiredIf", $parameters, true);

    }

    public static function testParametersAreValidWith()
    {

        $parameters = static::getParameters();

        $validWithParameters = static::recursiveArrayFilterReturnArray("validWith", $parameters, true);

    }

    public static function testParametersAreValidif ()
    {

        $parameters = static::getParameters();

        $validIfParameters = static::recursiveArrayFilterReturnArray("validIf", $parameters, false);

    }

    public static function testParameterCountIsLessThanMaximum()
    {

        $parameters = static::getParameters();

        $countIsLessThanMaximumParameters = static::recursiveArrayFilterReturnArray("countIsLessThanMaximum", $parameters, false);

    }

    public static function testParametersAreNoLongerThanMaximum()
    {

        $parameters = static::getParameters();

        $noLongerThanMaximumParameters = static::recursiveArrayFilterReturnArray("noLongerThanMaximum", $parameters, false);

    }

    public static function testParametersAreNoShorterThanMinimum()
    {

        $parameters = static::getParameters();

        $noShorterThanMinimumParameters = static::recursiveArrayFilterReturnArray("noShorterThanMinimum", $parameters, false);

    }

    public static function testDatesNotOutsideInterval()
    {

        $parameters = static::getParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("datesNotOutsideInterval", $parameters, false);

    }

    public static function testDateTimesAreInProperFormat()
    {

        $dateTimeParameters = static::getDateTimeParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("dateTimesAreInProperFormat", $dateTimeParameters, false);

    }

    public static function testDatesAreInProperFormat()
    {

        $dateParameters = static::getDateParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("datesAreInProperFormat", $dateParameters, false);

    }

    public static function testDatesAreLaterThan()
    {

        $parameters = static::getParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("datesAreLaterThan", $parameters, false);

    }

    public static function testDatesAreEarlierThan()
    {

        $parameters = static::getParameters();

        $datesNotOutsideIntervalParameters = static::recursiveArrayFilterReturnArray("datesAreEarlierThan", $parameters, false);

    }

    public static function testParametersAreWithinGivenRange()
    {

        $parameters = static::getParameters();

        $rangeWithinParameters = static::recursiveArrayFilterReturnArray("areWithinRange", $parameters, false);

    }

    public static function testOneIsSet()
    {

        $parameters = static::getParameters();

        $oneIsSetParameters = static::recursiveArrayFilterReturnArray("oneIsSet", $parameters, true);

        static::$requiredParameters = static::removeConditionallyRequiredParametersNotUsed($oneIsSetParameters, static::$requiredParameters);

    }

    public static function testParametersWithIncompatibilities()
    {

        $parameters = static::getParameters();

        $withIncompatibilitiesParameters = static::recursiveArrayFilterReturnArray("withIncompatibilities", $parameters, false);

    }

    public static function testDivisorOf()
    {

        $parameters = static::getParameters();

        $divisorOf = static::recursiveArrayFilterReturnArray("divisorOf", $parameters, false);

    }

    public static function testGreaterThan()
    {

        $parameters = static::getParameters();

        $greaterThan = static::recursiveArrayFilterReturnArray("greaterThanParameters", $parameters, false);
    }

    public static function testLength()
    {

        $parameters = static::getParameters();

        $length = static::recursiveArrayFilterReturnArray("length", $parameters, false);

    }

    public static function removeConditionallyRequiredParametersNotUsed($arrayToRemoveConditionallyRequiredParameters, &$requiredParameters)
    {

        foreach ($arrayToRemoveConditionallyRequiredParameters as $parameter => $value)
        {

            if (is_array($value) && !array_key_exists("requiredIfNotSet", $value))
            {

                static::removeConditionallyRequiredParametersNotUsed($value, $requiredParameters);

            } elseif (is_array($value) && array_key_exists("requiredIfNotSet", $value)) {

                $matchingCurlParameters = static::searchBackupParameters($parameter);

                if (!$matchingCurlParameters)
                {

                    $requiredParameters = static::recursiveArrayFilterUnsetParameter("keyEqualsParameter", $requiredParameters, $parameter);

                }

            }

        }

        return $requiredParameters;

    }
    public static function getNestedParameterKey($parameterToFind, $arrayToCheck)
    {

        if (is_array($arrayToCheck))
        {

            if (!array_key_exists($parameterToFind, $arrayToCheck))
            {

                return static::getNestedParameterKey($parameterToFind, end($arrayToCheck));

            } else {

                return end($arrayToCheck);

            }

        } else {

            return false;

        }

    }

    public static function getNestedParameterValue($parameterToFind, $arrayToCheck)
    {

        if (!array_key_exists($parameterToFind, $arrayToCheck))
        {

            return static::getNestedParameterValue($parameterToFind, end($arrayToCheck));

        } else {

            return end($arrayToCheck);

        }

    }

    public static function setParameters($parametersToSet = null)
    {

        static::resetCurlParameters();

        static::resetRequiredParameters();

        static::$parameters = static::combineFormatWithParameters(static::$parameters);

        if ($parametersToSet)
        {

            static::setPassedParameters($parametersToSet);

        }

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

    }

    public static function verifyParameters()
    {
        // Helpers::dd(static::getCurlParameters());
        // Helpers::dd(static::getParameters());

        // static::testOneIsSet();

        static::ensureRequiredParametersAreSet();

        // static::testRequiredIfParametersAreSet();

        // static::ensureSetParametersAreAllowed();

        // static::ensureParameterIsInFormat("AmazonOrderId", self::getOrderNumberFormat());

        // static::testParametersWithIncompatibilities();

        // static::testParametersAreValidWith();

        // static::testParametersAreValidif();

        // static::testParametersAreWithinGivenRange();

        // static::testParametersAreNoLongerThanMaximum();

        // static::testParametersAreNoShorterThanMinimum();

        // static::testParameterCountIsLessThanMaximum();

        // static::testDatesAreEarlierThan();

        // static::testDatesAreLaterThan();

        // static::testDatesAreInProperFormat();

        // static::testDateTimesAreInProperFormat();

        // static::testDatesNotOutsideInterval();

        // static::testGreaterThan();

        // static::testDivisorOf();

        // static::testLength();

    }

}