<?php

namespace Markup\Addressing\Provider;

use Markup\Addressing\Templating\TemplateInterface;

/**
 * An interface for an object that, given a country identifier (ISO3166 alpha-2),
 * can provide an appropriate template to use for rendering an address of that country.
 **/
interface IntlAddressTemplateProviderInterface
{
    /**
     * Gets a template that pertains to the provided country.
     *
     * @param  string            $country The ISO3166 alpha-2 value for a country.
     * @param  string            $format  The address format being used.
     * @param  array             $options
     * @return TemplateInterface
     **/
    public function getTemplateForCountry($country, $format, array $options = []);
}
