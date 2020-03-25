<?php

namespace Markup\Addressing\Iso;

/**
 * An object that can convert ISO3166 alpha-2 representations to alpha-3, and vice versa.
 */
class Iso3166Converter
{
    /**
     * @var array
     */
    private static $codes = [
        'AD' => 'AND',//Andorra
        'AE' => 'ARE',//United Arab Emirates
        'AF' => 'AFG',//Afghanistan
        'AG' => 'ATG',//Antigua and Barbuda
        'AI' => 'AIA',//Anguilla
        'AL' => 'ALB',//Albania
        'AM' => 'ARM',//Armenia
        'AO' => 'AGO',//Angola
        'AQ' => 'ATA',//Antarctica
        'AR' => 'ARG',//Argentina
        'AS' => 'ASM',//American Samoa
        'AT' => 'AUT',//Austria
        'AU' => 'AUS',//Australia
        'AW' => 'ABW',//Aruba
        'AX' => 'ALA',//Åland Islands
        'AZ' => 'AZE',//Azerbaijan
        'BA' => 'BIH',//Bosnia and Herzegovina
        'BB' => 'BRB',//Barbados
        'BD' => 'BGD',//Bangladesh
        'BE' => 'BEL',//Belgium
        'BF' => 'BFA',//Burkina Faso
        'BG' => 'BGR',//Bulgaria
        'BH' => 'BHR',//Bahrain
        'BI' => 'BDI',//Burundi
        'BJ' => 'BEN',//Benin
        'BL' => 'BLM',//Saint Barthélemy
        'BM' => 'BMU',//Bermuda
        'BN' => 'BRN',//Brunei Darussalam
        'BO' => 'BOL',//Bolivia, Plurinational State of
        'BQ' => 'BES',//Bonaire, Sint Eustatius and Saba
        'BR' => 'BRA',//Brazil
        'BS' => 'BHS',//Bahamas
        'BT' => 'BTN',//Bhutan
        'BV' => 'BVT',//Bouvet Island
        'BW' => 'BWA',//Botswana
        'BY' => 'BLR',//Belarus
        'BZ' => 'BLZ',//Belize
        'CA' => 'CAN',//Canada
        'CC' => 'CCK',//Cocos (Keeling) Islands
        'CD' => 'COD',//Congo, the Democratic Republic of the
        'CF' => 'CAF',//Central African Republic
        'CG' => 'COG',//Congo
        'CH' => 'CHE',//Switzerland
        'CI' => 'CIV',//Côte d'Ivoire
        'CK' => 'COK',//Cook Islands
        'CL' => 'CHL',//Chile
        'CM' => 'CMR',//Cameroon
        'CN' => 'CHN',//China
        'CO' => 'COL',//Colombia
        'CR' => 'CRI',//Costa Rica
        'CU' => 'CUB',//Cuba
        'CV' => 'CPV',//Cabo Verde
        'CW' => 'CUW',//Curaçao
        'CX' => 'CXR',//Christmas Island
        'CY' => 'CYP',//Cyprus
        'CZ' => 'CZE',//Czech Republic
        'DE' => 'DEU',//Germany
        'DJ' => 'DJI',//Djibouti
        'DK' => 'DNK',//Denmark
        'DM' => 'DMA',//Dominica
        'DO' => 'DOM',//Dominican Republic
        'DZ' => 'DZA',//Algeria
        'EC' => 'ECU',//Ecuador
        'EE' => 'EST',//Estonia
        'EG' => 'EGY',//Egypt
        'EH' => 'ESH',//Western Sahara
        'ER' => 'ERI',//Eritrea
        'ES' => 'ESP',//Spain
        'ET' => 'ETH',//Ethiopia
        'FI' => 'FIN',//Finland
        'FJ' => 'FJI',//Fiji
        'FK' => 'FLK',//Falkland Islands (Malvinas)
        'FM' => 'FSM',//Micronesia, Federated States of
        'FO' => 'FRO',//Faroe Islands
        'FR' => 'FRA',//France
        'GA' => 'GAB',//Gabon
        'GB' => 'GBR',//United Kingdom
        'GD' => 'GRD',//Grenada
        'GE' => 'GEO',//Georgia
        'GF' => 'GUF',//French Guiana
        'GG' => 'GGY',//Guernsey
        'GH' => 'GHA',//Ghana
        'GI' => 'GIB',//Gibraltar
        'GL' => 'GRL',//Greenland
        'GM' => 'GMB',//Gambia
        'GN' => 'GIN',//Guinea
        'GP' => 'GLP',//Guadeloupe
        'GQ' => 'GNQ',//Equatorial Guinea
        'GR' => 'GRC',//Greece
        'GS' => 'SGS',//South Georgia and the South Sandwich Islands
        'GT' => 'GTM',//Guatemala
        'GU' => 'GUM',//Guam
        'GW' => 'GNB',//Guinea-Bissau
        'GY' => 'GUY',//Guyana
        'HK' => 'HKG',//Hong Kong
        'HM' => 'HMD',//Heard Island and McDonald Islands
        'HN' => 'HND',//Honduras
        'HR' => 'HRV',//Croatia
        'HT' => 'HTI',//Haiti
        'HU' => 'HUN',//Hungary
        'ID' => 'IDN',//Indonesia
        'IE' => 'IRL',//Ireland
        'IL' => 'ISR',//Israel
        'IM' => 'IMN',//Isle of Man
        'IN' => 'IND',//India
        'IO' => 'IOT',//British Indian Ocean Territory
        'IQ' => 'IRQ',//Iraq
        'IR' => 'IRN',//Iran, Islamic Republic of
        'IS' => 'ISL',//Iceland
        'IT' => 'ITA',//Italy
        'JE' => 'JEY',//Jersey
        'JM' => 'JAM',//Jamaica
        'JO' => 'JOR',//Jordan
        'JP' => 'JPN',//Japan
        'KE' => 'KEN',//Kenya
        'KG' => 'KGZ',//Kyrgyzstan
        'KH' => 'KHM',//Cambodia
        'KI' => 'KIR',//Kiribati
        'KM' => 'COM',//Comoros
        'KN' => 'KNA',//Saint Kitts and Nevis
        'KP' => 'PRK',//Korea, Democratic People's Republic of
        'KR' => 'KOR',//Korea, Republic of
        'KW' => 'KWT',//Kuwait
        'KY' => 'CYM',//Cayman Islands
        'KZ' => 'KAZ',//Kazakhstan
        'LA' => 'LAO',//Lao People's Democratic Republic
        'LB' => 'LBN',//Lebanon
        'LC' => 'LCA',//Saint Lucia
        'LI' => 'LIE',//Liechtenstein
        'LK' => 'LKA',//Sri Lanka
        'LR' => 'LBR',//Liberia
        'LS' => 'LSO',//Lesotho
        'LT' => 'LTU',//Lithuania
        'LU' => 'LUX',//Luxembourg
        'LV' => 'LVA',//Latvia
        'LY' => 'LBY',//Libya
        'MA' => 'MAR',//Morocco
        'MC' => 'MCO',//Monaco
        'MD' => 'MDA',//Moldova, Republic of
        'ME' => 'MNE',//Montenegro
        'MF' => 'MAF',//Saint Martin (French part)
        'MG' => 'MDG',//Madagascar
        'MH' => 'MHL',//Marshall Islands
        'MK' => 'MKD',//Macedonia, the former Yugoslav Republic of
        'ML' => 'MLI',//Mali
        'MM' => 'MMR',//Myanmar
        'MN' => 'MNG',//Mongolia
        'MO' => 'MAC',//Macao
        'MP' => 'MNP',//Northern Mariana Islands
        'MQ' => 'MTQ',//Martinique
        'MR' => 'MRT',//Mauritania
        'MS' => 'MSR',//Montserrat
        'MT' => 'MLT',//Malta
        'MU' => 'MUS',//Mauritius
        'MV' => 'MDV',//Maldives
        'MW' => 'MWI',//Malawi
        'MX' => 'MEX',//Mexico
        'MY' => 'MYS',//Malaysia
        'MZ' => 'MOZ',//Mozambique
        'NA' => 'NAM',//Namibia
        'NC' => 'NCL',//New Caledonia
        'NE' => 'NER',//Niger
        'NF' => 'NFK',//Norfolk Island
        'NG' => 'NGA',//Nigeria
        'NI' => 'NIC',//Nicaragua
        'NL' => 'NLD',//Netherlands
        'NO' => 'NOR',//Norway
        'NP' => 'NPL',//Nepal
        'NR' => 'NRU',//Nauru
        'NU' => 'NIU',//Niue
        'NZ' => 'NZL',//New Zealand
        'OM' => 'OMN',//Oman
        'PA' => 'PAN',//Panama
        'PE' => 'PER',//Peru
        'PF' => 'PYF',//French Polynesia
        'PG' => 'PNG',//Papua New Guinea
        'PH' => 'PHL',//Philippines
        'PK' => 'PAK',//Pakistan
        'PL' => 'POL',//Poland
        'PM' => 'SPM',//Saint Pierre and Miquelon
        'PN' => 'PCN',//Pitcairn
        'PR' => 'PRI',//Puerto Rico
        'PS' => 'PSE',//Palestine, State of
        'PT' => 'PRT',//Portugal
        'PW' => 'PLW',//Palau
        'PY' => 'PRY',//Paraguay
        'QA' => 'QAT',//Qatar
        'RE' => 'REU',//Réunion
        'RO' => 'ROU',//Romania
        'RS' => 'SRB',//Serbia
        'RU' => 'RUS',//Russian Federation
        'RW' => 'RWA',//Rwanda
        'SA' => 'SAU',//Saudi Arabia
        'SB' => 'SLB',//Solomon Islands
        'SC' => 'SYC',//Seychelles
        'SD' => 'SDN',//Sudan
        'SE' => 'SWE',//Sweden
        'SG' => 'SGP',//Singapore
        'SH' => 'SHN',//Saint Helena, Ascension and Tristan da Cunha
        'SI' => 'SVN',//Slovenia
        'SJ' => 'SJM',//Svalbard and Jan Mayen
        'SK' => 'SVK',//Slovakia
        'SL' => 'SLE',//Sierra Leone
        'SM' => 'SMR',//San Marino
        'SN' => 'SEN',//Senegal
        'SO' => 'SOM',//Somalia
        'SR' => 'SUR',//Suriname
        'SS' => 'SSD',//South Sudan
        'ST' => 'STP',//Sao Tome and Principe
        'SV' => 'SLV',//El Salvador
        'SX' => 'SXM',//Sint Maarten (Dutch part)
        'SY' => 'SYR',//Syrian Arab Republic
        'SZ' => 'SWZ',//Swaziland
        'TC' => 'TCA',//Turks and Caicos Islands
        'TD' => 'TCD',//Chad
        'TF' => 'ATF',//French Southern Territories
        'TG' => 'TGO',//Togo
        'TH' => 'THA',//Thailand
        'TJ' => 'TJK',//Tajikistan
        'TK' => 'TKL',//Tokelau
        'TL' => 'TLS',//Timor-Leste
        'TM' => 'TKM',//Turkmenistan
        'TN' => 'TUN',//Tunisia
        'TO' => 'TON',//Tonga
        'TR' => 'TUR',//Turkey
        'TT' => 'TTO',//Trinidad and Tobago
        'TV' => 'TUV',//Tuvalu
        'TW' => 'TWN',//Taiwan, Province of China
        'TZ' => 'TZA',//Tanzania, United Republic of
        'UA' => 'UKR',//Ukraine
        'UG' => 'UGA',//Uganda
        'UM' => 'UMI',//United States Minor Outlying Islands
        'US' => 'USA',//United States
        'UY' => 'URY',//Uruguay
        'UZ' => 'UZB',//Uzbekistan
        'VA' => 'VAT',//Holy See (Vatican City State)
        'VC' => 'VCT',//Saint Vincent and the Grenadines
        'VE' => 'VEN',//Venezuela, Bolivarian Republic of
        'VG' => 'VGB',//Virgin Islands, British
        'VI' => 'VIR',//Virgin Islands, U.S.
        'VN' => 'VNM',//Viet Nam
        'VU' => 'VUT',//Vanuatu
        'WF' => 'WLF',//Wallis and Futuna
        'WS' => 'WSM',//Samoa
        'YE' => 'YEM',//Yemen
        'YT' => 'MYT',//Mayotte
        'ZA' => 'ZAF',//South Africa
        'ZM' => 'ZMB',//Zambia
        'ZW' => 'ZWE',//Zimbabwe
    ];

    /**
     * Gets the ISO3166 alpha-3 code that corresponds to the provided alpha-2 code.
     *
     * @param string $alpha2
     * @return string|null
     */
    public function convertAlpha2ToAlpha3($alpha2)
    {
        if (!isset(self::$codes[$alpha2])) {
            return null;
        }

        return self::$codes[$alpha2];
    }

    /**
     * Gets the ISO3166 alpha-2 code that corresponds to the provided alpha-3 code.
     *
     * @param string $alpha3
     * @return string|null
     */
    public function convertAlpha3ToAlpha2($alpha3)
    {
        $alpha2 = array_search($alpha3, self::$codes);
        if (false === $alpha2) {
            return null;
        }

        return (string) $alpha2;
    }
} 
