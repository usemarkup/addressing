<?php

namespace Markup\Addressing\Provider;

/**
 * An interface for an object that can provide localized names for countries given ISO3166 codes.
 **/
interface CountryNameProviderInterface
{
    /**
     * Gets all known display country names, keyed by the ISO3166 alpha-2 representation for that country.
     *
     * @return array
     **/
    public function getDisplayCountries();

    /**
     * Gets the display name for the provided country (ISO3166 alpha-2), localized.  Returns null if display name not known.
     *
     * @param  string $country The ISO3166 alpha-2 representation of a country.
     * @return string
     **/
    public function getDisplayNameForCountry($country);
}
