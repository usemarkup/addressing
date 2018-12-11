<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CanonicalizerInterface;
use Markup\Addressing\Canonicalizer\UnitedKingdomPostcodeCanonicalizer;
use PHPUnit\Framework\TestCase;

/**
* A test for a canonicalizer object that can take a postal code that is recognisable as a United Kingdom postcode and transform it to a canonical form.
*/
class UnitedKingdomPostcodeCanonicalizerTest extends TestCase
{
    public function setUp()
    {
        $this->canonicalizer = new UnitedKingdomPostcodeCanonicalizer();
    }

    public function testIsCanonicalizer()
    {
        $this->assertInstanceOf(CanonicalizerInterface::class, $this->canonicalizer);
    }

    /**
     * @dataProvider postcodes
     **/
    public function testCanonicalize($input, $output)
    {
        $this->assertEquals($output, $this->canonicalizer->canonicalize($input));
    }

    public function postcodes()
    {
        return [
            ['SW1A 1AA', 'SW1A 1AA'],
            ['SW1A1AA', 'SW1A 1AA'],
            ['sW1a1Aa', 'SW1A 1AA'],
            ['sw1a  1aa', 'SW1A 1AA'],
            ['  SW1A 1AA ', 'SW1A 1AA'],
            ['CR01EW', 'CR0 1EW'],
            ['CRO1EW', 'CRO1EW'],
            ['w1f9qs', 'W1F 9QS'],
        ];
    }
}
