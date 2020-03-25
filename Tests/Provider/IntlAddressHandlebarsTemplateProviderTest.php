<?php

namespace Markup\Addressing\Tests\Provider;

use Markup\Addressing\Provider\IntlAddressHandlebarsTemplateProvider;
use Markup\Addressing\Provider\IntlAddressTemplateProviderInterface;
use PHPUnit\Framework\TestCase;

class IntlAddressHandlebarsTemplateProviderTest extends TestCase
{
    /**
     * @var array
     */
    private $knownCountries;

    /**
     * @var IntlAddressHandlebarsTemplateProvider
     */
    private $provider;

    protected function setUp(): void
    {
        $this->knownCountries = ['gb', 'fr', 'de', 'us'];
        $this->provider = new IntlAddressHandlebarsTemplateProvider($this->knownCountries);
    }

    public function testIsTemplateProvider(): void
    {
        $this->assertInstanceOf(IntlAddressTemplateProviderInterface::class, $this->provider);
    }
}
