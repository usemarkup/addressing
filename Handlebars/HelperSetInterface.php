<?php

namespace Markup\Addressing\Handlebars;

interface HelperSetInterface
{
    /**
     * @return callable
     */
    public function getAddressBlockFunction();

    /**
     * @return callable
     */
    public function getRecipientFunction();

    /**
     * @return callable
     */
    public function getStreetLinesFunction();

    /**
     * @return callable
     */
    public function getStreetLineFunction();

    /**
     * @return callable
     */
    public function getLocalityFunction();

    /**
     * @return callable
     */
    public function getRegionFunction();

    /**
     * @return callable
     */
    public function getPostalCodeFunction();

    /**
     * @return callable
     */
    public function getCountryFunction();

    /**
     * @return callable
     */
    public function getBreakFunction();

    /**
     * @return callable
     */
    public function getSpaceFunction();

    /**
     * @return callable
     */
    public function getUppercaseFunction();

    /**
     * @return callable
     */
    public function getLowercaseFunction();

    /**
     * @return array
     */
    public function toArray();
}
