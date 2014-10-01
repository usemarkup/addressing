<?php

namespace Markup\Addressing\Canonicalizer;

/**
 * An object representing a possible format for a postal code.
 */
class PostalCodeVariant implements PostalCodeVariantInterface
{
    /**
     * @var array
     */
    private $parts;

    /**
     * @var string
     */
    private $delimiter;

    /**
     * @param int[]  $parts
     * @param string $delimiter
     */
    public function __construct(array $parts, $delimiter = '')
    {
        $this->parts = $parts;
        $this->delimiter = $delimiter;
    }

    /**
     * @param string $postalCode
     */
    public function format($postalCode)
    {
        $codeLength = array_sum($this->parts);
        $strippedCode = preg_replace('/[^A-Z0-9]/', '', $postalCode);
        if ($codeLength !== strlen($strippedCode)) {
            return $postalCode;
        }
        $position = 0;
        $codeParts = array();
        foreach ($this->parts as $part) {
            $codeParts[] = substr($strippedCode, $position, intval($part));
            $position += intval($part);
        }

        return implode($this->delimiter, $codeParts);
    }
} 
