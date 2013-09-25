<?php

namespace Markup\Addressing\Twig\Extension;

/**
 * An interface for a provider object that fetches Twig extensions based on their format names.
 **/
interface InternalExtensionProviderInterface
{
    /**
     * Fetches a Twig extension for address node rendering. Returns null if no extension is available for the format indicated.
     *
     * @param  string                        $format
     * @return \Twig_ExtensionInterface|null
     **/
    public function fetchExtension($format);
}
