<?php

namespace Markup\Addressing\Twig\TokenParser;

/**
* A token parser for self-closing parts of an address specification, like a "break" tag.
*/
class SelfClosingAddressPart extends AddressPart
{
    /**
     * Parses a token and returns a node.
     *
     * @param  \Twig_Token         $token
     * @return \Twig_NodeInterface
     **/
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();

        $tagName = $this->getName();
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return $this->getNodeProvider()->fetchNode($this->getName(), $lineno);
    }
}
