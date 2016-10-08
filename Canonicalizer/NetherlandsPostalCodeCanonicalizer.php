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
        if (!preg_match('/^\d{4}\s?[A-Za-z]{2}$/', $input)) {
            return $input;
        }

        return implode(' ', [substr($input, 0, 4), mb_strtoupper(substr($input, -2, 2))]);
    }
}
