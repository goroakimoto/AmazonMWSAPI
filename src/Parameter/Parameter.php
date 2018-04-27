<?php

namespace AmazonMWSAPI\Parameter;

class Parameter
{

    protected $parameter;

    public function __construct($parameter)
    {

        $this->setParameter($parameter);

    }

    protected function setParameter($parameter)
    {

        $this->parameter = $parameter;

    }

    protected function getParameter()
    {

        return $this->parameter;

    }

}