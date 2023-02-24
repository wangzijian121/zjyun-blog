<?php

/**
 * All Database Queries are here.
 *
 * @link       https://pagevisitcounter.com
 * @since      4.0.0
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 */
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      3.0.1
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 * @author     Ankit Panchal <wptoolsdev@gmail.com>
 */
class Advanced_Visit_Counter_Queries
{
    public  $transients = array(
        'apvc_yearly_data',
        'apvc_monthly_data',
        'apvc_weekly_data',
        'apvc_daily_data',
        'apvc_browser_traffic_stats_data',
        'apvc_browser_traffic_data',
        'apvc_ref_traffic_data',
        'apvc_os_data',
        'apvc_orders_total',
        'apvc_total_orders_data',
        'apvc_total_products_sales',
        'apvc_mvp_month_data',
        'apvc_mvp_daily_data',
        'apvc_fv_30_td',
        'apvc_fv_30_past',
        'apvc_fv_td',
        'apvc_fv_past',
        'apvc_get_visitors_mn_data',
        'apvc_get_visitors_data',
        'apvc_pvp_30_data',
        'apvc_pvp_ip_30_data',
        'apvc_pvp_daily_data',
        'apvc_pvp_ip_daily_data',
        'apvc_get_visit_stats'
    ) ;
    public function apvc_number_format( $num )
    {
        $op = get_option( 'numbers_in_k' );
        if ( $op == 'Yes' ) {
            
            if ( $num > 1000 ) {
                $x = round( $num );
                $x_number_format = number_format( $x );
                $x_array = explode( ',', $x_number_format );
                $x_parts = [
                    'k',
                    'm',
                    'b',
                    't'
                ];
                $x_count_parts = count( $x_array ) - 1;
                $x_display = $x;
                $x_display = $x_array[0] . (( (int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '' ));
                $x_display .= $x_parts[$x_count_parts - 1];
                return $x_display;
            }
        
        }
        return $num;
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the last year.
     *
     * @since    3.0.1
     */
    public function get_total_counts_of_the_year()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $currentDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -1 year' ) );
        $monthWise = $wpdb->get_results( "SELECT COUNT(*) as total_count, MONTH(date) as month, YEAR(date) as year FROM {$table} WHERE date >= '{$currentDate}' GROUP BY MONTH(date) order by year ASC", ARRAY_N );
        $totalCounts = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $currentDate . "'" );
        $monthArray = [];
        foreach ( $monthWise as $value ) {
            array_push( $monthArray, $value[0] );
        }
        return wp_json_encode( [
            "months_wise"  => $monthArray,
            "total_counts" => $totalCounts,
        ] );
    }
    
    /**
     * Advanced Page Visit Counter Get Browsers Logos to list on reports pages.
     *
     * @since    3.0.1
     */
    public function get_browsers_logos()
    {
        $logos = [
            'Firefox' => 'firefox.png',
            'Chrome'  => 'chrome.png',
            'Safari'  => 'Safari.png',
            'MSIE'    => 'Internet-Explorer.png',
            'Opera'   => 'opera.png',
            'Vivaldi' => 'vivaldi.png',
            'default' => 'default-browser.png',
        ];
        return wp_json_encode( $logos );
    }
    
