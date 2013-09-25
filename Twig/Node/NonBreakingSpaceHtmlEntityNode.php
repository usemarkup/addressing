<?php

namespace Markup\Addressing\Twig\Node;

/**
* A Twig node that represents a non-breaking space HTML entity.
*/
class NonBreakingSpaceHtmlEntityNode extends \Twig_Node_Text
{
    const NBSP_HTML_ENTITY = '&nbsp;';

    /**
     * @param int $lineno
     **/
    public function __construct($lineno)
    {
        parent::__construct(self::NBSP_HTML_ENTITY, $lineno);
    }
}
