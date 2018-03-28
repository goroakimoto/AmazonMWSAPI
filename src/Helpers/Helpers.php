<?php

namespace AmazonMWSAPI\Helpers;

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

}