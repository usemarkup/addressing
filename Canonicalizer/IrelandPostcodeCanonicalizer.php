<?php


namespace Markup\Addressing\Canonicalizer;


class IrelandPostcodeCanonicalizer implements CanonicalizerInterface
{
    /**
     * {@inheritdoc}
     **/
    public function canonicalize($input)
    {
        $acceptableRegex = '/^([AC-FHKNPRTV-Y]\d{2}|D6W) [0-9AC-FHKNPRTV-Y]{4}/';

        //first, return unmodified any input less than 5 characters long, or anything not a string
        if (!is_string($input) || strlen($input) < 5) {
            return $input;
        }

        //second, remove any spaces, uppercase
        $unspaced = mb_strtoupper(preg_replace('/\s/', '', $input) ?? '', 'UTF-8');
        $spaced = sprintf('%s %s', substr($unspaced, 0, -4), substr($unspaced, -4));


        //now check against the regex, and return unmodified if it doesn't pass
        if (!preg_match($acceptableRegex, $spaced)) {
            return $input;
        }

        //return the modified postcode
        return $spaced;
    }
}
