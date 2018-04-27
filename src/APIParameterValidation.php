<?php

namespace AmazonMWSAPI;

use AmazonMWSAPI\Exception\RequiredException;
use \DateTime;
use \DateInterval;
use \DateTimeZone;
use AmazonMWSAPI\Helpers\Helpers;

trait APIParameterValidation
{

    public function parametersToMatch($parameterToCheck, $backupCheck)
    {

        return $backupCheck ?

            $this->searchBackupParameters($parameterToCheck) :

            $this->searchParameters($parameterToCheck);

    }

    public function requireParameterToBeSet($parameterToCheck, $backupCheck = false)
    {

        $matchingParameters = $this->parametersToMatch($parameterToCheck, $backupCheck);

        if(empty($matchingParameters)) throw new RequiredException($parameterToCheck);

    }

    public function ensureIntervalBetweenDates($dateToEnsureInterval, $baseDate = "Timestamp", $direction = "earlier", $interval = "PT2M")
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($dateToEnsureInterval);

        if (!empty($matchingParameters))
        {

            $baseDateResults = $this->searchBackupParametersReturnResults($baseDate);

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

    public function ensureDatesNotOutsideInterval($earlierDate, $laterDate, $intervalInDays)
    {

        $matchingEarlierDateParameters = $this->searchBackupParametersReturnResults($earlierDate);

        $matchingLaterDateParameters = $this->searchBackupParametersReturnResults($laterDate);

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

    public function ensureDateTimesAreInProperFormat($parameterToCheck)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (!preg_match("/^\d{4}-\d{2}-\d{2}T[0-2][0-9]:[0-5][0-9]:[0-5][0-9]Z$/", end($matchingParameters)))
            {

                throw new Exception("Dates must be in this format: YYYY-MM-DDTHH:II:SSZ. Please correct and try again.");

            }

        }

    }

