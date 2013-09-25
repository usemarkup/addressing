<?php

namespace Markup\Addressing\Twig\Node;

/**
* A factory that can provide address node providers previously registered to it using references.
*/
class ProviderFactory
{
    /**
     * A keyed list of providers to use for retrieving node provider services from the DIC.
     *
     * @var array
     **/
    private $providers;

    public function __construct()
    {
        $this->providers = array();
    }

    /**
     * Fetches a provider referred to by the provided reference.
     *
     * @param  string                    $reference
     * @return ProviderInterface
     * @throws \InvalidArgumentException if the reference does not refer to a known service
     **/
    public function fetchProvider($reference)
    {
        if (!isset($this->providers[$reference])) {
            throw new \InvalidArgumentException(sprintf('The provider reference "%s" is not any of the known provider references (%s).', $reference, implode(', ', array_keys($this->providers))));
        }

        return $this->providers[$reference];
    }

    /**
     * @param string            $reference
     * @param ProviderInterface $provider
     */
    public function registerProvider($reference, ProviderInterface $provider)
    {
        $this->providers[$reference] = $provider;

        return $this;
    }
}
