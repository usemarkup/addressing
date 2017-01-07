<?php

namespace Markup\Addressing\Handlebars;

trait HelperSetAsArrayTrait
{
    public function toArray()
    {
        return [
            'addressblock' => $this->getAddressBlockFunction(),
            'recipient' => $this->getRecipientFunction(),
            'streetlines' => $this->getStreetLinesFunction(),
            'streetline' => $this->getStreetLineFunction(),
            'locality' => $this->getLocalityFunction(),
            'region' => $this->getRegionFunction(),
            'postalCode' => $this->getPostalCodeFunction(),
            'country' => $this->getCountryFunction(),
            'break' => $this->getBreakFunction(),
            'space' => $this->getSpaceFunction(),
            'uppercase' => $this->getUppercaseFunction(),
            'lowercase' => $this->getLowercaseFunction(),
        ];
    }
}
