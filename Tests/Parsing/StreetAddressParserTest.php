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
    public function testParseLines($lines, $street, $streetNumber, $district, $streetNumberWithoutAddition, $streetNumberAddition)
    {
        $parsed = $this->parser->parseLines($lines);
        $this->assertInstanceOf('Markup\Addressing\Parsing\ParsedStreetAddressInterface', $parsed);
        $this->assertEquals($street, $parsed->getStreet());
        $this->assertEquals($streetNumber, $parsed->getStreetNumber());
        $this->assertEquals($district, $parsed->getDistrict());
        $this->assertEquals($streetNumberWithoutAddition, $parsed->getStreetNumberWithoutAddition());
        $this->assertEquals($streetNumberAddition, $parsed->getStreetNumberAddition());
    }

    public function cases()
    {
        return array(
            array(array(), null, null, null, null, null),
            array(array('1600 Pennsylvania Avenue'), 'Pennsylvania Avenue', '1600', null, '1600', null),
            array(array('Heleneborgsgatan 56', 'Skanstull'), 'Heleneborgsgatan', '56', 'Skanstull', '56', null),
            array(array('1600', 'Pennsylvania Avenue'), 'Pennsylvania Avenue', '1600', null, '1600', null),
            array(array('Haagstraat 23A'), 'Haagstraat', '23A', null, '23', 'A'),
            array(array('Haagstraat 23 A-I'), 'Haagstraat', '23 A-I', null, '23', 'A-I'),
            array(array('1000 1/2 5th Avenue'), '5th Avenue', '1000 1/2', null, '1000', '1/2'),
            array(array('65 High Street'), 'High Street', '65', null, '65', null),
            array(array('Shop', 'Haagstraat, 123'), 'Haagstraat', '123', null, '123', null),
        );
    }
}
