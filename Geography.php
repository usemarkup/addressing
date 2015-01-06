<?php

namespace Markup\Addressing;

/**
 * Class with no dependencies that can provide certain specific pieces of geographical information/ tests.
 */
class Geography
{
    private static $euCountries = array('AT', 'BE', 'BG', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HR', 'HU', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'GB');

    private static $usStates = array(
        'AL' => "Alabama",
        'AK' => "Alaska",
        'AZ' => "Arizona",
        'AR' => "Arkansas",
        'CA' => "California",
        'CO' => "Colorado",
        'CT' => "Connecticut",
        'DE' => "Delaware",
        'DC' => "District Of Columbia",
        'FL' => "Florida",
        'GA' => "Georgia",
        'HI' => "Hawaii",
        'ID' => "Idaho",
        'IL' => "Illinois",
        'IN' => "Indiana",
        'IA' => "Iowa",
        'KS' => "Kansas",
        'KY' => "Kentucky",
        'LA' => "Louisiana",
        'ME' => "Maine",
        'MD' => "Maryland",
        'MA' => "Massachusetts",
        'MI' => "Michigan",
        'MN' => "Minnesota",
        'MS' => "Mississippi",
        'MO' => "Missouri",
        'MT' => "Montana",
        'NE' => "Nebraska",
        'NV' => "Nevada",
        'NH' => "New Hampshire",
        'NJ' => "New Jersey",
        'NM' => "New Mexico",
        'NY' => "New York",
        'NC' => "North Carolina",
        'ND' => "North Dakota",
        'OH' => "Ohio",
        'OK' => "Oklahoma",
        'OR' => "Oregon",
        'PA' => "Pennsylvania",
        'RI' => "Rhode Island",
        'SC' => "South Carolina",
        'SD' => "South Dakota",
        'TN' => "Tennessee",
        'TX' => "Texas",
        'UT' => "Utah",
        'VT' => "Vermont",
        'VA' => "Virginia",
        'WA' => "Washington",
        'WV' => "West Virginia",
        'WI' => "Wisconsin",
        'WY' => "Wyoming",
    );

    private static $canadaProvincesEn = array(
        "BC" => "British Columbia",
        "ON" => "Ontario",
        "NL" => "Newfoundland and Labrador",
        "NS" => "Nova Scotia",
        "PE" => "Prince Edward Island",
        "NB" => "New Brunswick",
        "QC" => "Quebec",
        "MB" => "Manitoba",
        "SK" => "Saskatchewan",
        "AB" => "Alberta",
        "NT" => "Northwest Territories",
        "NU" => "Nunavut",
        "YT" => "Yukon Territory",
    );

    private static $canadaProvincesFr = array(
        "AB" => "Alberta",
        "BC" => "Colombie-Britannique",
        "MB" => "Manitoba",
        "NB" => "Nouveau-Brunswick",
        "NL" => "Terre-Neuve-et-Labrador",
        "NS" => "Nouvelle-Écosse",
        "NT" => "Territoires du Nord-Ouest",
        "NU" => "Nunavut",
        "ON" => "Ontario",
        "PE" => "Île-du-Prince-Édouard",
        "QC" => "Québec",
        "SK" => "Saskatchewan",
        "YT" => "Yukon",
    );

    /**
     * Gets whether the country or address are in the EU.
     *
     * @param mixed $addressOrCountry
     * @return bool
     */
    public function checkInEu($addressOrCountry)
    {
        $country = (is_object($addressOrCountry) && method_exists($addressOrCountry, 'getCountry')) ? $addressOrCountry->getCountry() : $addressOrCountry;
        if (!is_string($country)) {
            return false;
        }

        return in_array($country, self::$euCountries);
    }

    /**
     * Gets the abbreviation for the provided state name, if this can be found - otherwise returns null.
     *
     * @param string $name
     * @return string|null
     */
    public function getUsStateAbbreviationForName($name)
    {
        if (!in_array($name, self::$usStates)) {
            return null;
        }

        return array_search($name, self::$usStates);
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getCanadianProvinceAbbreviationForName($name)
    {
        if (in_array($name, self::$canadaProvincesEn)) {
            return array_search($name, self::$canadaProvincesEn);
        }
        if (in_array($name, self::$canadaProvincesFr)) {
            return array_search($name, self::$canadaProvincesFr);
        }

        return null;
    }

    /**
     * @param string $state
     * @return bool
     */
    public function isUsStateAbbreviation($state)
    {
        return in_array($state, array_keys(self::$usStates));
    }

    /**
     * @param string $province
     * @return bool
     */
    public function isCanadianProvinceAbbreviation($province)
    {
        return in_array($province, array_keys(self::$canadaProvincesEn));
    }
}
