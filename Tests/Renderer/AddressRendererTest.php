<?php

namespace Markup\Addressing\Tests\Renderer;

use Markup\Addressing\Renderer\AddressRenderer;

/**
* A test for an address renderer object.
*/
class AddressRendererTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->twigProvider = $this->getMockBuilder('Markup\Addressing\Provider\KeyedEnvironmentServiceProvider')
            ->disableOriginalConstructor()
            ->getMock();
        $this->templateProvider = $this->getMock('Markup\Addressing\Provider\IntlAddressTemplateProviderInterface');
        $this->renderer = new AddressRenderer($this->twigProvider, $this->templateProvider);
    }

    public function testIsAddressRenderer()
    {
        $this->assertTrue($this->renderer instanceof \Markup\Addressing\Renderer\AddressRendererInterface);
    }
}
