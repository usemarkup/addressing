<?php

namespace Markup\Addressing\Tests\Element;

use Markup\Addressing\Element\HtmlElement;

/**
* A test for an object representing an HTML element.
*/
class HtmlElementTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $elementName = 'body';
        $element = new HtmlElement($elementName);
        $this->assertEquals($elementName, $element->getName());
    }

    public function testGetAttributes()
    {
        $attrs = array('class' => 'one two three', 'rel' => 'relative');
        $element = new HtmlElement('span', $attrs);
        $this->assertEquals($attrs, $element->getAttributes());
    }

    public function testIsClosingByDefault()
    {
        $closing = true;
        $element = new HtmlElement('span', array());
        $this->assertSame($closing, $element->isClosing());
    }

    public function testShouldBreakAfter()
    {
        $shouldBreakAfter = true;
        $element = new HtmlElement('span', array(), array('break_after' => true));
        $this->assertSame($shouldBreakAfter, $element->shouldBreakAfter());
    }

    public function testNotXmlStyleByDefault()
    {
        $element = new HtmlElement('span');
        $this->assertFalse($element->shouldUseXmlStyle());
    }

    public function testSetAsXmlStyle()
    {
        $element = new HtmlElement('span', array(), array('xml_style' => true));
        $this->assertTrue($element->shouldUseXmlStyle());
    }
}
