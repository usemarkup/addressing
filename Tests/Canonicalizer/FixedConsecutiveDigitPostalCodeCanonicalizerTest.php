<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CanonicalizerInterface;
use Markup\Addressing\Canonicalizer\FixedConsecutiveDigitPostalCodeCanonicalizer;
use PHPUnit\Framework\TestCase;

class FixedConsecutiveDigitPostalCodeCanonicalizerTest extends TestCase
{
    /**
     * @var int
     */
    private $digits;

    /**
     * @var FixedConsecutiveDigitPostalCodeCanonicalizer
     */
    private $canonicalizer;

    protected function setUp(): void
    {
        $this->digits = 5;
        $this->canonicalizer = new FixedConsecutiveDigitPostalCodeCanonicalizer($this->digits);
    }

    public function testIsCanonicalizer(): void
    {
        $this->assertInstanceOf(CanonicalizerInterface::class, $this->canonicalizer);
    }

    /**
     * @dataProvider fiveDigitCodes
     */
    public function testCanonicalize(string $input, string $expected): void
    {
        $this->assertEquals($expected, $this->canonicalizer->canonicalize($input));
    }

    public function fiveDigitCodes(): array
    {
        return [
            ['AQ-244 66', '24466'],
            ['1235854', '1235854'],
        ];
    }
}
