<?php

namespace Markup\Addressing\Tests\Provider;

use Markup\Addressing\Provider\CountryNameProvider;
use PHPUnit\Framework\TestCase;

/**
* A test for a country name provider.
*/
class CountryNameProviderTest extends TestCase
{
    /**
     * @var string
     */
    private $renderingLocale;

    /**
     * @var callable
     */
    private $localeProvider;

    /**
     * @var CountryNameProvider
     */
    private $provider;

    protected function setUp(): void
    {
        $this->renderingLocale = 'en_GB';
        $this->localeProvider = function () {
            return $this->renderingLocale;
        };
        $this->provider = new CountryNameProvider($this->localeProvider);
    }

    public function testIsCountryNameProvider(): void
    {
        $this->assertTrue($this->provider instanceof \Markup\Addressing\Provider\CountryNameProviderInterface);
    }
}
