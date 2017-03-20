<?php

namespace Markup\Addressing\Tests\Renderer;

use Markup\Addressing\AddressInterface;
use Markup\Addressing\Provider\CountryNameProvider;
use Markup\Addressing\Provider\CountryNameProviderInterface;
use Markup\Addressing\Provider\IntlAddressHandlebarsTemplateProvider;
use Markup\Addressing\Provider\IntlAddressTemplateProviderInterface;
use Markup\Addressing\Renderer\AddressRenderer;
use Markup\Addressing\Renderer\AddressRendererInterface;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;

/**
* A test for an address renderer object.
*/
class AddressRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    private $cacheDir;

    /**
     * @var IntlAddressTemplateProviderInterface
     */
    private $templateProvider;

    /**
     * @var CountryNameProviderInterface
     */
    private $countryNameProvider;

    /**
     * @var AddressRenderer
     */
    private $renderer;

    protected function setUp()
    {
        $locale = 'en_GB';
        $this->cacheDir = vfsStream::setup();
        $this->templateProvider = new IntlAddressHandlebarsTemplateProvider(
            ['gb', 'se'],
            $this->cacheDir->url().'/'
        );
        $this->countryNameProvider = new CountryNameProvider(function () use ($locale) {
            return $locale;
        });
        $this->renderer = new AddressRenderer(
            $this->templateProvider,
            $this->countryNameProvider,
            $locale
        );
    }

    public function testIsAddressRenderer()
    {
        $this->assertInstanceOf(AddressRendererInterface::class, $this->renderer);
    }

    public function testRenderPlaintext()
    {
        $expected = "Test Recipient
23 Main Street
Anytown
Anyshire
AB1 2CD
United Kingdom";
        $rendered = $this->renderer->render($this->getGbAddress(), ['format' => 'plaintext']);
        $this->assertEquals($expected, $rendered);
    }

    public function testRenderHtml()
    {
        $expected = '<p class="adr" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="name" itemscope itemtype="http://schema.org/Person" class="recipient">Test Recipient</span><br><span class="street-address" itemprop="streetAddress">23 Main Street<br></span><span class="locality" itemprop="addressLocality">Anytown</span><br><span class="region" itemprop="addressRegion">Anyshire</span><br><span class="postal-code" itemprop="postalCode">AB1 2CD</span><br><span class="country-name" itemprop="addressCountry" itemscope itemtype="http://schema.org/Country">United Kingdom</span></p>';
        $rendered = $this->renderer->render($this->getGbAddress(), ['format' => 'html']);
        $this->assertEquals($expected, $rendered);
    }

    public function testRenderCommaSeparated()
    {
        $expected = 'Test Recipient, 23 Main Street, Anytown, Anyshire, AB1 2CD, United Kingdom';
        $rendered = $this->renderer->render($this->getGbAddress(), ['format' => 'comma_separated']);
        $this->assertEquals($expected, $rendered);
    }

    public function testRenderSwedishAddress()
    {
        $expected = 'Lars Larsson, Storgatan 23, Lillastad, 775 77  MALMÖ, Sweden';
        $rendered = $this->renderer->render($this->getSeAddress(), ['format' => 'comma_separated']);
        $this->assertEquals($expected, $rendered);
    }

    public function testRenderFrenchAddress()
    {
        $expected = 'M Dommage, Rue de la Rue 24, 75006  PARIS, Frankreich';
        $locale = 'de_DE';
        $renderer = new AddressRenderer(
            $this->templateProvider,
            $this->countryNameProvider,
            $locale
        );
        $rendered = $renderer->render($this->getFrAddress(), ['format' => 'comma_separated']);
        $this->assertEquals($expected, $rendered);
    }

    /**
     * @var AddressInterface
     */
    private function getGbAddress()
    {
        return new TestGbAddress();
    }

    private function getSeAddress()
    {
        return new TestSeAddress();
    }

    private function getFrAddress()
    {
        return new TestFrAddress();
    }
}
