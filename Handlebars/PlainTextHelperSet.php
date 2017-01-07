<?php

namespace Markup\Addressing\Handlebars;

class PlainTextHelperSet extends AbstractHelperSet
{
    public function getBreakFunction()
    {
        return function () {
            return "\n";
        };
    }

    public function getSpaceFunction()
    {
        return function () {
            return ' ';
        };
    }
}
