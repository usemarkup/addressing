<?php

namespace Markup\Addressing\Renderer;

use Markup\Addressing\AddressInterface;
use Markup\Addressing\RenderableAddressInterface;

/**
 * An adapter that implements \JsonSerializable providing a means of serializing an object into a hash.
 */
class SerializableAddressAdapter implements RenderableAddressInterface, \JsonSerializable
{
    /**
     * @var AddressInterface
     */
    private $address;

    /**
     * @var callable
     */
    private $countryNameRenderer;

    /**
     * @param AddressInterface $address
     * @param callable         $countryNameRenderer A callable taking ISO3166-2 for country, returning the name.
     */
    public function __construct(AddressInterface $address, callable $countryNameRenderer)
    {
        $this->address = $address;
        $this->countryNameRenderer = $countryNameRenderer;
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
     * Gets the numbered address line, counting from one.  If there is no address line for provided number, return null.
     *
     * @param  int $lineNumber
     * @return string|null
     **/
    public function getStreetAddressLine($lineNumber)
    {
        $lines = $this->getStreetAddressLines();
        if (!isset($lines[$lineNumber-1])) {
            return null;
        }

        return $lines[$lineNumber-1];
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
        return $this->address->getRegion() ?: '';
    }

    /**
     * Gets the postal code for this address.
     * If no postal code is indicated as part of the address information, returns an empty string.
     *
     * @return string
     **/
    public function getPostalCode()
    {
        return $this->address->getPostalCode();
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

    /**
     * Gets any prerendered representation of the address lines (as an indexed array), minus the country, *if* this is persisted as a whole with the address.
     * Otherwise, this method must return null.
     *
     * @return array|null
     **/
    public function getPrerenderedLines()
    {
        return ($this->address instanceof RenderableAddressInterface) ? $this->address->getPrerenderedLines() : null;
    }

    /**
     * Gets whether this address has a prerendered representation, minus the country.
     *
     * @return bool
     **/
    public function hasPrerenderedLines()
    {
        return ($this->address instanceof RenderableAddressInterface) ? $this->address->hasPrerenderedLines() : false;
    }

    public function jsonSerialize(): array
    {
        return [
            'recipient' => $this->getRecipient() ?: '',
            'streetAddressLines' => $this->getStreetAddressLines(),
            'locality' => $this->getLocality(),
            'postalCode' => $this->getPostalCode(),
            'region' => $this->getRegion(),
            'country' => $this->getCountry(),
            'countryName' => call_user_func($this->countryNameRenderer, $this->getCountry()),
        ];
    }
}
