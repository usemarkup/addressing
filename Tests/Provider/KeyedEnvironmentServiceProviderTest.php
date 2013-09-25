<?php

namespace Markup\Addressing\Tests\Provider;

use Markup\Addressing\Provider\KeyedEnvironmentServiceProvider;

/**
* A test for a provider object that can provide instances of a prototype Twig environment service that are shared for a given key.
*/
class KeyedEnvironmentServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $test = $this;
        $this->generator = function () use ($test) {
            return $test->getMockEnvironment();
        };
        $this->provider = new KeyedEnvironmentServiceProvider($this->generator);
    }

    public function testCallWithSameKeyTwiceFetchesEnvironmentOnce()
    {
        $key = 'key';
        $this->assertInstanceOf('Twig_Environment', $this->provider->fetchEnvironment($key));
        $this->assertInstanceOf('Twig_Environment', $this->provider->fetchEnvironment($key));
    }

    public function testCallWithDifferentKeysFetchesTwoDifferentEnvironments()
    {
        $env1 = $this->provider->fetchEnvironment('key1');
        $env2 = $this->provider->fetchEnvironment('key2');
        $this->assertNotEquals(spl_object_hash($env1), spl_object_hash($env2));
    }

    public function getMockEnvironment()
    {
        return clone $this->getMockBuilder('Twig_Environment')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
