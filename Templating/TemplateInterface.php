<?php

namespace Markup\Addressing\Templating;

interface TemplateInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data);
}
