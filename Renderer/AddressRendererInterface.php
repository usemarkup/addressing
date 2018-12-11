<?php

namespace Markup\Addressing\Renderer;

use Markup\Addressing\RenderableAddressInterface;

/**
 * An interface for an object that can render addresses.
 **/
interface AddressRendererInterface
{
    const DEFAULT_FORMAT = 'html';

    public function render(RenderableAddressInterface $address, array $options = []): string;
}
