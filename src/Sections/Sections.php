<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\{APIMethods, APIParameters, APIParameterValidation, APIProperties};
use AmazonMWSAPI\Helpers\Helpers;

class Sections
{

    use APIMethods;
    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected static $feed;

    public function __construct($parametersToSet = null)
    {

        static::setSectionName();

        static::setParameters($parametersToSet);

        static::verifyParameters();

    }

    protected static function setSectionName()
    {

        static::$feed = Helpers::getCalledClassParentNameOnly(get_called_class());

    }

}
