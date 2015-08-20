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

        $getDistrict = function (array $lines, $streetLineIndex) {
            if (count($lines) - 1 === $streetLineIndex) {
                return null;
            }

            return array_pop($lines);//not a reference, so mutation is all good
        };

        $trim = function ($string) {
            return trim($string, ',');
        };

        $that = $this;

        $parseOutAddressWithNumberBefore = function ($line, $index) use ($lines, $trim, $getDistrict, $that) {
            if (preg_match('/^(\d+\s?[[:upper:]\d\-\/]{0,4})\s(.*)$/', $line, $matches)) {
                $houseNumberParts = $that->parseHouseNumberParts($matches[1]);

                return new ParsedStreetAddress(
                    $trim($matches[2]),
                    $trim($matches[1]),
                    $getDistrict($lines, $index),
                    $houseNumberParts['without_addition'],
                    $houseNumberParts['addition']
                );
            }
        };
        $parseOutAddressWithNumberAfter = function ($line, $index) use ($lines, $trim, $getDistrict, $that) {
            if (preg_match('/^(.*)\s(\d+\s?[\w\-\/]*)$/', $line, $matches)) {
                $houseNumberParts = $that->parseHouseNumberParts($matches[2]);

                return new ParsedStreetAddress(
                    $trim($matches[1]),
                    $trim($matches[2]),
                    $getDistrict($lines, $index),
                    $houseNumberParts['without_addition'],
                    $houseNumberParts['addition']
                );
            }
        };
        $parsers = array($parseOutAddressWithNumberBefore, $parseOutAddressWithNumberAfter);

        foreach ($lines as $index => $line) {
            foreach ($parsers as $parser) {
                $parsed = $parser($line, $index);
                if ($parsed) {
                    return $parsed;
                }
            }
        }

        //case where street number is on one line, street name on next
        if (count($lines) >= 2 && preg_match('/^(\d+\S*)$/', $lines[0], $matches)) {
            $houseNumberParts = $this->parseHouseNumberParts($lines[0]);

            return new ParsedStreetAddress(
                $lines[1],
                $lines[0],
                $getDistrict($lines, 1),
                $houseNumberParts['without_addition'],
                $houseNumberParts['addition']
            );
        }

        //fallback
        return new ParsedStreetAddress($lines[0], null, $getDistrict($lines, 0));
    }

    /**
     * @param string $houseNumber
     * @return array with members 'original', 'without_addition' and 'addition' - use nulls rather than empty strings
     */
    public function parseHouseNumberParts($houseNumber)
    {
        preg_match('/^(\d+)(.*)$/', $houseNumber, $matches);

        return array(
            'original' => $houseNumber,
            'without_addition' => (!empty($matches[1])) ? $matches[1] : null,
            'addition' => (!empty($matches[2])) ? trim($matches[2]) : null,
        );
    }
}
