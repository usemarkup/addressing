<?php

namespace Markup\Addressing\Tests\Provider;

use Markup\Addressing\Provider\CountryNameProvider;

/**
* A test for a country name provider.
*/
class CountryNameProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->renderingLocale = 'en_GB';
        $this->localeProvider = $this->getMock('Markup\Addressing\Provider\LocaleProviderInterface');
        $this->localeProvider
            ->expects($this->any())
            ->method('getLocale')
            ->will($this->returnValue($this->renderingLocale));
        $this->provider = new CountryNameProvider($this->localeProvider);
    }

    public function testIsCountryNameProvider()
    {
        $this->assertTrue($this->provider instanceof \Markup\Addressing\Provider\CountryNameProviderInterface);
    }
}
