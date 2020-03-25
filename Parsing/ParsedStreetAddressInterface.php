<?php

namespace Markup\Addressing\Parsing;

/**
 * An interface for an object representing parsed parts of street address lines.
 */
interface ParsedStreetAddressInterface
{
    public function getStreetNumber(): ?string;

    public function getStreet(): ?string;

    public function getDistrict(): ?string;

    /**
     * Gets the street number without any non-numeric addition - i.e. for 23A will return '23'.
     */
    public function getStreetNumberWithoutAddition(): ?string;

    /**
     * Gets any non-numeric additional part of a street number - i.e. for 23A will return 'A'.
     */
    public function getStreetNumberAddition(): ?string;
}
