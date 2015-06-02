<?php

namespace Markup\Addressing\Parsing;

class ParsedStreetAddress implements ParsedStreetAddressInterface
{
    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $streetNumber;

    /**
     * @param string $street
     * @param string $streetNumber
     * @param string $district
     */
    public function __construct($street = null, $streetNumber = null, $district = null)
    {
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->district = $district;
    }

    /**
     * @var string
     */
    private $district;

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
}
