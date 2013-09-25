<?php

namespace Markup\Addressing\Twig\Node;

/**
* A node provider that provides address nodes separated by commas, on the same line.
*/
class CommaSeparatedNodeProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     **/
    public function fetchNode($tag, $lineno, \Twig_NodeInterface $body = null)
    {
        switch ($tag) {
            case 'address':
            case 'recipient':
            case 'streetlines':
            case 'streetline':
            case 'locality':
            case 'region':
            case 'postalcode':
            case 'country':
                $node = $body;
                break;
            case 'break':
                $node = new \Twig_Node_Text(', ', $lineno);
                break;
            case 'space':
                $node = new \Twig_Node_Text(' ', $lineno);
                break;

            default:
                throw new \InvalidArgumentException(sprintf('Could not fetch node for unrecognised tag "%s".', $tag));
                break;
        }

        return $node;
    }
}
