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
        $this->locale = 'en_GB';
        $this->provider = new CountryNameProvider($this->locale);
    }

    public function testIsCountryNameProvider()
    {
        $this->assertTrue($this->provider instanceof \Markup\Addressing\Provider\CountryNameProviderInterface);
    }
}