    /**
     * Advanced Page Visit Counter Get Country names to list on reports pages.
     *
     * @since    3.0.1
     */
    public function get_country_names()
    {
        $allCountries = [
            "Afghanistan"                                  => "AF",
            "land Islands"                                 => "AX",
            "Albania"                                      => "AL",
            "Algeria"                                      => "DZ",
            "American Samoa"                               => "AS",
            "AndorrA"                                      => "AD",
            "Angola"                                       => "AO",
            "Anguilla"                                     => "AI",
            "Antarctica"                                   => "AQ",
            "Antigua and Barbuda"                          => "AG",
            "Argentina"                                    => "AR",
            "Armenia"                                      => "AM",
            "Aruba"                                        => "AW",
            "Australia"                                    => "AU",
            "Austria"                                      => "AT",
            "Azerbaijan"                                   => "AZ",
            "Bahamas"                                      => "BS",
            "Bahrain"                                      => "BH",
            "Bangladesh"                                   => "BD",
            "Barbados"                                     => "BB",
            "Belarus"                                      => "BY",
            "Belgium"                                      => "BE",
            "Belize"                                       => "BZ",
            "Benin"                                        => "BJ",
            "Bermuda"                                      => "BM",
            "Bhutan"                                       => "BT",
            "Bolivia"                                      => "BO",
            "Bosnia and Herzegovina"                       => "BA",
            "Botswana"                                     => "BW",
            "Bouvet Island"                                => "BV",
            "Brazil"                                       => "BR",
            "British Indian Ocean Territory"               => "IO",
            "Brunei Darussalam"                            => "BN",
            "Bulgaria"                                     => "BG",
            "Burkina Faso"                                 => "BF",
            "Burundi"                                      => "BI",
            "Cambodia"                                     => "KH",
            "Cameroon"                                     => "CM",
            "Canada"                                       => "CA",
            "Cape Verde"                                   => "CV",
            "Cayman Islands"                               => "KY",
            "Central African Republic"                     => "CF",
            "Chad"                                         => "TD",
            "Chile"                                        => "CL",
            "China"                                        => "CN",
            "Christmas Island"                             => "CX",
            "Cocos (Keeling) Islands"                      => "CC",
            "Colombia"                                     => "CO",
            "Comoros"                                      => "KM",
            "Congo"                                        => "CG",
            "Congo, The Democratic Republic of the"        => "CD",
            "Cook Islands"                                 => "CK",
            "Costa Rica"                                   => "CR",
            "Cote D'Ivoire"                                => "CI",
            "Croatia"                                      => "HR",
            "Cuba"                                         => "CU",
            "Cyprus"                                       => "CY",
            "Czechia"                                      => "CZ",
            "Denmark"                                      => "DK",
            "Djibouti"                                     => "DJ",
            "Dominica"                                     => "DM",
            "Dominican Republic"                           => "DO",
            "Ecuador"                                      => "EC",
            "Egypt"                                        => "EG",
            "El Salvador"                                  => "SV",
            "Equatorial Guinea"                            => "GQ",
            "Eritrea"                                      => "ER",
            "Estonia"                                      => "EE",
            "Ethiopia"                                     => "ET",
            "Falkland Islands (Malvinas)"                  => "FK",
            "Faroe Islands"                                => "FO",
            "Fiji"                                         => "FJ",
            "Finland"                                      => "FI",
            "France"                                       => "FR",
            "French Guiana"                                => "GF",
            "French Polynesia"                             => "PF",
            "French Southern Territories"                  => "TF",
            "Gabon"                                        => "GA",
            "Gambia"                                       => "GM",
            "Georgia"                                      => "GE",
            "Germany"                                      => "DE",
            "Ghana"                                        => "GH",
            "Gibraltar"                                    => "GI",
            "Greece"                                       => "GR",
            "Greenland"                                    => "GL",
            "Grenada"                                      => "GD",
            "Guadeloupe"                                   => "GP",
            "Guam"                                         => "GU",
            "Guatemala"                                    => "GT",
            "Guernsey"                                     => "GG",
            "Guinea"                                       => "GN",
            "Guinea-Bissau"                                => "GW",
            "Guyana"                                       => "GY",
            "Haiti"                                        => "HT",
            "Heard Island and Mcdonald Islands"            => "HM",
            "Vatican City"                                 => "VA",
            "Honduras"                                     => "HN",
            "Hong Kong"                                    => "HK",
            "Hungary"                                      => "HU",
            "Iceland"                                      => "IS",
            "India"                                        => "IN",
            "Indonesia"                                    => "ID",
            "Iran"                                         => "IR",
            "Iraq"                                         => "IQ",
            "Ireland"                                      => "IE",
            "Isle of Man"                                  => "IM",
            "Israel"                                       => "IL",
            "Italy"                                        => "IT",
            "Jamaica"                                      => "JM",
            "Japan"                                        => "JP",
            "Jersey"                                       => "JE",
            "Hashemite Kingdom of Jordan"                  => "JO",
            "Kazakhstan"                                   => "KZ",
            "Kenya"                                        => "KE",
            "Kiribati"                                     => "KI",
            "Korea, Democratic People'S Republic of"       => "KP",
            "Republic of Korea"                            => "KR",
            "South Korea"                                  => "KR",
            "Kuwait"                                       => "KW",
            "Kyrgyzstan"                                   => "KG",
            "Laos"                                         => "LA",
            "Latvia"                                       => "LV",
            "Lebanon"                                      => "LB",
            "Lesotho"                                      => "LS",
            "Liberia"                                      => "LR",
            "Libyan Arab Jamahiriya"                       => "LY",
            "Liechtenstein"                                => "LI",
            "Republic of Lithuania"                        => "LT",
            "Luxembourg"                                   => "LU",
            "Macao"                                        => "MO",
            "Macedonia, The Former Yugoslav Republic of"   => "MK",
            "Madagascar"                                   => "MG",
            "Malawi"                                       => "MW",
            "Malaysia"                                     => "MY",
            "Maldives"                                     => "MV",
            "Mali"                                         => "ML",
            "Malta"                                        => "MT",
            "Marshall Islands"                             => "MH",
            "Martinique"                                   => "MQ",
            "Mauritania"                                   => "MR",
            "Mauritius"                                    => "MU",
            "Mayotte"                                      => "YT",
            "Mexico"                                       => "MX",
            "Micronesia, Federated States of"              => "FM",
            "Republic of Moldova"                          => "MD",
            "Monaco"                                       => "MC",
            "Mongolia"                                     => "MN",
            "Montenegro"                                   => "ME",
            "Montserrat"                                   => "MS",
            "Morocco"                                      => "MA",
            "Mozambique"                                   => "MZ",
            "Myanmar"                                      => "MM",
            "Namibia"                                      => "NA",
            "Nauru"                                        => "NR",
            "Nepal"                                        => "NP",
            "Netherlands"                                  => "NL",
            "Netherlands Antilles"                         => "AN",
            "New Caledonia"                                => "NC",
            "New Zealand"                                  => "NZ",
            "Nicaragua"                                    => "NI",
            "Niger"                                        => "NE",
            "Nigeria"                                      => "NG",
            "Niue"                                         => "NU",
            "Norfolk Island"                               => "NF",
            "Northern Mariana Islands"                     => "MP",
            "Norway"                                       => "NO",
            "Oman"                                         => "OM",
            "Pakistan"                                     => "PK",
            "Palau"                                        => "PW",
            "Palestine"                                    => "PS",
            "Panama"                                       => "PA",
            "Papua New Guinea"                             => "PG",
            "Paraguay"                                     => "PY",
            "Peru"                                         => "PE",
            "Philippines"                                  => "PH",
            "Pitcairn"                                     => "PN",
            "Poland"                                       => "PL",
            "Portugal"                                     => "PT",
            "Puerto Rico"                                  => "PR",
            "Qatar"                                        => "QA",
            "Reunion"                                      => "RE",
            "Romania"                                      => "RO",
            "Russia"                                       => "RU",
            "RWANDA"                                       => "RW",
            "Saint Helena"                                 => "SH",
            "Saint Kitts and Nevis"                        => "KN",
            "Saint Lucia"                                  => "LC",
            "Saint Pierre and Miquelon"                    => "PM",
            "Saint Vincent and the Grenadines"             => "VC",
            "Samoa"                                        => "WS",
            "San Marino"                                   => "SM",
            "Sao Tome and Principe"                        => "ST",
            "Saudi Arabia"                                 => "SA",
            "Senegal"                                      => "SN",
            "Serbia"                                       => "RS",
            "Seychelles"                                   => "SC",
            "Sierra Leone"                                 => "SL",
            "Singapore"                                    => "SG",
            "Slovakia"                                     => "SK",
            "Slovenia"                                     => "SI",
            "Solomon Islands"                              => "SB",
            "Somalia"                                      => "SO",
            "South Africa"                                 => "ZA",
            "South Georgia and the South Sandwich Islands" => "GS",
            "Spain"                                        => "ES",
            "Sri Lanka"                                    => "LK",
            "Sudan"                                        => "SD",
            "Suriname"                                     => "SR",
            "Svalbard and Jan Mayen"                       => "SJ",
            "Swaziland"                                    => "SZ",
            "Sweden"                                       => "SE",
            "Switzerland"                                  => "CH",
            "Syrian Arab Republic"                         => "SY",
            "Taiwan"                                       => "TW",
            "Tajikistan"                                   => "TJ",
            "Tanzania"                                     => "TZ",
            "Thailand"                                     => "TH",
            "Timor-Leste"                                  => "TL",
            "Togo"                                         => "TG",
            "Tokelau"                                      => "TK",
            "Tonga"                                        => "TO",
            "Trinidad and Tobago"                          => "TT",
            "Tunisia"                                      => "TN",
            "Turkey"                                       => "TR",
            "Turkmenistan"                                 => "TM",
            "Turks and Caicos Islands"                     => "TC",
            "Tuvalu"                                       => "TV",
            "Uganda"                                       => "UG",
            "Ukraine"                                      => "UA",
            "United Arab Emirates"                         => "AE",
            "United Kingdom"                               => "GB",
            "United States"                                => "US",
            "United States Minor Outlying Islands"         => "UM",
            "Uruguay"                                      => "UY",
            "Uzbekistan"                                   => "UZ",
            "Vanuatu"                                      => "VU",
            "Venezuela"                                    => "VE",
            "Vietnam"                                      => "VN",
            "Virgin Islands, British"                      => "VG",
            "Virgin Islands, U.S."                         => "VI",
            "Wallis and Futuna"                            => "WF",
            "Western Sahara"                               => "EH",
            "Yemen"                                        => "YE",
            "Zambia"                                       => "ZM",
            "Zimbabwe"                                     => "ZW",
        ];
        return wp_json_encode( $allCountries );
    }
    
