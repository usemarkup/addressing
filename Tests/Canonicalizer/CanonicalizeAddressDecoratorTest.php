<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\AddressInterface;
use Markup\Addressing\Canonicalizer\CanonicalizeAddressDecorator;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CanonicalizeAddressDecoratorTest extends MockeryTestCase
{
    /**
     * @var AddressInterface|m\MockInterface
     */
    private $address;

    /**
     * @var CanonicalizeAddressDecorator
     */
    private $decorator;

    protected function setUp(): void
    {
        $this->address = m::mock(AddressInterface::class);
        $this->decorator = new CanonicalizeAddressDecorator($this->address);
    }

    public function testIsAddress(): void
    {
        $this->assertInstanceOf(AddressInterface::class, $this->decorator);
    }

    /**
     * @dataProvider codesForCountries
     */
    public function testCanonicalizesPostalCode(string $original, string $expected, string $country): void
    {
        $this->address
            ->shouldReceive('getPostalCode')
            ->andReturn($original);
        $this->address
            ->shouldReceive('getCountry')
            ->andReturn($country);
        $this->assertEquals($expected, $this->decorator->getPostalCode());
    }

    public function codesForCountries(): array
    {
        return [
            [' WD36TH', 'WD3 6TH', 'GB'],
            [' l4R3e6', 'L4R 3E6', 'CA'],
        ];
    }
}
