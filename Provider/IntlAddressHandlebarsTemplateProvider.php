<?php

namespace Markup\Addressing\Provider;

use LightnCandy\Flags;
use LightnCandy\LightnCandy;
use Markup\Addressing\Handlebars\CommaSeparatedHelperSet;
use Markup\Addressing\Handlebars\HelperSetInterface;
use Markup\Addressing\Handlebars\PlainTextHelperSet;
use Markup\Addressing\Handlebars\SchemaDotOrgAdrHtmlHelperSet;
use Markup\Addressing\Templating\HandlebarsTemplate;
use Markup\Addressing\Templating\TemplateInterface;

class IntlAddressHandlebarsTemplateProvider implements IntlAddressTemplateProviderInterface
{
    const DEFAULT_TEMP_DIR = '/tmp/addressing/';

    /**
     * @var array
     */
    private $knownCountries;

    /**
     * @var string
     */
    private $cacheDir;

    /**
     * @var array
     */
    private static $cachedRenderFunctions;

    /**
     * @param string $cacheDir
     */
    public function __construct(array $knownCountries, $cacheDir = self::DEFAULT_TEMP_DIR)
    {
        $this->knownCountries = $knownCountries;
        $this->cacheDir = $cacheDir;
        if (null === self::$cachedRenderFunctions) {
            self::$cachedRenderFunctions = [];
        }
    }

    /**
     * Gets a template that pertains to the provided country.
     *
     * @param  string            $country The ISO3166 alpha-2 value for a country (case-insensitive).
     * @param  string            $format  The address format being used.
     * @param  array             $options
     * @return TemplateInterface
     **/
    public function getTemplateForCountry($country, $format, array $options = [])
    {
        return new HandlebarsTemplate($this->getRenderFunction(strtolower($country), $format));
    }

    private function getRenderFunction(string $country, string $format): callable
    {
        $label = (in_array($country, $this->knownCountries)) ? $country : 'fallback';
        $filename = sprintf('address_%s_%s_compiled.php', $label, $format);
        $filePath = $this->cacheDir . $filename;
        if (!file_exists($filePath)) {
            $phpString = LightnCandy::compile(
                $this->getHandlebarsTemplate($label),
                [
                    'flags' => Flags::FLAG_HANDLEBARSJS
                        | Flags::FLAG_ERROR_EXCEPTION
                        | Flags::FLAG_THIS
                        | (($format !== 'html') ? Flags::FLAG_NOESCAPE : 0),
                    'helpers' => $this->getHelperSetForFormat($format)->toArray()
                ]
            );
            file_put_contents(
                $filePath,
                sprintf("<?php\n%s", $phpString)
            );
        }

        $cachedFunction = self::getCachedRenderFunction($label, $format);
        if ($cachedFunction) {
            return $cachedFunction;
        }

        $renderFunction = include_once $filePath;
        self::cacheRenderFunction($label, $format, $renderFunction);

        return $renderFunction;
    }

    /**
     * @param string $label
     * @return string
     */
    private function getHandlebarsTemplate($label)
    {
        $handlebarsFilePath = sprintf(
            '%s/../Templates/address.%s.hbs',
            __DIR__,
            $label
        );
        if (!file_exists($handlebarsFilePath)) {
            return '';
        }

        return file_get_contents($handlebarsFilePath) ?: '';
    }

    private function getHelperSetForFormat(string $format): HelperSetInterface
    {
        switch ($format) {
            case 'comma_separated':
                $helperSet = new CommaSeparatedHelperSet();
                break;
            case 'html':
                $helperSet = new SchemaDotOrgAdrHtmlHelperSet();
                break;
            default:
                $helperSet = new PlainTextHelperSet();
        };

        return $helperSet;
    }

    private static function cacheRenderFunction(string $label, string $format, callable $renderFunction): void
    {
        $key = self::getCacheKey($label, $format);
        self::$cachedRenderFunctions[$key] = $renderFunction;
    }

    /**
     * @param string $label
     * @param string $format
     * @return callable|null
     */
    private static function getCachedRenderFunction($label, $format)
    {
        $key = self::getCacheKey($label, $format);
        if (!array_key_exists($key, self::$cachedRenderFunctions)) {
            return null;
        }

        return self::$cachedRenderFunctions[$key];
    }

    private static function getCacheKey(string $label, string $format): string
    {
        return implode('', [$label, $format]);
    }
}
