<?php

namespace Markup\Addressing\Twig\Node;

use Markup\Addressing\Element\HtmlElement;

/**
* A Twig node that represents an HTML element.
*/
class HtmlElementNode extends \Twig_Node
{
    /**
     * The HTML element object.
     *
     * @var HtmlElement
     **/
    private $element;

    /**
     * @param HtmlElement         $element
     * @param \Twig_NodeInterface $body
     * @param int                 $lineno
     * @param string              $tag
     **/
    public function __construct(HtmlElement $element, \Twig_NodeInterface $body = null, $lineno, $tag)
    {
        $this->element = $element;
        parent::__construct((null !== $body) ? ['body' => $body] : [], [], $lineno, $tag);
    }

    /**
     * {@inheritdoc}
     **/
    public function compile(\Twig_Compiler $compiler)
    {
        $attributesHtml = '';
        foreach ($this->getElement()->getAttributes() as $attr => $value) {
            if (null !== $value) {
                $format = ' %s="%s"';
            } else {
                $format = ' %s%s';//unary HTML attributes
            }
            $attributesHtml .= sprintf($format, $attr, $value);
        }
        $compiler
            ->addDebugInfo($this)
            ->raw(sprintf('echo "<%s%s>";', $this->getElement()->getName(), addslashes($attributesHtml)))
            ->subcompile($this->getNode('body'));
        if ($this->getElement()->isClosing()) {
            $compiler->raw(sprintf('echo "</%s>";', $this->getElement()->getName()));
        }
        if ($this->getElement()->shouldBreakAfter()) {
            $compiler->raw('echo "\n";');
        }
    }

    /**
     * @return HtmlElement
     **/
    protected function getElement()
    {
        return $this->element;
    }
}
