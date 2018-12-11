<?php

namespace Markup\Addressing\Canonicalizer;


class FixedConsecutiveDigitPostalCodeCanonicalizer implements CanonicalizerInterface
{
    /**
     * @var int
     */
    private $digitLength;

    /**
     * @param int $digitLength
     */
    public function __construct($digitLength)
    {
        $this->digitLength = intval($digitLength);
    }

    /**
     * @param string $input
     *
     * @return mixed
     **/
    public function canonicalize($input)
    {
        $filtered = preg_replace('/\D+/', '', $input) ?? '';
        if (strlen($filtered) !== $this->digitLength) {
            return $input;
        }

        return $filtered;
    }
}
