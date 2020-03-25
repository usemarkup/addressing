<?php

namespace Markup\Addressing\Handlebars;

trait PassthroughTrait
{
    public function getPassthroughFunction(): \Closure
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
}
