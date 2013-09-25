<?php

namespace Markup\Addressing\Tests\Twig\Extension;

use Markup\Addressing\Twig\Extension\InternalExtensionProvider;

class InternalExtensionProviderTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->provider = new InternalExtensionProvider();
    }

    public function testIsInternalExtensionProvider()
    {
        $this->assertInstanceOf('Markup\Addressing\Twig\Extension\InternalExtensionProviderInterface', $this->provider);
    }

    public function testFetchReturnsNullIfFormatUnregistered()
    {
        $this->assertNull($this->provider->fetchExtension('unknown_format'));
    }

    public function testFetchReturnsRegisteredExtension()
    {
        $format = 'known_format';
        $extension = $this->getMock('Twig_ExtensionInterface');
        $this->provider->registerExtension($format, $extension);
        $this->assertSame($extension, $this->provider->fetchExtension($format));
    }
}
