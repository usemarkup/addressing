<?php

namespace Markup\Addressing\Twig\Extension;

/**
* A provider object that fetches extensions based on their format names.
*/
class InternalExtensionProvider implements InternalExtensionProviderInterface
{
    /**
     * @var array
     */
    private $extensions;

    public function __construct()
    {
        $this->extensions = [];
    }

    /**
     * {@inheritdoc}
     **/
    public function fetchExtension($format)
    {
        if (!isset($this->extensions[$format])) {
            return null;
        }

        return $this->extensions[$format];
    }

    /**
     * @param $format
     * @param \Twig_ExtensionInterface $extension
     */
    public function registerExtension($format, \Twig_ExtensionInterface $extension)
    {
        $this->extensions[$format] = $extension;

        return $this;
    }
}
