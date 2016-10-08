<?php

namespace Markup\Addressing\Tests\Twig\Node;

use Markup\Addressing\Twig\Node\HtmlElementNode;

/**
* A test for a Twig node representing an HTML element.
*/
class HtmlElementNodeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->el = $this->getMockBuilder('Markup\Addressing\Element\HtmlElement')
        ->disableOriginalConstructor()
        ->getMock();
        $this->body = $this->getMock('Twig_NodeInterface');
        $this->lineNumber = 42;
        $this->tagName = 'streetline';
        $this->node = new HtmlElementNode($this->el, $this->body, $this->lineNumber, $this->tagName);
    }

    public function testIsTwigNode()
    {
        $this->assertTrue($this->node instanceof \Twig_NodeInterface);
    }

    public function testCompileWithSimpleNonClosingElement()
    {
        $compiler = $this->getMockBuilder('Twig_Compiler')
            ->disableOriginalConstructor()
            ->getMock();
        $this->el
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('span'));
        $this->el
            ->expects($this->any())
            ->method('getAttributes')
            ->will($this->returnValue([]));
        $compiler
            ->expects($this->once())
            ->method('addDebugInfo')
            ->with($this->equalTo($this->node))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->once())
            ->method('raw')
            ->with($this->equalTo('echo "<span>";'))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->once())
            ->method('subcompile')
            ->with($this->equalTo($this->body))
            ->will($this->returnSelf());
        $this->node->compile($compiler);
    }

    public function testCompileWithSimpleClosingElement()
    {
        $compiler = $this->getMockBuilder('Twig_Compiler')
            ->disableOriginalConstructor()
            ->getMock();
        $this->el
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('span'));
        $this->el
            ->expects($this->any())
            ->method('getAttributes')
            ->will($this->returnValue([]));
        $this->el
            ->expects($this->any())
            ->method('isClosing')
            ->will($this->returnValue(true));
        $compiler
            ->expects($this->at(0))
            ->method('addDebugInfo')
            ->with($this->equalTo($this->node))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(1))
            ->method('raw')
            ->with($this->equalTo('echo "<span>";'))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(2))
            ->method('subcompile')
            ->with($this->equalTo($this->body))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(3))
            ->method('raw')
            ->with($this->equalTo('echo "</span>";'))
            ->will($this->returnSelf());
        $this->node->compile($compiler);
    }

    public function testCompileWithSimpleClosingElementAndBreakAfter()
    {
        $compiler = $this->getMockBuilder('Twig_Compiler')
            ->disableOriginalConstructor()
            ->getMock();
        $this->el
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('span'));
        $this->el
            ->expects($this->any())
            ->method('getAttributes')
            ->will($this->returnValue([]));
        $this->el
            ->expects($this->any())
            ->method('isClosing')
            ->will($this->returnValue(true));
        $this->el
            ->expects($this->any())
            ->method('shouldBreakAfter')
            ->will($this->returnValue(true));
        $compiler
            ->expects($this->at(0))
            ->method('addDebugInfo')
            ->with($this->equalTo($this->node))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(1))
            ->method('raw')
            ->with($this->equalTo('echo "<span>";'))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(2))
            ->method('subcompile')
            ->with($this->equalTo($this->body))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(3))
            ->method('raw')
            ->with($this->equalTo('echo "</span>";'))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->at(4))
            ->method('raw')
            ->with($this->equalTo('echo "\n";'))
            ->will($this->returnSelf());
        $this->node->compile($compiler);
    }

    public function testCompileWithNonClosingElementWithAttributes()
    {
        $compiler = $this->getMockBuilder('Twig_Compiler')
            ->disableOriginalConstructor()
            ->getMock();
        $this->el
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('span'));
        $attributes = [
            'class' => 'element one',
            'id' => 'identifier',
        ];
        $this->el
            ->expects($this->any())
            ->method('getAttributes')
            ->will($this->returnValue($attributes));
        $compiler
            ->expects($this->once())
            ->method('addDebugInfo')
            ->with($this->equalTo($this->node))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->once())
            ->method('raw')
            ->with($this->equalTo('echo "<span class=\"element one\" id=\"identifier\">";'))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->once())
            ->method('subcompile')
            ->with($this->equalTo($this->body))
            ->will($this->returnSelf());
        $this->node->compile($compiler);
    }

    public function testCompileWithNonClosingElementWithAttributesIncludingUnary()
    {
        $compiler = $this->getMockBuilder('Twig_Compiler')
            ->disableOriginalConstructor()
            ->getMock();
        $this->el
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('span'));
        $attributes = [
            'class' => 'adr',
            'itemscope' => null,
            'itemtype' => 'http://schema.org/PostalAddress',
        ];
        $this->el
            ->expects($this->any())
            ->method('getAttributes')
            ->will($this->returnValue($attributes));
        $compiler
            ->expects($this->once())
            ->method('addDebugInfo')
            ->with($this->equalTo($this->node))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->once())
            ->method('raw')
            ->with($this->equalTo('echo "<span class=\"adr\" itemscope itemtype=\"http://schema.org/PostalAddress\">";'))
            ->will($this->returnSelf());
        $compiler
            ->expects($this->once())
            ->method('subcompile')
            ->with($this->equalTo($this->body))
            ->will($this->returnSelf());
        $this->node->compile($compiler);
    }
}
