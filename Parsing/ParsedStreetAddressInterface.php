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

    /**
     * Gets the street number without any non-numeric addition - i.e. for 23A will return '23'.
     *
     * @return string
     */
    public function getStreetNumberWithoutAddition();

    /**
     * Gets any non-numeric additional part of a street number - i.e. for 23A will return 'A'.
     *
     * @return string
     */
    public function getStreetNumberAddition();
}
