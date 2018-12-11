<?php

namespace Canonicalizer;

use Markup\Addressing\Canonicalizer\CanonicalizerInterface;
use Markup\Addressing\Canonicalizer\NetherlandsPostalCodeCanonicalizer;
use PHPUnit\Framework\TestCase;

class NetherlandsPostalCodeCanonicalizerTest extends TestCase
{
    protected function setUp()
    {
        $this->canonicalizer = new NetherlandsPostalCodeCanonicalizer();
    }

    public function testIsCanonicalizer()
    {
        $this->assertInstanceOf(CanonicalizerInterface::class, $this->canonicalizer);
    }

    /**
     * @dataProvider postcodes
     */
    public function testCanonicalize($dirty, $filtered)
    {
        $this->assertEquals($filtered, $this->canonicalizer->canonicalize($dirty));
    }

    public function postcodes()
    {
        return [
            ['1012VF', '1012 VF'],
            ['1012 vf', '1012 VF'],
            ['1012', '1012'],
            ['101 2VF', '1012 VF'],
        ];
    }
}
