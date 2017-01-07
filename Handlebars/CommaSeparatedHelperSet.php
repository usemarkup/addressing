<?php

namespace Markup\Addressing\Handlebars;

class CommaSeparatedHelperSet extends AbstractHelperSet
{
    public function getBreakFunction()
    {
        return function () {
            return ', ';
        };
    }

    public function getSpaceFunction()
    {
        return function () {
            return ' ';
        };
    }
}
