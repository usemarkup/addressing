<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CanonicalizerInterface;
use Markup\Addressing\Canonicalizer\FixedConsecutiveDigitPostalCodeCanonicalizer;
use PHPUnit\Framework\TestCase;

class FixedConsecutiveDigitPostalCodeCanonicalizerTest extends TestCase
{
    protected function setUp()
    {
        $this->digits = 5;
        $this->canonicalizer = new FixedConsecutiveDigitPostalCodeCanonicalizer($this->digits);
    }

    public function testIsCanonicalizer()
    {
        $this->assertInstanceOf(CanonicalizerInterface::class, $this->canonicalizer);
    }

    /**
     * @dataProvider fiveDigitCodes
     */
    public function testCanonicalize($input, $expected)
    {
        $this->assertEquals($expected, $this->canonicalizer->canonicalize($input));
    }

    public function fiveDigitCodes()
    {
        return [
            ['AQ-244 66', '24466'],
            ['1235854', '1235854'],
        ];
    }
}
