<?php

namespace Markup\Addressing\Parsing;

class ParsedStreetAddress implements ParsedStreetAddressInterface
{
    /**
     * @var ?string
     */
    private $street;

    /**
     * @var ?string
     */
    private $streetNumber;

    /**
     * @var ?string
     */
    private $district;

    /**
     * @var ?string
     */
    private $streetNumberWithoutAddition;

    /**
     * @var ?string
     */
    private $streetNumberAddition;

    /**
     * @param string|null $street
     * @param string|null $streetNumber
     * @param string|null $district
     * @param string|null $streetNumberWithoutAddition
     * @param string|null $streetNumberAddition
     */
    public function __construct(
        $street = null,
        $streetNumber = null,
        $district = null,
        $streetNumberWithoutAddition = null,
        $streetNumberAddition = null
    ) {
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->district = $district;
        $this->streetNumberWithoutAddition = $streetNumberWithoutAddition ?: $streetNumber;
        $this->streetNumberAddition = $streetNumberAddition;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Gets the street number without any non-numeric addition - i.e. for 23A will return '23'.
     *
     * @return string|null
     */
    public function getStreetNumberWithoutAddition()
    {
        return $this->streetNumberWithoutAddition;
    }

    /**
     * Gets any non-numeric additional part of a street number - i.e. for 23A will return 'A'.
     *
     * @return string|null
     */
    public function getStreetNumberAddition()
    {
        return $this->streetNumberAddition;
    }
}
