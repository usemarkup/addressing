<?php

namespace Markup\Addressing\Twig\Node;

/**
* A Twig node that represents an HTML element that is rendered as a suffix to a node.
*/
class SuffixHtmlElementNode extends HtmlElementNode
{
    /**
     * {@inheritdoc}
     **/
    public function compile(\Twig_Compiler $compiler)
    {
        $tagEnd = ($this->getElement()->shouldUseXmlStyle()) ? ' /' : '';
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
            ->raw(sprintf('echo "<%s%s%s>";', $this->getElement()->getName(), addslashes($attributesHtml), $tagEnd));
    }
}
