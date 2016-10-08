<?php

namespace Markup\Addressing\Tests;

use Markup\Addressing\Geography;

class GeographyTest extends \PHPUnit_Framework_TestCase
{
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
