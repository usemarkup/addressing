<?php

namespace Markup\Addressing\Provider;

use Symfony\Component\Intl\Intl;

/**
* A provider object that can provide information about country names for a certain locale string.  This implementation consumes the Symfony Locale component, statically.
*/
class CountryNameProvider implements CountryNameProviderInterface
{
    /**
     * An associative array of display countries keyed by the ISO3166 alpha-2 representations.
     *
     * @var array
     **/
    private $displayCountries = null;

    /**
     * The locale string being used.
     *
     * @var string
     **/
    private $locale;

    /**
     * @param string $locale
     **/
    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    /**
     * {@inheritdoc}
     **/
    public function getDisplayCountries()
    {
        if (!$this->hasLoadedCountries()) {
            $this->loadCountries();
        }

        return $this->displayCountries;
    }

    /**
     * {@inheritdoc}
     **/
    public function getDisplayNameForCountry($country)
    {
        if (!$this->hasLoadedCountries()) {
            $this->loadCountries();
        }
        if (!isset($this->displayCountries[$country])) {
            return null;
        }

        return $this->displayCountries[$country];
    }

    /**
     * Gets whether the countries have been loaded into this object.
     *
     * @return bool
     **/
    private function hasLoadedCountries()
    {
        return null !== $this->displayCountries;
    }

    /**
     * Loads countries in.
     **/
    private function loadCountries()
    {
        //load from Symfony Intl component
        $regionBundle = Intl::getRegionBundle();
        $this->displayCountries = $regionBundle->getCountryNames($this->locale);
    }
}
