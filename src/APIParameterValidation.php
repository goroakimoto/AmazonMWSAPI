<?php

namespace AmazonMWSAPI;

use \Exception;
use \DateTime;
use \DateInterval;
use \DateTimeZone;
use AmazonMWSAPI\Helpers\Helpers;

trait APIParameterValidation
{

    public static function requireParameterToBeSet($parameterToCheck)
    {

        $matchingParameters = static::searchParameters($parameterToCheck);

        if (empty($matchingParameters))
        {

            throw new Exception("$parameterToCheck must be set to complete this request. Please correct and try again.");

        }

    }

    public static function ensureIntervalBetweenDates($dateToEnsureInterval, $baseDate = "Timestamp", $direction = "earlier", $interval = "PT2M")
    {

        $matchingParameters = static::searchParametersReturnResults($dateToEnsureInterval);

        if (!empty($matchingParameters))
        {

            $baseDateResults = static::searchParametersReturnResults($baseDate);

            $date = new DateTime(end($baseDateResults));

            $formattedInterval = new DateInterval($interval);

            if ($direction !== "earlier")
            {

                $adjustedDate = $date->add($formattedInterval);

            } else {

                $adjustedDate = $date->sub($formattedInterval);

            }

            $dateToEnsure = new DateTime(end($matchingParameters));

            if ($dateToEnsure > $adjustedDate && $direction === "earlier")
            {

                $exceptionNotice = "$dateToEnsureInterval must be earlier than ";
                $exceptionNotice .= $formattedInterval->format('%i minutes');
                $exceptionNotice .= " before ";
                $exceptionNotice .= "$baseDate. Please correct and try again.";

                throw new Exception($exceptionNotice);

            } elseif ($adjustedDate > $dateToEnsure && $direction === "later") {

                $exceptionNotice = "$dateToEnsureInterval must be later than ";
                $exceptionNotice .= $formattedInterval->format('%i minutes');
                $exceptionNotice .= " after ";
                $exceptionNotice .= "$baseDate. Please correct and try again.";

                throw new Exception($exceptionNotice);

            }
        }

    }

    public static function ensureDatesNotOutsideInterval($earlierDate, $laterDate, $intervalInDays)
    {

        $matchingEarlierDateParameters = static::searchParametersReturnResults($earlierDate);

        $matchingLaterDateParameters = static::searchParametersReturnResults($laterDate);

        if (
            !empty($matchingEarlierDateParameters) &&
            !empty($matchingLaterDateParameters)
        ){

            $earlyDate = new DateTime(end($matchingEarlierDateParameters));
            $lateDate = new DateTime(end($matchingLaterDateParameters));
            $difference = $earlyDate->diff($lateDate);

            if ($difference->format('%a') > $intervalInDays)
            {

                throw new Exception("These dates: $earlierDate, $laterDate are greater than $intervalInDays days apart. Please correct and try again.");

            }

        }

    }

