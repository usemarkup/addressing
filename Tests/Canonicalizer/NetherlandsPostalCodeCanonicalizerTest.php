<?php

namespace Canonicalizer;

use Markup\Addressing\Canonicalizer\NetherlandsPostalCodeCanonicalizer;

class NetherlandsPostalCodeCanonicalizerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->canonicalizer = new NetherlandsPostalCodeCanonicalizer();
    }

    public function testIsCanonicalizer()
    {
        $this->assertInstanceOf('Markup\Addressing\Canonicalizer\CanonicalizerInterface', $this->canonicalizer);
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
        ];
    }
}
