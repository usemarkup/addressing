<?php

namespace Markup\Addressing\Tests\Twig\Node;

use Markup\Addressing\Twig\Node\ProviderFactory;

/**
 * Test for a factory for node providers.
 */
class ProviderFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->fac = new ProviderFactory();
    }

    public function testInvalidArgumentIfUnknownReference()
    {
        $reference = 'unknown_reference';
        $this->setExpectedException('InvalidArgumentException');
        $this->fac->fetchProvider($reference);
    }

    public function testFetchReturnsRegisteredProvider()
    {
        $reference = 'known_reference';
        $provider = $this->getMock('Markup\Addressing\Twig\Node\ProviderInterface');
        $this->fac->registerProvider($reference, $provider);
        $this->assertSame($provider, $this->fac->fetchProvider($reference));
    }
}
