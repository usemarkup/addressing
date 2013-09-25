<?php

namespace Markup\Addressing\Twig\Loader;

/**
* A Twig loader that uses a key that is specific to a particular addressing format, and loads from the package Templates directory.
*/
class TemplateLoader extends \Twig_Loader_Filesystem
{
    /**
     * @var string
     **/
    private $delimiter;

    /**
     * @param string                      $delimiter
     **/
    public function __construct($delimiter)
    {
        $this->delimiter = $delimiter;
        //add path to templates
        $this->addPath(__DIR__.'/../../Templates/');
    }

    /**
     * {@inheritdoc}
     **/
    public function getSource($name)
    {
        if (false === strstr($name, $this->delimiter)) {
            throw new \InvalidArgumentException(sprintf('The name parameter ("%s") was not of the format "{template_name}%s{format}.', $name, $this->delimiter));
        }
        list($template, $format) = explode($this->delimiter, $name, 2);

        return parent::getSource($template);
    }

    /**
     * {@inheritdoc}
     **/
    public function getCacheKey($name)
    {
        if (false === strstr($name, $this->delimiter)) {
            throw new \InvalidArgumentException(sprintf('The name parameter ("%s") was not of the format "{template_name}%s{format}.', $name, $this->delimiter));
        }
        list($template, $format) = explode($this->delimiter, $name, 2);

        return sprintf('%s%s%s', parent::getCacheKey($template), $this->delimiter, $format);
    }

    /**
     * {@inheritdoc}
     **/
    public function isFresh($name, $time)
    {
        if (false === strstr($name, $this->delimiter)) {
            throw new \InvalidArgumentException(sprintf('The name parameter ("%s") was not of the format "{template_name}%s{format}.', $name, $this->delimiter));
        }
        list($template, $format) = explode($this->delimiter, $name, 2);

        return parent::isFresh($template, $time);
    }
}
