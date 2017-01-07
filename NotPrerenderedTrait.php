<?php

namespace Markup\Addressing;

/**
 * Trait for easy implementation of "renderable" address methods when address is not prerendered.
 */
trait NotPrerenderedTrait
{
    /**
     * Gets any prerendered representation of the address lines (as an indexed array), minus the country, *if* this is persisted as a whole with the address.
     * Otherwise, this method must return null.
     *
     * @return array|null
     **/
    public function getPrerenderedLines()
    {
        return null;
    }

    /**
     * Gets whether this address has a prerendered representation, minus the country.
     *
     * @return bool
     **/
    public function hasPrerenderedLines()
    {
        return false;
    }
}
