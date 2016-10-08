<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CanadaPostalCodeCanonicalizer;

class CanadaPostalCodeCanonicalizerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->canonicalizer = new CanadaPostalCodeCanonicalizer();
    }

    public function testIsCanonicalizer()
    {
        $this->assertInstanceOf('Markup\Addressing\Canonicalizer\CanonicalizerInterface', $this->canonicalizer);
    }

    /**
     * @dataProvider postalCodes
     **/
    public function testCanonicalize($input, $output)
    {
        $this->assertEquals($output, $this->canonicalizer->canonicalize($input));
    }

    public function postalCodes()
    {
        return [
            ['l3f6y7', 'L3F 6Y7'],
            ['f6g  3E2', 'F6G 3E2'],
            ['L3F 5T2', 'L3F 5T2'],
        ];
    }
}
