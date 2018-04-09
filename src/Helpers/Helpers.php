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

    public static function getCalledClass($calledClass)
    {

        $fullClassName = explode("\\", $calledClass);

        return end($fullClassName);

    }

    public static function arrayToString($array)
    {

        $newString = "";

        foreach ($array as $value) {

            if ($value === end($array)) {

                $newString .= "$value. ";

            } else {

                $newString .= "$value, ";

            }

        }

        return $newString;

    }

    public static function startClock($print = true)
    {

        $startTime = microtime(true);

        if ($print) {

            echo "Start Time: " . date("Y/m/d H:i:s") . "<br>";

        }

        return $startTime;

    }

    public static function endClock($startTime, $print = true)
    {

        $endTime = microtime(true);

        $executionTime = ($endTime - $startTime) / 60;

        if ($print) {

            echo "Execution time: $executionTime mins";

            echo "End Time: " . date('Y-m-d H:i:s') . "<br>";

        }

        return $executionTime;

    }

    protected static function newUpObject($objectToNewUp, $parameters)
    {

        return new $objectToNewUp($parameters);

    }

    protected static function performance($objectToNewUp, $parameters, $iterations)
    {

        $totalTime = 0;

        for ($x = 0; $x < $iterations; $x++) {
            $startIteration = startClock(false);

            static::newUpObject($objectToNewUp, $parameters);

            $endIteration = endClock($startIteration, false);

            $totalTime += $endIteration;

        }

        static::dd("Average is: " . $totalTime / $iterations);

    }

    public static function test($objectToNewUp, $parameters, $testPerformance = false, $iterations = 1)
    {

        if($testPerformance)
        {

            static::dd(

                static::performance($objectToNewUp, $parameters, $iterations)

            );

        } else {

            static::dd(

                static::newUpObject($objectToNewUp, $parameters)

            );

        }


    }

    public static function testAPI($objectToNewUp, $parameters, $testPerformance = false, $iterations = 1)
    {

        if($testPerformance)
        {

            static::ddXml(

                AmazonClient::amazonCurl(

                    static::performance($objectToNewUp, $parameters, $iterations)

                )

            );

        } else {

            static::ddXml(

                AmazonClient::amazonCurl(

                    static::newUpObject($objectToNewUp, $parameters)

                )

            );

        }

    }

}