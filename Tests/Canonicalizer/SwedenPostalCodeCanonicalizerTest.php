<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CanonicalizerInterface;
use Markup\Addressing\Canonicalizer\SwedenPostalCodeCanonicalizer;
use PHPUnit\Framework\TestCase;

/**
* A test for a canonicalizer for Swedish postal codes.
*/
class SwedenPostalCodeCanonicalizerTest extends TestCase
{
    /**
     * @var SwedenPostalCodeCanonicalizer
     */
    private $canonicalizer;

    protected function setUp(): void
    {
        $this->canonicalizer = new SwedenPostalCodeCanonicalizer();
    }

    public function testIsCanonicalizer(): void
    {
        $this->assertInstanceOf(CanonicalizerInterface::class, $this->canonicalizer  );
    }

    /**
     * @dataProvider postalCodes
     **/
    public function testCanonicalize(string $input, string $output): void
    {
        $this->assertEquals($output, $this->canonicalizer->canonicalize($input));
    }

    public function postalCodes(): array
    {
        return [
            ['SE-12345', '123 45'],
            ['S-12345', '123 45'],
            ['12345', '123 45'],
            ['123 456', '123 456'],
            ['12 345', '123 45'],
        ];
    }
}
