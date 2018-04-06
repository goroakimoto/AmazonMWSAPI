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

        $matchingParameters = static::searchCurlParameters($parameterToCheck);
        // Helpers::dd($parameterToCheck);
        // Helpers::dd($matchingParameters);

        if(empty($matchingParameters))
        {

            throw new Exception("$parameterToCheck must be set to complete this request. Please correct and try again.");

        }

    }

    public static function ensureIntervalBetweenDates($dateToEnsureInterval, $baseDate = "Timestamp", $direction = "earlier", $interval = "PT2M")
    {

        $matchingParameters = static::searchCurlParametersReturnResults($dateToEnsureInterval);

        if(!empty($matchingParameters))
        {

            $baseDateResults = static::searchCurlParametersReturnResults($baseDate);

            $date = new DateTime(end($baseDateResults));

            $formattedInterval = new DateInterval($interval);

            if($direction !== "earlier")
            {

                $adjustedDate = $date->add($formattedInterval);

            } else {

                $adjustedDate = $date->sub($formattedInterval);

            }

            $dateToEnsure = new DateTime(end($matchingParameters));

            if($dateToEnsure > $adjustedDate && $direction === "earlier")
            {

                $exceptionNotice = "$dateToEnsureInterval must be earlier than ";
                $exceptionNotice .= $formattedInterval->format('%i minutes');
                $exceptionNotice .= " before ";
                $exceptionNotice .= "$baseDate. Please correct and try again.";

                throw new Exception($exceptionNotice);

            } elseif($adjustedDate > $dateToEnsure && $direction === "later")
            {

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

        $matchingEarlierDateParameters = static::searchCurlParametersReturnResults($earlierDate);

        $matchingLaterDateParameters = static::searchCurlParametersReturnResults($laterDate);

        if(
            !empty($matchingEarlierDateParameters) &&
            !empty($matchingLaterDateParameters)
        ){

            $earlyDate = new DateTime(end($matchingEarlierDateParameters));
            $lateDate = new DateTime(end($matchingLaterDateParameters));
            $difference = $earlyDate->diff($lateDate);

            if($difference->format('%a') > $intervalInDays)
            {

                throw new Exception("These dates: $earlierDate, $laterDate are greater than $intervalInDays days apart. Please correct and try again.");

            }

        }

    }

    public static function ensureDateTimesAreInProperFormat($parameterToCheck)
    {

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if(!empty($matchingParameters))
        {

            if (!preg_match("/^\d{4}-\d{2}-\d{2}T[0-2][0-9]:[0-5][0-9]:[0-5][0-9]Z$/", end($matchingParameters)))
            {

                throw new Exception("Dates must be in this format: YYYY-MM-DDTHH:II:SSZ. Please correct and try again.");

            }

        }

    }

    public static function ensureDatesAreInProperFormat($parameterToCheck)
    {

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (!preg_match("/^\d{4}-\d{2}-\d{2}Z$/", end($matchingParameters))) {

                throw new Exception("Dates must be in this format: YYYY-MM-DDZ. Please correct and try again.");

            }

        }

    }

    public static function ensureAllAreSet($dependentParameters)
    {

        $dependentParametersCopy = $dependentParameters;

        foreach ($dependentParameters as $parameter)
        {

            if(!in_array($parameter, static::getCurlParameters()))
            {

                $dependentParameter = "The following must all be set: ";

                $dependentParameter .= Helpers::arrayToString($dependentParametersCopy);

                $dependentParameter .= "Please correct and try again.";

                throw new Exception($dependentParameter);

            }

        }

    }

    public static function ensureOneOrTheOtherIsSet($firstParameter, $secondParameter)
    {

        $matchingFirstParameters = static::searchCurlParametersReturnResults($firstParameter);

        $matchingSecondParameters = static::searchCurlParametersReturnResults($secondParameter);

        if(
            (
                empty($matchingFirstParameters) && empty($matchingSecondParameters)
            ) || (
                !empty($matchingFirstParameters) && !empty($matchingSecondParameters)
            )
        ){

            throw new Exception("$firstParameter OR $secondParameter (not both) must be set. Please correct and try again.");

        }

    }

    public static function ensureOnlyOneIsSet($firstParameter, $otherParameters)
    {

        $matchingFirstParameter = static::searchCurlParametersReturnResults($firstParameter);

        if(!empty($matchingFirstParameter)){

            foreach($otherParameters as $conditionallyRequiredParameter)
            {

                $matchingOtherParameter = static::searchCurlParametersReturnResults($conditionallyRequiredParameter);

                if(!empty($matchingOtherParameter))
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

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if(!empty($matchingParameters))
        {

            if(is_array($restrictedParameters))
            {

                foreach($restrictedParameters as $restricted)
                {

                    if(!empty(static::searchCurlParametersReturnResults($restricted)))
                    {

                        throw new Exception("$restricted cannot be set at the same time as $parameterToCheck. Please correct and try again.");

                    }

                }

            } else {

                if(!empty(static::searchCurlParametersReturnResults($restrictedParameters)))
                {

                    throw new Exception("$restrictedParameters cannot be set at the same time as $parameterToCheck. Please correct and try again.");

                }

            }

        }

    }

    public static function ensureParameterValuesAreValidWith($parameterToCheck, $validParameterValues = null)
    {

        $matchingParameter = static::searchCurlParametersReturnResults($parameterToCheck);

        if(!empty($matchingParameter))
        {

            // Helpers::dd($matchingParameter);

            if(!array_key_exists($parameterToCheck, $matchingParameter))
            {
                $parameters = static::getParameters();

                // Helpers::dd("Parameter:");
                // Helpers::dd($parameterToCheck);
                // Helpers::dd($validParameterValues);
                // Helpers::dd("MatchingParameters:");

                foreach ($matchingParameter as $parameter => $value) {

                    $explodedKey = explode(".", $parameter);
                    // Helpers::dd($explodedKey);
                    $lastValue = end($explodedKey);
                    // Helpers::dd($lastValue);
                    $parentParameter = prev($explodedKey);
                    // Helpers::dd("ParentParameter:");
                    // Helpers::dd($parentParameter);

                    $matchingParameter = static::searchCurlParametersReturnResults($parentParameter);
                    // Helpers::dd($matchingParameter);

                }

            } else {

                $validParameterValue = [];
                $dependentParameters = [];

                foreach($validParameterValues as $key => $value)
                {

                    if(is_array($value))
                    {

                        $validParameterValue[] = $key;

                        if(array_key_exists("dependentOn", $value))
                        {

                            $dependentParameters[] = $key;

                        }

                    } else {

                        $validParameterValue[] = $value;

                    }

                }

                $parameterValue = end($matchingParameter);

                if(!in_array($parameterValue, $validParameterValue))
                {

                    $exception = "The value for $parameterToCheck must be one of the following: ";

                    $exception .= Helpers::arrayToString($validParameterValue);

                    $exception .= "Please correct and try again.";

                    throw new Exception($exception);

                }

                if(!empty($dependentParameters))
                {

                    static::ensureAllAreSet($dependentParameters);

                }

            }

        }

    }

    public static function ensureParameterValuesAreValidIf($parameterToCheck, $validParameterValues = null)
    {

        $matchingParameter = static::searchCurlParametersReturnResults($parameterToCheck);
        // Helpers::dd($parameterToCheck);
        // Helpers::dd($matchingParameter);
        // Helpers::dd($validParameterValues);

        if (!empty($matchingParameter))
        {

            $setParameter = end($matchingParameter);

            if(array_key_exists("region", $validParameterValues))
            {

                $sellerRegion = static::getRegion();

                if(array_key_exists($sellerRegion, $validParameterValues["region"]))
                {

                    if(!in_array($setParameter, $validParameterValues["region"][$sellerRegion]))
                    {

                        $exception = "The value for $parameterToCheck must be one of the following: ";

                        $exception .= Helpers::arrayToString($validParameterValues["region"][$sellerRegion]);

                        $exception .= "Please correct and try again.";

                        throw new Exception($exception);

                    }

                }

            } elseif(array_key_exists("country", $validParameterValues)) {

                $sellerCountry = static::getCountry();

                if(is_numeric(current($validParameterValues["country"])))
                {

                    if (!in_array($setParameter, $validParameterValues["country"])) {

                        $exception = "The value for $parameterToCheck must be one of the following: ";

                        $exception .= Helpers::arrayToString($validParameterValues["country"]);

                        $exception .= "Please correct and try again.";

                        throw new Exception($exception);

                    }
                } elseif(isset($validParameterValues["country"][$sellerCountry])) {

                    if(is_array($validParameterValues["country"][$sellerCountry]))
                    {

                        if(!in_array($setParameter, $validParameterValues["country"][$sellerCountry]))
                        {

                            $exception = "The value for $parameterToCheck must be one of the following: ";

                            $exception .= Helpers::arrayToString($validParameterValues["country"][$sellerCountry]);

                            $exception .= "Please correct and try again.";

                            throw new Exception($exception);

                        }

                    } elseif($setParameter !== $validParameterValues["country"][$sellerCountry]) {

                        $exception = "The value for $parameterToCheck must be the following: ";

                        $exception .= $validParameterValues["country"][$sellerCountry];

                        $exception .= "Please correct and try a gain.";

                        throw new Exception($exception);

                    }

                }

            } elseif(array_key_exists("RecommendationCategory", $validParameterValues)) {

                // Helpers::dd($validParameterValues);

            }

        }

    }

    public static function ensureSetParametersAreAllowed($parameters = null)
    {

        if (!$parameters) {

            $parameters = static::getCurlParameters();

        }

        foreach($parameters as $parameterToCheck => $value)
        {

            $inArray = static::searchCurlParameters($parameterToCheck, static::getAllowedParameters());

            if(!$inArray)
            {

                throw new Exception("The $parameterToCheck parameter is not allowed. Please correct and try again.");

            }

        }

    }

    public static function ensureRequiredParametersAreSet($requiredParameters = null, $parentKey = null)
    {

        if(!$requiredParameters)
        {

            $requiredParameters = static::$requiredParameters;

        }

        foreach ($requiredParameters as $key => $parameter)
        {

            if(is_array($parameter))
            {

                static::ensureRequiredParametersAreSet($parameter, $key);

            } else {

                if($parentKey)
                {

                    static::requireParameterToBeSet($parentKey);

                } else {

                    static::requireParameterToBeSet($key);

                }

            }

        }

    }

    public static function ensureParameterIsInRange($parameterToCheck, $min, $max)
    {

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if(!empty($matchingParameters))
        {

            if(
                end($matchingParameters) < $min ||
                end($matchingParameters) > $max
            ){

                throw new Exception("$parameterToCheck must be between $min and $max. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsNotGreaterThanMaximum($parameterToCheck, $max)
    {

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (end($matchingParameters) > $max) {

                throw new Exception("$parameterToCheck must be less than or equal to $max. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsNotLessThanMinimum($parameterToCheck, $min)
    {

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (trim(end($matchingParameters)) < $min) {

                throw new Exception("$parameterToCheck must be greater than or equal to $min. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsNoLongerThanMaximum($parameterToCheck, $max)
    {

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if(!empty($matchingParameters))
        {

            if(strlen(end($matchingParameters)) > $max)
            {

                throw new Exception("$parameterToCheck must be shorter than $max characters. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsNoShorterThanMinimum($parameterToCheck, $min)
    {

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (strlen(trim(end($matchingParameters))) < $min) {

                throw new Exception("$parameterToCheck must be at least $min character(s). Please correct and try again.");

            }

        }

    }

    public static function ensureParameterCountIsLessThanMaximum($parameterToCheck, $maxCount)
    {

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if(!empty($matchingParameters))
        {

            if(count($matchingParameters) > $maxCount)
            {

                throw new Exception("$parameterToCheck must have less than $maxCount values. Please correct and try again.");

            }

        }

    }

    public static function ensureParameterIsInFormat($parameterToCheck, $format)
    {

        $matchingParameters = static::searchCurlParametersReturnResults($parameterToCheck);

        if(!empty($matchingParameters))
        {

            if(empty(preg_match($format, end($matchingParameters))))
            {

                throw new Exception("$parameterToCheck does not match the format: $format. Please correct and try again.");

            }

        }

    }

}