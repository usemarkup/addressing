<?php

namespace Markup\Addressing;

/**
 * An interface for an address that can be rendered.
 **/
interface RenderableAddressInterface extends AddressInterface
{
    /**
     * Gets any prerendered representation of the address lines (as an indexed array), minus the country, *if* this is persisted as a whole with the address.
     * Otherwise, this method must return null.
     *
     * @return array|null
     **/
    public function getPrerenderedLines();

    /**
     * Gets whether this address has a prerendered representation, minus the country.
     *
     * @return bool
     **/
    public function hasPrerenderedLines();
}
