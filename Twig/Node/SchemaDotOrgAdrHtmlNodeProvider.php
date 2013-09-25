<?php

namespace Markup\Addressing\Twig\Node;

use Markup\Addressing\Element\HtmlElement;

/**
* A node provider that provides address nodes in HTML that adhere to both schema.org and microformat specs for addresses.
*/
class SchemaDotOrgAdrHtmlNodeProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     **/
    public function fetchNode($tag, $lineno, \Twig_NodeInterface $body = null)
    {
        switch ($tag) {
            case 'address':
                $node = new HtmlElementNode(
                    new HtmlElement(
                        'p',
                        array(
                            'class' => 'adr',
                            'itemscope' => null,
                            'itemtype' => 'http://schema.org/PostalAddress',
                            )
                        ),
                    $body,
                    $lineno,
                    $tag
                    );
                break;
            case 'recipient':
                $node = new HtmlElementNode(
                    new HtmlElement(
                        'span',
                        array(
                            'itemprop' => 'name',
                            'itemscope' => null,
                            'itemtype' => 'http://schema.org/Person',
                            'class' => 'recipient',
                            )
                        ),
                    $body,
                    $lineno,
                    $tag
                    );
                break;
            case 'streetlines':
                $node = new HtmlElementNode(
                    new HtmlElement(
                        'span',
                        array(
                            'class' => 'street-address',
                            'itemprop' => 'streetAddress'
                            )
                        ),
                    $body,
                    $lineno,
                    $tag
                    );
                break;
            case 'streetline':
                $node = $body;
                break;
            case 'locality':
                $node = new HtmlElementNode(
                    new HtmlElement(
                        'span',
                        array(
                            'class' => 'locality',
                            'itemprop' => 'addressLocality',
                            )
                        ),
                    $body,
                    $lineno,
                    $tag
                    );
                break;
            case 'region':
                $node = new HtmlElementNode(
                    new HtmlElement(
                        'span',
                        array(
                            'class' => 'region',
                            'itemprop' => 'addressRegion',
                            )
                        ),
                    $body,
                    $lineno,
                    $tag
                    );
                break;
            case 'postalcode':
                $node = new HtmlElementNode(
                    new HtmlElement(
                        'span',
                        array(
                            'class' => 'postal-code',
                            'itemprop' => 'postalCode',
                            )
                        ),
                    $body,
                    $lineno,
                    $tag
                    );
                break;

            case 'country':
                $node = new HtmlElementNode(
                    new HtmlElement(
                        'span',
                        array(
                            'class' => 'country-name',
                            'itemprop' => 'addressCountry',
                            'itemscope' => null,
                            'itemtype' => 'http://schema.org/Country',
                            )
                        ),
                    $body,
                    $lineno,
                    $tag
                    );
                break;
            case 'break':
                $node = new SuffixHtmlElementNode(
                    new HtmlElement(
                        'br'
                        ),
                    $body,
                    $lineno,
                    $tag
                    );
                break;
            case 'space':
                $node = new NonBreakingSpaceHtmlEntityNode($lineno);
                break;

            default:
                throw new \InvalidArgumentException(sprintf('Could not fetch node for unrecognised tag "%s".', $tag));
                break;
        }

        return $node;
    }
}
