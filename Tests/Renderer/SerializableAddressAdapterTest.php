<?php

namespace Renderer;

use Markup\Addressing\Address;
use Markup\Addressing\AddressInterface;
use Markup\Addressing\RenderableAddressInterface;
use Markup\Addressing\Renderer\SerializableAddressAdapter;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class SerializableAddressAdapterTest extends MockeryTestCase
{
    /**
     * @var AddressInterface|m\MockInterface
     */
    private $address;

    /**
     * A callable that takes an ISO3166-2 country representation and a locale, and returns the country name.
     *
     * @var callable
     */
    private $countryNameRenderer;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var SerializableAddressAdapter
     */
    private $adapter;

    protected function setUp()
    {
        $this->address = m::mock(AddressInterface::class);
        $this->locale = 'fr';
        $this->countryNameRenderer = function ($iso3166) {
            return implode(';', [$iso3166, $this->locale]);
        };
        $this->adapter = new SerializableAddressAdapter($this->address, $this->countryNameRenderer);
    }

    public function testIsRenderableAddress()
    {
        $this->assertInstanceOf(RenderableAddressInterface::class, $this->adapter);
    }

    public function testIsJsonSerializable()
    {
        $this->assertInstanceOf(\JsonSerializable::class, $this->adapter);
    }

    public function testStandardGetters()
    {
        $recipient = 'Anders Andersson';
        $this->mockAddressMethod('getRecipient', $recipient);
        $this->assertEquals($recipient, $this->adapter->getRecipient());
        $streetAddressLines = ['23 Havering Avenue', 'Candleford'];
        $this->mockAddressMethod('getStreetAddressLines', $streetAddressLines);
        $this->assertEquals($streetAddressLines, $this->adapter->getStreetAddressLines());
        $this->assertEquals('Candleford', $this->adapter->getStreetAddressLine(2));
        $locality = 'Salisbury';
        $this->mockAddressMethod('getLocality', $locality);
        $this->assertEquals($locality, $this->adapter->getLocality());
        $region = 'Wiltshire';
        $this->mockAddressMethod('getRegion', $region);
        $this->assertEquals($region, $this->adapter->getRegion());
        $postalCode = 'A12 3BC';
        $this->mockAddressMethod('getPostalCode', $postalCode);
        $this->assertEquals($postalCode, $this->adapter->getPostalCode());
        $code = 'GB';
        $this->mockAddressMethod('getCountry', $code);
        $this->assertEquals($code, $this->adapter->getCountry());
    }

    public function testRenderableMethodsWithNonRenderableAddress()
    {
        $this->assertNull($this->adapter->getPrerenderedLines());
        $this->assertFalse($this->adapter->hasPrerenderedLines());
    }

    public function testRenderableMethodsWithRenderableAddress()
    {
        $renderable = m::mock(RenderableAddressInterface::class);
        $adapter = new SerializableAddressAdapter($renderable, $this->countryNameRenderer);
        $renderedLines = ['1', '2', '3'];
        $this->mockAddressMethod('getPrerenderedLines', $renderedLines, $renderable);
        $this->mockAddressMethod('hasPrerenderedLines', true, $renderable);
        $this->assertEquals($renderedLines, $adapter->getPrerenderedLines());
        $this->assertTrue($adapter->hasPrerenderedLines());
    }

    public function testSerialized()
    {
        $recipient = 'Joe Smith';
        $streetAddressLines = ['45 Götgatan', 'Södermalm'];
        $locality = 'Stockholm';
        $postalCode = '117 56';
        $country = 'SE';
        $address = new Address(
            $country,
            $streetAddressLines,
            $locality,
            $postalCode,
            null,
            $recipient
        );
        $adapter = new SerializableAddressAdapter($address, $this->countryNameRenderer);
        $expected = [
            'recipient' => $recipient,
            'streetAddressLines' => $streetAddressLines,
            'locality' => $locality,
            'postalCode' => $postalCode,
            'region' => '',
            'country' => $country,
            'countryName' => 'SE;fr',
        ];
        $this->assertEquals($expected, $adapter->jsonSerialize());
    }

    private function mockAddressMethod($method, $return, m\MockInterface $mock = null)
    {
        $mock = $mock ?: $this->address;
        $mock
            ->shouldReceive($method)
            ->andReturn($return);
    }
}
