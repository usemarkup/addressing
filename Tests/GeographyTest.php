<?php

namespace Markup\Addressing\Tests;

use Markup\Addressing\Geography;
use PHPUnit\Framework\TestCase;

class GeographyTest extends TestCase
{
    /**
     * @var Geography
     */
    private $geography;

    protected function setUp()
    {
        $this->geography = new Geography();
    }

    /**
     * @dataProvider euCountryCases
     */
    public function testInEu($country, $expected)
    {
        $this->assertEquals($expected, $this->geography->checkInEu($country));
    }

    public function euCountryCases()
    {
        return [
            ['FR', true],
            ['CH', false],
        ];
    }

    /**
     * @dataProvider usRegionAbbreviations
     */
    public function testRegionAbbreviationForUs($region, $expected)
    {
        $this->assertEquals($expected, $this->geography->isUsStateAbbreviation($region));
    }

    public function usRegionAbbreviations()
    {
        return [
            ['NY', true],
            ['ON', false],
        ];
    }
}
