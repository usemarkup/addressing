<?php

namespace Markup\Addressing\Renderer;

use Markup\Addressing\Provider\CountryNameProviderInterface;
use Markup\Addressing\RenderableAddressInterface;
use Markup\Addressing\Provider\IntlAddressTemplateProviderInterface;

/**
 * An object that can render addresses.
 **/
class AddressRenderer implements AddressRendererInterface
{
    /**
     * An object that can provide address templates given a country identifier.
     *
     * @var IntlAddressTemplateProviderInterface
     **/
    private $templateProvider;

    /**
     * @var CountryNameProviderInterface
     */
    private $countryNameProvider;

    /**
     * @var string|callable
     */
    private $locale;

    /**
     * @param IntlAddressTemplateProviderInterface $templateProvider
     * @param CountryNameProviderInterface         $countryNameProvider
     * @param string|callable                      $locale
     **/
    public function __construct(
        IntlAddressTemplateProviderInterface $templateProvider,
        CountryNameProviderInterface $countryNameProvider,
        $locale = null)
    {
        $this->templateProvider = $templateProvider;
        $this->countryNameProvider = $countryNameProvider;
        $this->locale = $locale ?: \Locale::getDefault();
    }

    /**
     * {@inheritdoc}
     **/
    public function render(RenderableAddressInterface $address, array $options = [])
    {
        $format = (isset($options['format'])) ? $options['format'] : self::DEFAULT_FORMAT;
        $template = $this->templateProvider->getTemplateForCountry($address->getCountry(), $format, $options);
        $locale = (isset($options['locale']) ? $options['locale'] : $this->getLocale());

        return $template->render(
            [
                'recipient' => $address->getRecipient(),
                'streetAddressLines' => $address->getStreetAddressLines(),
                'locality' => $address->getLocality(),
                'region' => $address->getRegion(),
                'postalCode' => $address->getPostalCode(),
                'country' => $address->getCountry(),
                'countryName' => $this->countryNameProvider->getDisplayNameForCountry($address->getCountry(), $locale),
                'format' => $format,
                'omit_recipient' => (isset($options['omit_recipient'])) ? (bool) $options['omit_recipient'] : false,
                'omit_country' => (isset($options['omit_country'])) ? (bool) $options['omit_country'] : false,
            ]
        );
    }

    /**
     * @return string
     */
    private function getLocale()
    {
        if (is_callable($this->locale)) {
            return call_user_func($this->locale);
        }

        return $this->locale;
    }
}
