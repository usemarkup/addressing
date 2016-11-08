<?php

namespace Markup\Addressing\Canonicalizer;

class NetherlandsPostalCodeCanonicalizer implements CanonicalizerInterface
{
    /**
     * @param mixed $input
     *
     * @return mixed
     **/
    public function canonicalize($input)
    {
        $strippedInput = str_replace(' ', '', $input);
        if (!preg_match('/^\d{4}[A-Za-z]{2}$/', $strippedInput)) {
            return $input;
        }

        return implode(' ', [substr($strippedInput, 0, 4), mb_strtoupper(substr($strippedInput, -2, 2))]);
    }
}
