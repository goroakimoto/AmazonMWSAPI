<?php

namespace AmazonMWSAPI;

use AmazonMWSAPI\AmazonClient;
use AmazonMWSAPI\Helpers\Helpers;
use DateTime;
use DateTimeZone;

trait APIParameters
{

    private $requiredParameters = [
        "AWSAccessKeyId",
        "Action",
        // "MWSAuthToken", //For Developer Access
        "SignatureMethod",
        "SignatureVersion",
        "Timestamp",
        "Version"
    ];

    public function getOrderNumberFormat()
    {

        return $this->orderNumberFormat;

    }

    public function getAllowedParameters()
    {

        return $this->allowedParameters;

    }

    public function setClassParameterByKey($key, $value)
    {

        $this->parameters[$key] = $value;

    }

    public function getIncrementors()
    {

        return $this->incrementors;

    }

    public function getParameterByKey($key)
    {

        return $this->curlParameters[$key] ?? null;

    }

    private function getSignatureMethod()
    {

        return $this->signatureMethod;

    }

    private function getSignatureVersion()
    {

        return $this->signatureVersion;

    }

    public function getCurlParameters()
    {

        return $this->curlParameters;

    }

    public function getRequiredParameters($parent = null)
    {

        return $parent ? $this->requiredParameters : $this->requiredParameters;

    }

    public function unsetClassParameterByKey($key)
    {

        unset($this->parameters[$key]);

    }

    public function resetCurlParameters()
    {

        $this->curlParameters = [];

    }

    public function resetRequiredParameters()
    {

        $this->requiredParameters = [];

    }

    public function setSignatureMethodParameter()
    {

        $this->setCurlParameter("SignatureMethod", $this->getSignatureMethod());

    }

    public function setSignatureVersionParameter()
    {

        $this->setCurlParameter("SignatureVersion", $this->getSignatureVersion());

    }

    public function setTimestampParameter()
    {

        $date = new DateTime(date("Y-m-d H:i:s"));

        $this->setCurlParameter("Timestamp", $date->format("Y-m-d\TH:i:s\Z"));

    }

    public function setAwsAccessKeyParameter()
    {

        $this->setCurlParameter("AWSAccessKeyId", AmazonClient::getAwsAccessKey());

    }

    public function setActionParameter()
    {

        $this->setCurlParameter("Action", Helpers::getCalledClassNameOnly(get_called_class()));

    }

    public function setMerchantIdParameter($key)
    {

        $this->setCurlParameter($key, AmazonClient::getMerchantId());

    }

    public function setPurgeAndReplaceParameter()
    {

        $this->setCurlParameter("PurgeAndReplace", "false");

    }

    public function setMarketplaceIdParameter()
    {

        $this->incrementParameterWithValue("MarketplaceId", $this->getMarketplaceId());

    }

    public function setDateParameter($parameter, $date, $format = "Y-m-d\TH:i:s\Z")
    {

        $newDate = new DateTime($date);

        $this->curlParameters[$parameter] = $newDate->format($format);

    }

