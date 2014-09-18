<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CombinedPostalCodeVariant;
use Markup\Addressing\Canonicalizer\PostalCodeVariant;

class CombinedPostalCodeVariantTest extends \PHPUnit_Framework_TestCase
{
    public function testIsPostalCodeVariant()
    {
        $this->assertInstanceOf('Markup\Addressing\Canonicalizer\PostalCodeVariantInterface', new CombinedPostalCodeVariant([]));
    }

    public function testVariant()
    {
        $variant = new CombinedPostalCodeVariant(array(new PostalCodeVariant(array(5)), new PostalCodeVariant(array(5, 4), '-')));
        $code = '123456789';
        $this->assertEquals('12345-6789', $variant->format($code));
    }
}