    public function ensureDatesAreInProperFormat($parameterToCheck)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (!preg_match("/^\d{4}-\d{2}-\d{2}Z$/", end($matchingParameters)))
            {

                throw new Exception("Dates must be in this format: YYYY-MM-DDZ. Please correct and try again.");

            }

        }

    }

    public function ensureAllParametersAreSet($dependentParameters)
    {

        $dependentParametersCopy = $dependentParameters;

        foreach ($dependentParameters as $parameter)
        {

            if (!in_array($parameter, $this->getCurlParameters()))
            {

                $dependentParameter = "The following must all be set: ";

                $dependentParameter .= Helpers::arrayToString($dependentParametersCopy);

                $dependentParameter .= "Please correct and try again.";

                throw new Exception($dependentParameter);

            }

        }

    }

    public function ensureOneParameterOrTheOtherIsSet($firstParameter, $secondParameter)
    {

        $matchingFirstParameters = $this->searchBackupParametersReturnResults($firstParameter);

        $matchingSecondParameters = $this->searchBackupParametersReturnResults($secondParameter);

        if (
            (empty($matchingFirstParameters) && empty($matchingSecondParameters)) ||
            (!empty($matchingFirstParameters) && !empty($matchingSecondParameters))
        ){

            throw new Exception("$firstParameter OR $secondParameter (not both) must be set. Please correct and try again.");

        }

    }

    public function ensureOnlyOneParameterIsSet($firstParameter, $otherParameters)
    {

        $matchingFirstParameter = $this->searchBackupParametersReturnResults($firstParameter);

        if (!empty($matchingFirstParameter))
        {

            foreach ($otherParameters as $conditionallyRequiredParameter)
            {

                $matchingOtherParameter = $this->searchBackupParametersReturnResults($conditionallyRequiredParameter);

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

    public function ensureIncompatibleParametersNotSet($parameterToCheck, $restrictedParameters)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (is_array($restrictedParameters))
            {

                foreach ($restrictedParameters as $restricted)
                {

                    if (!empty($this->searchBackupParametersReturnResults($restricted)))
                    {

                        throw new Exception("$restricted cannot be set at the same time as $parameterToCheck. Please correct and try again.");

                    }

                }

            } else {

                if (!empty($this->searchBackupParametersReturnResults($restrictedParameters)))
                {

                    throw new Exception("$restrictedParameters cannot be set at the same time as $parameterToCheck. Please correct and try again.");

                }

            }

        }

    }

    public function ensureParameterValuesAreValidWith($parameterToCheck, $validParameterValues = null)
    {

        $matchingParameter = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameter))
        {

            if (!array_key_exists($parameterToCheck, $matchingParameter))
            {
                $parameters = $this->getParameters();

                $ifOperationIsParameters = $this->searchBackupParametersReturnResults("ifOperationIs", $parameters);

                if ($this->getNestedParameterKey($parameterToCheck, $ifOperationIsParameters))
                {

                    $validKey = $this->getNestedParameterKey($parameterToCheck, $ifOperationIsParameters);

                    $value = end($matchingParameter);

                    if (key($this->getNestedParameterKey("validWith", $ifOperationIsParameters)) === $value)
                    {

                        $validOperation = $this->getNestedParameterValue("ifOperationIs", $ifOperationIsParameters);

                        if (Helpers::getCalledClassNameOnly(get_called_class()) !== $validOperation)
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

                    $this->ensureAllParametersAreSet($dependentParameters);

                }

            }

        }

    }

    public function ensureParameterValuesAreValidif($parameterToCheck, $validParameterValues = null)
    {

        $matchingParameter = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameter))
        {

            $setParameter = end($matchingParameter);

            if (array_key_exists("region", $validParameterValues))
            {

                $this->ensureRegionValue($setParameter, $validParameterValues);

            } elseif (array_key_exists("country", $validParameterValues)) {

                $this->ensureCountryValues($setParameter, $validParameterValues);

            } elseif (array_key_exists("RecommendationCategory", $validParameterValues)) {

                $parameter = "RecommendationCategory";

                $recommendationCategories = $this->searchBackupParametersReturnResults($parameter);

                $this->ensureParameterAtASpecificLevel($parameter, $recommendationCategories, $parameterToCheck, $matchingParameter, $validParameterValues);

            }

        }

    }

    protected function ensureRegionValue($setParameter, $validParameterValues)
    {

        $sellerRegion = $this->getRegion();

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

    protected function ensureCountryValues($setParameter, $validParameterValues)
    {

        $sellerCountry = $this->getCountry();

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

    protected function ensureParameterAtASpecificLevel($parameterToCheck, $arrayToCheck, $subParameter, $matchingParameter, $validParameterValues = null)
    {

        return array_filter(

            $arrayToCheck,

            function($v, $k) use ($parameterToCheck, $subParameter, $matchingParameter, $validParameterValues)
            {

                $level = $this->getLevel($parameterToCheck);

                if ($level)
                {

                    $levelArray = $this->levelArray($matchingParameter, $level, $subParameter);

                    $this->ensureLevelArrayValues($levelArray, $parameterToCheck, $v, $validParameterValues);

                }

            }, ARRAY_FILTER_USE_BOTH

        );

    }

    protected function levelArray($matchingParameter, $level, $subParameter)
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

    protected function ensureLevelArrayValues($levelArray, $parameterToCheck, $value, $validParameterValues)
    {

        return array_filter(

            $levelArray,

            function ($v, $k) use ($parameterToCheck, $value, $validParameterValues)
            {

                $this->ensureParameterValuesAreValidWith($k, $validParameterValues[$parameterToCheck][$value]);

            },

            ARRAY_FILTER_USE_BOTH

        );

    }

    public function ensureSetParametersAreAllowed($parameters = null)
    {

        if (!$parameters)
        {

            $parameters = $this->getCurlParameters();

        }

        foreach ($parameters as $parameterToCheck => $value)
        {

            $inArray = $this->searchBackupParameters($parameterToCheck, $this->getAllowedParameters());

            if (!$inArray)
            {

                throw new Exception("The $parameterToCheck parameter is not allowed. Please correct and try again.");

            }

        }

    }

    public function ensureRequiredParametersAreSet($requiredParameters = null, $parentKey = null)
    {

        if (!$requiredParameters)
        {

            $requiredParameters = $this->getRequiredParameters();
            // Helpers::dd($requiredParameters);

        }

        foreach ($requiredParameters as $key => $parameter)
        {

            if (is_array($parameter))
            {

                $this->ensureRequiredParametersAreSet($parameter, $key);

            } else {

                if ($parentKey)
                {

                    try {

                        $this->requireParameterToBeSet($parentKey, true);

                    } catch (RequiredException $e) {

                        Helpers::dd($e->errorMessage());
                    }

                } else {

                    try {

                        $this->requireParameterToBeSet($key);

                    } catch (RequiredException $e) {

                        Helpers::dd($e->errorMessage());

                    }

                }

            }

        }

    }

    public function ensureRequiredIfParametersAreSet($parameterToCheck, $requiredIf)
    {

        $requiredIfKey = key($requiredIf);

        $requiredIfParameters = $this->searchBackupParametersReturnResults($requiredIfKey);

        $requiredIfParameterValue = end($requiredIfParameters);

        $requiredIfValue = end($requiredIf);

        if ($requiredIfKey === "notIn")
        {

            $sellerCountry = $this->getCountry();

            if ($sellerCountry !== $requiredIfValue)
            {

                $this->requireParameterToBeSet($parameterToCheck);

            }

        } elseif ($requiredIfKey === "destinationCountryIsNot") {

            $sellerCountry = $this->getCountry();

            $destinationAddress = $this->searchBackupParametersReturnResults("DestinationAddress");

            $destinationAddressCountry = $this->searchBackupParametersReturnResults("Country", $destinationAddress);

            if ($sellerCountry !== end($destinationAddressCountry))
            {

                $this->requireParameterToBeSet($parameterToCheck);

            }

        } else {

            if ($requiredIfParameterValue === $requiredIfValue)
            {

                $this->requireParameterToBeSet($parameterToCheck);

            }

        }

    }

    public function ensureParameterIsInRange($parameterToCheck, $min, $max)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

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

    public function ensureParameterIsNotGreaterThanMaximum($parameterToCheck, $max)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (end($matchingParameters) > $max) {

                throw new Exception("$parameterToCheck must be less than or equal to $max. Please correct and try again.");

            }

        }

    }

    public function ensureParameterIsNotLessThanMinimum($parameterToCheck, $min)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (trim(end($matchingParameters)) < $min) {

                throw new Exception("$parameterToCheck must be greater than or equal to $min. Please correct and try again.");

            }

        }

    }

    public function ensureParameterIsNoLongerThanMaximum($parameterToCheck, $max)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (strlen(end($matchingParameters)) > $max)
            {

                throw new Exception("$parameterToCheck must be shorter than $max characters. Please correct and try again.");

            }

        }

    }

    public function ensureParameterIsNoShorterThanMinimum($parameterToCheck, $min)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters)) {

            if (strlen(trim(end($matchingParameters))) < $min) {

                throw new Exception("$parameterToCheck must be at least $min character(s). Please correct and try again.");

            }

        }

    }

    public function ensureParameterCountIsLessThanMaximum($parameterToCheck, $maxCount)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (count($matchingParameters) > $maxCount)
            {

                throw new Exception("$parameterToCheck must have less than $maxCount values. Please correct and try again.");

            }

        }

    }

    public function ensureParameterIsInFormat($parameterToCheck, $format)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (empty(preg_match($format, end($matchingParameters))))
            {

                throw new Exception("$parameterToCheck does not match the format: $format. Please correct and try again.");

            }

        }

    }

    public function ensureParameterIsAnEvenDivisorOf($divisor, $divisorOf)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($divisor);

        if (!empty($matchingParameters))
        {

            foreach ($matchingParameters as $parameter => $value)
            {

                $siblings = $this->getSiblingParameters($parameter);

                $divisorOfParameters = $this->searchBackupParametersReturnResults($divisorOf, $siblings);

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

    public function ensureParameterIsGreaterThan($parameterToCheck, $greaterThan)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

        if (!empty($matchingParameters))
        {

            if (end($matchingParameters) <= $greaterThan)
            {

                throw new Exception("$parameterToCheck must be greater than $greaterThan. Please correct and try again.");

            }

        }

    }

    public function ensureParameterIsThisLength($parameterToCheck, $length)
    {

        $matchingParameters = $this->searchBackupParametersReturnResults($parameterToCheck);

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