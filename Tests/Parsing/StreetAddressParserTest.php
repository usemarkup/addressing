<?php

namespace Markup\Addressing\Tests\Parsing;

use Markup\Addressing\Parsing\StreetAddressParser;

class StreetAddressParserTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->parser = new StreetAddressParser();
    }

    /**
     * @dataProvider cases
     */
    public function testParseLines($lines, $street, $streetNumber, $district)
    {
        $parsed = $this->parser->parseLines($lines);
        $this->assertInstanceOf('Markup\Addressing\Parsing\ParsedStreetAddressInterface', $parsed);
        $this->assertEquals($street, $parsed->getStreet());
        $this->assertEquals($streetNumber, $parsed->getStreetNumber());
        $this->assertEquals($district, $parsed->getDistrict());
    }

    public function cases()
    {
        return array(
            array(array(), null, null, null),
            array(array('1600 Pennsylvania Avenue'), 'Pennsylvania Avenue', '1600', null),
            array(array('Heleneborgsgatan 56', 'Skanstull'), 'Heleneborgsgatan', '56', 'Skanstull'),
            array(array('1600', 'Pennsylvania Avenue'), 'Pennsylvania Avenue', '1600', null),
        );
    }
}
