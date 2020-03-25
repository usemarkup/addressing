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

    protected function setUp(): void
    {
        $this->geography = new Geography();
    }

    /**
     * @dataProvider euCountryCases
     */
    public function testInEu(string $country, bool $expected): void
    {
        $this->assertEquals($expected, $this->geography->checkInEu($country));
    }

    public function euCountryCases(): array
    {
        return [
            ['FR', true],
            ['CH', false],
        ];
    }

    /**
     * @dataProvider usRegionAbbreviations
     */
    public function testRegionAbbreviationForUs(string $region, bool $expected): void
    {
        $this->assertEquals($expected, $this->geography->isUsStateAbbreviation($region));
    }

    public function usRegionAbbreviations(): array
    {
        return [
            ['NY', true],
            ['ON', false],
        ];
    }
}
