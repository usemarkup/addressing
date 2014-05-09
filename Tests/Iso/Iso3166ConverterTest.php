<?php

namespace Markup\Addressing\Tests\Provider;

use Markup\Addressing\Iso\Iso3166Converter;

class Iso3166ConverterTest extends \PHPUnit_Framework_TestCase
{
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
        return array(
            array('GB', 'GBR'),
            array('TC', 'TCA'),
        );
    }
}
