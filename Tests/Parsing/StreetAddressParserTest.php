<?php

namespace Markup\Addressing\Tests\Parsing;

use Markup\Addressing\Parsing\ParsedStreetAddressInterface;
use Markup\Addressing\Parsing\StreetAddressParser;
use PHPUnit\Framework\TestCase;

class StreetAddressParserTest extends TestCase
{
    /**
     * @var StreetAddressParser
     */
    private $parser;

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
        $this->assertInstanceOf(ParsedStreetAddressInterface::class, $parsed);
        $this->assertEquals($street, $parsed->getStreet());
        $this->assertEquals($streetNumber, $parsed->getStreetNumber());
        $this->assertEquals($district, $parsed->getDistrict());
        $this->assertEquals($streetNumberWithoutAddition, $parsed->getStreetNumberWithoutAddition());
        $this->assertEquals($streetNumberAddition, $parsed->getStreetNumberAddition());
    }

    public function cases()
    {
        return [
            [[], null, null, null, null, null],
            [['1600 Pennsylvania Avenue'], 'Pennsylvania Avenue', '1600', null, '1600', null],
            [['Heleneborgsgatan 56', 'Skanstull'], 'Heleneborgsgatan', '56', 'Skanstull', '56', null],
            [['1600', 'Pennsylvania Avenue'], 'Pennsylvania Avenue', '1600', null, '1600', null],
            [['Haagstraat 23A'], 'Haagstraat', '23A', null, '23', 'A'],
            [['Haagstraat 23 A-I'], 'Haagstraat', '23 A-I', null, '23', 'A-I'],
            [['1000 1/2 5th Avenue'], '5th Avenue', '1000 1/2', null, '1000', '1/2'],
            [['65 High Street'], 'High Street', '65', null, '65', null],
            [['Shop', 'Haagstraat, 123'], 'Haagstraat', '123', null, '123', null],
        ];
    }
}
