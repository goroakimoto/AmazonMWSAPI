<?php

namespace AmazonMWSAPI\Operations;

use AmazonMWSAPI\{APIMethods, APIParameters, APIParameterValidation, APIProperties};
use AmazonMWSAPI\Helpers\Helpers;

class Operations
{

    use APIMethods;
    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected static $feed;

    public function __construct($parametersToSet = null)
    {

        static::setFeedName();

        static::setParameters($parametersToSet);

        static::verifyParameters();

    }

    protected static function setFeedName()
    {

        static::$feed = Helpers::getCalledClassNameOnly(get_called_class());

    }

}
