<?php

namespace Markup\Addressing\Canonicalizer;

interface PostalCodeVariantInterface
{
    /**
     * @param string $code
     * @return string
     */
    public function format($code);
} 
