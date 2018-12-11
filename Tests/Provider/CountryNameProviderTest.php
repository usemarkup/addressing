<?php

namespace Markup\Addressing\Tests\Provider;

use Markup\Addressing\Provider\CountryNameProvider;
use PHPUnit\Framework\TestCase;

/**
* A test for a country name provider.
*/
class CountryNameProviderTest extends TestCase
{
    public function setUp()
    {
        $this->renderingLocale = 'en_GB';
        $this->localeProvider = function () {
            return $this->renderingLocale;
        };
        $this->provider = new CountryNameProvider($this->localeProvider);
    }

    public function testIsCountryNameProvider()
    {
        $this->assertTrue($this->provider instanceof \Markup\Addressing\Provider\CountryNameProviderInterface);
    }
}