    public function setEachRequiredParentParameter()
    {

        $parentRequiredParameters = $this->getRequiredParameters(true);

        $parentRequiredParameters = array_flip($parentRequiredParameters);

        array_filter(

            $parentRequiredParameters,

            function ($value, $parameter) {

                $this->setRequiredParameter($parameter, $value);

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    public function getNumberOfObjectsAtLevel($parameterToCheck, $incrementor, $arrayToCheck)
    {

        $count = [];

        array_filter(

            $arrayToCheck,

            function ($parameter) use (&$count) {

                $explodedParameter = explode(".", $parameter);

                $baseParameter = current($explodedParameter);

                $incrementorParameter = next($explodedParameter);

                $numberParameter = next($explodedParameter);

                $reconstructed = "$baseParameter.$incrementorParameter.$numberParameter";

                $count[$reconstructed] = 1;

            }

        );

        return count($count);

    }

    public function setEachRequiredParameter($requiredParameters = null, $requiredParentParameter = null)
    {

        $requiredParameters = $requiredParameters ?? $this->findRequiredParameters();

        $this->setRequiredParameters($requiredParameters);

        array_filter(

            $requiredParameters,

            function ($value, $parameter) {

                $this->setRequiredParameter($parameter, $value);

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    protected function incrementRequiredParameterByInstancesInCurl($numberOfInstances, $key, $val, $requiredParameters, $parentParameter)
    {

        for ($x = 1; $x <= $numberOfInstances; $x++) {

            $this->incrementRequiredParameter($key, $val, $requiredParameters, "$parentParameter.$x");

        }

    }

    protected function setRequiredParametersByInstancesInCurl($numberOfInstances, $parameter)
    {

        for ($x = 1; $x <= $numberOfInstances; $x++) {

            $this->setRequiredParameter("$parameter.$x", 1);

        }

    }

    protected function setRequiredParametersArrayWithParentParameterAndIncrementor($parameter, $parentParameter, $incrementor, $key, $val, $requiredParameters, &$currentKey, $curlParameters)
    {

        if (!is_numeric($key)) {

            $matchingParameters = $this->searchBackupParametersReturnResults("$parentParameter.$parameter.$incrementor", $curlParameters);

            $numberOfInstances = $this->getNumberOfObjectsAtLevel("$parentParameter.$parameter", $incrementor, array_keys($matchingParameters));

            $numberOfInstances ? $this->incrementRequiredParameterByInstancesInCurl($numberOfInstances, $key, $val, $requiredParameters, "$parentParameter.$parameter.$incrementor") : "";

            return;

        }

        $currentKey++;

    }

    protected function setRequiredParametersArrayWithParentParameter($parameter, $parentParameter, $key, $val, $requiredParameters, $requiredArray)
    {

        if (is_numeric($parameter)) {

            (is_array($val) && $val !== $requiredArray) ?

                $this->incrementRequiredParameter($key, $val, $requiredParameters, "$parentParameter") :

                $this->incrementRequiredParameter($key, $val, $requiredParameters, "$parentParameter.$key");

            return;

        }

        !is_numeric($key) ? $this->setRequiredParameter("$parentParameter.$parameter.$key", 1) : "";

    }

    protected function setRequiredParametersArrayWithIncrementor($parameter, $incrementor, $key, $val, $requiredParameters, &$currentKey, $curlParameters)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults("$parameter.$incrementor", $curlParameters);

        $numberOfInstances = $this->getNumberOfObjectsAtLevel($parameter, $incrementor, array_keys($matchingParameters));

        is_numeric($key) ? $currentKey++ : "";

        return $numberOfInstances ? $this->incrementRequiredParameterByInstancesInCurl($numberOfInstances, $key, $val, $requiredParameters, "$parameter.$incrementor") : "";

    }

    protected function setRequiredParametersWithParentParameterAndIncrementor($parameter, $parentParameter, $incrementor, $curlParameters)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults("$parentParameter.$parameter.$incrementor", $curlParameters);

        $numberOfInstances = $this->getNumberOfObjectsAtLevel("$parentParameter.$parameter", $incrementor, array_keys($matchingParameters));

        return $numberOfInstances ?

            $this->setRequiredParametersByInstancesInCurl($numberOfInstances, "$parentParameter.$parameter.$incrementor") :

            $this->setRequiredParameter("$parentParameter.$parameter.$incrementor.1", 1);

    }

    protected function setRequiredParametersUsingArray($parameter, $value, $parentParameter, $incrementor, $key, $val, $requiredParameters, $requiredArray, $currentKey, $curlParameters)
    {

        if ($parentParameter && $incrementor) {

            $this->setRequiredParametersArrayWithParentParameterAndIncrementor($parameter, $parentParameter, $incrementor, $key, $val, $requiredParameters, $currentKey, $curlParameters);

        } elseif ($parentParameter) {

            $this->setRequiredParametersArrayWithParentParameter($parameter, $parentParameter, $key, $val, $requiredParameters, $requiredArray);

        } elseif ($incrementor) {

            $this->setRequiredParametersArrayWithIncrementor($parameter, $incrementor, $key, $val, $requiredParameters, $currentKey, $curlParameters);

        }

    }

    protected function setRequiredParametersValueIsArray($parameter, $value, $requiredParameters, $requiredArray, $curlParameters, $parentParameter = null, $incrementor = null, &$currentKey = 0)
    {

        foreach ($value as $key => $val) {

            $this->setRequiredParametersUsingArray($parameter, $value, $parentParameter, $incrementor, $key, $val, $requiredParameters, $requiredArray, $currentKey, $curlParameters);

        }

    }

    protected function setRequiredParametersValueIsNotArray($parameter, $curlParameters, $parentParameter = null, $incrementor = null)
    {

        if ($parentParameter && $incrementor) {

            $this->setRequiredParametersWithParentParameterAndIncrementor($parameter, $parentParameter, $incrementor, $curlParameters);

        } elseif ($parentParameter) {

            $this->setRequiredParameter("$parentParameter.$parameter", 1);

        } else {

            $this->setRequiredParameter($parameter, 1);

        }

    }

    public function incrementRequiredParameter($parameter, $value, &$requiredParameters, $parentParameter = null)
    {

        $requiredArray = ["required"];

        $parameters = $this->getParameters();

        $curlParameters = $this->getCurlParameters();

        $notIncremented = $this->recursiveArrayFilterReturnBoolean("notIncremented", $parameters, $parameter);

        $incrementor = $this->assembleIncrementor($parameter);

        if ($notIncremented) {

            $this->setRequiredParameter($parameter, 1);

        } elseif (is_array($value) && $value !== $requiredArray) {

            $currentKey = 0;

            $this->setRequiredParametersValueIsArray($parameter, $value, $requiredParameters, $requiredArray, $curlParameters, $parentParameter, $incrementor, $currentKey);

        } else {

            $this->setRequiredParametersValueIsNotArray($parameter, $curlParameters, $parentParameter, $incrementor);

        }

    }

    public function setRequiredParameters($requiredParameters, $parentParameter = null)
    {

        $requiredArray = ["required"];

        foreach ($requiredParameters as $parameter => $value) {

            if ($this->assembleIncrementor($parameter)) {

                $this->incrementRequiredParameter($parameter, $value, $requiredParameters, $parentParameter);

            } elseif (is_array($value) && $value !== $requiredArray) {

                foreach ($value as $parameterSubKey => $subKeyValue) {

                    if (is_array($subKeyValue) && $subKeyValue !== $requiredArray) {

                        if ($parentParameter) {

                            $this->setRequiredParameters($subKeyValue, "$parentParameter.$parameter.$parameterSubKey");

                        } else {

                            $this->setRequiredParameters($subKeyValue, "$parameter.$parameterSubKey");

                        }


                    } else {

                        if ($parentParameter && !is_numeric($parameterSubKey)) {

                            $this->setRequiredParameter("$parentParameter.$parameter.$parameterSubKey", 1);

                        } elseif ($parentParameter) {

                            $this->setRequiredParameter("$parentParameter.$parameter", 1);

                        } elseif (!is_numeric($parameterSubKey)) {

                            $this->setRequiredParameter("$parameter.$parameterSubKey", 1);
                        }

                    }

                }

            } else {

                if ($parentParameter) {

                    if (!is_numeric($parameter)) {

                        $this->setRequiredParameter("$parentParameter.$parameter", 1);

                    }

                } else {

                    $this->setRequiredParameter($parameter, 1);

                }

            }

        }

    }

    public function setRequiredParameter($parameter, $value = null)
    {

        $this->requiredParameters[$parameter] = $value;

    }

    public function setVersionDateParameter()
    {

        $this->setCurlParameter("Version", $this->getVersionDate());

    }

    public function recursiveArrayFilterReturnBoolean($method, $array, $arg = null, $inArray = false, $class = "static")
    {

        foreach ($array as $key => $value) {

            if (!is_numeric($key) && call_user_func_array([$class, $method], [$value, $key, $arg]) === true) {

                $inArray = true;
                break;

            } elseif (is_array($value)) {

                $this->recursiveArrayFilterReturnBoolean($method, $value, $arg, $inArray);

            }

        }

        return $inArray;

    }

    public function recursiveArrayFilterReturnArray($method, $array, $removeEmptyArrays = false, $arg = null, $lookingFor = "key", $callback = false, $class = "static")
    {

        foreach ($array as $key => $value) {

            if (is_array($value) && $lookingFor === "value") {

                $array[$key] = $this->recursiveArrayFilterReturnArray($method, $value, $removeEmptyArrays, $arg, $lookingFor, call_user_func_array([$class, $method], [$value, $key, $arg]));

                if ($removeEmptyArrays && !(bool)$array[$key]) {

                    unset($array[$key]);

                }

            } elseif (is_array($value) && $lookingFor === "key" && !call_user_func_array([$class, $method], [$value, $key, $arg])) {

                $array[$key] = $this->recursiveArrayFilterReturnArray($method, $value, $removeEmptyArrays, $arg, $lookingFor, call_user_func_array([$class, $method], [$value, $key, $arg]));

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

    public function recursiveArrayFilterUnsetParameter($method, $array, $arg, $callback = false, $class = "static")
    {

        foreach ($array as $key => $value) {

            if (is_array($value) && !call_user_func_array([$class, $method], [$value, $key, $arg])) {

                $array[$key] = $this->recursiveArrayFilterUnsetParameter($method, $value, $arg, call_user_func_array([$class, $method], [$value, $key, $arg]));

            } elseif (call_user_func_array([$class, $method], [$value, $key, $arg])) {

                unset($array[$key]);

            }

        }

        return $array;

    }

    public function findRequiredParameters()
    {

        $parameters = $this->getParameters();

        return $this->recursiveArrayFilterReturnArray("required", $parameters, true, null, "value");

    }

    public function getIncrementorByKey($parameterToCheck)
    {

        if (is_string($parameterToCheck) && array_key_exists($parameterToCheck, $this->incrementors)) {

            return $this->incrementors[$parameterToCheck];

        }

        return false;

    }

    public function getDateTimeParameters()
    {

        return array_filter(

            $this->getParameters(),

            function ($v, $k) {

                return is_array($v) && array_key_exists("format", $v) && $v["format"] === "dateTime";

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    public function getDateParameters()
    {

        return array_filter(

            $this->getParameters(),

            function ($v, $k) {

                return is_array($v) && array_key_exists("format", $v) && $v["format"] === "date";

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    public function getParametersWithFormat($parameters = null)
    {

        if (!$parameters) {

            $parameters = $this->getParameters();

        }

        return array_filter(

            $parameters,

            function ($v, $k) {

                return is_array($v) && array_key_exists("format", $v) && $v["format"] !== "date";

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    public function combineFormatWithParameters($array, $find = null, $replace = null)
    {

        $dataTypes = $this->dataTypes;

        $parametersWithFormats = $this->getParametersWithFormat($replace);

        foreach ($array as $key => $value) {

            if (array_key_exists($key, $parametersWithFormats) && $value["format"] !== "dateTime" && $value["format"] !== "date") {

                $format = $value["format"];

                $dataType = $dataTypes[$format];

                $newValue = array_merge($array[$key], $dataType);

                $array[$key] = $newValue;

                unset($array[$key]["format"]);

                if (is_array($array[$key])) {

                    $array[$key] = $this->combineFormatWithParameters($array[$key], $key, $dataType);

                }

            }

        }

        return $array;

    }

    public function setCurlParameter($key, $value)
    {

        if (isset($value)) {

            if (array_key_exists($key, $this->getDateTimeParameters()) && !in_array($key, $this->getCurlParameters())) {

                $this->setDateParameter($key, $value);

            } elseif (array_key_exists($key, $this->getDateParameters()) && !in_array($key, $this->getCurlParameters())) {

                $this->setDateParameter($key, $value);

            } else {

                $this->curlParameters[$key] = $value;

            }

        }

    }

    public function notIncremented($v, $k, $arg)
    {

        if (is_array($v) && in_array("notIncremented", $v) && $k === $arg) {

            return true;

        }

        return false;

    }

    public function assembleIncrementor($parameter)
    {

        $incrementor = $this->getIncrementorByKey($parameter);

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

    public function incrementParameterWithValue($parameter, $value, $parentParameter = null)
    {

        $parameters = $this->getParameters();

        $notIncremented = $this->recursiveArrayFilterReturnBoolean("notIncremented", $parameters, $parameter);

        $incrementor = $this->assembleIncrementor($parameter);

        if ($notIncremented) {

            $this->setCurlParameter($parameter, $value);

        } elseif (is_array($value)) {

            foreach ($value as $key => $val) {

                if ($parentParameter && $incrementor) {

                    if (is_numeric($key)) {

                        $key++;
                        $this->incrementParameterWithValue($key, $val, "$parentParameter.$parameter.$incrementor.$key");

                    } else {

                        $this->incrementParameterWithValue($key, $val, "$parentParameter.$parameter.$incrementor");

                    }

                } elseif ($parentParameter) {

                    if (is_numeric($parameter)) {

                        if (is_array($val)) {

                            $this->incrementParameterWithValue($key, $val, "$parentParameter");

                        } else {

                            $this->incrementParameterWithValue($key, $val, "$parentParameter.$key");

                        }

                    } else {

                        $this->setCurlParameter("$parentParameter.$parameter.$key", $val);

                    }

                } elseif ($incrementor) {

                    $key++;

                    $this->incrementParameterWithValue($key, $val, "$parameter.$incrementor.$key");

                }

            }

        } else {

            if ($parentParameter) {

                $this->setCurlParameter($parentParameter, $value);

            } elseif ($incrementor) {

                $this->setCurlParameter("$parameter.$incrementor.1", $value);

            } else {

                $this->setCurlParameter($parameter, $value);

            }

        }

    }

    public function setPassedParameters($parametersToSet, $parentParameter = null)
    {

        foreach ($parametersToSet as $parameter => $value) {

            if ($this->getIncrementorByKey($parameter)) {

                $this->incrementParameterWithValue($parameter, $value, $parentParameter);

            } elseif (is_array($value)) {

                foreach ($value as $parameterSubKey => $subKeyValue) {

                    if (is_array($subKeyValue)) {

                        $this->setPassedParameters($subKeyValue, "$parameter.$parameterSubKey");

                    } else {

                        $this->setCurlParameter("$parameter.$parameterSubKey", $subKeyValue);

                    }

                }

            } else {

                if ($parentParameter) {

                    $this->setCurlParameter("$parentParameter.$parameter", $value);

                } else {

                    $this->setCurlParameter($parameter, $value);

                }

            }

        }

    }

    public function searchForBackupParameter($v, $k, $parameterToCheck)
    {

        $explodedKey = explode(".", $k);

        $parentParameter = $explodedKey[0];
        $last = end($explodedKey);

        if (strpos($k, ".") !== false || strpos($parameterToCheck, ".") !== false) {

            return strpos($parameterToCheck, $k) !== false || strpos($k, $parameterToCheck) !== false;

        } else {

            return $parameterToCheck === $last;

        }

    }

    public function keyEqualsParameter($v, $k, $parameterToCheck)
    {

        if ($k === $parameterToCheck) {

            return true;

        }

        return false;

    }

    public function searchParameters($parameterToCheck, $parameters = null)
    {

        if (!$parameters) {

            $parameters = $this->getCurlParameters();

        }

        return $this->recursiveArrayFilterReturnBoolean("keyEqualsParameter", $parameters, $parameterToCheck);

    }

    public function searchBackupParameters($parameterToCheck, $parameters = null)
    {

        if (!$parameters) {

            $parameters = $this->getCurlParameters();

        }

        return $this->recursiveArrayFilterReturnBoolean("searchForBackupParameter", $parameters, $parameterToCheck);

    }

    public function searchParametersReturnResults($parameterToCheck, $parameters = null)
    {

        if (!$parameters) {

            $parameters = $this->getCurlParameters();

        }

        return $this->recursiveArrayFilterReturnArray("keyEqualsParameter", $parameters, true, $parameterToCheck);

    }

    public function searchBackupParametersReturnResults($parameterToCheck, $parameters = null)
    {

        if (!$parameters) {

            $parameters = $this->getCurlParameters();

        }

        return $this->recursiveArrayFilterReturnArray("searchForBackupParameter", $parameters, true, $parameterToCheck);

    }

    public function combineRequiredParameters()
    {

        $this->setEachRequiredParentParameter();

        $this->setEachRequiredParameter();

    }

    public function combineRequiredAndAllowedParameters()
    {

        $this->allowedParameters = array_merge(

            $this->getRequiredParameters(),

            $this->getParameters()

        );

        // Helpers::dd($this->allowedParameters);

    }

    public function requiredIf($v, $k, $arg)
    {

        if (is_array($v) && array_key_exists("requiredIf", $v)) {

            $this->ensureRequiredIfParametersAreSet($k, $v["requiredIf"]);

            return true;

        }

        return false;

    }

    public function validWith($v, $k, $arg)
    {

        if (is_array($v) && array_key_exists("validWith", $v)) {

            $this->ensureParameterValuesAreValidWith($k, $v["validWith"]);

            return true;

        }

        return false;

    }

    public function validif($v, $k)
    {

        if (is_array($v) && array_key_exists("validIf", $v)) {

            $this->ensureParameterValuesAreValidif($k, $v {
                "validIf"});

            return true;

        }

        return false;

    }

    public function required($v, $k)
    {

        if (is_array($v) && in_array("required", $v)) {

            return true;

        } elseif ($v === "required") {

            return true;

        }

        return false;

    }

    public function countIsLessThanMaximum($v, $k)
    {

        if (is_array($v) && array_key_exists("maximumCount", $v)) {

            $this->ensureParameterCountIsLessThanMaximum($k, $v["maximumCount"]);

            return true;

        }

        return false;

    }

    public function noLongerThanMaximum($v, $k)
    {

        if (is_array($v) && array_key_exists("maximumLength", $v)) {

            $this->ensureParameterIsNoLongerThanMaximum($k, $v["maximumLength"]);

            return true;

        }

        return false;

    }

    public function noShorterThanMinimum($v, $k)
    {

        if (is_array($v) && array_key_exists("minimumLength", $v)) {

            $this->ensureParameterIsNoShorterThanMinimum($k, $v["minimumLength"]);

            return true;

        }

        return false;

    }

    public function areWithinRange($v, $k)
    {

        if (is_array($v) && array_key_exists("rangeWithin", $v)) {

            $this->ensureParameterIsNotGreaterThanMaximum($k, $v["rangeWithin"]["max"]);

            $this->ensureParameterIsNotLessThanMinimum($k, $v["rangeWithin"]["min"]);

            return true;

        }

        return false;

    }

    public function oneIsSet($v, $k)
    {

        if (is_array($v) && array_key_exists("requiredIfNotSet", $v)) {

            if (is_array($v["requiredIfNotSet"])) {

                $this->ensureOnlyOneParameterIsSet($k, $v["requiredIfNotSet"]);

            } else {

                $this->ensureOneParameterOrTheOtherIsSet($k, $v["requiredIfNotSet"]);

            }

            return true;

        }

        return false;

    }

    public function withIncompatibilities($v, $k)
    {

        if (is_array($v) && array_key_exists("incompatibleWith", $v)) {

            $this->ensureIncompatibleParametersNotSet($k, $v["incompatibleWith"]);

            return true;

        }

        return false;

    }

    public function datesNotOutsideInterval($v, $k)
    {

        if (is_array($v) && array_key_exists("notFartherApartThan", $v)) {

            $this->ensureDatesNotOutsideInterval($k, $v["notFartherApartThan"]["from"], $v["notFartherApartThan"]["days"]);

            return true;

        }

        return false;

    }

    public function dateTimesAreInProperFormat($v, $k)
    {

        $this->ensureDateTimesAreInProperFormat($k);

    }

    public function datesAreInProperFormat($v, $k)
    {

        $this->ensureDatesAreInProperFormat($k);

    }

    public function datesAreLaterThan($v, $k)
    {

        if (is_array($v) && array_key_exists("laterThan", $v)) {

            $this->ensureIntervalBetweenDates($k, $v["laterThan"], "later");

            return true;

        }

        return false;

    }

    public function datesAreEarlierThan($v, $k)
    {

        if (is_array($v) && array_key_exists("earlierThan", $v)) {

            if (is_array($v["earlierThan"])) {

                array_filter(

                    $v["earlierThan"],

                    function ($vv, $kk) use ($k) {

                        $this->ensureIntervalBetweenDates($k, $vv);

                    },

                    ARRAY_FILTER_USE_BOTH
                );

            } else {

                $this->ensureIntervalBetweenDates($k);

            }

        }

    }

    public function divisorOf($v, $k)
    {

        if (is_array($v) && array_key_exists("divisorOf", $v)) {

            $this->ensureParameterIsAnEvenDivisorOf($k, $v["divisorOf"]);

            return true;

        }

        return false;

    }

    public function greaterThanParameters($v, $k)
    {

        if (is_array($v) && array_key_exists("greaterThan", $v)) {

            $this->ensureParameterIsGreaterThan($k, $v["greaterThan"]);

            return true;

        }

        return false;

    }

    public function length($v, $k)
    {

        if (is_array($v) && array_key_exists("length", $v)) {

            $this->ensureParameterIsThisLength($k, $v["length"]);

            return true;

        }

        return false;

    }

    public function getSiblingParameters($parameterToCheck, $arrayToCheck = null)
    {

        if (!$arrayToCheck) {

            $arrayToCheck = $this->getCurlParameters();

        }

        $level = $this->getLevel($parameterToCheck);

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

    public function getLevel($parameterToCheck)
    {

        $level = explode(".", $parameterToCheck);

        $temporary = array_pop($level);

        return implode(".", $level);

    }

    public function testRequiredIfParametersAreSet()
    {

        $parameters = $this->getParameters();

        $requiredIfParameters = $this->recursiveArrayFilterReturnArray("requiredIf", $parameters, true);

    }

    public function testParametersAreValidWith()
    {

        $parameters = $this->getParameters();

        $validWithParameters = $this->recursiveArrayFilterReturnArray("validWith", $parameters, true);

    }

    public function testParametersAreValidif()
    {

        $parameters = $this->getParameters();

        $validIfParameters = $this->recursiveArrayFilterReturnArray("validIf", $parameters, false);

    }

    public function testParameterCountIsLessThanMaximum()
    {

        $parameters = $this->getParameters();

        $countIsLessThanMaximumParameters = $this->recursiveArrayFilterReturnArray("countIsLessThanMaximum", $parameters, false);

    }

    public function testParametersAreNoLongerThanMaximum()
    {

        $parameters = $this->getParameters();

        $noLongerThanMaximumParameters = $this->recursiveArrayFilterReturnArray("noLongerThanMaximum", $parameters, false);

    }

    public function testParametersAreNoShorterThanMinimum()
    {

        $parameters = $this->getParameters();

        $noShorterThanMinimumParameters = $this->recursiveArrayFilterReturnArray("noShorterThanMinimum", $parameters, false);

    }

    public function testDatesNotOutsideInterval()
    {

        $parameters = $this->getParameters();

        $datesNotOutsideIntervalParameters = $this->recursiveArrayFilterReturnArray("datesNotOutsideInterval", $parameters, false);

    }

    public function testDateTimesAreInProperFormat()
    {

        $dateTimeParameters = $this->getDateTimeParameters();

        $datesNotOutsideIntervalParameters = $this->recursiveArrayFilterReturnArray("dateTimesAreInProperFormat", $dateTimeParameters, false);

    }

    public function testDatesAreInProperFormat()
    {

        $dateParameters = $this->getDateParameters();

        $datesNotOutsideIntervalParameters = $this->recursiveArrayFilterReturnArray("datesAreInProperFormat", $dateParameters, false);

    }

    public function testDatesAreLaterThan()
    {

        $parameters = $this->getParameters();

        $datesNotOutsideIntervalParameters = $this->recursiveArrayFilterReturnArray("datesAreLaterThan", $parameters, false);

    }

    public function testDatesAreEarlierThan()
    {

        $parameters = $this->getParameters();

        $datesNotOutsideIntervalParameters = $this->recursiveArrayFilterReturnArray("datesAreEarlierThan", $parameters, false);

    }

    public function testParametersAreWithinGivenRange()
    {

        $parameters = $this->getParameters();

        $rangeWithinParameters = $this->recursiveArrayFilterReturnArray("areWithinRange", $parameters, false);

    }

    public function testOneIsSet()
    {

        $parameters = $this->getParameters();

        $oneIsSetParameters = $this->recursiveArrayFilterReturnArray("oneIsSet", $parameters, true);

        $this->requiredParameters = $this->removeConditionallyRequiredParametersNotUsed($oneIsSetParameters, $this->requiredParameters);

    }

    public function testParametersWithIncompatibilities()
    {

        $parameters = $this->getParameters();

        $withIncompatibilitiesParameters = $this->recursiveArrayFilterReturnArray("withIncompatibilities", $parameters, false);

    }

    public function testDivisorOf()
    {

        $parameters = $this->getParameters();

        $divisorOf = $this->recursiveArrayFilterReturnArray("divisorOf", $parameters, false);

    }

    public function testGreaterThan()
    {

        $parameters = $this->getParameters();

        $greaterThan = $this->recursiveArrayFilterReturnArray("greaterThanParameters", $parameters, false);
    }

    public function testLength()
    {

        $parameters = $this->getParameters();

        $length = $this->recursiveArrayFilterReturnArray("length", $parameters, false);

    }

    public function removeConditionallyRequiredParametersNotUsed($arrayToRemoveConditionallyRequiredParameters, &$requiredParameters)
    {

        foreach ($arrayToRemoveConditionallyRequiredParameters as $parameter => $value) {

            if (is_array($value) && !array_key_exists("requiredIfNotSet", $value)) {

                $this->removeConditionallyRequiredParametersNotUsed($value, $requiredParameters);

            } elseif (is_array($value) && array_key_exists("requiredIfNotSet", $value)) {

                $matchingCurlParameters = $this->searchBackupParameters($parameter);

                if (!$matchingCurlParameters) {

                    $requiredParameters = $this->recursiveArrayFilterUnsetParameter("keyEqualsParameter", $requiredParameters, $parameter);

                }

            }

        }

        return $requiredParameters;

    }
    public function getNestedParameterKey($parameterToFind, $arrayToCheck)
    {

        if (is_array($arrayToCheck)) {

            if (!array_key_exists($parameterToFind, $arrayToCheck)) {

                return $this->getNestedParameterKey($parameterToFind, end($arrayToCheck));

            } else {

                return end($arrayToCheck);

            }

        } else {

            return false;

        }

    }

    public function getNestedParameterValue($parameterToFind, $arrayToCheck)
    {

        if (!array_key_exists($parameterToFind, $arrayToCheck)) {

            return $this->getNestedParameterValue($parameterToFind, end($arrayToCheck));

        } else {

            return end($arrayToCheck);

        }

    }

    public function setParameters($parametersToSet = null)
    {

        $this->resetCurlParameters();

        $this->resetRequiredParameters();

        $this->parameters = $this->combineFormatWithParameters($this->parameters);

        if ($parametersToSet) {

            $this->setPassedParameters($parametersToSet);

        }

        $this->combineRequiredParameters();

        $this->combineRequiredAndAllowedParameters();

        $this->setAwsAccessKeyParameter();

        $this->setActionParameter();

        if (array_key_exists("Merchant", $this->getRequiredParameters())) {

            $this->setMerchantIdParameter("Merchant");

        }

        if (array_key_exists("SellerId", $this->getRequiredParameters())) {

            $this->setMerchantIdParameter("SellerId");

        }

        if (array_key_exists("MarketplaceId", $this->getRequiredParameters())) {

            $this->setMarketplaceIdParameter();

        }

        if (array_key_exists("PurgeAndReplace", $this->getRequiredParameters())) {

            $this->setPurgeAndReplaceParameter();

        }

        $this->setSignatureMethodParameter();

        $this->setSignatureVersionParameter();

        $this->setTimestampParameter();

        $this->setVersionDateParameter();

    }

    public function verifyParameters()
    {
        // Helpers::dd($this->getCurlParameters());
        // Helpers::dd($this->getParameters());

        $this->testOneIsSet();

        $this->ensureRequiredParametersAreSet();

        // $this->testRequiredIfParametersAreSet();

        // $this->ensureSetParametersAreAllowed();

        // $this->ensureParameterIsInFormat("AmazonOrderId", $this->getOrderNumberFormat());

        // $this->testParametersWithIncompatibilities();

        // $this->testParametersAreValidWith();

        // $this->testParametersAreValidif();

        // $this->testParametersAreWithinGivenRange();

        // $this->testParametersAreNoLongerThanMaximum();

        // $this->testParametersAreNoShorterThanMinimum();

        // $this->testParameterCountIsLessThanMaximum();

        // $this->testDatesAreEarlierThan();

        // $this->testDatesAreLaterThan();

        // $this->testDatesAreInProperFormat();

        // $this->testDateTimesAreInProperFormat();

        // $this->testDatesNotOutsideInterval();

        // $this->testGreaterThan();

        // $this->testDivisorOf();

        // $this->testLength();

    }

}