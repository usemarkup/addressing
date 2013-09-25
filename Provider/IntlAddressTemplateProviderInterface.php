<?php

namespace Markup\Addressing\Provider;

/**
 * An interface for an object that, given a country identifier (ISO3166 alpha-2), can provide an appropriate Twig template to use for rendering an address of that country.
 **/
interface IntlAddressTemplateProviderInterface
{
    /**
     * Gets a Twig template that pertains to the provided country.
     *
     * @param  string            $country The ISO3166 alpha-2 value for a country.
     * @param  \Twig_Environment $twig    A Twig environment.
     * @param  string            $format  The address format being used.
     * @param  array             $options
     * @return \Twig_Template
     **/
    public function getTemplateForCountry($country, \Twig_Environment $twig, $format, array $options = array());
}
