<?php

namespace Markup\Addressing\Provider;

class LocaleProvider
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @param string $locale
     */
    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function __invoke()
    {
        return $this->getLocale();
    }
}
