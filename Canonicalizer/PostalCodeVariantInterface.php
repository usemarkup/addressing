<?php

namespace Markup\Addressing\Canonicalizer;

interface PostalCodeVariantInterface
{
    public function format(string $code): string;
} 
