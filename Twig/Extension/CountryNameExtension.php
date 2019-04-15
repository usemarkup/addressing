<?php

namespace Markup\Addressing\Twig\Extension;

use Markup\Addressing\Provider\CountryNameProviderInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
* A Twig extension that provides a function that can provide the localized country name given an ISO3166 alpha-2.
*/
class CountryNameExtension extends AbstractExtension
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
        return [
            new TwigFunction('country_name', [$this, 'getNameForCountry']),
        ];
    }

    /**
     * Gets the name for the provided country ISO3166 alpha-2 code.
     *
     * @param  string $country
     * @param  string $locale
     * @return string
     **/
    public function getNameForCountry($country, $locale = null)
    {
        return $this->provider->getDisplayNameForCountry($country, $locale);
    }
}
