# MarkupAddressing

[![Build Status](https://api.travis-ci.org/usemarkup/addressing.png?branch=master)](http://travis-ci.org/usemarkup/addressing)

## About

This library provides formatting for international postal addresses.  It takes a common format of an address and renders it according to the rules set out in [Frank's Compulsive Guide To Postal Addresses](http://www.columbia.edu/~fdc/postal/).

## Limitations

At the current time, there are only definitions for: United Kingdom, Guernsey, Jersey, Isle of Man, Ireland, Sweden, Denmark,
Norway, Finland, Netherlands, Belgium, USA, Canada.  There are fallbacks in place for other countries.  Formats for other locations will be added soon, and PRs
are more than welcome!

This library is not currently usable by itself (a facade class is coming that will allow direct usage), but there is a Symfony2 bundle (markup/addressing-bundle) that provides easy use of the library.

## Usage

(Coming when a facade class is written to allow a stable method of direct usage.)

## License

Released under the MIT License. See LICENSE.
