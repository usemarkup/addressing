<?php

namespace Markup\Addressing\Parsing;

class StreetAddressParser
{
    /**
     * @param array $lines
     * @return ParsedStreetAddressInterface
     */
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
        if (preg_match('/^(\d+\s?[[:upper:]\d\-\/]{0,4})\s(.*)$/', $line, $matches)) {
            $houseNumberParts = $this->parseHouseNumberParts($matches[1]);

            return new ParsedStreetAddress(
                $matches[2],
                $matches[1],
                $this->getDistrictForLinesGivenStreetLine($lines, 0),
                $houseNumberParts['without_addition'],
                $houseNumberParts['addition']
            );
        } elseif (preg_match('/^(.*)\s(\d+\s?[\w\-\/]*)$/', $line, $matches)) {
            $houseNumberParts = $this->parseHouseNumberParts($matches[2]);

            return new ParsedStreetAddress(
                $matches[1],
                $matches[2],
                $this->getDistrictForLinesGivenStreetLine($lines, 0),
                $houseNumberParts['without_addition'],
                $houseNumberParts['addition']
            );
        }

        //case where street number is on one line, street name on next
        if (count($lines) >= 2 && preg_match('/^(\d+\S*)$/', $line[0], $matches)) {
            $houseNumberParts = $this->parseHouseNumberParts($lines[0]);

            return new ParsedStreetAddress(
                $lines[1],
                $lines[0],
                $this->getDistrictForLinesGivenStreetLine($lines, 1),
                $houseNumberParts['without_addition'],
                $houseNumberParts['addition']
            );
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

    /**
     * @param string $houseNumber
     * @return array with members 'original', 'without_addition' and 'addition' - use nulls rather than empty strings
     */
    private function parseHouseNumberParts($houseNumber)
    {
        preg_match('/^(\d+)(.*)$/', $houseNumber, $matches);

        return array(
            'original' => $houseNumber,
            'without_addition' => (!empty($matches[1])) ? $matches[1] : null,
            'addition' => (!empty($matches[2])) ? trim($matches[2]) : null,
        );
    }
}
