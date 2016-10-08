<?php

namespace Markup\Addressing\Provider;

use Markup\Addressing\Twig\Extension\InternalExtensionProviderInterface;

/**
* An address template provider that uses the template definitions available in this bundle.
*/
class IntlAddressTemplateProvider implements IntlAddressTemplateProviderInterface
{
    /**
     * A provider object for internal address Twig extensions.
     *
     * @var InternalExtensionProviderInterface
     **/
    private $extensionProvider;

    /**
     * @var string
     **/
    private $delimiter;

    /**
     * @param InternalExtensionProviderInterface $extensionProvider The delimiter to use to separate a template name from an address format indicator
     * @param string                             $delimiter
     **/
    public function __construct(InternalExtensionProviderInterface $extensionProvider, $delimiter)
    {
        $this->extensionProvider = $extensionProvider;
        $this->delimiter = $delimiter;
    }

    /**
     * {@inheritdoc}
     **/
    public function getTemplateForCountry($country, \Twig_Environment $twig, $format, array $options = [])
    {
        $extension = $this->extensionProvider->fetchExtension($format);
        if (!$twig->hasExtension($extension->getName())) {
            $twig->addExtension($extension);
        }
        $templateFilePath = sprintf('address.%s.twig%s%s', strtolower($country), $this->delimiter, $format);
        try {
            $template = $twig->loadTemplate($templateFilePath);
        } catch (\Twig_Error_Loader $e) {
            $template = $twig->loadTemplate(sprintf('address.%s.twig%s%s', 'fallback', $this->delimiter, $format));
        }

        return $template;
    }
}
