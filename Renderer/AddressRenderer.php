<?php

namespace Markup\Addressing\Renderer;

use Markup\Addressing\RenderableAddressInterface;
use Markup\Addressing\Provider\IntlAddressTemplateProviderInterface;
use Markup\Addressing\Provider\KeyedEnvironmentServiceProvider;

/**
 * An object that can render addresses.
 **/
class AddressRenderer implements AddressRendererInterface
{
    const DEFAULT_FORMAT = 'html';

    /**
     * A Twig environment provider = provides a unique instance of the vanilla Twig environment for each format being used.
     *
     * @var KeyedEnvironmentServiceProvider
     **/
    private $twigProvider;

    /**
     * An object that can provide address templates given a country identifier.
     *
     * @var IntlAddressTemplateProviderInterface
     **/
    private $templateProvider;

    /**
     * @param KeyedEnvironmentServiceProvider      $twig             A Twig environment provider.
     * @param IntlAddressTemplateProviderInterface $templateProvider
     **/
    public function __construct(KeyedEnvironmentServiceProvider $twigProvider, IntlAddressTemplateProviderInterface $templateProvider)
    {
        $this->twigProvider = $twigProvider;
        $this->templateProvider = $templateProvider;
    }

    /**
     * {@inheritdoc}
     **/
    public function render(RenderableAddressInterface $address, array $options = array())
    {
        $format = (isset($options['format'])) ? $options['format'] : self::DEFAULT_FORMAT;
        $twig = $this->twigProvider->fetchEnvironment($format);
        $template = $this->templateProvider->getTemplateForCountry($address->getCountry(), $twig, $format, $options);

        //name will contain format after a hash sign
        list($templateFile, $format) = explode('#', $template->getTemplateName());

        return $template->render(
            array(
                'address' => $address,
                'format' => $format,
                'omit_recipient' => (isset($options['omit_recipient'])) ? (bool) $options['omit_recipient'] : false,
                'omit_country' => (isset($options['omit_country'])) ? (bool) $options['omit_country'] : false,
            )
        );
    }
}
