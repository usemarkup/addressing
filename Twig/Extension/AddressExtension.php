<?php

namespace Markup\Addressing\Twig\Extension;

use Markup\Addressing\RenderableAddressInterface;
use Markup\Addressing\Renderer\AddressRendererInterface;

/**
* A Twig extension that provides a (public) address rendering function.
*/
class AddressExtension extends \Twig_Extension
{
    /**
     * An object that can render addresses.
     *
     * @var AddressRendererInterface
     **/
    private $addressRenderer;

    /**
     * @param AddressRendererInterface $addressRenderer
     **/
    public function __construct(AddressRendererInterface $addressRenderer)
    {
        $this->addressRenderer = $addressRenderer;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('address', array($this, 'renderAddress'), array('is_safe' => array('html'))),
            );
    }

    /**
     * Render an address.
     *
     * @param  RenderableAddressInterface $address
     * @return string
     **/
    public function renderAddress(RenderableAddressInterface $address, $options = array())
    {
        return $this->addressRenderer->render($address, $options);
    }

    public function getName()
    {
        return 'markup_addressing.address';
    }
}
