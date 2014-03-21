<?php

namespace Markup\Addressing;

/**
 * A simple address implementation.
 */
class Address implements AddressInterface
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var array
     */
    private $streetLines;

    /**
     * @var string
     */
    private $locality;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $recipient;

    /**
     * @param string $country
     * @param array  $streetLines
     * @param string $locality
     * @param string $postalCode
     * @param string $region
     * @param string $recipient
     */
    public function __construct($country, array $streetLines, $locality, $postalCode = null, $region = null, $recipient = null)
    {
        $this->country = $country;
        $this->streetLines = $streetLines;
        $this->locality = $locality;
        $this->postalCode = $postalCode;
        $this->region = $region;
        $this->recipient = $recipient;
    }

    /**
     * Gets a name for the recipient at this address. Returns null if one is not specified.
     *
     * @return string|null
     **/
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Gets whether the address has a recipient defined.
     *
     * @return bool
     **/
    public function hasRecipient()
    {
        return (bool) $this->recipient;
    }

    /**
     * Gets the numbered address line, counting from one.  If there is no address line for provided number, return null.
     *
     * @param  int $lineNumber
     * @return string|null
     **/
    public function getStreetAddressLine($lineNumber)
    {
        if (!isset($this->streetLines[$lineNumber-1])) {
            return null;
        }

        return $this->streetLines[$lineNumber-1];
    }

    /**
     * Gets the address lines that are part of the street address - i.e. everything up until the postal town.
     *
     * @return array
     **/
    public function getStreetAddressLines()
    {
        return $this->streetLines;
    }

    /**
     * Gets the locality for this address. This field is often referred to as a "town" or a "city".
     *
     * @return string
     **/
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Gets the region for this address.  This field is often referred to as a "county", "state" or "province".
     * If no region is indicated as part of the address information, returns an empty string.
     *
     * @return string
     **/
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Gets the postal code for this address.
     * If no postal code is indicated as part of the address information, returns an empty string.
     *
     * @return string
     **/
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Gets the ISO-3166-2 (alpha-2) representation of the country indicated for this address.
     * i.e. 'GB' for United Kingdom (*not* 'UK'), 'US' for United States.
     *
     * @return string
     **/
    public function getCountry()
    {
        return $this->country;
    }
}
