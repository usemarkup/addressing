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
    private $displayCountries;

    /**
     * The locale string provider..
     *
     * @var LocaleProviderInterface
     **/
    private $localeProvider;

    /**
     * @param string $locale
     **/
    public function __construct(LocaleProviderInterface $localeProvider)
    {
        $this->localeProvider = $localeProvider;
        $this->displayCountries = array();
    }

    /**
     * {@inheritdoc}
     **/
    public function getDisplayCountries($locale = null)
    {
        $localeToUse = $locale ?: $this->getLocale();
        if (!$this->hasLoadedCountriesForLocale($localeToUse)) {
            $this->loadCountriesForLocale($localeToUse);
        }

        return $this->displayCountries;
    }

    /**
     * {@inheritdoc}
     **/
    public function getDisplayNameForCountry($country, $locale = null)
    {
        $localeToUse = $locale ?: $this->getLocale();
        if (!$this->hasLoadedCountriesForLocale($localeToUse)) {
            $this->loadCountriesForLocale($localeToUse);
        }
        if (!isset($this->displayCountries[$localeToUse][$country])) {
            return null;
        }

        return $this->displayCountries[$localeToUse][$country];
    }

    /**
     * Gets whether the countries have been loaded into this object for a locale.
     *
     * @param string $locale
     * @return bool
     **/
    private function hasLoadedCountriesForLocale($locale)
    {
        return !empty($this->displayCountries[$locale]);
    }

    /**
     * Loads countries in.
     *
     * @param string $locale
     **/
    private function loadCountriesForLocale($locale)
    {
        //load from Symfony Intl component
        $regionBundle = Intl::getRegionBundle();
        $this->displayCountries[$locale] = $regionBundle->getCountryNames($locale);
    }

    /**
     * @var string
     */
    private function getLocale()
    {
        return $this->localeProvider->getLocale();
    }
}
