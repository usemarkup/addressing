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

    protected function setUp()
    {
        $this->converter = new Iso3166Converter();
    }

    /**
     * @dataProvider codes
     */
    public function testConvertAlpha2ToAlpha3($alpha2, $alpha3)
    {
        $this->assertEquals($alpha3, $this->converter->convertAlpha2ToAlpha3($alpha2));
    }

    /**
     * @dataProvider codes
     */
    public function testConvertAlpha3ToAlpha2($alpha2, $alpha3)
    {
        $this->assertEquals($alpha2, $this->converter->convertAlpha3ToAlpha2($alpha3));
    }

    public function codes()
    {
        return [
            ['GB', 'GBR'],
            ['TC', 'TCA'],
        ];
    }
}
