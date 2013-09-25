<?php

namespace Markup\Addressing\Twig\TokenParser;

use Markup\Addressing\Twig\Node\ProviderInterface as NodeProvider;

/**
* A generic token parser for parts of an address.
*
* This enables a way of specifying address formats per country that is agnostic of mark-up, or even format (HTML or plaintext).
*/
class AddressPart extends \Twig_TokenParser
{
    /**
     * The name for the Twig tag this token parser is specifying.
     *
     * @var string
     **/
    private $name;

    /**
     * A node provider object for fetching nodes.
     *
     * @var NodeProvider
     **/
    private $nodeProvider;

    /**
     * @param string       $name         The name for the Twig tag this token parser is specifying.
     * @param NodeProvider $nodeProvider
     **/
    public function __construct($name, NodeProvider $nodeProvider = null)
    {
        $this->name = $name;
        $this->nodeProvider = $nodeProvider;
    }

    /**
     * Parses a token and returns a node.
     *
     * @param  \Twig_Token         $token
     * @return \Twig_NodeInterface
     **/
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();

        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        $tagName = $this->getName();
        $body = $this->parser->subparse(function(\Twig_Token $token) use ($tagName) { return $token->test('end' . $tagName); }, true);
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return $this->getNodeProvider()->fetchNode($this->getName(), $lineno, $body);
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string
     **/
    public function getTag()
    {
        return $this->getName();
    }

    /**
     * Gets the name for the Twig tag this token parser is specifying.
     **/
    protected function getName()
    {
        return $this->name;
    }

    /**
     * Gets the node provider object.
     *
     * @return NodeProvider
     **/
    protected function getNodeProvider()
    {
        return $this->nodeProvider;
    }
}
