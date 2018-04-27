<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\{APIParameters, APIParameterValidation, APIProperties};
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Parameter\RequiredParameter;
use AmazonMWSAPI\Parameter\AllowedParameter;

class Sections
{

    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected $feed;
    protected $method;
    protected $country;
    protected $countryCode;
    protected $endpoint;
    protected $marketplaceId;
    protected $region;
    protected $curlParameters = [];
    protected $p = [];
    protected $allowedParameters = [];
    protected $parametersRequiredForAllCalls = [
        "AWSAccessKeyId",
        "Action",
        // "MWSAuthToken", //For Developer Access
        "SignatureMethod",
        "SignatureVersion",
        "Timestamp",
        "Version"
    ];

    public function __construct($parametersToSet = null)
    {

        $this->setSectionName();

        $this->setCountry();

        $this->setCountryCode();

        $this->setEndpoint();

        $this->setMarketplaceId();

        $this->setRegion();

        $this->setParameters($parametersToSet);

        $this->verifyParameters();

        $this->initializeParameters($this->getParametersRequiredForAllCalls());

        $this->initializeParameters();

    }

    protected function initializeParameters($parameters = null)
    {

        $parameters = !$parameters ? $this->getParameters() : $parameters;

        foreach ($parameters as $key => $value) {

            if (is_array($value)) {

                $parameter = $key;

                $this->setAllowedParameter($parameter);

            } else {

                $parameter = $value;

                $this->setAllowedParameter($parameter);

            }

        }

    }

    public function getParametersRequiredForAllCalls()
    {

        return $this->parametersRequiredForAllCalls;

    }

    public function getParameters()
    {

        return $this->parameters;

    }

    public function getProperty($property)
    {

        return $this->$property;

    }

    protected function setAllowedParameter($parameter)
    {

        $this->p["allowedParameters"][] = new AllowedParameter($parameter);

    }

    public function getAllowedParameters()
    {

        return $this->p["allowedParameters"];

    }

    protected function setSectionName()
    {

        $this->feed = Helpers::getCalledClassParentNameOnly(get_called_class());

    }
    protected function setCountry()
    {

        $this->country = getenv("AMAZON_COUNTRY");

    }

    public function getCountry()
    {

        return $this->country;

    }

    protected function setCountryCode()
    {

        $this->countryCode = $this->marketplaceTypes[$this->getCountry()]["countryCode"];

    }

    public function getCountryCode()
    {

        return $this->countryCode;

    }

    protected function setEndpoint()
    {

        $this->endpoint = $this->marketplaceTypes[$this->getCountry()]["endpoint"];

    }

    public function getEndpoint()
    {

        return $this->endpoint;

    }

    protected function setMarketplaceId()
    {

        $this->marketplaceId = $this->marketplaceTypes[$this->getCountry()]["marketplaceId"];

    }

    public function getMarketplaceId()
    {

        return $this->marketplaceId;

    }

    protected function setRegion()
    {

        $this->region = $this->marketplaceTypes[$this->getCountry()]["region"];

    }

    public function getRegion()
    {

        return $this->region;

    }

    public function getMethod()
    {

        return $this->method;

    }

    public function getFeed()
    {

        return $this->feed;

    }

    public function getFeedType()
    {

        return $this->feedType;

    }

    public function getFeedContent()
    {

        return $this->feedContent;

    }

    public function getVersionDate()
    {

        return $this->versionDate;

    }

}
