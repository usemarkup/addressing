<?php

namespace Markup\Addressing\Parsing;

/**
 * An interface for an object representing parsed parts of street address lines.
 */
interface ParsedStreetAddressInterface
{
    public function getStreetNumber();

    public function getStreet();

    public function getDistrict();
}
