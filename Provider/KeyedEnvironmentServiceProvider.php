<?php

namespace Markup\Addressing\Provider;

/**
* A provider object that can provide instances of a prototype Twig environment that are shared for a given key.
*/
class KeyedEnvironmentServiceProvider
{
    /**
     * @var callable
     */
    private $generator;

    /**
     * @var array
     **/
    private $environments;

    /**
     * @param callable $generator
     **/
    public function __construct(callable $generator)
    {
        $this->generator = $generator;
        $this->environments = array();
    }

    /**
     * Fetches a Twig environment for the given key. For each key, there will be a shared instance of the environment returned.
     *
     * @param  string            $key
     * @return \Twig_Environment
     **/
    public function fetchEnvironment($key)
    {
        if (!is_string($key) || strlen($key) === 0) {
            throw new \InvalidArgumentException('Key must be a non-empty string.');
        }
        if (!isset($this->environments[$key])) {
            $this->environments[$key] = call_user_func($this->generator);
        }

        return $this->environments[$key];
    }
}
