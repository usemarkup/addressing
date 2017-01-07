<?php

namespace Markup\Addressing\Handlebars;

/**
 * A Handlebars helper set that provides address nodes in HTML that adhere to both schema.org and microformat specs for addresses.
 */
class SchemaDotOrgAdrHtmlHelperSet extends AbstractHelperSet
{
    public function getAddressBlockFunction()
    {
        return function ($options) {
            if (!isset($options['fn']) || !is_callable($options['fn'])) {
                return $options['data']['root'][$options['name']];
            }

            return new \LightnCandy\SafeString(implode('', [
                '<p class="adr" itemscope itemtype="http://schema.org/PostalAddress">',
                $options['fn'](),
                '</p>'
            ]));
        };
    }

    public function getRecipientFunction()
    {
        return function ($options) {
            if (!isset($options['fn']) || !is_callable($options['fn'])) {
                return $options['data']['root'][$options['name']];
            }

            return new \LightnCandy\SafeString(implode('', [
                '<span itemprop="name" itemscope itemtype="http://schema.org/Person" class="recipient">',
                $options['fn'](),
                '</span>'
            ]));
        };
    }

    public function getStreetLinesFunction()
    {
        return function ($options) {
            if (!isset($options['fn']) || !is_callable($options['fn'])) {
                return $options['data']['root'][$options['name']];
            }

            return new \LightnCandy\SafeString(implode('', [
                '<span class="street-address" itemprop="streetAddress">',
                $options['fn'](),
                '</span>'
            ]));
        };
    }

    public function getLocalityFunction()
    {
        return function ($options) {
            if (!isset($options['fn']) || !is_callable($options['fn'])) {
                return $options['data']['root'][$options['name']];
            }

            return new \LightnCandy\SafeString(implode('', [
                '<span class="locality" itemprop="addressLocality">',
                $options['fn'](),
                '</span>'
            ]));
        };
    }

    public function getRegionFunction()
    {
        return function ($options) {
            if (!isset($options['fn']) || !is_callable($options['fn'])) {
                return $options['data']['root'][$options['name']];
            }

            return new \LightnCandy\SafeString(implode('', [
                '<span class="region" itemprop="addressRegion">',
                $options['fn'](),
                '</span>'
            ]));
        };
    }

    public function getPostalCodeFunction()
    {
        return function ($options) {
            if (!isset($options['fn']) || !is_callable($options['fn'])) {
                return $options['data']['root'][$options['name']];
            }

            return new \LightnCandy\SafeString(implode('', [
                '<span class="postal-code" itemprop="postalCode">',
                $options['fn'](),
                '</span>'
            ]));
        };
    }

    public function getCountryFunction()
    {
        return function ($options) {
            if (!isset($options['fn']) || !is_callable($options['fn'])) {
                return $options['data']['root'][$options['name']];
            }

            return new \LightnCandy\SafeString(implode('', [
                '<span class="country-name" itemprop="addressCountry" itemscope itemtype="http://schema.org/Country">',
                $options['fn'](),
                '</span>'
            ]));
        };
    }

    public function getBreakFunction()
    {
        return function ($options) {
            return new \LightnCandy\SafeString("<br>");
        };
    }

    public function getSpaceFunction()
    {
        return function () {
            return '&nbsp;';
        };
    }
}
