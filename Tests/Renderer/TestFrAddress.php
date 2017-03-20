<?php

namespace Markup\Addressing\Tests\Renderer;

use Markup\Addressing\NotPrerenderedTrait;
use Markup\Addressing\RenderableAddressInterface;

class TestFrAddress implements RenderableAddressInterface
{
    use GetStreetAddressLineTrait;
    use NotPrerenderedTrait;

    /**
     * Gets a name for the recipient at this address. Returns null if one is not specified.
     *
     * @return string|null
     **/
    public function getRecipient()
    {
        return 'M Dommage';
    }

    /**
     * Gets whether the address has a recipient defined.
     *
     * @return bool
     **/
    public function hasRecipient()
    {
        return true;
    }

    /**
     * Gets the address lines that are part of the street address - i.e. everything up until the postal town.
     *
     * @return array
     **/
    public function getStreetAddressLines()
    {
        return [
            'Rue de la Rue 24',
        ];
    }

    /**
     * Gets the locality for this address. This field is often referred to as a "town" or a "city".
     *
     * @return string
     **/
    public function getLocality()
    {
        return 'Paris';
    }

    /**
     * Gets the region for this address.  This field is often referred to as a "county", "state" or "province".
     * If no region is indicated as part of the address information, returns an empty string.
     *
     * @return string
     **/
    public function getRegion()
    {
        return '';
    }

    /**
     * Gets the postal code for this address.
     * If no postal code is indicated as part of the address information, returns an empty string.
     *
     * @return string
     **/
    public function getPostalCode()
    {
        return '75006';
    }

    /**
     * Gets the ISO-3166-2 (alpha-2) representation of the country indicated for this address.
     * i.e. 'GB' for United Kingdom (*not* 'UK'), 'US' for United States.
     *
     * @return string
     **/
    public function getCountry()
    {
        return 'FR';
    }
}
