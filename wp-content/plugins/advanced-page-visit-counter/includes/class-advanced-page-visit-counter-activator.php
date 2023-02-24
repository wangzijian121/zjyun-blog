<?php

/**
 * Fired during plugin activation
 *
 * @link  https://pagevisitcounter.com
 * @since 3.0.1
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
class Advanced_Visit_Counter_Activator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since 3.0.1
     */
    public static function activate()
    {
        global  $wpdb ;
        set_transient( 'apvcSetPromo', 'no', 86400 );
        update_option( 'apvc_promo', 'yes' );
        $version = get_option( 'apvc_version' );
        $history_table = $wpdb->prefix . 'avc_page_visit_history';
        $exSettings = get_option( 'apvc_configurations' );
        
        if ( empty($exSettings) ) {
            $apvc_config = array();
            $apvc_config['apvc_post_types'] = array( 'post', 'page' );
            $apvc_config['apvc_ip_address'] = array();
            $apvc_config['apvc_exclude_counts'] = array();
            $apvc_config['apvc_exclude_users'] = array();
            $apvc_config['apvc_exclude_show_counter'] = array();
            $apvc_config['apvc_spam_controller'] = '';
            $apvc_config['apvc_show_conter_on_front_side'] = array( 'disable' );
            $apvc_config['apvc_default_text_color'] = array( '#000000' );
            $apvc_config['apvc_default_label'] = array( 'Visits: ' );
            $apvc_config['apvc_todays_label'] = array( 'Today: ' );
            $apvc_config['apvc_global_label'] = array( 'Total: ' );
            $apvc_config['apvc_default_border_radius'] = array( 0 );
            $apvc_config['apvc_default_background_color'] = array( '#ffffff' );
            $apvc_config['apvc_default_border_color'] = array( '#000000' );
            $apvc_config['apvc_default_border_width'] = array( 2 );
            $apvc_config['apvc_wid_alignment'] = array( 'center' );
            $apvc_config['apvc_show_today_count'] = '';
            $apvc_config['apvc_show_global_count'] = '';
            $apvc_config['apvc_widget_width'] = array( 300 );
            $apvc_config['apvc_atc_page_count'] = array( 'on' );
            update_option( 'apvc_configurations', $apvc_config );
        }
        
        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        
        if ( $wpdb->get_var( "SHOW TABLES LIKE '{$history_table}'" ) != $history_table ) {
            $sql = "CREATE TABLE {$history_table} (\n\t\t\t\tid int(11) unsigned NOT NULL AUTO_INCREMENT,\n\t\t\t\tarticle_id int(11) NOT NULL,\n\t\t\t\tarticle_type text NOT NULL,\n\t\t\t\tuser_type text NOT NULL,\n\t\t\t\tdevice_type text NOT NULL,\n\t\t\t\tdate  datetime NOT NULL,\n\t\t\t\tlast_date  datetime NOT NULL,\n\t\t\t\tip_address varchar(255) NOT NULL,\n\t\t\t\tbrowser_full_name varchar(255) NOT NULL,\n\t\t\t\tbrowser_short_name varchar(255) NOT NULL,\n\t\t\t\tbrowser_version varchar(255) NOT NULL,\n\t\t\t\toperating_system varchar(255) NOT NULL,\n\t\t\t\thttp_referer varchar(255) NOT NULL,\n\t\t\t\tuser_id int(9) NOT NULL,\n\t\t\t\tsite_id int(9) NOT NULL,\n\t\t\t\tflag int(1) NULL,\n\t\t\t\tcountry varchar(255),\n\t\t\t\tPRIMARY KEY  (id)\n\t\t\t);";
            include_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta( $sql );
        }
        
        update_option( 'apvc_version', ADVANCED_PAGE_VISIT_COUNTER );
        delete_option( 'apvc_newsletter' );
        delete_option( 'avc_config' );
        update_option( 'apvc_notice', 'no' );
    }

}