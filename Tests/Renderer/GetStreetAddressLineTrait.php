<?php

namespace Markup\Addressing\Tests\Renderer;

trait GetStreetAddressLineTrait
{
    /**
     * Gets the numbered address line, counting from one.  If there is no address line for provided number, return null.
     *
     * @param  int $lineNumber
     * @return string|null
     **/
    public function getStreetAddressLine($lineNumber): ?string
    {
        $streetLines = $this->getStreetAddressLines();
        if (!isset($streetLines[$lineNumber-1])) {
            return null;
        }

        return $streetLines[$lineNumber-1];
    }
}
