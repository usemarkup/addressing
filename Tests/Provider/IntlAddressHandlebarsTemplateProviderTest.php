<?php

namespace Provider;

use Markup\Addressing\Provider\IntlAddressHandlebarsTemplateProvider;
use Markup\Addressing\Provider\IntlAddressTemplateProviderInterface;

class IntlAddressHandlebarsTemplateProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $knownCountries;

    /**
     * @var IntlAddressHandlebarsTemplateProvider
     */
    private $provider;

    protected function setUp()
    {
        $this->knownCountries = ['gb', 'fr', 'de', 'us'];
        $this->provider = new IntlAddressHandlebarsTemplateProvider($this->knownCountries);
    }

    public function testIsTemplateProvider()
    {
        $this->assertInstanceOf(IntlAddressTemplateProviderInterface::class, $this->provider);
    }
}
