<?php

namespace Markup\Addressing\Tests;

use Markup\Addressing\Address;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    public function testAddress()
    {
        $country = 'GB';
        $streetLines = array(
            '999 Letsbe Avenue',
            'Anydistrict'
        );
        $locality = 'Anytown';
        $postalCode = 'AB1 2CD';
        $region = 'Anyshire';
        $recipient = 'Mr John Smith';
        $address = new Address(
            $country,
            $streetLines,
            $locality,
            $postalCode,
            $region,
            $recipient
        );
        $this->assertInstanceOf('Markup\Addressing\AddressInterface', $address);
        $this->assertEquals($country, $address->getCountry());
        $this->assertEquals($streetLines, $address->getStreetAddressLines());
        $this->assertEquals('Anydistrict', $address->getStreetAddressLine(2));
        $this->assertEquals($locality, $address->getLocality());
        $this->assertEquals($postalCode, $address->getPostalCode());
        $this->assertEquals($region, $address->getRegion());
        $this->assertEquals($recipient, $address->getRecipient());
        $this->assertTrue($address->hasRecipient());
    }
}
