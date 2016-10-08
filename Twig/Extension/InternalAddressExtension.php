<?php

namespace Markup\Addressing\Twig\Extension;

use Markup\Addressing\Twig\Node\ProviderFactory as NodeProviderFactory;
use Markup\Addressing\Twig\TokenParser\AddressPart as AddressPartTokenParser;
use Markup\Addressing\Twig\TokenParser\SelfClosingAddressPart as SelfClosingAddressPartTokenParser;

/**
* A Twig extension that provides address tags for internal rendering.
*/
class InternalAddressExtension extends \Twig_Extension
{
    /**
     * A factory for provider objects for address nodes.
     *
     * @var NodeProviderFactory
     **/
    private $nodeProviderFactory;

    /**
     * The named format for address nodes.
     *
     * @var string
     **/
    private $format;

    /**
     * @param Node\ProviderInterface $nodeProvider
     **/
    public function __construct(NodeProviderFactory $nodeProviderFactory, $format)
    {
        $this->nodeProviderFactory = $nodeProviderFactory;
        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     **/
    public function getTokenParsers()
    {
        $tags = ['address', 'recipient', 'streetlines', 'streetline', 'locality', 'region', 'postalcode', 'country'];
        $nodeProvider = $this->getNodeProvider();
        $tokenParsers = array_map(
            function($tag) use ($nodeProvider) {
                return new AddressPartTokenParser($tag, $nodeProvider);
            },
            $tags
            );
        $selfClosingTags = ['break', 'space'];

        return array_merge(
            $tokenParsers,
            array_map(
                function($tag) use ($nodeProvider) {
                    return new SelfClosingAddressPartTokenParser($tag, $nodeProvider);
                },
                $selfClosingTags
                )
            );
    }

    /**
     * Gets the provider object for address nodes.
     *
     * @return NodeProviderInterface
     **/
    private function getNodeProvider()
    {
        return $this->nodeProviderFactory->fetchProvider($this->format);
    }

    public function getName()
    {
        return 'markup_addressing.internal_address.' . $this->format;
    }
}
