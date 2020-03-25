<?php

namespace Markup\Addressing\Tests\Canonicalizer;

use Markup\Addressing\Canonicalizer\CanadaPostalCodeCanonicalizer;
use Markup\Addressing\Canonicalizer\CanonicalizerInterface;
use PHPUnit\Framework\TestCase;

class CanadaPostalCodeCanonicalizerTest extends TestCase
{
    /**
     * @var CanadaPostalCodeCanonicalizer
     */
    private $canonicalizer;

    protected function setUp(): void
    {
        $this->canonicalizer = new CanadaPostalCodeCanonicalizer();
    }

    public function testIsCanonicalizer(): void
    {
        $this->assertInstanceOf(CanonicalizerInterface::class, $this->canonicalizer);
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
            ['l3f6y7', 'L3F 6Y7'],
            ['f6g  3E2', 'F6G 3E2'],
            ['L3F 5T2', 'L3F 5T2'],
        ];
    }
}
