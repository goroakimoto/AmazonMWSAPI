<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\{APIParameters, APIParameterValidation, APIProperties};
use AmazonMWSAPI\Helpers\Helpers;
use AmazonMWSAPI\Parameter\RequiredParameter;
use AmazonMWSAPI\Parameter\AllowedParameter;
use AmazonMWSAPI\Marketplaces\Marketplaces;

class Sections
{

    use APIParameters;
    use APIProperties;
    use APIParameterValidation;

    protected $signatureMethod = 'HmacSHA256';
    protected $signatureVersion = "2";
    protected $orderNumberFormat = "/^[0-9]{3}\-[0-9]{7}\-[0-9]{7}$/";
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
    protected $marketplaces;
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

        $this->setMarketplaces();

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

    protected function setMarketplaces()
    {

        $this->marketplaces = Marketplaces::$marketplaces;

    }

    protected function setSectionName()
    {

        $this->feed = Helpers::getCalledClassParentNameOnly(get_called_class());

    }
    protected function setCountry()
    {

        $this->country = getenv("AMAZON_COUNTRY");

    }

    protected function setCountryCode()
    {

        $this->countryCode = $this->marketplaces[$this->getCountry()]["countryCode"];

    }

    protected function setEndpoint()
    {

        $this->endpoint = $this->marketplaces[$this->getCountry()]["endpoint"];

    }

    protected function setMarketplaceId()
    {

        $this->marketplaceId = $this->marketplaces[$this->getCountry()]["marketplaceId"];

    }

    protected function setRegion()
    {

        $this->region = $this->marketplaces[$this->getCountry()]["region"];

    }

    protected function setAllowedParameter($parameter)
    {

        $this->p["allowedParameters"][] = new AllowedParameter($parameter);

    }

    public function getCountry()
    {

        return $this->country;

    }

    public function getCountryCode()
    {

        return $this->countryCode;

    }

    public function getEndpoint()
    {

        return $this->endpoint;

    }

    public function getMarketplaceId()
    {

        return $this->marketplaceId;

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

    public function getProperty($property)
    {

        return $this->$property;

    }

    public function getParameters()
    {

        return $this->parameters;

    }

    public function getAllowedParameters()
    {

        return $this->p["allowedParameters"];

    }

    public function getParametersRequiredForAllCalls()
    {

        return $this->parametersRequiredForAllCalls;

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

}
