<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\FixedConsecutiveDigitPostalCodeCanonicalizer;

class FixedConsecutiveDigitPostalCodeCanonicalizerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->digits = 5;
        $this->canonicalizer = new FixedConsecutiveDigitPostalCodeCanonicalizer($this->digits);
    }

    public function testIsCanonicalizer()
    {
        $this->assertInstanceOf('Markup\Addressing\Canonicalizer\CanonicalizerInterface', $this->canonicalizer);
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
        return array(
            array('AQ-244 66', '24466'),
            array('1235854', '1235854'),
        );
    }
}