    /**
     * Advanced Page Visit Counter Get short country name from full country
     * name to list on reports pages.
     *
     * @since    3.0.1
     */
    public function get_country_name( $name )
    {
        $allCountries = json_decode( $this->get_country_names(), TRUE );
        
        if ( !empty($name) ) {
            return $allCountries[$name];
        } else {
            return '';
        }
    
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the last month.
     *
     * @since    3.0.1
     */
    public function get_total_counts_of_last_month()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $currentDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -1 month' ) );
        $prevMonthDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -2 month' ) );
        $prevPrevMonthDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -3 month' ) );
        $lastMonthCounts = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $currentDate . "'" );
        $prevMonthCounts = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $prevMonthDate . "' AND date <= '" . $currentDate . "'" );
        $prevPrevMonthCounts = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $prevPrevMonthDate . "' AND date <= '" . $prevMonthDate . "'" );
        $diff = $lastMonthCounts - $prevMonthCounts;
        $diff = ( $diff >= 0 ? "+" . $diff : $diff );
        $class = ( $diff >= 0 ? "text-success" : "text-danger" );
        return wp_json_encode( [
            "lastMonth"   => $lastMonthCounts,
            "months_wise" => [ $prevPrevMonthCounts, $prevMonthCounts, $lastMonthCounts ],
            "countDiff"   => $diff,
            "class"       => $class,
        ] );
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the last week.
     *
     * @since    3.0.1
     */
    public function get_total_counts_of_last_week()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $currentDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -1 week' ) );
        $prevWeekDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -2 weeks' ) );
        $prevPrevWeekDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -3 weeks' ) );
        $lastWeekCounts = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $currentDate . "'" );
        $prevWeekCounts = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $prevWeekDate . "' AND date <= '" . $currentDate . "'" );
        $prevPrevWeekCounts = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $prevPrevWeekDate . "' AND date <= '" . $prevWeekDate . "'" );
        $diff = $lastWeekCounts - $prevWeekCounts;
        $diff = ( $diff >= 0 ? "+" . $diff : $diff );
        $class = ( $diff >= 0 ? "text-success" : "text-danger" );
        return wp_json_encode( [
            "lastWeek"   => $lastWeekCounts,
            "weeks_wise" => [ $prevPrevWeekCounts, $prevWeekCounts, $lastWeekCounts ],
            "countDiff"  => $diff,
            "class"      => $class,
        ] );
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of daily.
     *
     * @since    3.0.1
     */
    public function get_total_counts_of_last_daily()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $currentDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) ) );
        $yesterdayDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -2 day' ) );
        $prevDate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -3 day' ) );
        $todaysCounts = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $currentDate . "'" );
        $yesterdayCounts = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $yesterdayDate . "' AND date <= '" . $currentDate . "'" );
        $prevDate = $wpdb->get_var( "SELECT COUNT(*) as total_count FROM {$table} WHERE date >= '" . $prevDate . "' AND date <= '" . $yesterdayDate . "'" );
        $diff = $todaysCounts - $yesterdayCounts;
        $diff = ( $diff >= 0 ? "+" . $diff : $diff );
        $class = ( $diff >= 0 ? "text-success" : "text-danger" );
        return wp_json_encode( [
            "todaysCounts" => $todaysCounts,
            "day_wise"     => [ $prevDate, $yesterdayCounts, $todaysCounts ],
            "countDiff"    => $diff,
            "class"        => $class,
        ] );
    }
    
    /**
     * Advanced Page Visit Counter Get total counts.
     *
     * @since    3.0.1
     */
    public function get_total_counts()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $total_count = $wpdb->get_var( "SELECT COUNT(*) FROM {$table}" );
        return $total_count;
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get browser traffic stats.
     *
     * @since    3.0.1
     */
    public function get_browser_traffic_stats()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $browserStats = $wpdb->get_results( "SELECT COUNT(*) as total_count, device_type, COUNT(*)*100/(SELECT COUNT(*) FROM {$table}) as percentage  FROM {$table} GROUP BY device_type" );
        return wp_json_encode( $browserStats );
    }
    
    /**
     * Advanced Page Visit Counter Get browser traffic stats list.
     *
     * @since    3.0.1
     */
    public function get_browser_traffic_stats_list()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $browserStatsList = $wpdb->get_results( "SELECT COUNT(*) as total_count, browser_short_name, browser_full_name FROM {$table} GROUP BY browser_short_name order by total_count DESC LIMIT 0,5" );
        return wp_json_encode( $browserStatsList );
    }
    
    /**
     * Advanced Page Visit Counter Get referrel websites traffic stats.
     *
     * @since    3.0.1
     */
    public function get_referral_websites_stats()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $referralStats = $wpdb->get_results( "SELECT COUNT(*) as total_count, SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE(REPLACE(LOWER(http_referer), 'https://', ''), 'http://', ''), '/', 1), '?', 1) as http_referer, http_referer as htp_ref, COUNT(*)*100/(SELECT COUNT(*) FROM {$table}) as percentage FROM {$table} GROUP BY http_referer ORDER BY total_count DESC LIMIT 0,5 " );
        return wp_json_encode( $referralStats );
    }
    
    /**
     * Advanced Page Visit Counter Get stats by Operation Systems.
     *
     * @since    3.0.1
     */
    public function get_stats_by_operating_systems()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $OsStats = $wpdb->get_results( "SELECT COUNT(*) as total_count, operating_system, COUNT(*)*100/(SELECT COUNT(*) FROM {$table}) as percentage FROM {$table} GROUP BY operating_system ORDER BY total_count DESC LIMIT 0,5" );
        return wp_json_encode( $OsStats );
    }
    
    /**
     * Advanced Page Visit Counter Get recent visit stats.
     *
     * @since    3.0.1
     */
    public function get_recent_visit( $article_id, $type = '' )
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        
        if ( $type == 'ip_address' ) {
            $recentVisit = $wpdb->get_var( "SELECT date FROM {$table} WHERE ip_address = '{$article_id}' ORDER BY date DESC" );
        } else {
            $recentVisit = $wpdb->get_var( "SELECT date FROM {$table} WHERE article_id = {$article_id} ORDER BY date DESC" );
        }
        
        $recentVisit = human_time_diff( strtotime( $recentVisit ), strtotime( date( "Y-m-d 0:0:0" ) ) ) . __( ' ago', "advanced-page-visit-counter" );
        return $recentVisit;
    }
    
    /**
     * Advanced Page Visit Counter Get total reports.
     *
     * @since    3.0.1
     */
    public function get_the_reports( $offset, $no_of_records_per_page )
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $where = '';
        $where = " ";
        $totalCount = count( $wpdb->get_results( "SELECT article_id FROM {$table} " . $where . " GROUP BY article_id" ) );
        $apvcReports = $wpdb->get_results( "SELECT COUNT(*) as count, article_id, ( SELECT post_title FROM {$wpdb->prefix}posts WHERE ID=article_id ) as title FROM {$table} " . $where . " GROUP BY article_id ORDER BY count DESC LIMIT {$offset}, {$no_of_records_per_page}" );
        return wp_json_encode( [
            "totalCount" => $totalCount,
            "list"       => $apvcReports,
        ] );
    }
    
    /**
     * Advanced Page Visit Counter Get detailed report of any article.
     *
     * @since    3.0.1
     */
    public function get_the_detailed_reports( $article_id, $offset, $no_of_records_per_page )
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $where = '';
        $where = " ";
        $totalCount = count( $wpdb->get_results( "SELECT article_id FROM {$table} WHERE article_id={$article_id} " . $where . " " ) );
        $apvcReports = $wpdb->get_results( "SELECT *, (SELECT post_title FROM {$wpdb->prefix}posts WHERE ID={$article_id}) as title,  SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE(REPLACE(LOWER(http_referer), 'https://', ''), 'http://', ''), '/', 1), '?', 1) as http_referer_clean FROM {$table} WHERE article_id={$article_id} " . $where . " ORDER BY date DESC LIMIT {$offset}, {$no_of_records_per_page}" );
        return wp_json_encode( [
            "totalCount" => $totalCount,
            "list"       => $apvcReports,
        ] );
    }
    
    /**
     * Advanced Page Visit Counter Get top 10 pages data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_10_page_data()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $where = '';
        $where = "  WHERE article_id != '' AND article_type = 'page' ";
        $top10Pages = $wpdb->get_results( "SELECT article_id, count(*) as count, ( SELECT post_title FROM {$wpdb->prefix}posts WHERE ID=article_id ) as title FROM {$table} " . $where . " GROUP BY article_id ORDER BY count DESC LIMIT 10" );
        return wp_json_encode( $top10Pages );
    }
    
    /**
     * Advanced Page Visit Counter Get top 10 posts data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_10_posts_data()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $where = '';
        $where = " WHERE article_id != '' AND article_type NOT IN ('page','cart') ";
        $top10Posts = $wpdb->get_results( "SELECT article_id, count(*) as count, ( SELECT post_title FROM {$wpdb->prefix}posts WHERE ID=article_id ) as title FROM {$table} " . $where . " GROUP BY article_id ORDER BY count DESC LIMIT 10" );
        return wp_json_encode( $top10Posts );
    }
    
    /**
     * Advanced Page Visit Counter Get top 10 countries data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_10_contries_data()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $where = '';
        $where = " WHERE country != '' ";
        $top10Country = $wpdb->get_results( "SELECT article_id, country, count(*) as count FROM {$table} " . $where . "  GROUP BY country ORDER BY count DESC LIMIT 10" );
        return wp_json_encode( $top10Country );
    }
    
    /**
     * Advanced Page Visit Counter Get top 10 ip address data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_10_ip_address_data()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $where = '';
        $where = " WHERE ip_address != '' ";
        $top10iPAddress = $wpdb->get_results( "SELECT article_id, ip_address, country, count(*) as count FROM {$table} " . $where . " GROUP BY ip_address ORDER BY count DESC LIMIT 10" );
        return wp_json_encode( $top10iPAddress );
    }
    
    /**
     * Advanced Page Visit Counter Get human time difference data.
     *
     * @since    3.0.1
     */
    public function apvc_get_human_time_diff( $recentVisit )
    {
        $recentVisit = human_time_diff( strtotime( $recentVisit ), strtotime( date( "Y-m-d H:i:s" ) ) ) . __( ' ago', "advanced-page-visit-counter" );
        return $recentVisit;
    }
    
    /**
     * Advanced Page Visit Counter Get total reports.
     *
     * @since    3.0.1
     */
    public function get_the_reports_for_countries( $offset, $no_of_records_per_page, $country )
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $where = '';
        $d = ( isset( $_REQUEST['d'] ) ? sanitize_text_field( $_REQUEST['d'] ) : "" );
        $e = ( isset( $_REQUEST['e'] ) ? sanitize_text_field( $_REQUEST['e'] ) : "" );
        
        if ( $d != 0 && !$this->apvc_is_date( $d ) ) {
            $days_ago = date( 'Y-m-d', time() - $d * APVC_SECONDS_PER_DAY );
            $where = " WHERE date >= '{$days_ago}' AND country = '{$country}' ";
        } else {
            
            if ( $this->apvc_is_date( $d ) && $this->apvc_is_date( $e ) ) {
                $where = " WHERE date >= '{$d}' AND date <= '{$e}' AND country = '{$country}' ";
            } else {
                $where = " WHERE country = '{$country}' ";
            }
        
        }
        
        $totalCount = count( $wpdb->get_results( "SELECT article_id FROM {$table} " . $where . " GROUP BY article_id" ) );
        $apvcReports = $wpdb->get_results( "SELECT COUNT(*) as count, article_id, ( SELECT post_title FROM {$wpdb->prefix}posts WHERE ID=article_id ) as title FROM {$table} " . $where . " GROUP BY article_id ORDER BY count DESC LIMIT {$offset}, {$no_of_records_per_page}" );
        return wp_json_encode( [
            "totalCount" => $totalCount,
            "list"       => $apvcReports,
        ] );
    }
    
    /**
     * Advanced Page Visit Counter Get icons.
     *
     * @since    3.0.1
     */
    public function apvc_get_icons()
    {
        $icons = [
            'None',
            'icon-eye',
            'icon-user',
            'icon-people',
            'icon-user-female',
            'icon-user-follow',
            'icon-user-following',
            'icon-emotsmile',
            'icon-location-pin',
            'icon-list',
            'icon-options',
            'icon-clock',
            'icon-plus',
            'icon-trophy',
            'icon-screen-desktop',
            'icon-plane',
            'icon-mouse',
            'icon-mustache',
            'icon-cursor-move',
            'icon-cursor',
            'icon-energy',
            'icon-screen-tablet',
            'icon-shield',
            'icon-speedometer',
            'icon-chemistry',
            'icon-magic-wand',
            'icon-disc',
            'icon-graduation',
            'icon-ghost',
            'icon-eyeglass',
            'icon-fire',
            'icon-bell',
            'icon-game-controller',
            'icon-speech',
            'icon-badge',
            'icon-pin',
            'icon-playlist',
            'icon-present',
            'icon-picture',
            'icon-globe',
            'icon-diamond',
            'icon-basket-loaded',
            'icon-cup',
            'icon-rocket',
            'icon-home',
            'icon-music-tone-alt',
            'icon-music-tone',
            'icon-earphones-alt',
            'icon-graph',
            'icon-microphone',
            'icon-control-play',
            'icon-calendar',
            'icon-bulb',
            'icon-chart',
            'icon-camera',
            'icon-cloud-download',
            'icon-bubble',
            'icon-heart',
            'icon-star'
        ];
        return wp_json_encode( $icons );
    }
    
    /**
     * Advanced Page Visit Counter Save settings method.
     *
     * @since    3.0.1
     */
    public function apvc_save_settings()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        
        if ( !current_user_can( 'manage_options' ) ) {
            echo  'failed' ;
            exit;
        }
        
        $formData = $_POST['formData'];
        $default_label = $_POST['default_label'];
        $todays_label = $_POST['todays_label'];
        $global_label = $_POST['global_label'];
        $range_posts = $_POST['range_posts'];
        $range_ip_add = $_POST['range_ip_add'];
        $ex_show_counter = $_POST['ex_show_counter'];
        $formDataStr = $formData;
        $formData = explode( "&", $formData );
        $finalFormData = [];
        
        if ( strpos( $formDataStr, 'cache_active' ) ) {
            update_option( 'cache_active', 'Yes' );
        } else {
            update_option( 'cache_active', 'No' );
        }
        
        
        if ( strpos( $formDataStr, 'numbers_in_k' ) ) {
            update_option( 'numbers_in_k', 'Yes' );
        } else {
            update_option( 'numbers_in_k', 'No' );
        }
        
        foreach ( $formData as $key => $value ) {
            $rawFormData = explode( "=", $value );
            if ( isset( $rawFormData[0] ) ) {
                
                if ( 'apvc_default_label' === $rawFormData[0] ) {
                    $finalFormData[$rawFormData[0]][] = sanitize_text_field( $default_label );
                } else {
                    
                    if ( 'apvc_todays_label' === $rawFormData[0] ) {
                        $finalFormData[$rawFormData[0]][] = sanitize_text_field( $todays_label );
                    } else {
                        
                        if ( 'apvc_global_label' === $rawFormData[0] ) {
                            $finalFormData[$rawFormData[0]][] = sanitize_text_field( $global_label );
                        } else {
                            
                            if ( 'apvc_exclude_counts' === $rawFormData[0] ) {
                                $finalFormData[$rawFormData[0]][] = $range_posts;
                            } else {
                                
                                if ( 'apvc_ip_address' === $rawFormData[0] ) {
                                    $finalFormData[$rawFormData[0]][] = $range_ip_add;
                                } else {
                                    
                                    if ( 'apvc_exclude_show_counter' === $rawFormData[0] ) {
                                        $finalFormData[$rawFormData[0]][] = $ex_show_counter;
                                    } else {
                                        $finalFormData[$rawFormData[0]][] = sanitize_text_field( $rawFormData[1] );
                                    }
                                
                                }
                            
                            }
                        
                        }
                    
                    }
                
                }
            
            }
        }
        update_option( "apvc_configurations", $finalFormData );
        echo  "success" ;
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Reset settings method.
     *
     * @since    3.0.1
     */
    public function apvc_reset_settings()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        $finalFormData = [];
        $finalFormData['apvc_post_types'] = [ 'post', 'page' ];
        $finalFormData['apvc_widget_width'] = [ 300 ];
        $finalFormData['apvc_default_label'] = [ 'Visits' ];
        $finalFormData['apvc_wid_alignment'] = [ 'center' ];
        $finalFormData['apvc_default_text_color'] = [ '#000000' ];
        $finalFormData['apvc_default_background_color'] = [ '#fffffff' ];
        $finalFormData['apvc_default_border_color'] = [ '#000000' ];
        $finalFormData['apvc_default_border_radius'] = [ 5 ];
        $finalFormData['apvc_default_border_width'] = [ 2 ];
        update_option( "apvc_configurations", $finalFormData );
        echo  "success" ;
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Reset data method.
     *
     * @since    3.0.1
     */
    public function apvc_reset_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $tbl_history = APVC_DATA_TABLE;
        $wpdb->query( "TRUNCATE TABLE {$tbl_history}" );
        $wpdb->query( "DELETE FROM {$wpdb->postmeta} WHERE meta_key='count_start_from'" );
        $tbl_users = APVC_USER_TABLE;
        $wpdb->query( "TRUNCATE TABLE {$tbl_users}" );
        echo  "success" ;
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get All Articles.
     *
     * @since    3.0.1
     */
    public function apvc_get_all_articles_sh()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $allArticles = $wpdb->get_results( "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type NOT IN('attachment','revision','nav_menu_item') AND post_status='publish'" );
        $array = [];
        $html = '';
        foreach ( $allArticles as $article ) {
            $html .= '<option value="' . $article->ID . '">' . $article->post_title . '</option>';
        }
        ob_clean();
        wp_send_json_success( $html );
        wp_die();
    }
    
    /**
     * Get column head title in wordpress admin
     *
     * @since    1.0.0
     *
     * @return  string
     */
    public function apvc_columns_label( $defaults )
    {
        $defaults['views'] = esc_html__( 'Views', "advanced-page-visit-counter" );
        return $defaults;
    }
    
    /**
     * Get column head content in wordpress admin
     *
     * @param string $column_id
     * @param int $article_id
     *
     * @since    3.0.6
     *
     */
    public function apvc_columns_counts( $column_id, $article_id )
    {
        global  $wpdb ;
        $tbl_history = APVC_DATA_TABLE;
        
        if ( $column_id == 'views' ) {
            global  $wpdb ;
            $post_result = get_post( $article_id );
            
            if ( 'post' === $post_result->post_type ) {
                $type = 'post';
            } else {
                $type = 'page';
            }
            
            $totalVisits = $wpdb->get_var( "SELECT count(*) FROM " . APVC_DATA_TABLE . " WHERE article_id = {$article_id}" );
            
            if ( $totalVisits ) {
                echo  '<a href="' . esc_url( site_url( '/wp-admin/admin.php?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=' . esc_attr( $article_id ) ) ) . '">' . esc_html( $totalVisits ) . '</a>' ;
            } else {
                echo  "0" ;
            }
        
        }
    
    }
    
    /**
     * Advanced Page Visit Counter Save posts meta for counter.
     *
     * @since    3.0.1
     */
    public function apvc_advanced_save_metaboxes( $post_id )
    {
        global  $wpdb ;
        $tbl_history = APVC_DATA_TABLE;
        $active_count = ( isset( $_POST["apvc_active_counter"] ) ? sanitize_text_field( $_POST["apvc_active_counter"] ) : "" );
        $reset_count = ( isset( $_POST["apvc_reset_cnt"] ) ? sanitize_text_field( $_POST["apvc_reset_cnt"] ) : "" );
        $start_count = ( isset( $_POST["count_start_from"] ) ? sanitize_text_field( $_POST["count_start_from"] ) : "" );
        $widget_label = ( isset( $_POST["widget_label"] ) ? sanitize_text_field( $_POST["widget_label"] ) : "" );
        if ( empty($active_count) ) {
            $active_count = "Yes";
        }
        update_post_meta( $post_id, "apvc_active_counter", $active_count );
        update_post_meta( $post_id, "count_start_from", $start_count );
        update_post_meta( $post_id, "widget_label", $widget_label );
        if ( $reset_count == "Yes" ) {
            $wpdb->query( "DELETE FROM {$tbl_history} WHERE article_id={$post_id}" );
        }
    }
    
    /**
     * Advanced Page Visit Counter Upgrade process method.
     *
     * @since    3.0.1
     */
    public function apvc_upgrader_process_complete()
    {
        set_transient( "apvcSetPromo", "no", 86400 );
        update_option( 'apvc_promo', 'yes' );
        $current_version = get_option( "apvc_version" );
        // $this->apvc_migrate_from_old_version($current_version);
        update_option( "apvc_version", ADVANCED_PAGE_VISIT_COUNTER );
        update_option( "apvc_newsletter", "show" );
        update_option( 'apvc_notice', 'no' );
    }
    
    public function apvc_get_html_with_icon( $class )
    {
        return '<div class="' . $class . '"><div><i class="icon-graph icons"></i> Visits: <span>999</span></div><div><i class="icon-eyeglass icons"></i> Today: <span>123</span></div><div><i class="icon-chart icons"></i> Total: <span>123</span></div></div>';
    }
    
    public function apvc_get_html_without_icon( $class )
    {
        return '<div class="' . $class . '"><div>Visits: <span>999</span></div><div>Today: <span>123</span></div><div>Total: <span>123</span></div></div>';
    }
    
    /**
     * Advanced Page Visit Counter Shortcode Library.
     *
     * @since    3.0.1
     */
    public function apvc_get_shortcodes( $shortcode = '' )
    {
        $shortcodes = [];
        $shortcodes['template_3']['icon'] = 'yes';
        $shortcodes['template_3']['css'] = '.template_3{background:#1c8394;padding:15px;margin:15px;border-radius:50px;border:2px solid #1c8394;-webkit-box-shadow:3px 4px 12px -2px rgba(0,0,0,.68);-moz-box-shadow:3px 4px 12px -2px rgba(0,0,0,.68);box-shadow:3px 4px 12px -2px rgba(0,0,0,.68);font-family:calibri;font-size:13pt;text-align:center}.template_3>div{color:#fff;display:inline-block;margin:0 30px}.template_3>div>span{font-weight:700;margin-left:10px}.template_3 .icons{color:#fff;margin-right:5px;font-weight:700}@media (max-width:644px){.template_3>div{margin:0 10px}}@media (max-width:525px){.template_3>div{color:#fff;display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_3>div:last-child{border-bottom:none}}';
        $shortcodes['template_6']['icon'] = 'yes';
        $shortcodes['template_6']['class'] = 'effect2';
        $shortcodes['template_6']['css'] = '.template_6{background:#764ba2;background:linear-gradient(90deg,#667eea 0,#764ba2 100%);padding:15px;margin:15px;border-radius:40px;border:2px solid #764ba2;font-family:calibri;font-size:13pt;text-align:center}.effect2{position:relative}.effect2:after{z-index:-1;position:absolute;content:"";bottom:15px;right:10px;left:auto;width:50%;top:50%;max-width:300px;background:#777;-webkit-box-shadow:0 15px 10px #777;-moz-box-shadow:0 15px 10px #777;box-shadow:0 15px 10px #777;-webkit-transform:rotate(4deg);-moz-transform:rotate(4deg);-o-transform:rotate(4deg);-ms-transform:rotate(4deg);transform:rotate(4deg)}.template_6>div{color:#fff;display:inline-block;margin:0 30px}.template_6>div>span{font-weight:700;margin-left:10px}.template_6 .icons{color:#fff;margin-right:5px;font-weight:700}@media (max-width:644px){.template_6>div{margin:0 10px}}@media (max-width:525px){.template_6>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fcb8a1}.template_6>div:last-child{border-bottom:none}}';
        $shortcodes['template_7']['icon'] = 'yes';
        $shortcodes['template_7']['class'] = 'effect2';
        $shortcodes['template_7']['css'] = '.template_7{background:#dfa579;background:linear-gradient(90deg,#c79081 0,#dfa579 100%);padding:15px;margin:15px;border-radius:40px;border:2px solid #dfa579;font-family:calibri;font-size:13pt;text-align:center}.effect2{position:relative}.effect2:after,.effect2:before{z-index:-1;position:absolute;content:"";bottom:25px;left:10px;width:50%;top:35%;max-width:300px;background:#000;-webkit-box-shadow:0 35px 20px #000;-moz-box-shadow:0 35px 20px #000;box-shadow:0 35px 20px #000;-webkit-transform:rotate(-7deg);-moz-transform:rotate(-7deg);-o-transform:rotate(-7deg);-ms-transform:rotate(-7deg);transform:rotate(-7deg)}.effect2:after{-webkit-transform:rotate(7deg);-moz-transform:rotate(7deg);-o-transform:rotate(7deg);-ms-transform:rotate(7deg);transform:rotate(7deg);right:10px;left:auto}.template_7>div{color:#fff;display:inline-block;margin:0 30px}.template_7>div>span{font-weight:700;margin-left:10px}.template_7 .icons{color:#fff;margin-right:5px;font-weight:700}@media (max-width:644px){.template_7>div{margin:0 10px}}@media (max-width:525px){.template_7>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fcb8a1}.template_7>div:last-child{border-bottom:none}}';
        $shortcodes['template_8']['icon'] = 'yes';
        $shortcodes['template_8']['class'] = 'effect2';
        $shortcodes['template_8']['css'] = '.template_8{background:#5fc3e4;background:linear-gradient(90deg,#e55d87 0,#5fc3e4 100%);padding:15px;margin:15px;border:2px solid #5fc3e4;font-family:calibri;font-size:13pt;text-align:center}.effect2{position:relative;-webkit-box-shadow:0 1px 4px rgba(0,0,0,.3),0 0 40px rgba(0,0,0,.1) inset;-moz-box-shadow:0 1px 4px rgba(0,0,0,.3),0 0 40px rgba(0,0,0,.1) inset;box-shadow:0 1px 4px rgba(0,0,0,.3),0 0 40px rgba(0,0,0,.1) inset}.effect2:after,.effect2:before{content:"";position:absolute;z-index:-1;-webkit-box-shadow:0 0 20px rgba(0,0,0,.8);-moz-box-shadow:0 0 20px rgba(0,0,0,.8);box-shadow:0 0 20px rgba(0,0,0,.8);top:0;bottom:0;left:10px;right:10px;-moz-border-radius:100px/10px;border-radius:100px/10px}.effect2:after{right:10px;left:auto;-webkit-transform:skew(8deg) rotate(3deg);-moz-transform:skew(8deg) rotate(3deg);-ms-transform:skew(8deg) rotate(3deg);-o-transform:skew(8deg) rotate(3deg);transform:skew(8deg) rotate(3deg)}.template_8>div{color:#fff;display:inline-block;margin:0 30px}.template_8>div>span{font-weight:700;margin-left:10px}.template_8 .icons{color:#fff;margin-right:5px;font-weight:700}@media (max-width:644px){.template_8>div{margin:0 10px}}@media (max-width:525px){.template_8>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_8>div:last-child{border-bottom:none}}';
        $shortcodes['template_11']['icon'] = 'yes';
        $shortcodes['template_11']['css'] = '.template_11{background:#2980b9;background:linear-gradient(225deg,#2980b9 0,#6dd5fa 50%,#fff 100%);padding:15px;margin:15px;border-radius:40px;border:2px solid #2980b9;font-family:calibri;font-size:13pt;text-align:center}.template_11>div{color:#1a1a1a;display:inline-block;margin:0 30px}.template_11>div>span{font-weight:700;margin-left:10px}.template_11 .icons{color:#1a1a1a;margin-right:5px;font-weight:700}@media (max-width:644px){.template_11>div{margin:0 10px}}@media (max-width:525px){.template_11>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #2980b9}.template_11>div:last-child{border-bottom:none}}';
        $shortcodes['template_22']['icon'] = 'no';
        $shortcodes['template_22']['css'] = '.template_22{background:#355c7d;background:linear-gradient(90deg,#355c7d 0,#6c5b7b 50%,#c06c84 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_22>div{color:#fff;display:inline-block;margin:0 30px}.template_22>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_22>div{margin:0 10px}}@media (max-width:525px){.template_22>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #c06c84}.template_22>div:last-child{border-bottom:none}}';
        $shortcodes['template_23']['icon'] = 'no';
        $shortcodes['template_23']['css'] = '.template_23{background:#fc5c7d;background:linear-gradient(90deg,#fc5c7d 0,#6c5b7b 50%,#6a82fb 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_23>div{color:#fff;display:inline-block;margin:0 30px}.template_23>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_23>div{margin:0 10px}}@media (max-width:525px){.template_23>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #c06c84}.template_23>div:last-child{border-bottom:none}}';
        $shortcodes['template_24']['icon'] = 'no';
        $shortcodes['template_24']['css'] = '.template_24{background:#fffbd5;background:linear-gradient(90deg,#fffbd5 0,#b20a2c 50%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_24>div{color:#fff;display:inline-block;margin:0 30px}.template_24>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_24>div{margin:0 10px}}@media (max-width:525px){.template_24>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fffbd5}.template_24>div:last-child{border-bottom:none}}';
        $shortcodes['template_25']['icon'] = 'no';
        $shortcodes['template_25']['css'] = '.template_25{background:#302b63;background:linear-gradient(90deg,#0f0c29 0,#7365ff 50%,#24243e 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_25>div{color:#fff;display:inline-block;margin:0 30px}.template_25>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_25>div{margin:0 10px}}@media (max-width:525px){.template_25>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #0f0c29}.template_25>div:last-child{border-bottom:none}}';
        $shortcodes['template_26']['icon'] = 'no';
        $shortcodes['template_26']['css'] = '.template_26{background:#d3cce3;background:linear-gradient(90deg,#d3cce3 0,#e9e4f0 50%,#d3cce3 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_26>div{color:#6a6279;display:inline-block;margin:0 30px}.template_26>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_26>div{margin:0 10px}}@media (max-width:525px){.template_26>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #7f7a8a}.template_26>div:last-child{border-bottom:none}}';
        $shortcodes['template_29']['icon'] = 'no';
        $shortcodes['template_29']['css'] = '.template_29{background:#6d6027;background:linear-gradient(90deg,#6d6027 0,#d3cbb8 80%,#3c3b3f 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_29>div{color:#fff;display:inline-block;margin:0 30px}.template_29>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_29>div{margin:0 10px}}@media (max-width:525px){.template_29>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #00f260}.template_29>div:last-child{border-bottom:none}}';
        $shortcodes['template_31']['icon'] = 'no';
        $shortcodes['template_31']['css'] = '.template_31{background:#3a1c71;background:linear-gradient(90deg,#3a1c71 0,#d76d77 25%,#ffaf7b 50%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_31>div{color:#1a1a1a;display:inline-block;margin:0 30px}.template_31>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_31>div{margin:0 10px}}@media (max-width:525px){.template_31>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_31>div:last-child{border-bottom:none}}';
        $shortcodes['template_34']['icon'] = 'no';
        $shortcodes['template_34']['css'] = '.template_34{background:#f7971e;background:linear-gradient(90deg,#f7971e 0,#ffd200 50%,#f7971e 1%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_34>div{color:#1a1a1a;display:inline-block;margin:0 30px}.template_34>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_34>div{margin:0 10px}}@media (max-width:525px){.template_34>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_34>div:last-child{border-bottom:none}}';
        $shortcodes['template_39']['icon'] = 'no';
        $shortcodes['template_39']['css'] = '.template_39{background:#000;background:linear-gradient(90deg,#000 0,#b3cc2c 50%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_39>div{color:#fff;display:inline-block;margin:0 30px}.template_39>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_39>div{margin:0 10px}}@media (max-width:525px){.template_39>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_39>div:last-child{border-bottom:none}}';
        $shortcodes['template_40']['icon'] = 'no';
        $shortcodes['template_40']['css'] = '.template_40{background:#ba8b02;background:linear-gradient(90deg,#ba8b02 0,#ffd65d 80%,#ba8b02 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_40>div{color:#1a1a1a;display:inline-block;margin:0 30px}.template_40>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_40>div{margin:0 10px}}@media (max-width:525px){.template_40>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_40>div:last-child{border-bottom:none}}';
        
        if ( !empty($shortcode) ) {
            return wp_json_encode( $shortcodes[$shortcode] );
        } else {
            return wp_json_encode( $shortcodes );
        }
    
    }
    
    /**
     * Advanced Page Visit Counter Migrate from older version.
     *
     * @since    3.0.1
     */
    public function apvc_migrate_from_old_version( $version )
    {
        global  $wpdb ;
        $version = get_option( "apvc_version" );
        
        if ( $version != '3.0.0' && $version != '3.0.1' && $version != '3.0.2' && $version != '3.0.3' && $version != '3.0.4' && $version != '3.0.5' && $version != '3.0.6' ) {
            $newConfArray = [];
            $avc_configNew = (object) get_option( "apvc_configurations", TRUE );
            $avc_config = json_decode( get_option( "avc_config", TRUE ) );
            foreach ( $avc_config as $key => $value ) {
                
                if ( $key == 'post_types' ) {
                    $newConfArray['apvc_post_types'] = $value;
                } else {
                    
                    if ( $key == 'ip_address' ) {
                        $ips = json_decode( $value );
                        foreach ( $ips as $ip ) {
                            $newConfArray['apvc_ip_address'][] = $ip->tag;
                        }
                    } else {
                        
                        if ( $key == 'exclude_counts' ) {
                            $exCounts = json_decode( $value );
                            foreach ( $exCounts as $exCount ) {
                                $newConfArray['apvc_exclude_counts'][] = $exCount->tag;
                            }
                        } else {
                            
                            if ( $key == 'exclude_users' ) {
                                $users = json_decode( $value );
                                foreach ( $users as $user ) {
                                    $newConfArray['apvc_exclude_users'][] = $user->tag;
                                }
                            } else {
                                
                                if ( $key == 'exclude_show_counter' ) {
                                    $exSCounts = json_decode( $value );
                                    foreach ( $exSCounts as $exSCount ) {
                                        $newConfArray['apvc_exclude_show_counter'][] = $exSCount->tag;
                                    }
                                } else {
                                    
                                    if ( $key == 'spam_controller' ) {
                                        $newConfArray['apvc_spam_controller'][0] = ( $value == "true" ? "on" : "" );
                                    } else {
                                        
                                        if ( $key == 'show_conter_on_fron_side' ) {
                                            $newConfArray['apvc_show_conter_on_front_side'][0] = $value;
                                        } else {
                                            
                                            if ( $key == 'avc_default_text_color_of_counter' ) {
                                                $newConfArray['apvc_default_text_color'][0] = $value;
                                            } else {
                                                
                                                if ( $key == 'apv_default_label' ) {
                                                    $newConfArray['apvc_default_label'][0] = $value;
                                                } else {
                                                    
                                                    if ( $key == 'apv_default_border_radius' ) {
                                                        $newConfArray['apvc_default_border_radius'][0] = $value;
                                                    } else {
                                                        
                                                        if ( $key == 'apv_default_background_color' ) {
                                                            $newConfArray['apvc_default_background_color'][0] = $value;
                                                        } else {
                                                            
                                                            if ( $key == 'apv_default_border_color' ) {
                                                                $newConfArray['apvc_default_border_color'][0] = $value;
                                                            } else {
                                                                
                                                                if ( $key == 'apv_default_border_width' ) {
                                                                    $newConfArray['apvc_default_border_width'][0] = $value;
                                                                } else {
                                                                    
                                                                    if ( $key == 'wid_alignment' ) {
                                                                        $newConfArray['apvc_wid_alignment'][0] = $value;
                                                                    } else {
                                                                        
                                                                        if ( $key == 'show_today_count' ) {
                                                                            $newConfArray['apvc_show_today_count'][0] = ( $value == "true" ? "on" : "" );
                                                                        } else {
                                                                            
                                                                            if ( $key == 'show_global_count' ) {
                                                                                $newConfArray['apvc_show_global_count'][0] = ( $value == "true" ? "on" : "" );
                                                                            } else {
                                                                                if ( $key == 'widget_width' ) {
                                                                                    $newConfArray['apvc_widget_width'][0] = $value;
                                                                                }
                                                                            }
                                                                        
                                                                        }
                                                                    
                                                                    }
                                                                
                                                                }
                                                            
                                                            }
                                                        
                                                        }
                                                    
                                                    }
                                                
                                                }
                                            
                                            }
                                        
                                        }
                                    
                                    }
                                
                                }
                            
                            }
                        
                        }
                    
                    }
                
                }
            
            }
            update_option( "apvc_configurations", $newConfArray );
        }
    
    }
    
    public function apvc_get_visit_stats()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $stats = get_transient( "apvc_get_visit_stats" );
        
        if ( empty($stats) ) {
            $labels = [];
            $dCount = [];
            $vCount = [];
            for ( $i = 0 ;  $i < 20 ;  $i++ ) {
                $labels[] = date( "d-M", strtotime( '-' . $i . ' days' ) );
                $sDate = date( "Y-m-d 0:0:0", strtotime( '-' . $i . ' days' ) );
                $eDate = date( "Y-m-d 23:59:59", strtotime( '-' . $i . ' days' ) );
                $dCount[] = $wpdb->get_var( "SELECT COUNT(*) FROM {$table} WHERE date >= '{$sDate}' AND date <= '{$eDate}'" );
                $vCount[] = $wpdb->get_var( "SELECT COUNT(*) FROM {$table} WHERE date >= '{$sDate}' AND date <= '{$eDate}' GROUP BY ip_address" );
            }
            set_transient( "apvc_get_visit_stats", json_encode( [
                "labels"   => $labels,
                "visitors" => $vCount,
                "visits"   => $dCount,
            ] ), APVC_HOURLY_REFRESH );
            echo  wp_json_encode( [
                "message" => "Success",
                "chart"   => json_encode( [
                "labels"   => $labels,
                "visitors" => $vCount,
                "visits"   => $dCount,
            ] ),
            ] ) ;
        } else {
            echo  wp_json_encode( [
                "message" => "Success",
                "chart"   => $stats,
            ] ) ;
        }
        
        wp_die();
    }
    
    public function apvc_get_chart_data_single()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $article = sanitize_text_field( $_REQUEST["article"] );
        $days = sanitize_text_field( $_REQUEST["days"] );
        $labels = [];
        $dCount = [];
        $vCount = [];
        $andQuery = "";
        if ( $days == 0 || $days == "" ) {
            $days = 20;
        }
        for ( $i = 0 ;  $i < 20 ;  $i++ ) {
            $labels[] = date( "d-M", strtotime( '-' . $i . ' days' ) );
            $sDate = date( "Y-m-d 0:0:0", strtotime( '-' . $i . ' days' ) );
            $eDate = date( "Y-m-d 23:59:59", strtotime( '-' . $i . ' days' ) );
            $dCount[] = $wpdb->get_var( "SELECT COUNT(*) FROM {$table} WHERE date >= '{$sDate}' AND date <= '{$eDate}' AND article_id='{$article}' '{$andQuery}' " );
            $vCount[] = $wpdb->get_var( "SELECT COUNT(*) FROM {$table} WHERE date >= '{$sDate}' AND date <= '{$eDate}' AND article_id='{$article}' GROUP BY ip_address" );
        }
        echo  wp_json_encode( [
            "message" => "Success",
            "chart"   => json_encode( [
            "labels"   => $labels,
            "visitors" => $vCount,
            "visits"   => $dCount,
        ] ),
        ] ) ;
        wp_die();
    }

}