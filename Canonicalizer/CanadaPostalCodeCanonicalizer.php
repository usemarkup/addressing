<?php

namespace Markup\Addressing\Canonicalizer;

/**
 * A canonicalizer for Canadian postal codes.
 */
class CanadaPostalCodeCanonicalizer implements CanonicalizerInterface
{
    const CODE_REGEX = '/^[A-Z][0-9][A-Z] [0-9][A-Z][0-9]$/';

    /**
     * @param mixed $input
     *
     * @return mixed
     **/
    public function canonicalize($input)
    {
        //first, return unmodified any input less than 5 characters long, or anything not a string
        if (!is_string($input) or strlen($input) < 5) {
            return $input;
        }

        //second, remove any spaces, uppercase, and break off the last three characters of the string
        $unspaced = mb_strtoupper(preg_replace('/\s/', '', $input) ?? '', 'UTF-8');
        $spaced = sprintf('%s %s', substr($unspaced, 0, -3), substr($unspaced, -3));

        //now check against the regex
        if (!preg_match(self::CODE_REGEX, $spaced)) {
            return $input;
        }

        return $spaced;
    }
}
