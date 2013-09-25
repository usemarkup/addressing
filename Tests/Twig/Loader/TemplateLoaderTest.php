<?php

namespace Markup\Addressing\Tests\Twig\Loader;

use Markup\Addressing\Twig\Loader\TemplateLoader;

/**
* A test for a Twig loader that uses a key that is specific to a particular addressing format.
*/
class FormatSpecificLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->delimiter = '#';
        $this->loader = new TemplateLoader($this->delimiter);
    }

    public function testIsTwigLoader()
    {
        $this->assertInstanceOf('Twig_LoaderInterface', $this->loader);
    }

    public function testGetSourceThrowsInvalidArgumentExceptionIfArgumentDoesNotContainHashSign()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->loader->getSource('no_hashes_here');
    }

    public function testGetCacheKeyThrowsInvalidArgumentExceptionIfArgumentDoesNotContainHashSign()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->loader->getCacheKey('no_hashes_here');
    }
}
