<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\PostalCodeVariant;

class PostalCodeVariantTest extends \PHPUnit_Framework_TestCase
{
    public function testIsPostalCodeVariant()
    {
        $this->assertInstanceOf('Markup\Addressing\Canonicalizer\PostalCodeVariantInterface', new PostalCodeVariant([]));
    }

    public function testSimpleVariant()
    {
        $variant = new PostalCodeVariant([5]);
        $dirtyCode = '123-45';
        $this->assertEquals('12345', $variant->format($dirtyCode));
    }

    public function testComplexVariant()
    {
        $variant = new PostalCodeVariant([5, 4], '-');
        $code = '123456789';
        $this->assertEquals('12345-6789', $variant->format($code));
    }
}
