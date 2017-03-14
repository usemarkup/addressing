<?php

namespace Markup\Addressing\Handlebars;

abstract class AbstractHelperSet implements HelperSetInterface
{
    use HelperSetAsArrayTrait;
    use PassthroughTrait;

    public function getAddressBlockFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getRecipientFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getStreetLinesFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getStreetLineFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getLocalityFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getRegionFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getPostalCodeFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getCountryFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getBreakFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getSpaceFunction()
    {
        return $this->getPassthroughFunction();
    }

    public function getUppercaseFunction()
    {
        return function ($options) {
            return mb_strtoupper($options['fn'](), 'UTF-8');
        };
    }

    public function getLowercaseFunction()
    {
        return function ($options) {
            return mb_strtolower($options['fn'](), 'UTF-8');
        };
    }
}
