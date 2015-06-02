<?php

namespace Markup\Addressing\Parsing;

class StreetAddressParser
{
    public function parseLines(array $lines)
    {
        //strip out any empty lines
        $lines = array_values(array_filter($lines));

        //case where there are no lines
        if (count($lines) === 0) {
            return new ParsedStreetAddress();
        }

        //cases where first line is street line
        $line = $lines[0];
        if (preg_match('/^(\d+\w*)\s(.*)$/', $line, $matches)) {
            return new ParsedStreetAddress($matches[2], $matches[1], $this->getDistrictForLinesGivenStreetLine($lines, 0));
        } elseif (preg_match('/^(.*)\s(\d+\w*)$/', $line, $matches)) {
            return new ParsedStreetAddress($matches[1], $matches[2], $this->getDistrictForLinesGivenStreetLine($lines, 0));
        }

        //case where street number is on one line, street name on next
        if (count($lines) >= 2 && preg_match('/^(\d+\S*)$/', $line[0], $matches)) {
            return new ParsedStreetAddress($lines[1], $lines[0], $this->getDistrictForLinesGivenStreetLine($lines, 1));
        }

        //fallback
        return new ParsedStreetAddress($lines[0], null, $this->getDistrictForLinesGivenStreetLine($lines, 0));
    }

    private function getDistrictForLinesGivenStreetLine(array $lines, $streetLineIndex)
    {
        if (count($lines) - 1 === $streetLineIndex) {
            return null;
        }

        return array_pop($lines);//not a reference, so mutation is all good
    }
}
