<?php

namespace Markup\Addressing\Templating;

class HandlebarsTemplate implements TemplateInterface
{
    /**
     * @var callable
     */
    private $renderFunction;

    public function __construct(callable $renderFunction)
    {
        $this->renderFunction = $renderFunction;
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        return call_user_func($this->renderFunction, $data);
    }
}
