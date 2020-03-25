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
    public function getDisplayCountries(?string $locale = null): array
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
    public function getDisplayNameForCountry(string $country, ?string $locale = null): string
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
     **/
    private function hasLoadedCountriesForLocale(string $locale): bool
    {
        return !empty($this->displayCountries[$locale]);
    }

    /**
     * Loads countries in.
     **/
    private function loadCountriesForLocale(string $locale): void
    {
        $this->displayCountries[$locale] = $this->getCountryNamesForLocale($locale);
    }

    private function getLocale(): string
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
