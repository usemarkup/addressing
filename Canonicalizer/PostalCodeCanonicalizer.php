<?php

namespace Markup\Addressing\Canonicalizer;

/**
* A canonicalizer object for provided postal codes that can recognise acceptable forms of postal codes for given countries and return a canonical version.
*/
class PostalCodeCanonicalizer
{
    /**
     * Canonicalizes a provided postal code for a given country if it is possible to do so, otherwise returns the postal code unmodified.
     *
     * @param string $postalCode A postal code string.
     * @param string $country    The ISO3166 alpha-2 representation of a country.
     *
     * @return string
     **/
    public function canonicalizeForCountry($postalCode, $country)
    {
        switch ($country) {
            case 'GB':
            case 'IM':
            case 'JE':
            case 'GG':
            case 'GI':
                $ukCanonicalizer = new UnitedKingdomPostcodeCanonicalizer();

                return $ukCanonicalizer->canonicalize($postalCode);

            case 'SE':
                $seCanonicalizer = new SwedenPostalCodeCanonicalizer();

                return $seCanonicalizer->canonicalize($postalCode);

            case 'FI':
            case 'IT':
            case 'ES':
                $fiveDigitCanonicalizer = new FixedConsecutiveDigitPostalCodeCanonicalizer(5);

                return $fiveDigitCanonicalizer->canonicalize($postalCode);

            case 'PT':
                $variant = new CombinedPostalCodeVariant([new PostalCodeVariant([4]), new PostalCodeVariant([4, 3], '-')]);

                return $variant->format($postalCode);

            case 'NL':
                $nlCanonicalizer = new NetherlandsPostalCodeCanonicalizer();
                return $nlCanonicalizer->canonicalize($postalCode);

            case 'NO':
            case 'DK':
                $fourDigitCanonicalizer = new FixedConsecutiveDigitPostalCodeCanonicalizer(4);

                return $fourDigitCanonicalizer->canonicalize($postalCode);

            case 'CA':
                $caCanonicalizer = new CanadaPostalCodeCanonicalizer();

                return $caCanonicalizer->canonicalize($postalCode);

             case 'IE':
                 $ieCanonicalizer = new IrelandPostcodeCanonicalizer();

                 return $ieCanonicalizer->canonicalize($postalCode);

            default:
                return $postalCode;
        }
    }
}
