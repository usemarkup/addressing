<?php

namespace Markup\Addressing\Tests\Iso;

use Markup\Addressing\Iso\Iso3166Converter;
use PHPUnit\Framework\TestCase;

class Iso3166ConverterTest extends TestCase
{
    /**
     * @var Iso3166Converter
     */
    private $converter;

    protected function setUp(): void
    {
        $this->converter = new Iso3166Converter();
    }

    /**
     * @dataProvider codes
     */
    public function testConvertAlpha2ToAlpha3(string $alpha2, string $alpha3): void
    {
        $this->assertEquals($alpha3, $this->converter->convertAlpha2ToAlpha3($alpha2));
    }

    /**
     * @dataProvider codes
     */
    public function testConvertAlpha3ToAlpha2(string $alpha2, string $alpha3): void
    {
        $this->assertEquals($alpha2, $this->converter->convertAlpha3ToAlpha2($alpha3));
    }

    public function codes(): array
    {
        return [
            ['GB', 'GBR'],
            ['TC', 'TCA'],
        ];
    }
}
