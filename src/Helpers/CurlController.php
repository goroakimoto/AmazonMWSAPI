<?php

namespace AmazonMWSAPI\Helpers;

class CurlController
{

    public static function request($request)
    {

        return CurlController::send($request);

    }

    protected static function send($request)
    {

        $response = curl_exec($request);

        if (curl_errno($request))
        {

            curl_close($request);

            return 'Error: ' . curl_error($request);

        }

        curl_close($request);

        return $response;

    }

}