<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CombinedPostalCodeVariant;
use Markup\Addressing\Canonicalizer\PostalCodeVariant;
use Markup\Addressing\Canonicalizer\PostalCodeVariantInterface;
use PHPUnit\Framework\TestCase;

class CombinedPostalCodeVariantTest extends TestCase
{
    public function testIsPostalCodeVariant()
    {
        $this->assertInstanceOf(PostalCodeVariantInterface::class, new CombinedPostalCodeVariant([]));
    }

    public function testVariant()
    {
        $variant = new CombinedPostalCodeVariant([new PostalCodeVariant([5]), new PostalCodeVariant([5, 4], '-')]);
        $code = '123456789';
        $this->assertEquals('12345-6789', $variant->format($code));
    }
}
