<?php

namespace Markup\Addressing\Tests\Templating;

use Markup\Addressing\Templating\HandlebarsTemplate;
use Markup\Addressing\Templating\TemplateInterface;
use PHPUnit\Framework\TestCase;

class HandlebarsTemplateTest extends TestCase
{
    /**
     * @var array
     */
    private $context;

    /**
     * @var callable
     */
    private $renderFunction;

    /**
     * @var HandlebarsTemplate
     */
    private $template;

    protected function setUp()
    {
        $this->context = [
            'this' => 'that',
            'up' => 'down',
        ];
        $this->renderFunction = function ($context) {
            if ($context === $this->context) {
                throw new CustomTemplateException();
            }
        };
        $this->template = new HandlebarsTemplate($this->renderFunction);
    }

    public function testIsTemplate()
    {
        $this->assertInstanceOf(TemplateInterface::class, $this->template);
    }

    public function testRender()
    {
        $this->expectException(CustomTemplateException::class);
        $this->template->render($this->context);
    }
}

class CustomTemplateException extends \Exception
{

}
