<?php

namespace Markup\Addressing\Handlebars;

class OptionsHelper
{
    /**
     * @param array $options
     * @return string
     */
    public static function passthrough(array $options)
    {
        return function ($options) {
            if (isset($options['fn']) && is_callable($options['fn'])) {
                return $options['fn']();
            }
            if (!isset($options['name']) || !isset($options['data']['root'])) {
                return '';
            }

            return $options['data']['root'][$options['name']];
        };
    }

    /**
     * @param array $options
     * @return bool
     */
    public static function isBlock(array $options)
    {
        return isset($options['fn']) && is_callable($options['fn']);
    }
}