    public static function ensureDateTimesAreInProperFormat($parameterToCheck)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (!preg_match("/^\d{4}-\d{2}-\d{2}T[0-2][0-9]:[0-5][0-9]:[0-5][0-9]Z$/", end($matchingParameters)))
            {

                throw new Exception("Dates must be in this format: YYYY-MM-DDTHH:II:SSZ. Please correct and try again.");

            }

        }

    }

    public static function ensureDatesAreInProperFormat($parameterToCheck)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (!preg_match("/^\d{4}-\d{2}-\d{2}Z$/", end($matchingParameters)))
            {

                throw new Exception("Dates must be in this format: YYYY-MM-DDZ. Please correct and try again.");

            }

        }

    }

    public static function ensureAllParametersAreSet($dependentParameters)
    {

        $dependentParametersCopy = $dependentParameters;

        foreach ($dependentParameters as $parameter)
        {

            if (!in_array($parameter, static::getCurlParameters()))
            {

                $dependentParameter = "The following must all be set: ";

                $dependentParameter .= Helpers::arrayToString($dependentParametersCopy);

                $dependentParameter .= "Please correct and try again.";

                throw new Exception($dependentParameter);

            }

        }

    }

    public static function ensureOneParameterOrTheOtherIsSet($firstParameter, $secondParameter)
    {

        $matchingFirstParameters = static::searchParametersReturnResults($firstParameter);

        $matchingSecondParameters = static::searchParametersReturnResults($secondParameter);

        if (
            (empty($matchingFirstParameters) && empty($matchingSecondParameters)) ||
            (!empty($matchingFirstParameters) && !empty($matchingSecondParameters))
        ){

            throw new Exception("$firstParameter OR $secondParameter (not both) must be set. Please correct and try again.");

        }

    }

    public static function ensureOnlyOneParameterIsSet($firstParameter, $otherParameters)
    {

        $matchingFirstParameter = static::searchParametersReturnResults($firstParameter);

        if (!empty($matchingFirstParameter))
        {

            foreach ($otherParameters as $conditionallyRequiredParameter)
            {

                $matchingOtherParameter = static::searchParametersReturnResults($conditionallyRequiredParameter);

                if (!empty($matchingOtherParameter))
                {

                    $exception = "Only one of the following must be set: $firstParameter, ";

                    $exception .= Helpers::arrayToString($otherParameters);

                    $exception .= "Please correct and try again.";

                    throw new Exception($exception);

                }

            }

        }

    }

    public static function ensureIncompatibleParametersNotSet($parameterToCheck, $restrictedParameters)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (is_array($restrictedParameters))
            {

                foreach ($restrictedParameters as $restricted)
                {

                    if (!empty(static::searchParametersReturnResults($restricted)))
                    {

                        throw new Exception("$restricted cannot be set at the same time as $parameterToCheck. Please correct and try again.");

                    }

                }

            } else {

                if (!empty(static::searchParametersReturnResults($restrictedParameters)))
                {

                    throw new Exception("$restrictedParameters cannot be set at the same time as $parameterToCheck. Please correct and try again.");

                }

            }

        }

    }

    public static function ensureParameterValuesAreValidWith($parameterToCheck, $validParameterValues = null)
    {

        $matchingParameter = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameter))
        {

            if (!array_key_exists($parameterToCheck, $matchingParameter))
            {
                $parameters = static::getParameters();

                $ifOperationIsParameters = static::searchParametersReturnResults("ifOperationIs", $parameters);

                if (static::getNestedParameterKey($parameterToCheck, $ifOperationIsParameters))
                {

                    $validKey = static::getNestedParameterKey($parameterToCheck, $ifOperationIsParameters);

                    $value = end($matchingParameter);

                    if (key(static::getNestedParameterKey("validWith", $ifOperationIsParameters)) === $value)
                    {

                        $validOperation = static::getNestedParameterValue("ifOperationIs", $ifOperationIsParameters);

                        if (Helpers::getCalledClass(get_called_class()) !== $validOperation)
                        {

                            throw new Exception("$value is only valid when called from $validOperation. Please correct and try again.");

                        }

                    }

                } else {

                    foreach ($matchingParameter as $parameter => $value)
                    {

                        if (!in_array($value, $validParameterValues))
                        {

                            $exception = "The value for $parameterToCheck must be one of the following: ";

                            $exception .= Helpers::arrayToString($validParameterValues);

                            $exception .= "Please correct and try again.";

                            throw new Exception($exception);

                        }

                    }
                }

            } else {

                $validParameterValue = [];

                $dependentParameters = [];

                foreach ($validParameterValues as $key => $value)
                {

                    if (is_array($value))
                    {

                        $validParameterValue[] = $key;

                        if (array_key_exists("dependentOn", $value))
                        {

                            $dependentParameters[] = $key;

                        }

                    } else {

                        $validParameterValue[] = $value;

                    }

                }

                $parameterValue = end($matchingParameter);

                if (!in_array($parameterValue, $validParameterValue))
                {

                    $exception = "The value for $parameterToCheck must be one of the following: ";

                    $exception .= Helpers::arrayToString($validParameterValue);

                    $exception .= "Please correct and try again.";

                    throw new Exception($exception);

                }

                if (!empty($dependentParameters))
                {

                    static::ensureAllParametersAreSet($dependentParameters);

                }

            }

        }

    }

    public static function ensureParameterValuesAreValidif($parameterToCheck, $validParameterValues = null)
    {

        $matchingParameter = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameter))
        {

            $setParameter = end($matchingParameter);

            if (array_key_exists("region", $validParameterValues))
            {

                static::ensureRegionValue($setParameter, $validParameterValues);

            } elseif (array_key_exists("country", $validParameterValues)) {

                static::ensureCountryValues($setParameter, $validParameterValues);

            } elseif (array_key_exists("RecommendationCategory", $validParameterValues)) {

                $parameter = "RecommendationCategory";

                $recommendationCategories = static::searchParametersReturnResults($parameter);

                static::ensureParameterAtASpecificLevel($parameter, $recommendationCategories, $parameterToCheck, $matchingParameter, $validParameterValues);

            }

        }

    }

    protected static function ensureRegionValue($setParameter, $validParameterValues)
    {

        $sellerRegion = static::getRegion();

        $parameter = "region";

        if (array_key_exists($sellerRegion, $validParameterValues[$parameter]))
        {

            if (!in_array($setParameter, $validParameterValues[$parameter][$sellerRegion]))
            {

                $exception = "The value for $parameterToCheck must be one of the following: ";

                $exception .= Helpers::arrayToString($validParameterValues[$parameter][$sellerRegion]);

                $exception .= "Please correct and try again.";

                throw new Exception($exception);

            }

        }

    }

    protected static function ensureCountryValues($setParameter, $validParameterValues)
    {

        $sellerCountry = static::getCountry();

        $parameter = "country";

        if (is_numeric(current($validParameterValues[$parameter])))
        {

            if (!in_array($setParameter, $validParameterValues[$parameter]))
            {

                $exception = "The value for $parameterToCheck must be one of the following: ";

                $exception .= Helpers::arrayToString($validParameterValues[$parameter]);

                $exception .= "Please correct and try again.";

                throw new Exception($exception);

            }
        } elseif (isset($validParameterValues[$parameter][$sellerCountry])) {

            if (is_array($validParameterValues[$parameter][$sellerCountry]))
            {

                if (!in_array($setParameter, $validParameterValues[$parameter][$sellerCountry]))
                {

                    $exception = "The value for $parameterToCheck must be one of the following: ";

                    $exception .= Helpers::arrayToString($validParameterValues[$parameter][$sellerCountry]);

                    $exception .= "Please correct and try again.";

                    throw new Exception($exception);

                }

            } elseif ($setParameter !== $validParameterValues[$parameter][$sellerCountry]) {

                $exception = "The value for $parameterToCheck must be the following: ";

                $exception .= $validParameterValues[$parameter][$sellerCountry];

                $exception .= "Please correct and try a gain.";

                throw new Exception($exception);

            }

        }

    }

    protected static function ensureParameterAtASpecificLevel($parameterToCheck, $arrayToCheck, $subParameter, $matchingParameter, $validParameterValues = null)
    {

        return array_filter(

            $arrayToCheck,

            function($v, $k) use ($parameterToCheck, $subParameter, $matchingParameter, $validParameterValues)
            {

                $level = static::getLevel($parameterToCheck);

                if ($level)
                {

                    $levelArray = static::levelArray($matchingParameter, $level, $subParameter);

                    static::ensureLevelArrayValues($levelArray, $parameterToCheck, $v, $validParameterValues);

                }

            }, ARRAY_FILTER_USE_BOTH

        );

    }

    protected static function levelArray($matchingParameter, $level, $subParameter)
    {

        return array_filter(

            $matchingParameter,

            function ($k) use ($level, $subParameter)
            {

                return strpos($k, "$level.$subParameter") !== false;

            },

            ARRAY_FILTER_USE_KEY

        );

    }

    protected static function ensureLevelArrayValues($levelArray, $parameterToCheck, $value, $validParameterValues)
    {

        return array_filter(

            $levelArray,

            function ($v, $k) use ($parameterToCheck, $value, $validParameterValues)
            {

                static::ensureParameterValuesAreValidWith($k, $validParameterValues[$parameterToCheck][$value]);

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    public static function ensureSetParametersAreAllowed($parameters = null)
    {

        if (!$parameters)
        {

            $parameters = static::getCurlParameters();

        }

        foreach ($parameters as $parameterToCheck => $value)
        {

            $inArray = static::searchParameters($parameterToCheck, static::getAllowedParameters());

            if (!$inArray)
            {

                throw new Exception("The $parameterToCheck parameter is not allowed. Please correct and try again.");

            }

        }

    }

    public static function ensureRequiredParametersAreSet($requiredParameters = null, $parentKey = null)
    {

        if (!$requiredParameters)
        {

            $requiredParameters = static::$requiredParameters;
            // Helpers::dd($requiredParameters);

        }

        foreach ($requiredParameters as $key => $parameter)
        {

            if (is_array($parameter))
            {

                static::ensureRequiredParametersAreSet($parameter, $key);

            } else {

                if ($parentKey)
                {

                    static::requireParameterToBeSet($parentKey);

                } else {

                    static::requireParameterToBeSet($key);

                }

            }

        }

    }

    public static function ensureRequiredIfParametersAreSet($parameterToCheck, $requiredIf)
    {

        $requiredIfKey = key($requiredIf);

        $requiredIfParameters = static::searchParametersReturnResults($requiredIfKey);

        $requiredIfParameterValue = end($requiredIfParameters);

        $requiredIfValue = end($requiredIf);

        if ($requiredIfKey === "notIn")
        {

            $sellerCountry = static::getCountry();

            if ($sellerCountry !== $requiredIfValue)
            {

                static::requireParameterToBeSet($parameterToCheck);

            }

        } elseif ($requiredIfKey === "destinationCountryIsNot") {

            $sellerCountry = static::getCountry();

            $destinationAddress = static::searchParametersReturnResults("DestinationAddress");

            $destinationAddressCountry = static::searchParametersReturnResults("Country", $destinationAddress);

            if ($sellerCountry !== end($destinationAddressCountry))
            {

                static::requireParameterToBeSet($parameterToCheck);

            }

        } else {

            if ($requiredIfParameterValue === $requiredIfValue)
            {

                static::requireParameterToBeSet($parameterToCheck);

            }

        }

    }

    public static function ensureParameterIsInRange($parameterToCheck, $min, $max)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (
                end($matchingParameters) < $min ||
                end($matchingParameters) > $max
            ){

                throw new Exception("$parameterToCheck must be between $min and $max. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsNotGreaterThanMaximum($parameterToCheck, $max)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (end($matchingParameters) > $max) {

                throw new Exception("$parameterToCheck must be less than or equal to $max. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsNotLessThanMinimum($parameterToCheck, $min)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (trim(end($matchingParameters)) < $min) {

                throw new Exception("$parameterToCheck must be greater than or equal to $min. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsNoLongerThanMaximum($parameterToCheck, $max)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (strlen(end($matchingParameters)) > $max)
            {

                throw new Exception("$parameterToCheck must be shorter than $max characters. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsNoShorterThanMinimum($parameterToCheck, $min)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (strlen(trim(end($matchingParameters))) < $min) {

                throw new Exception("$parameterToCheck must be at least $min character(s). Please correct and try again.");

            }

        }

    }

    public static function ensureParameterCountIsLessThanMaximum($parameterToCheck, $maxCount)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (count($matchingParameters) > $maxCount)
            {

                throw new Exception("$parameterToCheck must have less than $maxCount values. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsInFormat($parameterToCheck, $format)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (empty(preg_match($format, end($matchingParameters))))
            {

                throw new Exception("$parameterToCheck does not match the format: $format. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsAnEvenDivisorOf($divisor, $divisorOf)
    {

        $matchingParameters = static::searchParametersReturnResults($divisor);

        if (!empty($matchingParameters))
        {

            foreach ($matchingParameters as $parameter => $value)
            {

                $siblings = static::getSiblingParameters($parameter);

                $divisorOfParameters = static::searchParametersReturnResults($divisorOf, $siblings);

                if (!empty($divisorOfParameters))
                {

                    if (end($divisorOfParameters) % $value !== 0)
                    {

                        throw new Exception("$divisor must be a divisor of $divisorOf. Please correct and try again.");

                    }

                }

            }

        }

    }

    public static function ensureParameterIsGreaterThan($parameterToCheck, $greaterThan)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (end($matchingParameters) <= $greaterThan)
            {

                throw new Exception("$parameterToCheck must be greater than $greaterThan. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsThisLength($parameterToCheck, $length)
    {

        $matchingParameters = static::searchParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            foreach ($matchingParameters as $parameter => $value)
            {

                if (strlen($value) !== $length)
                {

                    throw new Exception("$parameterToCheck must be $length character(s). Please correct and try again.");

                }
            }

        }

    }

}