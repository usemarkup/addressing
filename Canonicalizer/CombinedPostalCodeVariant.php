<?php

namespace Markup\Addressing\Canonicalizer;

/**
 * A combination of individual postal code variants, to accommodate the fact that there can be different levels of postal code specificity in the same country (e.g. ZIP and ZIP+4 for the US)
 */
class CombinedPostalCodeVariant implements PostalCodeVariantInterface
{
    /**
     * @var PostalCodeVariantInterface[]
     */
    private $variants;

    /**
     * @param PostalCodeVariantInterface[] $variants
     */
    public function __construct(array $variants)
    {
        $this->variants = $variants;
    }

    /**
     * @param string $code
     * @return string
     */
    public function format(string $code): string
    {
        foreach ($this->variants as $variant) {
            $newCode = $variant->format($code);
            if ($newCode !== $code) {
                return $newCode;
            }
            $code = $newCode;
        }

        return $code;
    }
}
