<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CanonicalizeAddressDecorator;

class CanonicalizeAddressDecoratorTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->address = $this->getMock('Markup\Addressing\AddressInterface');
        $this->decorator = new CanonicalizeAddressDecorator($this->address);
    }

    public function testIsAddress()
    {
        $this->assertInstanceOf('Markup\Addressing\AddressInterface', $this->decorator);
    }

    /**
     * @dataProvider codesForCountries
     */
    public function testCanonicalizesPostalCode($original, $expected, $country)
    {
        $this->address
            ->expects($this->any())
            ->method('getPostalCode')
            ->will($this->returnValue($original));
        $this->address
            ->expects($this->any())
            ->method('getCountry')
            ->will($this->returnValue($country));
        $this->assertEquals($expected, $this->decorator->getPostalCode());
    }

    public function codesForCountries()
    {
        return [
            [' WD36TH', 'WD3 6TH', 'GB'],
            [' l4R3e6', 'L4R 3E6', 'CA'],
        ];
    }
}
