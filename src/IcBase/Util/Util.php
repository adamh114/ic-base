<?php

namespace IcBase\Util;

class Util
{
    public static function normalizeKey($key)
    {
        return str_replace(array('/', '\\', '.'), '_', $key);
    }

    public static function getUsStates()
    {
        return array(
            'AL'=>"Alabama",
            'AK'=>"Alaska",
            'AZ'=>"Arizona",
            'AR'=>"Arkansas",
            'CA'=>"California",
            'CO'=>"Colorado",
            'CT'=>"Connecticut",
            'DE'=>"Delaware",
            'DC'=>"District Of Columbia",
            'FL'=>"Florida",
            'GA'=>"Georgia",
            'HI'=>"Hawaii",
            'ID'=>"Idaho",
            'IL'=>"Illinois",
            'IN'=>"Indiana",
            'IA'=>"Iowa",
            'KS'=>"Kansas",
            'KY'=>"Kentucky",
            'LA'=>"Louisiana",
            'ME'=>"Maine",
            'MD'=>"Maryland",
            'MA'=>"Massachusetts",
            'MI'=>"Michigan",
            'MN'=>"Minnesota",
            'MS'=>"Mississippi",
            'MO'=>"Missouri",
            'MT'=>"Montana",
            'NE'=>"Nebraska",
            'NV'=>"Nevada",
            'NH'=>"New Hampshire",
            'NJ'=>"New Jersey",
            'NM'=>"New Mexico",
            'NY'=>"New York",
            'NC'=>"North Carolina",
            'ND'=>"North Dakota",
            'OH'=>"Ohio",
            'OK'=>"Oklahoma",
            'OR'=>"Oregon",
            'PA'=>"Pennsylvania",
            'PR'=>"Puerto Rico",
            'RI'=>"Rhode Island",
            'SC'=>"South Carolina",
            'SD'=>"South Dakota",
            'TN'=>"Tennessee",
            'TX'=>"Texas",
            'UT'=>"Utah",
            'VT'=>"Vermont",
            'VA'=>"Virginia",
            'WA'=>"Washington",
            'WV'=>"West Virginia",
            'WI'=>"Wisconsin",
            'WY'=>"Wyoming");
    }

    /**
     * Returns associative array of CA Provinces in (Abbr => Full Name) format
     * @return array
     */
    public static function getCaStates()
    {
        return array(
            'AB'    =>	"Alberta",
            'BC'    =>	"British Columbia",
            'MB'    =>	"Manitoba",
            'NB'    =>	"New Brunswick",
            'NL'    =>	"Newfoundland and Labrador",
            'NT'    =>	"Northwest Territories",
            'NS'    =>	"Nova Scotia",
            'NU'    =>	"Nunavut",
            'ON'    =>	"Ontario",
            'PE'    =>	"Prince Edward Island",
            'QC'    =>	"Quebec",
            'SK'    =>	"Saskatchewan",
            'YT'    =>	"Yukon");
    }

    public static function getLocalizedStateProvinces($withPrompt=false)
    {
        if ( \Locale::getDefault() == 'en_CA') {
            $arr = self::getCaStates();
        } else {
            $arr = self::getUsStates();
        }

        if ($withPrompt) {
            $arr = array(''=>'Select One...') + $arr;
        }

        return $arr;
    }

    public static function getLocaliedStateLabel()
    {
        if ( \Locale::getDefault() == 'en_CA') {
            return 'Province';
        } else {
            return 'State';
        }

    }

    public static function getLocaliedPostalCodeLabel()
    {
        if ( \Locale::getDefault() == 'en_CA') {
            return 'Postal Code';
        } else {
            return 'Zip';
        }

    }

    public static function getExpMonths($withPrompt=false)
    {
        $arr = array(
            '01'        => '01',
            '02'        => '02',
            '03'        => '03',
            '04'        => '04',
            '05'        => '05',
            '06'        => '06',
            '07'        => '07',
            '08'        => '08',
            '09'        => '09',
            '10'        => '10',
            '11'        => '11',
            '12'        => '12'
        );

        if ($withPrompt) {
            $arr = array(''=>'Select One...') + $arr;
        }

        return $arr;
    }

    public static function getExpYears($withPrompt=false)
    {
        $date = new \DateTime();
        $short = $date->format('y');
        $start = $date->format('Y');

        $arr =array();
        for ($i = 0; $i < 8; $i++) {
            $arr[$short + $i] = $start + $i;
        }

        if ($withPrompt) {
            $arr = array(''=>'Select One...') + $arr;
        }

        return $arr;
    }

    public static function detectCreditCardType($cardNumber)
    {
        $cardNumber = preg_replace('/[^0-9]/','',$cardNumber); // Strip non-numeric characters

        $creditCard = array(
            'visa'                        =>        "/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/",
            'mastercard'        =>        "/^5[1-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$/",
            'discover'                =>        "/^6011-?\d{4}-?\d{4}-?\d{4}$/",
            'amex'                        =>        "/^3[4,7]\d{13}$/",
            'diners'                =>        "/^3[0,6,8]\d{12}$/",
            'bankcard'                =>        "/^5610-?\d{4}-?\d{4}-?\d{4}$/",
            'jcb'                        =>        "/^[3088|3096|3112|3158|3337|3528]\d{12}$/",
            'enroute'                =>        "/^[2014|2149]\d{11}$/",
            'switch'                =>        "/^[4903|4911|4936|5641|6333|6759|6334|6767]\d{12}$/"
        );

        $match=false;
        foreach ($creditCard as $cardType=>$pattern) {
                if (preg_match($pattern,$cardNumber)==1) {
                        $match=true;
                        break;
                }
        }
        if (!$match) {
                return '';
        }

        return $cardType;
    }

    public static function getDeltaCargoFacilities()
    {
        return array(
            'AL'    => array(
                'id'    => 'AL',
                'name'  => 'Alabama',
                'facilities'    => array(
                    'BHM'   => 'Birmingham (BHM)',
                    'DHN'   => 'Dothan (DHN)',
                    'HSV'   => 'Huntsville/Decatur (HSV)',
                    'MOB'   => 'Mobile (MOB)',
                    'MGM'   => 'Montgomery (MGM)',
                    'MSL'   => 'Muscle Shoals (MSL)'
                )
            ),
            'AK'    => array(
                'id'    => 'AK',
                'name'  => 'Alaska',
                'facilities'    => array(
                    'ANC'   => 'Anchorage (ANC)'
                )
            ),
            'AK'    => array(
                'id'    => 'AZ',
                'name'  => 'Arizona',
                'facilities'    => array(
                    'PHX'   => 'Phoenix (PHX)',
                    'TUS'   => 'Tucson (TUS)'
                )
            )
        );
    }
}