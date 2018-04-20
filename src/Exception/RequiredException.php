<?php

namespace AmazonMWSAPI\Exception;

use Exception;

class RequiredException extends Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {

        parent::__construct($message, $code, $previous);

    }

    public function errorMessage()
    {

        return "{$this->message} must be set to complete this request. Please correct and try again.";

    }

}