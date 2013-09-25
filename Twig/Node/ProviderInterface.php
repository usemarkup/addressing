<?php

namespace Markup\Addressing\Twig\Node;

/**
 * An interface for an object that can provide Twig node given an address tag name and other necessary data.
 **/
interface ProviderInterface
{
    /**
     * Fetches a Twig node, given a tag body, the line number for the tag, and the tag name.
     *
     * @param  string              $tag    The tag name
     * @param  int                 $lineno The line number on which the tag appears
     * @param  \Twig_NodeInterface $body   (Optional.) The body within the tag
     * @return \Twig_NodeInterface
     **/
    public function fetchNode($tag, $lineno, \Twig_NodeInterface $body = null);
}
