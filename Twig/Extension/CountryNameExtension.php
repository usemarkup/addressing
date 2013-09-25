<?php

namespace Markup\Addressing\Twig\Extension;

use Markup\Addressing\Provider\CountryNameProviderInterface;

/**
* A Twig extension that provides a function that can provide the localized country name given an ISO3166 alpha-2.
*/
class CountryNameExtension extends \Twig_Extension
{
    /**
     * A country name provider object.
     *
     * @var CountryNameProviderInterface
     **/
    private $provider;

    /**
     * @param CountryNameProviderInterface $provider A provider of country names.
     **/
    public function __construct(CountryNameProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('country_name', array($this, 'getNameForCountry')),
            );
    }

    /**
     * Gets the name for the provided country ISO3166 alpha-2 code.
     *
     * @param  string $country
     * @return string
     **/
    public function getNameForCountry($country)
    {
        return $this->provider->getDisplayNameForCountry($country);
    }

    public function getName()
    {
        return 'markup_addressing.country_name';
    }
}
