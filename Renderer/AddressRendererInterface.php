<?php

namespace Markup\Addressing\Renderer;

use Markup\Addressing\RenderableAddressInterface;

/**
 * An interface for an object that can render addresses.
 **/
interface AddressRendererInterface
{
    /**
     * Render the provided address.
     *
     * @param  RenderableAddressInterface $address
     * @param  array                      $options
     * @return string
     **/
    public function render(RenderableAddressInterface $address, array $options = array());
}
