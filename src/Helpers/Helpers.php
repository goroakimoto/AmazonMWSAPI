<?php

namespace AmazonMWSAPI\Helpers;

use AmazonMWSAPI\AmazonClient;


class Helpers
{

    public static function dd($data)
    {

        echo '<br><pre>';

        print_r($data);

        echo '</pre><br>';

     }

    public static function ddXml($data)
    {

        echo "<br><pre>";

        echo htmlentities($data);

        echo "</pre>";

    }

    public static function removeUrlProtocol($url)
    {

        return implode(array_slice(explode("/", preg_replace("/https?:\/\//", "", $url)), 0, 1));

    }

    public static function getCalledClassNameOnly($calledClass)
    {

        $fullClassName = explode("\\", $calledClass);

        return end($fullClassName);

    }

    public static function getAPIProperty($class, $property)
    {

        return $class::${$property};

    }

    public static function arrayToString($array)
    {

        $newString = "";

        foreach ($array as $value)
        {

            $newString .= $value === end($array) ? "$value. " : "$value, ";

        }

        return $newString;

    }

    public static function startClock($print = true)
    {

        $startTime = microtime(true);

        echo $print ? "Start Time: " . date("Y/m/d H:i:s") . "<br>" : "";

        return $startTime;

    }

    public static function endClock($startTime, $print = true)
    {

        $endTime = microtime(true);

        $executionTime = ($endTime - $startTime) / 60;

        echo $print ? "End Time:" . date("Y-m-d H:i:s") . "<br>Execution time: $executionTime mins.<br>" : "";

        return $executionTime;

    }

    protected static function performance($objectToNewUp, $parameters, $iterations)
    {

        $totalTime = 0;

        for ($x = 0; $x < $iterations; $x++)
        {

            $startIteration = static::startClock(false);

            new $objectToNewUp($parameters);

            $endIteration = static::endClock($startIteration, false);

            $totalTime += $endIteration;

        }

        static::dd("Average is: " . $totalTime / $iterations);

    }

    public static function printTest($print, $object)
    {

        return $print ? static::dd($object) : $object;

    }

    public static function test($objectToNewUp, $parameters, $print = false, $testPerformance = false, $iterations = 1)
    {

        return $testPerformance ?

            static::printTest($print, static::performance($objectToNewUp, $parameters, $iterations))

            :

            static::printTest($print, new $objectToNewUp($parameters));

    }

    public static function testAPI($objectToNewUp, $parameters, $print = false, $testPerformance = false, $iterations = 1)
    {

        return $testPerformance ?

            static::printTest($print, AmazonClient::amazonCurl(static::performance($objectToNewUp, $parameters, $iterations)))

            :

            static::printTest($print, AmazonClient::amazonCurl(new $objectToNewUp($parameters)));

    }

}