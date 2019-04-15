<?php

namespace Markup\Addressing\Provider;

use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Intl;

/**
* A provider object that can provide information about country names for a certain locale string.  This implementation consumes the Symfony Locale component, statically.
*/
class CountryNameProvider implements CountryNameProviderInterface
{
    /**
     * The locale string provider.
     *
     * @var callable
     **/
    private $localeProvider;

    /**
     * An associative array of display countries keyed by the ISO3166 alpha-2 representations.
     *
     * @var array
     **/
    private $displayCountries;

    public function __construct(callable $localeProvider)
    {
        $this->localeProvider = $localeProvider;
        $this->displayCountries = [];
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
            return '';
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
        $this->displayCountries[$locale] = $this->getCountryNamesForLocale($locale);
    }

    /**
     * @var string
     */
    private function getLocale()
    {
        return call_user_func($this->localeProvider);
    }

    private function getCountryNamesForLocale(string $locale): array
    {
        if (!class_exists(Countries::class)) {
            if (!method_exists(Intl::class, 'getRegionBundle')) {
                throw new \LogicException();
            }
            return Intl::getRegionBundle()->getCountryNames($locale);
        }

        return Countries::getNames($locale);
    }
}
