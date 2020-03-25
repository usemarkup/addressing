<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\PostalCodeVariant;
use Markup\Addressing\Canonicalizer\PostalCodeVariantInterface;
use PHPUnit\Framework\TestCase;

class PostalCodeVariantTest extends TestCase
{
    public function testIsPostalCodeVariant(): void
    {
        $this->assertInstanceOf(PostalCodeVariantInterface::class, new PostalCodeVariant([]));
    }

    public function testSimpleVariant(): void
    {
        $variant = new PostalCodeVariant([5]);
        $dirtyCode = '123-45';
        $this->assertEquals('12345', $variant->format($dirtyCode));
    }

    public function testComplexVariant(): void
    {
        $variant = new PostalCodeVariant([5, 4], '-');
        $code = '123456789';
        $this->assertEquals('12345-6789', $variant->format($code));
    }
}
