<?php

namespace Markup\Addressing\Tests\Twig\Node;

use Markup\Addressing\Twig\Node\SuffixHtmlElementNode;

/**
* A test for a Twig node representing a text body suffixed by a self-closing HTML element.
*/
class SuffixHtmlElementNodeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->el = $this->getMockBuilder('Markup\Addressing\Element\HtmlElement')
            ->disableOriginalConstructor()
            ->getMock();
        $this->body = $this->getMock('Twig_NodeInterface');
        $this->lineNumber = 42;
        $this->tagName = 'break';
        $this->node = new SuffixHtmlElementNode($this->el, $this->body, $this->lineNumber, $this->tagName);
    }

    public function testIsTwigNode()
    {
        $this->assertTrue($this->node instanceof \Twig_NodeInterface);
    }

    public function testSimpleHtmlElement()
    {
        $compiler = $this->getMockBuilder('Twig_Compiler')
            ->disableOriginalConstructor()
            ->getMock();
        $this->el
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('br'));
        $this->el
            ->expects($this->any())
            ->method('getAttributes')
            ->will($this->returnValue([]));
        $compiler
            ->expects($this->at(0))
            ->method('addDebugInfo')
            ->with($this->equalTo($this->node))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(1))
            ->method('raw')
            ->with($this->equalTo('echo "<br>";'))
            ->will($this->returnSelf());
        $this->node->compile($compiler);
    }

    public function testXmlStyleHtmlElement()
    {
        $compiler = $this->getMockBuilder('Twig_Compiler')
            ->disableOriginalConstructor()
            ->getMock();
        $this->el
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('br'));
        $this->el
            ->expects($this->any())
            ->method('getAttributes')
            ->will($this->returnValue([]));
        $this->el
            ->expects($this->any())
            ->method('shouldUseXmlStyle')
            ->will($this->returnValue(true));
        $compiler
            ->expects($this->at(0))
            ->method('addDebugInfo')
            ->with($this->equalTo($this->node))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(1))
            ->method('raw')
            ->with($this->equalTo('echo "<br />";'))
            ->will($this->returnSelf());
        $this->node->compile($compiler);
    }

    public function testSimpleHtmlElementWithAttributes()
    {
        $compiler = $this->getMockBuilder('Twig_Compiler')
            ->disableOriginalConstructor()
            ->getMock();
        $this->el
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('br'));
        $this->el
            ->expects($this->any())
            ->method('getAttributes')
            ->will($this->returnValue(['class' => 'breaky']));
        $compiler
            ->expects($this->at(0))
            ->method('addDebugInfo')
            ->with($this->equalTo($this->node))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(1))
            ->method('raw')
            ->with($this->equalTo('echo "<br class=\"breaky\">";'))
            ->will($this->returnSelf());
        $this->node->compile($compiler);
    }
}
