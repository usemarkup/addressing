<?php

namespace Markup\Addressing\Canonicalizer;

use Markup\Addressing\AddressInterface;

/**
 * A decorator that automatically canonicalizes an address.
 */
class CanonicalizeAddressDecorator implements AddressInterface
{
    /**
     * @var AddressInterface
     */
    private $address;

    /**
     * @param AddressInterface $address The address to decorate.
     */
    public function __construct(AddressInterface $address)
    {
        $this->address = $address;
    }

    /**
     * Gets a name for the recipient at this address. Returns null if one is not specified.
     *
     * @return string|null
     **/
    public function getRecipient()
    {
        return $this->address->getRecipient();
    }

    /**
     * Gets whether the address has a recipient defined.
     *
     * @return bool
     **/
    public function hasRecipient()
    {
        return $this->address->hasRecipient();
    }

    /**
     * Gets the numbered address line, counting from one.  If there is no address line for provided number, return false.
     *
     * @param  int $lineNumber
     * @return string|null
     **/
    public function getStreetAddressLine($lineNumber)
    {
        return $this->address->getStreetAddressLine($lineNumber);
    }

    /**
     * Gets the address lines that are part of the street address - i.e. everything up until the postal town.
     *
     * @return array
     **/
    public function getStreetAddressLines()
    {
        return $this->address->getStreetAddressLines();
    }

    /**
     * Gets the locality for this address. This field is often referred to as a "town" or a "city".
     *
     * @return string
     **/
    public function getLocality()
    {
        return $this->address->getLocality();
    }

    /**
     * Gets the region for this address.  This field is often referred to as a "county", "state" or "province".
     * If no region is indicated as part of the address information, returns an empty string.
     *
     * @return string
     **/
    public function getRegion()
    {
        return $this->address->getRegion();
    }

    /**
     * Gets the postal code for this address.
     * If no postal code is indicated as part of the address information, returns an empty string.
     *
     * @return string
     **/
    public function getPostalCode()
    {
        $canonicalizer = new PostalCodeCanonicalizer();

        return $canonicalizer->canonicalizeForCountry($this->address->getPostalCode(), $this->address->getCountry());
    }

    /**
     * Gets the ISO-3166-2 (alpha-2) representation of the country indicated for this address.
     * i.e. 'GB' for United Kingdom (*not* 'UK'), 'US' for United States.
     *
     * @return string
     **/
    public function getCountry()
    {
        return $this->address->getCountry();
    }
}
