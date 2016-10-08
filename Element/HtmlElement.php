<?php

namespace Markup\Addressing\Element;

/**
* An object representing an HTML element. This class does not have knowledge about what elements may be valid according to any HTML specs.
*/
class HtmlElement
{
    /**
     * The name of the element.
     *
     * @var string
     **/
    private $name;

    /**
     * Attributes of the element.
     *
     * @var array
     **/
    private $attributes;

    /**
     * The options that apply to this element.
     *
     * @var array
     **/
    private $options;

    /**
     * @param string $name       The element name.
     * @param array  $attributes The element's attributes as an associative array.  Null values signify valueless attributes.
     * @param array  $options    The options that apply to this element ('is_closing', 'break_after' and 'xml_style', all Booleans)
     **/
    public function __construct($name, array $attributes = [], array $options = [])
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->options = array_merge($this->getDefaultOptions(), $options);
    }

    /**
     * Gets the name of the element.
     *
     * @return string
     **/
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the attributes of the element, as an array.  Null-valued elements signify valueless attributes.
     *
     * @return array
     **/
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Gets whether this element should close (i.e. should be rendered with a closing tag).
     *
     * @return bool
     **/
    public function isClosing()
    {
        return (bool) $this->options['is_closing'];
    }

    /**
     * Gets whether this element should close (i.e. should be rendered )
     *
     * @return bool
     **/
    public function shouldBreakAfter()
    {
        return (bool) $this->options['break_after'];
    }

    /**
     * Gets whether this element should be rendered with XML style.
     *
     * @return bool
     **/
    public function shouldUseXmlStyle()
    {
        return (bool) $this->options['xml_style'];
    }

    /**
     * @return array
     **/
    protected function getDefaultOptions()
    {
        return [
            'is_closing'                => true,
            'break_after'               => true,
            'xml_style'                 => false,
        ];
    }
}
