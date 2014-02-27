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

    public function testCanonicalizesPostalCode()
    {
        $postalCode = ' WD36TH';
        $this->address
            ->expects($this->any())
            ->method('getPostalCode')
            ->will($this->returnValue($postalCode));
        $this->address
            ->expects($this->any())
            ->method('getCountry')
            ->will($this->returnValue('GB'));
        $this->assertEquals('WD3 6TH', $this->decorator->getPostalCode());
    }
}
