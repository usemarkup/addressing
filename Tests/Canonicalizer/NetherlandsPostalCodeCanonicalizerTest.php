<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CanonicalizerInterface;
use Markup\Addressing\Canonicalizer\NetherlandsPostalCodeCanonicalizer;
use PHPUnit\Framework\TestCase;

class NetherlandsPostalCodeCanonicalizerTest extends TestCase
{
    /**
     * @var NetherlandsPostalCodeCanonicalizer
     */
    private $canonicalizer;

    protected function setUp(): void
    {
        $this->canonicalizer = new NetherlandsPostalCodeCanonicalizer();
    }

    public function testIsCanonicalizer(): void
    {
        $this->assertInstanceOf(CanonicalizerInterface::class, $this->canonicalizer);
    }

    /**
     * @dataProvider postcodes
     */
    public function testCanonicalize(string $dirty, string $filtered): void
    {
        $this->assertEquals($filtered, $this->canonicalizer->canonicalize($dirty));
    }

    public function postcodes(): array
    {
        return [
            ['1012VF', '1012 VF'],
            ['1012 vf', '1012 VF'],
            ['1012', '1012'],
            ['101 2VF', '1012 VF'],
        ];
    }
}
