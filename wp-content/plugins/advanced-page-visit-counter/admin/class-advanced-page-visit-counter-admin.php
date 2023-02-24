<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://pagevisitcounter.com
 * @since      3.0.1
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/admin
 * @author     Ankit Panchal <wptoolsdev@gmail.com>
 */
class Advanced_Visit_Counter_Admin extends Advanced_Visit_Counter_Queries
{
    /**
     * The ID of this plugin.
     *
     * @var      string    $plugin_name    The ID of this plugin.
     * @since    3.0.1
     * @access   private
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @var      string    $version    The current version of this plugin.
     * @since    3.0.1
     * @access   private
     */
    private  $version ;
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
    /**
     * Initialize the class and set its properties.
     *
     * @param      string $plugin_name       The name of this plugin.
     * @param      string $version    The version of this plugin.
     *
     * @since    3.0.1
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the admin area.
     *
     * @since    3.0.1
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Advanced_Visit_Counter_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Advanced_Visit_Counter_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        
        if ( isset( $_GET['page'] ) && ($_GET['page'] === 'apvc-dashboard-page' || $_GET['page'] === 'apvc-smart-notifications-page') ) {
            wp_enqueue_style(
                'apvc_material_icons',
                plugin_dir_url( __FILE__ ) . 'css/mdi/css/materialdesignicons.min.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_base',
                plugin_dir_url( __FILE__ ) . 'css/vendor.bundle.base.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_base',
                plugin_dir_url( __FILE__ ) . 'css/vendor.bundle.base.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_dataTables_bootstrap4',
                plugin_dir_url( __FILE__ ) . 'assets/datatables/dataTables.bootstrap4.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_icheck',
                plugin_dir_url( __FILE__ ) . 'css/icheck/all.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_select',
                plugin_dir_url( __FILE__ ) . 'css/select2.min.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_tags',
                plugin_dir_url( __FILE__ ) . 'css/jquery.tagsinput.min.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_colorPicker',
                plugin_dir_url( __FILE__ ) . 'css/asColorPicker.min.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_style_base',
                plugin_dir_url( __FILE__ ) . 'css/style.css',
                array(),
                filemtime( plugin_dir_path( __FILE__ ) . 'css/style.css' ),
                'all'
            );
            wp_enqueue_style(
                'apvc_style_main',
                plugin_dir_url( __FILE__ ) . 'css/main/style.css',
                array(),
                filemtime( plugin_dir_path( __FILE__ ) . 'css/main/style.css' ),
                'all'
            );
            wp_enqueue_style(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'css/advanced-page-visit-counter-admin.css',
                array(),
                filemtime( plugin_dir_path( __FILE__ ) . 'css/advanced-page-visit-counter-admin.css' ),
                'all'
            );
        }
    
    }
    
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    3.0.1
     */
    public function enqueue_scripts()
    {
        global  $wpdb ;
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Advanced_Visit_Counter_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Advanced_Visit_Counter_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script(
            'apvc-menu',
            plugin_dir_url( __FILE__ ) . 'js/apvc-menu.js',
            array( 'jquery' ),
            filemtime( plugin_dir_path( __FILE__ ) . 'js/apvc-menu.js' ),
            true
        );
        
        if ( isset( $_GET['page'] ) && ($_GET['page'] === 'apvc-dashboard-page' || $_GET['page'] === 'apvc-smart-notifications-page') ) {
            wp_enqueue_script(
                'apvc_js_base',
                plugin_dir_url( __FILE__ ) . 'js/vendor.bundle.base.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_chart_js',
                plugin_dir_url( __FILE__ ) . 'js/Chart.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_datatables_js',
                plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_datatables4_js',
                plugin_dir_url( __FILE__ ) . 'assets/datatables/dataTables.bootstrap4.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_hover_js',
                plugin_dir_url( __FILE__ ) . 'js/hoverable-collapse.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_misc_js',
                plugin_dir_url( __FILE__ ) . 'js/misc.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_settings_js',
                plugin_dir_url( __FILE__ ) . 'js/settings.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_icheck_js',
                plugin_dir_url( __FILE__ ) . 'js/icheck.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_select_js',
                plugin_dir_url( __FILE__ ) . 'js/select2.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_alert_js',
                plugin_dir_url( __FILE__ ) . 'js/sweetalert.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_asColor_js',
                plugin_dir_url( __FILE__ ) . 'js/jquery-asColor.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_color_picker_js',
                plugin_dir_url( __FILE__ ) . 'js/jquery-asColorPicker.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_tags_js',
                plugin_dir_url( __FILE__ ) . 'js/jquery.tagsinput.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_dashboard_js',
                plugin_dir_url( __FILE__ ) . 'js/dashboard.js',
                array( 'jquery' ),
                filemtime( plugin_dir_path( __FILE__ ) . 'js/dashboard.js' ),
                false
            );
            wp_enqueue_script(
                'apvc_script_js',
                plugin_dir_url( __FILE__ ) . 'js/script.js',
                array( 'jquery' ),
                filemtime( plugin_dir_path( __FILE__ ) . 'js/script.js' ),
                false
            );
            wp_enqueue_script(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'js/advanced-page-visit-counter-admin.js',
                array( 'jquery' ),
                filemtime( plugin_dir_path( __FILE__ ) . 'js/advanced-page-visit-counter-admin.js' ),
                true
            );
            $translations = array(
                'search_lable'      => __( 'Search By :', 'advanced-page-visit-counter' ),
                'shortcode_copied'  => __( 'Shortcode Copied to clipboard.', 'advanced-page-visit-counter' ),
                'import_completed'  => __( 'Data Imported successfully.', 'advanced-page-visit-counter' ),
                'import_failed'     => __( 'File format is not supported.', 'advanced-page-visit-counter' ),
                'shortcode_delete'  => __( 'Shortcode Deleted successfully.', 'advanced-page-visit-counter' ),
                'file_delete'       => __( 'File Deleted successfully.', 'advanced-page-visit-counter' ),
                'success'           => __( 'Success', 'advanced-page-visit-counter' ),
                'failed'            => __( 'Failed', 'advanced-page-visit-counter' ),
                'are_you_sure'      => __( 'Are you sure?', 'advanced-page-visit-counter' ),
                'are_you_sure_text' => __( "You won't be able to revert this!", 'advanced-page-visit-counter' ),
                'cancel_btn'        => __( 'Cancel', 'advanced-page-visit-counter' ),
                'okay_btn'          => __( 'OK', 'advanced-page-visit-counter' ),
                'confirm_btn'       => __( 'Great ', 'advanced-page-visit-counter' ),
                'valid_date'        => __( 'Please select valid date range.', 'advanced-page-visit-counter' ),
                'valid_file'        => __( 'Please upload valid file. (xls,xlsx,csv)', 'advanced-page-visit-counter' ),
                'date_warning'      => __( 'Please enter valid date.', 'advanced-page-visit-counter' ),
                'data_warning'      => __( 'Please enter valid data.', 'advanced-page-visit-counter' ),
                'open'              => __( 'Open', 'advanced-page-visit-counter' ),
                'export_completed'  => __( 'File Export Completed', 'advanced-page-visit-counter' ),
                'shortcode_save'    => __( 'Please Enter Shortcode Name', 'advanced-page-visit-counter' ),
                'cleanup_completed' => __( 'Clean Up Process Completed', 'advanced-page-visit-counter' ),
                'refresh_dashboard' => __( 'Dashboard is reloading now...', 'advanced-page-visit-counter' ),
            );
            $table = APVC_DATA_TABLE;
            $sYear = $wpdb->get_var( "SELECT YEAR(date) FROM {$table} ORDER BY date ASC LIMIT 1" );
            $eYear = date( 'Y' );
            wp_localize_script( $this->plugin_name, 'apvc_ajax', array_merge( array(
                'ajax_url'       => admin_url( 'admin-ajax.php' ),
                'apvc_url'       => 'https://pagevisitcounter.com/',
                'search_lable'   => __( 'Search By :', 'advanced-page-visit-counter' ),
                'admin_d_url'    => admin_url( 'admin.php?page=apvc-dashboard-page' ),
                'post_url'       => get_home_url() . '/?p=',
                'ap_rest_url'    => get_rest_url(),
                'wp_rest'        => wp_create_nonce( 'wp_rest' ),
                'security_nonce' => wp_create_nonce( 'security_nonce' ),
                'show_in_k'      => get_option( 'numbers_in_k' ),
                'fl_warning'     => __( 'Something went wrong! Please reload your browser and try again.', 'advanced-page-visit-counter' ),
            ), $translations ) );
            wp_localize_script( 'apvc_script_js', 'apvc_translation', $translations );
        }
    
    }
    
    /**
     * Advanced Page Visit Counter Settings Page Init
     *
     * @since    3.0.1
     */
    public function avc_settings_page_init()
    {
        global  $wpdb ;
        add_menu_page(
            __( 'Advanced Page Visit Counter', 'advanced-page-visit-counter' ),
            __( 'Advanced Page Visit Counter', 'advanced-page-visit-counter' ),
            'manage_options',
            'apvc-dashboard-page',
            array( $this, 'apvc_dashboard_page' ),
            plugin_dir_url( __FILE__ ) . 'images/a-logo-1.png'
        );
        $history_table = $wpdb->prefix . 'avc_page_visit_history';
        $rows = $wpdb->get_results( "SHOW COLUMNS FROM {$history_table} LIKE 'article_title'" );
        
        if ( count( $rows ) == 0 ) {
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Dashboard', 'advanced-page-visit-counter' ),
                __( 'Dashboard', 'advanced-page-visit-counter' ),
                'manage_options',
                'apvc-dashboard-page',
                array( $this, 'apvc_dashboard_page' )
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Trending', 'advanced-page-visit-counter' ),
                __( 'Trending', 'advanced-page-visit-counter' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Reports', 'advanced-page-visit-counter' ),
                __( 'Reports', 'advanced-page-visit-counter' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Shortcode Generator', 'advanced-page-visit-counter' ),
                __( 'Shortcode Generator', 'advanced-page-visit-counter' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Shortcode Templates', 'advanced-page-visit-counter' ),
                __( 'Shortcode Templates', 'advanced-page-visit-counter' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Settings', 'advanced-page-visit-counter' ),
                __( 'Settings', 'advanced-page-visit-counter' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
        }
    
    }
    
    public function apvc_admin_head()
    {
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the year.
     *
     * @since    3.0.1
     */
    public function apvc_get_total_counts_of_the_year_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $yearTotalCounts = get_transient( 'apvc_yearly_data' );
        
        if ( empty($yearTotalCounts) ) {
            $yearTotalCounts = json_decode( $this->get_total_counts_of_the_year() );
            set_transient( 'apvc_yearly_data', $yearTotalCounts, APVC_HOURLY_REFRESH );
        }
        
        ?>
		<div class="card-body pb-0">
			<p class="text-muted"><?php 
        _e( 'Total Visits (Last 1 Year)', 'advanced-page-visit-counter' );
        ?></p>
			<div class="d-flex align-items-center">
				<h4 class="font-weight-semibold"><?php 
        echo  esc_html( $this->apvc_number_format( $yearTotalCounts->total_counts ) ) ;
        ?></h4>
			</div>

		</div>
		<canvas class="mt-2" height="60" months="<?php 
        echo  esc_html( implode( ',', $yearTotalCounts->months_wise ) ) ;
        ?>" id="apvc_total_visits_yearly"></canvas>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the month.
     *
     * @since    3.0.1
     */
    public function apvc_get_total_counts_of_the_month_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $monthTotalCounts = get_transient( 'apvc_monthly_data' );
        
        if ( empty($monthTotalCounts) ) {
            $monthTotalCounts = json_decode( $this->get_total_counts_of_last_month() );
            set_transient( 'apvc_monthly_data', $monthTotalCounts, APVC_HOURLY_REFRESH );
        }
        
        ?>
		<div class="card-body pb-0">
			<p class="text-muted"><?php 
        _e( 'Total Visits (Month)', 'advanced-page-visit-counter' );
        ?></p>
			<div class="d-flex align-items-center">
				<h4 class="font-weight-semibold"><?php 
        echo  esc_html( $this->apvc_number_format( $monthTotalCounts->lastMonth ) ) ;
        ?></h4>
				<h6 class="<?php 
        echo  esc_html( $monthTotalCounts->class ) ;
        ?> font-weight-semibold ml-2"><?php 
        echo  esc_html( $monthTotalCounts->countDiff ) ;
        ?></h6>
			</div>
		</div>
		<canvas class="mt-2" month="<?php 
        echo  esc_html( implode( ',', $monthTotalCounts->months_wise ) ) ;
        ?>" height="60" id="apvc_total_visits_monthly"></canvas>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the week.
     *
     * @since    3.0.1
     */
    public function apvc_get_total_counts_of_the_week_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $weeksTotalCounts = get_transient( 'apvc_weekly_data' );
        
        if ( empty($weeksTotalCounts) ) {
            $weeksTotalCounts = json_decode( $this->get_total_counts_of_last_week() );
            set_transient( 'apvc_weekly_data', $weeksTotalCounts, APVC_HOURLY_REFRESH );
        }
        
        ?>
		<div class="card-body pb-0">
			<p class="text-muted"><?php 
        _e( 'Total Visits (Week)', 'advanced-page-visit-counter' );
        ?></p>
			<div class="d-flex align-items-center">
				<h4 class="font-weight-semibold"><?php 
        echo  esc_html( $this->apvc_number_format( $weeksTotalCounts->lastWeek ) ) ;
        ?></h4>
				<h6 class="<?php 
        echo  esc_html( $weeksTotalCounts->class ) ;
        ?> font-weight-semibold ml-2"><?php 
        echo  esc_html( $weeksTotalCounts->countDiff ) ;
        ?></h6>
			</div>
		</div>
		<canvas class="mt-2" height="60" weeks="<?php 
        echo  esc_html( implode( ',', $weeksTotalCounts->weeks_wise ) ) ;
        ?>" id="apvc_total_visits_weekly"></canvas>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the day.
     *
     * @since    3.0.1
     */
    public function apvc_get_total_counts_daily_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $dailyTotalCounts = get_transient( 'apvc_daily_data' );
        
        if ( empty($dailyTotalCounts) ) {
            $dailyTotalCounts = json_decode( $this->get_total_counts_of_last_daily() );
            set_transient( 'apvc_daily_data', $dailyTotalCounts, APVC_HOURLY_REFRESH );
        }
        
        ?>
		<div class="card-body pb-0">
			<p class="text-muted"><?php 
        _e( 'Total Visits (Today)', 'advanced-page-visit-counter' );
        ?></p>
			<div class="d-flex align-items-center">
				<h4 class="font-weight-semibold"><?php 
        echo  esc_html( $this->apvc_number_format( $dailyTotalCounts->todaysCounts ) ) ;
        ?></h4>
				<h6 class="<?php 
        echo  esc_html( $dailyTotalCounts->class ) ;
        ?> font-weight-semibold ml-2"><?php 
        echo  esc_html( $dailyTotalCounts->countDiff ) ;
        ?></h6>
			</div>
		</div>
		<canvas class="mt-2" height="60" days="<?php 
        echo  esc_html( implode( ',', $dailyTotalCounts->day_wise ) ) ;
        ?>" id="apvc_total_visits_daily"></canvas>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get stats by browser.
     *
     * @since    3.0.1
     */
    public function apvc_get_browsers_stats_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        $browserTrafficStatsList = get_transient( 'apvc_browser_traffic_stats_data' );
        
        if ( empty($browserTrafficStatsList) ) {
            $browserTrafficStatsList = json_decode( $this->get_browser_traffic_stats_list() );
            set_transient( 'apvc_browser_traffic_stats_data', $browserTrafficStatsList, APVC_HOURLY_REFRESH );
        }
        
        $browserTrafficStats = get_transient( 'apvc_browser_traffic_data' );
        
        if ( empty($browserTrafficStats) ) {
            $browserTrafficStats = json_decode( $this->get_browser_traffic_stats() );
            set_transient( 'apvc_browser_traffic_data', $browserTrafficStats, APVC_HOURLY_REFRESH );
        }
        
        $browserLogos = (array) json_decode( $this->get_browsers_logos() );
        $browsersChartDataV = array();
        $browsersChartDataK = array();
        foreach ( $browserTrafficStatsList as $bChartList ) {
            array_push( $browsersChartDataV, $bChartList->total_count );
            array_push( $browsersChartDataK, $bChartList->browser_full_name );
        }
        ?>
		<div class="d-flex align-items-center mb-0 mb-lg-5">
		  <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" role="tablist">
			<li class="nav-item">
			</li>
		  </ul>
		  <ul class="ml-auto d-none d-lg-block" id="sourceLineChartLegend">
			<?php 
        $classColors = array(
            'bg-primary',
            'bg-success',
            'bg-secondary',
            'bg-danger',
            'bg-warning',
            'bg-pink'
        );
        $bsCnt = 0;
        foreach ( $browserTrafficStats as $bStats ) {
            echo  '<li>
				          <span class="chart-color ' . esc_html( $classColors[$bsCnt] ) . '"></span>
				          <span class="chart-label">' . __( ' ' . $bStats->device_type . ' ', 'advanced-page-visit-counter' ) . number_format_i18n( $bStats->percentage, 2 ) . '%</span>
				        </li>' ;
            $bsCnt++;
        }
        ?>
		  </ul>
		</div>
		<div class="tab-content tab-content-solid">
		  <div class="tab-pane fade show active" id="daily-traffic" role="tabpanel" aria-labelledby="daily-traffic-tab">
			<div class="row">
			  <div class="col-lg-12 order-lg-first">
				<div class="data-list">
				<?php 
        $src = "";
        foreach ( $browserTrafficStatsList as $statsList ) {
            $src = ( isset( $browserLogos[$statsList->browser_short_name] ) ? plugin_dir_url( __FILE__ ) . '/images/' . esc_html( $browserLogos[$statsList->browser_short_name] ) : plugin_dir_url( __FILE__ ) . '/images/' . esc_html( $browserLogos['default'] ) );
            ?>
				  <div class="list-item row">
					<div class="thumb col">
					  <img class="rounded-circle img-xs" src="<?php 
            echo  $src ;
            ?>" alt="thumb"> </div>
					<div class="browser col"><?php 
            echo  esc_html( $statsList->browser_full_name ) ;
            ?></div>
					<div class="visits col"><?php 
            echo  esc_html( $this->apvc_number_format( $statsList->total_count ) ) ;
            ?></div>
				  </div>
				<?php 
        }
        ?>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total counts by referrers.
     *
     * @since    3.0.1
     */
    public function apvc_get_referral_stats_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        $referralTrafficStats = get_transient( 'apvc_ref_traffic_data' );
        
        if ( empty($referralTrafficStats) ) {
            $referralTrafficStats = json_decode( $this->get_referral_websites_stats() );
            set_transient( 'apvc_ref_traffic_data', $referralTrafficStats, APVC_HOURLY_REFRESH );
        }
        
        $refChartDataV = array();
        $refChartDataK = array();
        foreach ( $referralTrafficStats as $refChartList ) {
            array_push( $refChartDataV, $refChartList->total_count );
            array_push( $refChartDataK, ucfirst( $refChartList->http_referer ) );
        }
        ?>
		<div class="col-md-12 legend-wrapper">
			<?php 
        $classColors = array(
            'bg-primary',
            'bg-success',
            'bg-secondary',
            'bg-danger',
            'bg-warning',
            'bg-pink'
        );
        $bsCnt = 0;
        echo  '<div class="data-list">' ;
        foreach ( $referralTrafficStats as $refStats ) {
            ?>
					<div class="list-item row">
						<div class="dot-indicator <?php 
            echo  esc_attr( $classColors[$bsCnt] ) ;
            ?> mt-1 mr-2" style="height: 30px; width: 5px;"></div>
						<div class="browser col"><?php 
            echo  esc_html( $refStats->http_referer ) ;
            ?></div>
						<div class="visits col"><?php 
            echo  esc_html( $this->apvc_number_format( $refStats->total_count ) ) . ' (' . number_format_i18n( $refStats->percentage, 2 ) . '%)' ;
            ?></div>
					  </div>
					  <?php 
            $bsCnt++;
        }
        echo  '</div>' ;
        ?>
		</div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get stats by Operating Systems.
     *
     * @since    3.0.1
     */
    public function apvc_get_os_stats_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        $osTrafficStats = get_transient( 'apvc_os_data' );
        
        if ( empty($osTrafficStats) ) {
            $osTrafficStats = json_decode( $this->get_stats_by_operating_systems() );
            set_transient( 'apvc_os_data', $osTrafficStats, APVC_HOURLY_REFRESH );
            update_option( 'avpc_recent_execution', date( 'Y-m-d H:i:s' ) );
        }
        
        $osChartDataV = array();
        $osChartDataK = array();
        foreach ( $osTrafficStats as $osChartList ) {
            array_push( $osChartDataV, $osChartList->total_count );
            array_push( $osChartDataK, ucfirst( $osChartList->operating_system ) );
        }
        ?>
		<div class="col-md-12 legend-wrapper">
		<?php 
        $classColors = array(
            'bg-primary',
            'bg-success',
            'bg-secondary',
            'bg-danger',
            'bg-warning',
            'bg-pink'
        );
        $bsCnt = 0;
        echo  '<div class="data-list">' ;
        foreach ( $osTrafficStats as $osStats ) {
            ?>
					<div class="list-item row">
						<div class="dot-indicator <?php 
            echo  esc_html( $classColors[$bsCnt] ) ;
            ?> mt-1 mr-2" style="height: 30px; width: 5px;"></div>
						<div class="browser col"><?php 
            echo  ucfirst( esc_html( $osStats->operating_system ) ) ;
            ?></div>
						<div class="visits col"><?php 
            echo  esc_html( $this->apvc_number_format( $osStats->total_count ) ) . ' (' . number_format_i18n( $osStats->percentage, 2 ) . '%)' ;
            ?></div>
					  </div>
				   <?php 
            $bsCnt++;
        }
        echo  '</div>' ;
        ?>
		</div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get Most visited article.
     *
     * @since    3.0.1
     */
    public function apvc_most_visited_article()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $sdate = date( 'Y-m-d 00:00:00' );
        $pedate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -31 day' ) );
        
        if ( isset( $_REQUEST['day'] ) && !empty($_REQUEST['day']) ) {
            $visits = get_transient( 'apvc_mvp_month_data' );
            
            if ( empty($visits) ) {
                $visits = $wpdb->get_results( "SELECT COUNT(*) as ar_count, article_id, (SELECT post_title FROM {$wpdb->posts} WHERE ID = article_id ) as title FROM " . APVC_DATA_TABLE . "  WHERE article_id != '' AND `date` > '{$pedate}' GROUP BY article_id ORDER BY ar_count DESC LIMIT 1" );
                set_transient( 'apvc_mvp_month_data', $visits, APVC_HOURLY_REFRESH );
            }
        
        } else {
            $visits = get_transient( 'apvc_mvp_daily_data' );
            
            if ( empty($visits) ) {
                $visits = $wpdb->get_results( "SELECT COUNT(*) as ar_count, article_id, (SELECT post_title FROM {$wpdb->posts} WHERE ID = article_id ) as title FROM " . APVC_DATA_TABLE . "  WHERE article_id != '' AND `date` > '{$sdate}' GROUP BY article_id ORDER BY ar_count DESC LIMIT 1" );
                set_transient( 'apvc_mvp_daily_data', $visits, APVC_HOURLY_REFRESH );
            }
        
        }
        
        ?>
		<div class="card-body">
			<div class="d-flex justify-content-center">
			  <i class="mdi mdi-clock icon-lg text-primary d-flex align-items-center"></i>
			  <div class="d-flex flex-column ml-4">
				<span class="d-flex flex-column">
				  <p class="mb-0"><?php 
        _e( 'Most Visited Article', 'advanced-page-visit-counter' );
        ?></p>
				  <h5 class="font-weight-bold"><?php 
        echo  ( isset( $visits[0]->title ) ? esc_html( $visits[0]->title ) : "" ) ;
        ?>
				  <span class="text-muted"><a style="font-weight: normal; font-size: 14px !important;" href="<?php 
        echo  get_the_permalink( $visits[0]->article_id ) ;
        ?>" target="_blank"><?php 
        _e( 'Link', 'advanced-page-visit-counter' );
        ?></a></span></h5>
				</span>
			  </div>
			</div>
		</div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get first time visitors.
     *
     * @since    3.0.1
     */
    public function apvc_get_first_time_visitors()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $sdate = date( 'Y-m-d 00:00:00' );
        $edate = date( 'Y-m-d 23:59:59' );
        $pedate = date( 'Y-m-d 00:00:00', strtotime( date( 'Y-m-d 0:0:0' ) . ' -30 day' ) );
        
        if ( isset( $_REQUEST['day'] ) && !empty($_REQUEST['day']) ) {
            $ipsToday = get_transient( 'apvc_fv_30_td' );
            
            if ( empty($ipsToday) ) {
                $ipsToday = $wpdb->get_results( 'SELECT ip_address FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' AND `date` >= '{$sdate}' GROUP BY ip_address", ARRAY_N );
                set_transient( 'apvc_fv_30_td', $ipsToday, APVC_HOURLY_REFRESH );
            }
            
            $ipsPast = get_transient( 'apvc_fv_30_past' );
            
            if ( empty($ipsPast) ) {
                $ipsPast = $wpdb->get_results( 'SELECT ip_address FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' AND `date` >= '{$pedate}' AND `date` < '{$sdate}' GROUP BY ip_address", ARRAY_N );
                set_transient( 'apvc_fv_30_past', $ipsPast, APVC_HOURLY_REFRESH );
            }
        
        } else {
            $ipsToday = get_transient( 'apvc_fv_td' );
            
            if ( empty($ipsToday) ) {
                $ipsToday = $wpdb->get_results( 'SELECT ip_address FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' AND `date` >= '{$sdate}' AND `date` <= '{$edate}' GROUP BY ip_address", ARRAY_N );
                set_transient( 'apvc_fv_td', $ipsToday, APVC_HOURLY_REFRESH );
            }
            
            $ipsPast = get_transient( 'apvc_fv_past' );
            
            if ( empty($ipsPast) ) {
                $ipsPast = $wpdb->get_results( 'SELECT ip_address FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' AND `date` >= '{$pedate}' AND `date` <= '{$sdate}'\t GROUP BY ip_address", ARRAY_N );
                set_transient( 'apvc_fv_past', $ipsPast, APVC_HOURLY_REFRESH );
            }
        
        }
        
        $ipsToday = call_user_func_array( 'array_merge', $ipsToday );
        $ipsPast = call_user_func_array( 'array_merge', $ipsPast );
        
        if ( count( $ipsPast ) <= 0 ) {
            $fnCount = count( $ipsToday );
        } else {
            $fnCount = count( array_diff( $ipsToday, $ipsPast ) );
        }
        
        ?>
		<div class="card-body">
			<div class="d-flex justify-content-center">
			  <i class="mdi mdi-human-greeting icon-lg text-success d-flex align-items-center"></i>
			  <div class="d-flex flex-column ml-4">
				<span class="d-flex flex-column">
				  <p class="mb-0"><?php 
        _e( 'First Time Visitors', 'advanced-page-visit-counter' );
        ?></p>
				  <h4 class="font-weight-bold"><?php 
        echo  esc_html( $fnCount ) ;
        ?></h4>
				</span>
			  </div>
			</div>
		  </div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total visitors.
     *
     * @since    3.0.1
     */
    public function apvc_get_visitors()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $sdate = date( 'Y-m-d 00:00:00' );
        $pedate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -30 day' ) );
        
        if ( isset( $_REQUEST['day'] ) && !empty($_REQUEST['day']) ) {
            $q = " AND `date` >= '{$pedate}' AND `date` <= '{$sdate}' ";
            $visitors = get_transient( 'apvc_get_visitors_mn_data' );
            
            if ( empty($visitors) ) {
                $visitors = count( $wpdb->get_results( 'SELECT DISTINCT ip_address FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' " . $q ) );
                set_transient( 'apvc_get_visitors_mn_data', $visitors, APVC_HOURLY_REFRESH );
            }
        
        } else {
            $q = " AND `date` >= '{$sdate}' ";
            $visitors = get_transient( 'apvc_get_visitors_data' );
            
            if ( empty($visitors) ) {
                $visitors = count( $wpdb->get_results( 'SELECT DISTINCT ip_address FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' " . $q ) );
                set_transient( 'apvc_get_visitors_data', $visitors, APVC_HOURLY_REFRESH );
            }
        
        }
        
        ?>
		<div class="card-body">
			<div class="d-flex justify-content-center">
			  <i class="mdi mdi-laptop icon-lg text-warning d-flex align-items-center"></i>
			  <div class="d-flex flex-column ml-4">
				<span class="d-flex flex-column">
				  <p class="mb-0"><?php 
        _e( 'Total Visitors', 'advanced-page-visit-counter' );
        ?></p>
				  <h4 class="font-weight-bold"><?php 
        echo  esc_html( $visitors ) ;
        ?></h4>
				</span>
			  </div>
			</div>
		  </div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get page views per visitor.
     *
     * @since    3.0.1
     */
    public function apvc_get_page_views_per_visitor()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $today = date( 'Y-m-d 00:00:01' );
        $lstDate = date( 'Y-m-d 00:00:01', strtotime( date( 'Y-m-d 00:00:01' ) . ' -30 days' ) );
        
        if ( isset( $_REQUEST['day'] ) && !empty($_REQUEST['day']) ) {
            $q = " AND `date` >= '{$lstDate}' AND `date` <= '{$today}' ";
            $totalCounts = get_transient( 'apvc_pvp_30_data' );
            
            if ( empty($totalCounts) ) {
                $totalCounts = count( $wpdb->get_results( 'SELECT * FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' " . $q . ' ' ) );
                set_transient( 'apvc_pvp_30_data', $totalCounts, APVC_HOURLY_REFRESH );
            }
            
            $ipCounts = get_transient( 'apvc_pvp_ip_30_data' );
            
            if ( empty($ipCounts) ) {
                $ipCounts = count( $wpdb->get_results( 'SELECT * FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' " . $q . '  GROUP BY ip_address' ) );
                set_transient( 'apvc_pvp_ip_30_data', $ipCounts, APVC_HOURLY_REFRESH );
            }
        
        } else {
            $q = " AND `date` >= '{$today}' ";
            $totalCounts = get_transient( 'apvc_pvp_daily_data' );
            
            if ( empty($totalCounts) ) {
                $totalCounts = count( $wpdb->get_results( 'SELECT * FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' " . $q . ' ' ) );
                set_transient( 'apvc_pvp_daily_data', $totalCounts, APVC_HOURLY_REFRESH );
            }
            
            $ipCounts = get_transient( 'apvc_pvp_ip_daily_data' );
            
            if ( empty($ipCounts) ) {
                $ipCounts = count( $wpdb->get_results( 'SELECT * FROM ' . APVC_DATA_TABLE . " WHERE article_id != '' " . $q . '  GROUP BY ip_address' ) );
                set_transient( 'apvc_pvp_ip_daily_data', $ipCounts, APVC_HOURLY_REFRESH );
            }
        
        }
        
        
        if ( $totalCounts > 0 && $ipCounts > 0 ) {
            $count = ( ceil( $totalCounts / $ipCounts ) !== 'NAN' ? ceil( $totalCounts / $ipCounts ) : '0' );
        } else {
            $count = 0;
        }
        
        ?>
		 <div class="card-body">
			<div class="d-flex justify-content-center">
			  <i class="mdi mdi-earth icon-lg text-danger d-flex align-items-center"></i>
			  <div class="d-flex flex-column ml-4">
				<span class="d-flex flex-column">
				  <p class="mb-0"><?php 
        _e( 'Page Views Per Visitor', 'advanced-page-visit-counter' );
        ?></p>
				  <h4 class="font-weight-bold"><?php 
        echo  esc_html( $count ) ;
        ?></h4>
				</span>
			  </div>
			</div>
		  </div>
		<?php 
        wp_die();
    }
    
    /*
     * Advanced Page Visit Counter update the dashboard data.
     *
     * @since    3.0.6
     */
    public function apvc_dashboard_updated()
    {
        if ( !wp_verify_nonce( $_GET['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        $recentUpdated = get_option( 'avpc_recent_execution', true );
        echo  $this->apvc_get_human_time_diff( $recentUpdated ) ;
        wp_die();
    }
    
    /*
     * Advanced Page Visit Counter Refresh the dashboard with latest data.
     *
     * @since    3.0.6
     */
    public function apvc_refresh_dashboard()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        foreach ( $this->transients as $transient ) {
            delete_transient( $transient );
        }
        $this->apvc_get_total_counts_of_the_year_data();
        $this->apvc_get_total_counts_of_the_month_data();
        $this->apvc_get_total_counts_of_the_week_data();
        $this->apvc_get_total_counts_daily_data();
        $this->apvc_get_browsers_stats_data();
        $this->apvc_get_referral_stats_data();
        $this->apvc_get_os_stats_data();
        $this->apvc_most_visited_article();
        $this->apvc_get_first_time_visitors();
        $this->apvc_get_visitors();
        $this->apvc_get_page_views_per_visitor();
        $this->apvc_get_visit_stats();
    }
    
    /**
     * Advanced Page Visit Counter Get settings page data.
     *
     * @since    3.0.1
     */
    public function apvc_settings_page_content()
    {
        global  $wpdb ;
        $recentUpdated = get_option( 'avpc_recent_execution', true );
        ?>
		<input type="hidden" id="current_page" value="dashboard">
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel container">
				  <div class="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<div class="hm_dash_heading">
								<h5 class="text-right"><?php 
        _e( "Dashboard Updated: <span id='apvc_dash_updated'>" . $this->apvc_get_human_time_diff( $recentUpdated ) . '</span>', 'advanced-page-visit-counter' );
        ?><button type="button" id="apvc_update_dash" class="btn btn-primary btn-fw"><i class="mdi mdi-dna"></i><?php 
        echo  _e( 'Update Now', 'advanced-page-visit-counter' ) ;
        ?></button></h5>

							</div>
						</div>
					  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card">
						<div class="card card-statistics" id="total_counts_year_data">
						 <?php 
        $this->apvc_loader_control();
        ?>
						</div>
					  </div>
					  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card">
						<div class="card card-statistics" id="total_counts_month_data">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					  </div>
					  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card">
						<div class="card card-statistics" id="total_counts_weeks_data">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					  </div>
					  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card">
						<div class="card card-statistics" id="total_counts_daily_data">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					  </div>

					<div class="col-lg-12">
						<div class="hm_heading">
							<h4 class="font-weight-semibold"><?php 
        _e( 'Today', 'advanced-page-visit-counter' );
        ?></h4>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_visit_length">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_total_visitors">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_first_time_visitors">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_post_views_per_user">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="hm_heading">
							<h4 class="font-weight-semibold"><?php 
        _e( 'Last 30 Days', 'advanced-page-visit-counter' );
        ?></h4>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_visit_length_t">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_total_visitors_t">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_first_time_visitors_t">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_post_views_per_user_t">
							<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-lg-12 grid-margin stretch-card">
						<div class="card">
						  <div class="p-4 border-bottom">
							  <div class="col-lg-8 float-left">
								<h4 class="card-title mb-0"><?php 
        _e( "Visit Statistics - <span id='duration_change'>Last 20 Days Statistics</span>", 'advanced-page-visit-counter' );
        ?></h4>
								<span style="font-size: 10px; color: red; font-style: italic;">*It can take some time to render chart based on size of the data.</span>
							</div>
							<div class="col-lg-4 float-right">
								<?php 
        ?>
								<select class="float-right" id="apvc_filter_chart_dash">
									<option selected="selected"><?php 
        _e( 'Filter Data', 'advanced-page-visit-counter' );
        ?></option>
									<option value="7_days"><?php 
        _e( '1 Week', 'advanced-page-visit-counter' );
        ?></option>
									<option value="1_month"><?php 
        _e( '1 Month', 'advanced-page-visit-counter' );
        ?></option>
									<option value="3_months"><?php 
        _e( '3 Months', 'advanced-page-visit-counter' );
        ?></option>
									<option value="6_month"><?php 
        _e( '6 Months', 'advanced-page-visit-counter' );
        ?></option>
								</select>
							  </div>
						  </div>

						  <div class="card-body visitStatsChart">
							<canvas id="visitStatsChart" style="position: relative; height:50vh; width:80vw"></canvas>
							 <div class="c-loader"><?php 
        $this->apvc_loader_control();
        ?></div>
						  </div>
						</div>
					  </div>
					<?php 
        ?>

					<div class="col-md-6 stretch-card">
						<div class="card">
						  <div class="card-header header-sm">
							<div class="d-flex align-items-center">
							  <h4 class="card-title mb-0"><?php 
        _e( 'Browser Traffic', 'advanced-page-visit-counter' );
        ?></h4>
							</div>
						  </div>
						  <div class="card-body" id="apvc_browser_stats_data">
							<?php 
        $this->apvc_loader_control();
        ?>
						  </div>
						</div>
					</div>

					<div class="col-md-6 grid-margin stretch-card">
						<div class="card">
						  <div class="card-body">
							<h4 class="card-title mb-4"><?php 
        _e( 'Traffic source (Referral Websites)', 'advanced-page-visit-counter' );
        ?></h4>
							<hr>
							<div class="row" id="apvc_referral_stats_data">
								<?php 
        $this->apvc_loader_control();
        ?>
							</div>


						  </div>
						</div>
					</div>
					<div class="col-md-6 grid-margin stretch-card">
						<div class="card">
						  <div class="card-body">
							<h4 class="card-title mb-4"><?php 
        _e( 'Traffic by Operating Systems', 'advanced-page-visit-counter' );
        ?></h4>
							<hr>
							<div class="row" id="apvc_os_stats_data">
							  <?php 
        $this->apvc_loader_control();
        ?>
							</div>
						  </div>
						</div>
					</div>
				  </div>
				</div>
			  </div>
		</div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Get version info block.
     *
     * @since    3.0.1
     */
    public function apvc_get_version_info_block()
    {
        if ( isset( $_GET['apvc_page'] ) ) {
            return;
        }
    }
    
    /**
     * Advanced Page Visit Counter Get date is valid or not.
     *
     * @since    3.0.1
     */
    public function apvc_is_date( $str )
    {
        $str = str_replace( '/', '-', $str );
        // see explanation below for this replacement
        return is_numeric( strtotime( $str ) );
    }
    
    /**
     * Advanced Page Visit Counter Get loader.
     *
     * @since    3.0.1
     */
    public function apvc_loader_control()
    {
        ?>
		<div class="loader-demo-box" style="border: none !important;">
		  <div class="square-box-loader">
			<div class="square-box-loader-container">
			  <div class="square-box-loader-corner-top"></div>
			  <div class="square-box-loader-corner-bottom"></div>
			</div>
			<div class="square-box-loader-square"></div>
		  </div>
		</div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Get top pages data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_pages_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $top10Pages = json_decode( $this->apvc_get_top_10_page_data() );
        ?>
		  <div class="d-flex justify-content-between">
			  <h4 class="card-title">
			  <?php 
        echo  __( 'Top 10 Pages', 'advanced-page-visit-counter' ) ;
        ?>
		</h4>
		  </div>
			<?php 
        $count = 1;
        
        if ( count( $top10Pages ) <= 0 ) {
            echo  '<h5 class="text-center">' . __( 'No Pages Found', 'advanced-page-visit-counter' ) . '</h5>' ;
        } else {
            foreach ( $top10Pages as $pages ) {
                ?>
			<div class="list d-flex align-items-center border-bottom py-3">
			  <div class="wrapper w-100 ml-3">
				<p class="mb-0"><b>
					<?php 
                echo  $count++ ;
                ?>
				.</b> 
					<?php 
                echo  esc_html( $pages->title ) ;
                ?>
				</p>
				<div class="d-flex justify-content-between align-items-center">
				  <div class="d-flex align-items-center">
					<i class="mdi mdi-clock text-muted mr-1"></i>
					  <small class="text-muted ml-auto">
					<?php 
                echo  __( 'Recent Visit:', 'advanced-page-visit-counter' ) ;
                ?>
				 <b>
					<?php 
                echo  $this->get_recent_visit( $pages->article_id ) ;
                ?>
				</b></small>&nbsp;
					  <small class="text-muted ml-auto"> 
					<?php 
                echo  __( 'Total Visits:', 'advanced-page-visit-counter' ) ;
                ?>
				 <b>
					<?php 
                echo  esc_html( $pages->count ) ;
                ?>
				</b></small>
					  <small class="text-muted ml-auto"><a href="
					<?php 
                echo  get_permalink( $pages->article_id ) ;
                ?>
				" target="_blank"><b>&nbsp;&nbsp;
					<?php 
                echo  __( 'Link', 'advanced-page-visit-counter' ) ;
                ?>
				</b></a></small>

				  </div>
				</div>
			  </div>
			</div>
					<?php 
            }
        }
        
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get top posts data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_posts_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $top10Posts = json_decode( $this->apvc_get_top_10_posts_data() );
        ?>
		<div class="d-flex justify-content-between">
		  <h4 class="card-title"><?php 
        _e( 'Top 10 Posts', 'advanced-page-visit-counter' );
        ?></h4>
		</div>
		<?php 
        $count = 1;
        
        if ( count( $top10Posts ) <= 0 ) {
            echo  '<h5 class="text-center">' . __( 'No Posts Found', 'advanced-page-visit-counter' ) . '</h5>' ;
        } else {
            foreach ( $top10Posts as $posts ) {
                ?>
		<div class="list d-flex align-items-center border-bottom py-3">
		  <div class="wrapper w-100 ml-3">
			<p class="mb-0"><b><?php 
                echo  $count++ ;
                ?>.</b> <?php 
                echo  esc_html( $posts->title ) ;
                ?></p>
			<div class="d-flex justify-content-between align-items-center">
			  <div class="d-flex align-items-center">
				<i class="mdi mdi-clock text-muted mr-1"></i>
				  <small class="text-muted ml-auto"><?php 
                _e( 'Recent Visit:', 'advanced-page-visit-counter' );
                ?> <b><?php 
                echo  $this->get_recent_visit( $posts->article_id ) ;
                ?></b></small>&nbsp;
				  <small class="text-muted ml-auto"> <?php 
                _e( 'Total Visits:', 'advanced-page-visit-counter' );
                ?> <b><?php 
                echo  $this->apvc_number_format( $posts->count ) ;
                ?></b></small>
				  <small class="text-muted ml-auto"><a href="<?php 
                echo  get_permalink( $posts->article_id ) ;
                ?>" target="_blank"><b>&nbsp;&nbsp;<?php 
                _e( 'Link', 'advanced-page-visit-counter' );
                ?></b></a></small>

			  </div>
			</div>
		  </div>
		</div>
				<?php 
            }
        }
        
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get top countries data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_countries_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $top10Country = json_decode( $this->apvc_get_top_10_contries_data() );
        ?>
		<div class="d-flex justify-content-between">
		  <h4 class="card-title"><?php 
        _e( 'Top 10 Country', 'advanced-page-visit-counter' );
        ?></h4>
		</div>
		<?php 
        $count = 1;
        
        if ( count( $top10Country ) <= 0 ) {
            echo  '<h5 class="text-center">' . __( 'No Countries Found', 'advanced-page-visit-counter' ) . '</h5>' ;
        } else {
            foreach ( $top10Country as $country ) {
                ?>
		<div class="list d-flex align-items-center border-bottom py-3">
		  <div class="wrapper w-100 ml-3">
			<p class="mb-0"><b><?php 
                echo  $count++ ;
                ?>.</b> <?php 
                echo  esc_html( $country->country ) ;
                ?>

			<img width="20px" src="<?php 
                echo  plugin_dir_url( __FILE__ ) . '/images/flags/' . strtolower( $this->get_country_name( $country->country ) ) ;
                ?>.svg" alt="<?php 
                echo  esc_attr( $country->country ) ;
                ?>" title="<?php 
                echo  esc_html( $country->country ) ;
                ?>">
			</p>
			<div class="d-flex justify-content-between align-items-center">
			  <div class="d-flex align-items-center">
				<i class="mdi mdi-clock text-muted mr-1"></i>
				  <small class="text-muted ml-auto"><?php 
                _e( 'Recent Visit:', 'advanced-page-visit-counter' );
                ?> <b><?php 
                echo  $this->get_recent_visit( esc_html( $country->article_id ) ) ;
                ?></b></small>&nbsp;
				  <small class="text-muted ml-auto"> <?php 
                _e( 'Total Visits:', 'advanced-page-visit-counter' );
                ?> <b><?php 
                echo  $this->apvc_number_format( intval( $country->count ) ) ;
                ?></b></small>
				  <small class="text-muted ml-auto"><a href="<?php 
                echo  get_permalink( esc_html( $country->article_id ) ) ;
                ?>" target="_blank"><b>&nbsp;&nbsp;<?php 
                _e( 'Link', 'advanced-page-visit-counter' );
                ?></b></a></small>

			  </div>
			</div>
		  </div>
		</div>
				<?php 
            }
        }
        
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get top ip address data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_ip_address_data()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        global  $wpdb ;
        $top10IPAddress = json_decode( $this->apvc_get_top_10_ip_address_data() );
        ?>
		<div class="d-flex justify-content-between">
		  <h4 class="card-title"><?php 
        _e( 'Top 10 IP Addresses', 'advanced-page-visit-counter' );
        ?></h4>
		</div>
		<?php 
        $count = 1;
        
        if ( count( $top10IPAddress ) <= 0 ) {
            echo  '<h5 class="text-center">' . __( 'No IP Address Data Found', 'advanced-page-visit-counter' ) . '</h5>' ;
        } else {
            foreach ( $top10IPAddress as $ip_address ) {
                ?>
		<div class="list d-flex align-items-center border-bottom py-3">
		  <div class="wrapper w-100 ml-3">
			<p class="mb-0"><b><?php 
                echo  $count++ ;
                ?>.</b> <?php 
                echo  esc_html( $ip_address->ip_address ) ;
                ?>
			<img width="20px" src="<?php 
                echo  plugin_dir_url( __FILE__ ) . '/images/flags/' . esc_html( strtolower( $this->get_country_name( $ip_address->country ) ) ) ;
                ?>.svg" alt="<?php 
                echo  esc_attr( $this->get_country_name( $ip_address->country ) ) ;
                ?>" title="<?php 
                echo  esc_attr( $this->get_country_name( $ip_address->country ) ) ;
                ?>">
			</p>
			<div class="d-flex justify-content-between align-items-center">
			  <div class="d-flex align-items-center">
				<i class="mdi mdi-clock text-muted mr-1"></i>
				  <small class="text-muted ml-auto"><?php 
                _e( 'Recent Visit:', 'advanced-page-visit-counter' );
                ?> <b><?php 
                echo  esc_html( $this->get_recent_visit( $ip_address->ip_address, 'ip_address' ) ) ;
                ?></b></small>&nbsp;
				  <small class="text-muted ml-auto"> <?php 
                _e( 'Total Visits:', 'advanced-page-visit-counter' );
                ?> <b><?php 
                echo  esc_html( $this->apvc_number_format( $ip_address->count ) ) ;
                ?></b></small>
				  <small class="text-muted ml-auto"><a href="<?php 
                echo  get_permalink( $ip_address->article_id ) ;
                ?>" target="_blank"><b>&nbsp;&nbsp;<?php 
                _e( 'Link', 'advanced-page-visit-counter' );
                ?></b></a></small>

			  </div>
			</div>
		  </div>
		</div>
				<?php 
            }
        }
        
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get trending pages data.
     *
     * @since    3.0.1
     */
    public function apvc_top_trending_content()
    {
        global  $wpdb ;
        ?>
		<input type="hidden" id="current_page" value="trending">
		<div class="container-fluid page-body-wrapper trending">
			<div class="main-panel container">
				<div class="content-wrapper">
					<div class="row">
						<?php 
        ?>

						<div class="col-12 col-md-12 col-lg-6 grid-margin stretch-card">
							<div class="card">
							  <div class="card-body" id="apvc_top_pages_data">
								<?php 
        $this->apvc_loader_control();
        ?>
							  </div>
							   </div>
						</div>
						<div class="col-12 col-md-12 col-lg-6 grid-margin stretch-card">
							<div class="card">
							  <div class="card-body" id="apvc_top_posts_data">
								<?php 
        $this->apvc_loader_control();
        ?>
							  </div>
							</div>
						</div>
						<div class="col-12 col-md-12 col-lg-6 grid-margin stretch-card">
							<div class="card">
							  <div class="card-body" id="apvc_top_countries_data">
								<?php 
        $this->apvc_loader_control();
        ?>
							  </div>
							</div>
						</div>
						<div class="col-12 col-md-12 col-lg-6 grid-margin stretch-card">
							<div class="card">
							  <div class="card-body" id="apvc_top_ip_address_data">
								<?php 
        $this->apvc_loader_control();
        ?>
							  </div>
							</div>
						</div>
					  </div>
				  </div>
			  </div>
		  </div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Get reports page data.
     *
     * @since    3.0.0
     */
    public function apvc_reports_page_content()
    {
        global  $wpdb ;
        
        if ( isset( $_GET['pageno'] ) ) {
            $pageno = sanitize_text_field( $_GET['pageno'] );
        } else {
            $pageno = 1;
        }
        
        $per_page = ( isset( $_GET['per_page'] ) && $_GET['per_page'] ? sanitize_text_field( $_GET['per_page'] ) : 10 );
        $offset = ($pageno - 1) * $per_page;
        $apvcReports = json_decode( $this->get_the_reports( $offset, $per_page ) );
        $total_pages = ceil( $apvcReports->totalCount / $per_page );
        $per_page_var = "";
        $dropDown = '';
        
        if ( $pageno == 0 ) {
            $rCnt = 1;
        } else {
            $rCnt = absint( $per_page ) * absint( $pageno - 1 ) + 1;
        }
        
        ?>
		<div class="container-fluid page-body-wrapper general-reports">
			<div class="main-panel container">
			  <div class="content-wrapper">
				  <div class="row grid-margin">
					<?php 
        ?>
				  </div>
				<div class="card report_card col-md-12">
				  <div class="card-body">
					<div class="row">
					  <div class=" table-responsive">
						  <div class="apvc-detailed-filters">
							<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php 
        echo  'Articles Per Page - ' . esc_html( $per_page ) ;
        ?></button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=10<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '10', 'advanced-page-visit-counter' );
        ?></a>
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=20<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '20', 'advanced-page-visit-counter' );
        ?></a>
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=50<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '50', 'advanced-page-visit-counter' );
        ?></a>
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=100<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '100', 'advanced-page-visit-counter' );
        ?></a>
								  <div class="dropdown-divider"></div>
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=500<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '500', 'advanced-page-visit-counter' );
        ?></a>
								</div>
							</div>
						</div>
						<table id="reports-listinga" class="table">
						  <thead>
							<tr>
							  <th><?php 
        _e( 'No.', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Article ID', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Article Title', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Total Visits Count', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Detailed Report', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Chart', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Set Starting Count', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Reset Count', 'advanced-page-visit-counter' );
        ?></th>
							</tr>
						  </thead>
						  <tbody>
							<?php 
        foreach ( $apvcReports->list as $reports ) {
            echo  '<tr>
			              				  <td>' . $rCnt++ . '</td>
						                  <td>' . $reports->article_id . '</td>
						                  <td><div class="apvc_title">' . $reports->title . '</div></td>
						                  <td>' . $this->apvc_number_format( $reports->count ) . '</td>
						                  <td>
						                    <a href="' . get_admin_url( get_current_blog_id(), 'admin.php?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=' . $reports->article_id . $dropDown . '' ) . '" class="btn btn-outline-primary">' . __( 'View', 'advanced-page-visit-counter' ) . '</a>
						                  </td>
						                  <td>
						                    <a href="' . get_admin_url( get_current_blog_id(), 'admin.php?page=apvc-dashboard-page&apvc_page=detailed-reports-chart&article_id=' . $reports->article_id . $dropDown . '' ) . '" class="btn btn-outline-primary">' . __( 'View Chart', 'advanced-page-visit-counter' ) . '</a>
						                  </td>
						                  <td>
						                    <a href="javascript:void(0);" art_id="' . $reports->article_id . '" class="btn btn-outline-primary set_start_cnt" data-toggle="modal" data-target="#setCnt"><i class="link-icon mdi mdi-clock"></i></a>
						                  </td>
						                  <td>
						                    <a href="javascript:void(0);" art_id="' . $reports->article_id . '" class="btn btn-outline-primary btn-red reset_cnt" data-toggle="modal" data-target="#resetCnt">X</a>
						                  </td>
						                </tr>' ;
        }
        ?>

						  </tbody>
						</table>

						<nav>
							<ul class="pagination d-flex justify-content-center">
								<li class="page-item"><a class="page-link" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=1<?php 
        echo  esc_html( $per_page_var ) ;
        ?>"><?php 
        _e( 'First', 'advanced-page-visit-counter' );
        ?></a></li>
								<li class="page-item 
								<?php 
        if ( $pageno <= 1 ) {
            echo  'disabled' ;
        }
        ?>
								">
									<a class="page-link" href="
									<?php 
        
        if ( $pageno <= 1 ) {
            echo  '#' ;
        } else {
            echo  '?page=apvc-dashboard-page&apvc_page=reports&pageno=' . ($pageno - 1) ;
        }
        
        ?>
															   <?php 
        echo  esc_html( $per_page_var ) ;
        ?>"><?php 
        _e( 'Prev', 'advanced-page-visit-counter' );
        ?></a>
								</li>
								<li class="page-item 
								<?php 
        if ( $pageno >= $total_pages ) {
            echo  'disabled' ;
        }
        ?>
								">
									<a class="page-link" href="
									<?php 
        
        if ( $pageno >= $total_pages ) {
            echo  '#' ;
        } else {
            echo  '?page=apvc-dashboard-page&apvc_page=reports&pageno=' . ($pageno + 1) ;
        }
        
        ?>
															   <?php 
        echo  esc_html( $per_page_var ) ;
        ?>"><?php 
        _e( 'Next', 'advanced-page-visit-counter' );
        ?></a>
								</li>
								<li class="page-item"><a class="page-link" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  esc_html( $total_pages ) ;
        echo  esc_html( $per_page_var ) ;
        ?>"><?php 
        _e( 'Last', 'advanced-page-visit-counter' );
        ?> (<?php 
        echo  esc_html( $total_pages ) ;
        ?>)</a></li>
							</ul>
						</nav>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>


		<div class="modal fade" id="setCnt" style="top:10%;" tabindex="-1" role="dialog" aria-labelledby="setCnt" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header text-center">
				<h5 class="modal-title"><?php 
        _e( 'Set Starting Count', 'advanced-page-visit-counter' );
        ?></h5>
			  </div>
			  <div class="modal-body setCntPreview" style="padding: 10px 25px;">
				<?php 
        $this->apvc_loader_control();
        ?>
			  </div>
			  <div class="modal-footer text-center">
				  <button type="button" class="btn btn-primary setCntSaveBtn"><?php 
        _e( 'Save Changes', 'advanced-page-visit-counter' );
        ?></button>
				<button type="button" class="setCntCloseBtn btn btn-warning"><?php 
        _e( 'Cancel', 'advanced-page-visit-counter' );
        ?></button>
			  </div>

			</div>
		  </div>
		</div>

		<div class="modal fade" id="resetCnt" style="top:10%;" tabindex="-1" role="dialog" aria-labelledby="resetCnt" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-body text-center" style="padding: 50px">

				<?php 
        _e( 'Are you sure to delete/reset count for this article? <Br />(This is impossible to revert.)', 'advanced-page-visit-counter' );
        ?><Br /><Br />
				  <button type="button" id="art_id_btn" art_id="" class="btn btn-primary resetCnt"><?php 
        _e( 'Yes', 'advanced-page-visit-counter' );
        ?></button>
				<button type="button" class="resetCloseBtn btn btn-warning"><?php 
        _e( 'No', 'advanced-page-visit-counter' );
        ?></button>
				<Br />
			  </div>
			</div>
		  </div>
		</div>




		<?php 
    }
    
    public function apvc_reset_count_art()
    {
        global  $wpdb ;
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        $history_table = $wpdb->prefix . 'avc_page_visit_history';
        $art_id = sanitize_text_field( $_REQUEST['artID'] );
        
        if ( $wpdb->query( "DELETE FROM {$history_table} WHERE article_id= '" . esc_sql( $art_id ) . "'" ) ) {
            echo  wp_send_json_success( 'success' ) ;
        } else {
            echo  wp_send_json_error() ;
        }
        
        wp_die();
    }
    
    public function apvc_show_counter_options()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        $art_id = esc_sql( sanitize_text_field( $_REQUEST['artID'] ) );
        $active = get_post_meta( $art_id, 'apvc_active_counter', true );
        $base_count = get_post_meta( $art_id, 'count_start_from', true );
        $widget_label = get_post_meta( $art_id, 'widget_label', true );
        ?>
		<style>p{ margin: 15px 0px 10px 0px; }</style>
		  <div class="apvc_meta_box_fields">
			  <input type="hidden" name="art_id" value="<?php 
        echo  esc_html( $art_id ) ;
        ?>">
			<div class="apvc_start_cnt">
				<p><?php 
        _e( 'Active Page Visit Counter for this Article?' );
        ?></p>
				<input type="radio" value="Yes" 
				<?php 
        if ( $active == 'Yes' ) {
            echo  'checked' ;
        }
        ?>
					 name="apvc_active_counter"><?php 
        _e( 'Yes' );
        ?>
				<input type="radio" value="No" 
				<?php 
        if ( $active == 'No' ) {
            echo  'checked' ;
        }
        ?>
					 name="apvc_active_counter"><?php 
        _e( 'No' );
        ?>
			</div>
			<div class="apvc_base_count">
				<p><?php 
        _e( 'Start Counting from. Enter any number from where you want to start counting.' );
        ?></p>
				<input style="width: 100%" type="number" name="count_start_from" value="<?php 
        echo  esc_html( $base_count ) ;
        ?>" placeholder="Enter Base Count to start">
			</div>
			<div class="apvc_label">
				<p><?php 
        _e( 'Widget Label' );
        ?></p>
				<input style="width: 100%" type="text" name="widget_label" value="<?php 
        esc_html( $widget_label );
        ?>" placeholder="Enter Label for Widget">
			</div>
		</div>
		<?php 
        wp_die();
    }
    
    public function apvc_save_start_counter_op()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        $post_id = sanitize_text_field( $_REQUEST['art_id'] );
        $apvc_active_counter = ( $_REQUEST['cnt_act'] ? sanitize_text_field( $_REQUEST['cnt_act'] ) : 'Yes' );
        $count_start_from = sanitize_text_field( $_REQUEST['start_from'] );
        $widget_label = sanitize_text_field( $_REQUEST['wid_label'] );
        update_post_meta( $post_id, 'apvc_active_counter', $apvc_active_counter );
        update_post_meta( $post_id, 'count_start_from', $count_start_from );
        update_post_meta( $post_id, 'widget_label', $widget_label );
        echo  wp_send_json_success( 'success' ) ;
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get detailed reports.
     *
     * @since    3.0.1
     */
    public function apvc_detailed_reports_page_content()
    {
        global  $wpdb ;
        $tbl_history = APVC_DATA_TABLE;
        $per_page_var = "";
        $dropDown = '';
        $g_checked = ( isset( $_REQUEST['u_g'] ) && $_REQUEST['u_g'] == 'on' ? 'checked' : '' );
        $rg_checked = ( isset( $_REQUEST['u_r'] ) && $_REQUEST['u_r'] == 'on' ? 'checked' : '' );
        
        if ( isset( $_GET['pageno'] ) ) {
            $pageno = sanitize_text_field( $_GET['pageno'] );
        } else {
            $pageno = 1;
        }
        
        $per_page = ( isset( $_GET['per_page'] ) && $_GET['per_page'] ? sanitize_text_field( $_GET['per_page'] ) : 20 );
        $offset = ($pageno - 1) * $per_page;
        $article_id = ( $_GET['article_id'] ? sanitize_text_field( $_GET['article_id'] ) : '' );
        $apvcDetailed = json_decode( $this->get_the_detailed_reports( $article_id, $offset, $per_page ) );
        $total_pages = ceil( $apvcDetailed->totalCount / $per_page );
        
        if ( $pageno == 0 ) {
            $cnt = 1;
        } else {
            $cnt = intval( $per_page ) * intval( $pageno - 1 ) + 1;
        }
        
        ?>
		<input type="hidden" id="current_page" value="detailed-reports">
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel container">
			  <div class="content-wrapper">

				<?php 
        ?>

				<div class="card report_card col-md-12">
				  <div class="card-body">
					<div class="row">
						<div class="apvc-detailed-filters">
							<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php 
        echo  'Articles Per Page - ' . $per_page ;
        ?></button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start">
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  esc_html( $article_id ) ;
        ?>&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=10<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '10', 'advanced-page-visit-counter' );
        ?></a>
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  esc_html( $article_id ) ;
        ?>&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=20<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '20', 'advanced-page-visit-counter' );
        ?></a>
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  esc_html( $article_id ) ;
        ?>&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=50<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '50', 'advanced-page-visit-counter' );
        ?></a>
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  esc_html( $article_id ) ;
        ?>&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=100<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '100', 'advanced-page-visit-counter' );
        ?></a>
								  <div class="dropdown-divider"></div>
								  <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  esc_html( $article_id ) ;
        ?>&pageno=<?php 
        echo  esc_html( $pageno ) ;
        ?>&per_page=500<?php 
        echo  esc_html( $dropDown ) ;
        ?>"><?php 
        _e( '500', 'advanced-page-visit-counter' );
        ?></a>
								</div>
							</div>
							 <a type="button" href="?page=apvc-dashboard-page&apvc_page=reports" class="btn btn-primary btn-fw buttona"><i class="mdi mdi-arrow-left-bold-circle"></i><?php 
        _e( 'Back To Reports', 'advanced-page-visit-counter' );
        ?></a>
						</div>
					  <div class=" table-responsive">
						<table id="reports-listing-detailed" class="table">
						  <thead>
							<tr>
							  <th><?php 
        _e( 'No.', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Article Title', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Article Type', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'User Type', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Visited Date', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'IP Address', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Browser Info', 'advanced-page-visit-counter' );
        ?></th>
							  <th><?php 
        _e( 'Referrer URL', 'advanced-page-visit-counter' );
        ?></th>
							</tr>
						  </thead>
						  <tbody>
							<?php 
        
        if ( count( $apvcDetailed->list ) > 0 ) {
            foreach ( $apvcDetailed->list as $reports ) {
                // $preBlock = '';
                // if ( apvc_fs()->is__premium_only() ) {
                // 	$preBlockData = $this->apvc_get_city_states__premium_only( $reports->id );
                // 	$preBlock     = '<br/><span style="color:#008000;">' . __( 'State: ', 'advanced-page-visit-counter' ) . '</span><span>' . esc_html( $preBlockData[0][1] ) . '</span><br/><span style="color:#ff00ff;">' . __( 'City: ', 'advanced-page-visit-counter' ) . '</span><span>' . esc_html( $preBlockData[0][0] ) . '</span>';
                // } else {
                // 	$preBlock = '<br/><span style="color:red;">' . __( 'State: ', 'advanced-page-visit-counter' ) . '</span><span>Premium</span><br/><span style="color:red;">' . __( 'City: ', 'advanced-page-visit-counter' ) . '</span><span>Premium</span>';
                // }
                echo  '<tr>
						                  <td>' . $cnt++ . '</td>
						                  <td><div class="ap_width">' . $reports->title . '</div></td>
						                  <td>' . ucfirst( $reports->article_type ) . '</td>
						                  <td>' . esc_html( $reports->user_type ) . '</td>
						                  <td>' . esc_html( $reports->date ) . '</td>
						                  <td><div class="ap_width">' . esc_html( $reports->ip_address ) . '</div></td>
						                  <td class="apvc_geo_stats"><span style="color:#007bff;">' . __( 'Browser: ', 'advanced-page-visit-counter' ) . '</span>' . ucwords( esc_html( $reports->browser_short_name ) ) . '<br /><span style="color:#d84545;">' . __( 'OS: ', 'advanced-page-visit-counter' ) . '</span>' . ucwords( esc_html( $reports->operating_system ) ) . '<br /><span style="color:#b93db5;">' . __( 'Device: ', 'advanced-page-visit-counter' ) . '</span>' . ucwords( $reports->device_type ) . '<br /><span style="color:#d84545;">' . __( 'Country: ', 'advanced-page-visit-counter' ) . '</span>' . ucwords( $reports->country ) . '</td>
						                  <td><div class="ap_width">' . esc_html( $reports->http_referer_clean ) . '<br/><a href="' . esc_html( $reports->http_referer ) . '" target="_blank"><small class="text-muted" styword-break: break-word;">' . esc_html( $reports->http_referer ) . '</small></a></div></td>
						                </tr>' ;
            }
        } else {
            echo  '<tr><td colspan="8" class="text-center">No Records Found</td></tr>' ;
        }
        
        ?>

						  </tbody>
						</table>

						<nav>
							<ul class="pagination d-flex justify-content-center">
								<li class="page-item"><a class="page-link" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  esc_html( $article_id ) ;
        ?>&pageno=1<?php 
        echo  esc_html( $per_page_var ) ;
        ?>"><?php 
        _e( 'First', 'advanced-page-visit-counter' );
        ?></a></li>
								<li class="page-item 
								<?php 
        if ( $pageno <= 1 ) {
            echo  'disabled' ;
        }
        ?>
								">
									<a class="page-link" href="
									<?php 
        
        if ( $pageno <= 1 ) {
            echo  '#' ;
        } else {
            echo  '?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=' . $article_id . '&pageno=' . ($pageno - 1) ;
        }
        
        ?>
															   <?php 
        echo  esc_html( $per_page_var ) ;
        ?>"><?php 
        _e( 'Prev', 'advanced-page-visit-counter' );
        ?></a>
								</li>
								<li class="page-item 
								<?php 
        if ( $pageno >= $total_pages ) {
            echo  'disabled' ;
        }
        ?>
								">
									<a class="page-link" href="
									<?php 
        
        if ( $pageno >= $total_pages ) {
            echo  '#' ;
        } else {
            echo  '?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=' . $article_id . '&pageno=' . ($pageno + 1) ;
        }
        
        ?>
															   <?php 
        echo  esc_html( $per_page_var ) ;
        ?>"><?php 
        _e( 'Next', 'advanced-page-visit-counter' );
        ?></a>
								</li>
								<li class="page-item"><a class="page-link" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  esc_html( $article_id ) ;
        ?>&pageno=<?php 
        echo  esc_html( $total_pages ) ;
        echo  esc_html( $per_page_var ) ;
        ?>"><?php 
        _e( 'Last', 'advanced-page-visit-counter' );
        ?> (<?php 
        echo  esc_html( $total_pages ) ;
        ?>)</a></li>
							</ul>
						</nav>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Get dashboard page.
     *
     * @since    3.0.1
     */
    public function apvc_dashboard_page()
    {
        global  $wpdb ;
        $noticeBoard = sanitize_text_field( get_option( 'apvc_notice' ) );
        $history_table = $wpdb->prefix . 'avc_page_visit_history';
        $rows = $wpdb->get_results( "SHOW COLUMNS FROM {$history_table} LIKE 'article_title'" );
        
        if ( count( $rows ) > 0 ) {
            ?>
		<div class="content-wrapper">
			<div class="row">
				<div class="col-lg-8 grid-margin stretch-card">
					<div class="card"  style="border: 2px solid #2196f3; border-radius: 5px;">
						<div class="card-body">
							<h4 style="color: red;">Database Upgrade required...</h4>
							<h6>Click on below button to upgrade the database.</h6>
							<button id="apvc_update_db" class="btn btn-icons btn-primary float-left" style="width: 200px">Click to upgrade...</button>
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php 
        } else {
            if ( isset( $_GET['clr'] ) && $_GET['clr'] == 'yes' ) {
                update_option( 'apvc_notice', 'yes' );
            }
            if ( isset( $_GET['promo'] ) && $_GET['promo'] == 'off' ) {
                update_option( 'apvc_promo', 'no' );
            }
            ?>
			<div class="container-scroller hidden-xs">
				<nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
					<div class="container d-flex flex-row nav-top">
					  <div class="text-center navbar-brand-wrapper d-flex align-items-top">
						<a class="navbar-brand brand-logo" href="admin.php?page=apvc-dashboard-page">
						  <img src="<?php 
            echo  plugin_dir_url( __FILE__ ) . '/images/apvc-logo.svg' ;
            ?>" alt="logo"> </a>
					  </div>
					</div>
					<div class="nav-bottom">
					  <div class="container">
						<ul class="nav page-navigation">
						  <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] == '' ? 'menu-active' : '' ) ;
            ?>">
							<a href="<?php 
            echo  get_admin_url( get_current_blog_id(), 'admin.php?page=apvc-dashboard-page' ) ;
            ?>" class="nav-link">
							  <i class="link-icon mdi mdi-airplay"></i>
							  <span class="menu-title"><?php 
            _e( 'Dashboard', 'advanced-page-visit-counter' );
            ?></span>
							</a>
						  </li>
						  <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] == 'trending' ? 'menu-active' : '' ) ;
            ?>">
							<a href="<?php 
            echo  get_admin_url( get_current_blog_id(), 'admin.php?page=apvc-dashboard-page&apvc_page=trending' ) ;
            ?>" class="nav-link">
							  <i class="link-icon mdi mdi-chart-line"></i>
							  <span class="menu-title"><?php 
            _e( 'Trending', 'advanced-page-visit-counter' );
            ?></span>
							</a>
						  </li>

						  <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] == 'reports' || isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] == 'detailed-reports' ? 'menu-active' : '' ) ;
            ?>">
							<a href="<?php 
            echo  get_admin_url( get_current_blog_id(), 'admin.php?page=apvc-dashboard-page&apvc_page=reports' ) ;
            ?>" class="nav-link">
							  <i class="link-icon mdi mdi-content-copy"></i>
							  <span class="menu-title"><?php 
            _e( 'Reports', 'advanced-page-visit-counter' );
            ?></span>
							</a>
							<?php 
            ?>
							<div class="submenu ">
							  <ul class="submenu-item ">
									<li class="nav-item ">
										  <a href="#" class="nav-link">
											<?php 
            _e( "Reports Country Wise <Br /><span style='color:red;'>Premium Only</span>", 'advanced-page-visit-counter' );
            ?>
										</a>
									</li>
							  </ul>
							</div>
							<?php 
            ?>

						  </li>
						  <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] == 'shortcode_generator' || isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] == 'shortcode_library' ? 'menu-active' : '' ) ;
            ?>">
							<a href="<?php 
            echo  get_admin_url( get_current_blog_id(), 'admin.php?page=apvc-dashboard-page&apvc_page=shortcode_generator' ) ;
            ?>" class="nav-link">
							  <i class="link-icon mdi mdi-palette"></i>
							  <span class="menu-title"><?php 
            _e( 'Shortcode Generator', 'advanced-page-visit-counter' );
            ?></span>
							</a>
							<div class="submenu ">
							  <ul class="submenu-item ">
								<li class="nav-item ">
								  <a href="<?php 
            echo  get_admin_url( get_current_blog_id(), 'admin.php?page=apvc-dashboard-page&apvc_page=shortcode_library' ) ;
            ?>" class="nav-link">
								  <?php 
            _e( 'Shortcode Library', 'advanced-page-visit-counter' );
            ?>
								</a>
								</li>
							  </ul>
							</div>
						  </li>
						  <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] == 'settings' ? 'menu-active' : '' ) ;
            ?>">
							<a href="<?php 
            echo  get_admin_url( get_current_blog_id(), 'admin.php?page=apvc-dashboard-page&apvc_page=settings' ) ;
            ?>" class="nav-link">
							  <i class="link-icon mdi mdi-settings-box"></i>
							  <span class="menu-title"><?php 
            _e( 'Settings', 'advanced-page-visit-counter' );
            ?></span>
							</a>
						  </li>
						  <?php 
            ?>
						<li class="nav-item">
							<a href="#" target="_blank" class="nav-link">
							  <i class="link-icon mdi mdi-lifebuoy"></i>
							  <span class="menu-title"><?php 
            _e( 'Support', 'advanced-page-visit-counter' );
            ?></span>
							</a>
							<div class="submenu ">
							  <ul class="submenu-item ">
									<li class="nav-item ">
									  <a href="https://pagevisitcounter.com/submit-ticket/" target="_blank" class="nav-link">
										<?php 
            _e( 'Submit a ticket', 'advanced-page-visit-counter' );
            ?>
										</a>
									</li>
									<li class="nav-item ">
									  <a href="https://pagevisitcounter.com/feature-request/" target="_blank" class="nav-link">
										<?php 
            _e( 'Request a feature', 'advanced-page-visit-counter' );
            ?>
										</a>
									</li>
								</ul>
							</div>
						  </li>
						</ul>
					  </div>
					</div>
				  </nav>
			</div>
			<?php 
            
            if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'trending' ) {
                $this->apvc_top_trending_content();
            } elseif ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'reports' && !isset( $_GET['article_id'] ) ) {
                $this->apvc_reports_page_content();
            } elseif ( isset( $_GET['apvc_page'] ) && isset( $_GET['article_id'] ) && $_GET['apvc_page'] === 'detailed-reports' && $_GET['article_id'] != '' ) {
                $this->apvc_detailed_reports_page_content();
            } elseif ( isset( $_GET['apvc_page'] ) && isset( $_GET['article_id'] ) && $_GET['apvc_page'] === 'detailed-reports-chart' && $_GET['article_id'] != '' ) {
                $this->apvc_detailed_reports_on_chart();
            } elseif ( isset( $_GET['apvc_page'] ) && isset( $_GET['article_id'] ) && $_GET['apvc_page'] === 'country_reports-detailed' && $_GET['article_id'] != '' ) {
                $this->apvc_detailed_reports_for_the_country_content__premium_only();
            } elseif ( isset( $_GET['apvc_page'] ) && isset( $_GET['country'] ) && $_GET['apvc_page'] === 'country_reports-list' && $_GET['country'] != '' ) {
                $this->country_reports_in_detailed__premium_only();
            } elseif ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'settings' ) {
                $this->apvc_reports_settings_page();
            } elseif ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'country_reports' ) {
                $this->country_reports__premium_only();
            } elseif ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'shortcode_generator' ) {
                $this->apvc_shortcode_generator_page();
            } elseif ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'export_data' ) {
                $this->apvc_export_data_page__premium_only();
            } elseif ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'import_data' ) {
                $this->apvc_import_data_page__premium_only();
            } elseif ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'cleanup_data' ) {
                $this->apvc_cleanup_data_page__premium_only();
            } elseif ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'shortcode_library' ) {
                $this->apvc_shortcode_library();
            } else {
                $this->apvc_settings_page_content();
            }
            
            ?>
		<footer class="footer">
			<div class="container clearfix">
			  <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><?php 
            _e( 'Hand-crafted & made with', 'advanced-page-visit-counter' );
            ?> <i class="mdi mdi-heart text-danger"></i>&nbsp; <a class="text-danger" href="https://pagevisitcounter.com" target="_blank"><?php 
            _e( 'Page Visit Counter', 'advanced-page-visit-counter' );
            ?></a>
			  </span>
			</div>
		</footer>
			<?php 
        }
    
    }
    
    /**
     * Advanced Page Visit Counter Get Premier Features.
     *
     * @since    3.0.1
     */
    public function apvc_get_premium_features_block()
    {
    }
    
    /**
     * Advanced Page Visit Counter Get reports settings data.
     *
     * @since    3.0.1
     */
    public function apvc_reports_settings_page()
    {
        global  $wpdb, $post ;
        $avc_config = (object) get_option( 'apvc_configurations', true );
        ?>
		<div class="container-fluid page-body-wrapper avpc-settings-page">
			<div class="main-panel container"><br />
			  <div class="content-wrapper">
					<div class="col-lg-12 grid-margin stretch-card">
						<div class="card">
						  <div class="card-body">
							  <ul class="nav nav-tabs tab-basic" role="tablist">
							  <li class="nav-item">
								<a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basicSettings" role="tab" aria-controls="basicSettings" aria-selected="true"><?php 
        echo  _e( 'Basic Settings', 'advanced-page-visit-counter' ) ;
        ?></a>
							  </li>

							  <li class="nav-item">
								<a class="nav-link" id="widget-tab" data-toggle="tab" href="#widgetTab" role="tab" aria-controls="widgetTab" aria-selected="false"><?php 
        echo  _e( 'Widget Settings', 'advanced-page-visit-counter' ) ;
        ?></a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="widget-v-tab" data-toggle="tab" href="#widgetVTab" role="tab" aria-controls="widgetVTab" aria-selected="false"><?php 
        echo  _e( 'Widget Visibility Settings', 'advanced-page-visit-counter' ) ;
        ?></a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="premium-tab" data-toggle="tab" href="#premiumSettings" role="tab" aria-controls="premiumSettings" aria-selected="false"><?php 
        echo  _e( 'Premium Settings', 'advanced-page-visit-counter' ) ;
        ?></a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="widget_templates-tab" data-toggle="tab" href="#widTemplates" role="tab" aria-controls="widTemplates" aria-selected="false"><?php 
        echo  _e( 'Widget Templates', 'advanced-page-visit-counter' ) ;
        ?></a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="advancedSettings-tab" data-toggle="tab" href="#adSettings" role="tab" aria-controls="adSettings" aria-selected="false"><?php 
        echo  _e( 'Advanced Settings', 'advanced-page-visit-counter' ) ;
        ?></a>
							  </li>


							</ul>

							<?php 
        
        if ( isset( $_GET['m'] ) && $_GET['m'] === 'success' && !isset( $_GET['t'] ) ) {
            echo  '<div class="alert alert-success mt-5" role="alert">' . __( 'Settings have been saved successfully', 'advanced-page-visit-counter' ) . '</div>' ;
        } elseif ( isset( $_GET['m'] ) && $_GET['m'] === 'success' && isset( $_GET['t'] ) && $_GET['t'] === 'reset' ) {
            echo  '<div class="alert alert-success mt-5" role="alert">' . __( 'Settings reset successfully.', 'advanced-page-visit-counter' ) . '</div>' ;
        }
        
        ?>

						 <div class="mt-5 tab-content tab-content-basic"><!--- Simple Div End -->
							<form class="form-sample" id="apvc_settings_form">
							  <div class="row tab-pane fade show active" id="basicSettings" role="tabpanel" aria-labelledby="basic-tab" aria-selected="true">
								<div class="row">
									<div class="col-md-6">
									  <div class="form-group card-body">
										  <label><?php 
        _e( 'Post Types', 'advanced-page-visit-counter' );
        ?></label>
										  <select id="apvc_post_types" name="apvc_post_types" class="apvc-post-types-select" multiple="multiple" style="width:100%">
										  <?php 
        $avc_post_types = get_post_types();
        foreach ( $avc_post_types as $avc_pt ) {
            
            if ( isset( $avc_config->apvc_post_types ) && in_array( $avc_pt, $avc_config->apvc_post_types ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
            
            echo  '<option value="' . esc_html( $avc_pt ) . '" ' . $selected . '>' . esc_html( $avc_pt ) . '</option>' ;
        }
        ?>
										  </select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											  <label><?php 
        _e( 'Exclude User', 'advanced-page-visit-counter' );
        ?></label>
											 <select id="apvc_exclude_users" name="apvc_exclude_users" class="apvc-post-types-select" multiple="multiple" style="width:100%">
										  <?php 
        $avc_users = get_users();
        foreach ( $avc_users as $avc_usr ) {
            
            if ( isset( $avc_config->apvc_exclude_users ) && in_array( $avc_usr->ID, $avc_config->apvc_exclude_users ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
            
            echo  '<option value="' . esc_html( $avc_usr->ID ) . '" ' . $selected . '>' . esc_html( $avc_usr->display_name ) . '</option>' ;
        }
        ?>
										  </select>
										  </div>
									  </div>
									</div>




								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											  <label><?php 
        _e( 'Exclude Post/Pages Counts', 'advanced-page-visit-counter' );
        ?></label>
											<input data-role="tagsinput" name="apvc_exclude_counts" id="apvc_exclude_counts" value="<?php 
        echo  ( !empty($avc_config->apvc_exclude_counts) ? implode( ',', $avc_config->apvc_exclude_counts ) : '' ) ;
        ?>" />

										  </div>
									  </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											  <label><?php 
        _e( 'Exclude Showing Counter Widget on Pages/Posts', 'advanced-page-visit-counter' );
        ?></label>
											<input name="apvc_exclude_show_counter" id="apvc_exclude_show_counter" value="<?php 
        echo  ( !empty($avc_config->apvc_exclude_show_counter) ? implode( ',', $avc_config->apvc_exclude_show_counter ) : '' ) ;
        ?>" />
										  </div>
									  </div>
									</div>
								</div>
								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											  <label><?php 
        _e( 'Exclude IP Addresses', 'advanced-page-visit-counter' );
        ?></label>
											<input name="apvc_ip_address" id="apvc_ip_address" value="<?php 
        echo  ( !empty($avc_config->apvc_ip_address) ? implode( ',', $avc_config->apvc_ip_address ) : '' ) ;
        ?>" />
											<small class="text-muted">
												<?php 
        _e( 'Now exclude ip address by adding ranges.
					                        	<br /><b>1.</b> 192.168.0.* (This exclude ip address range from 192.168.0.0 to 192.168.0.255)<br /><b>2.</b> 192.168.0.10/20 (This exclude ip address range from 192.168.0.10 to 192.168.0.20) <br />', 'advanced-page-visit-counter' );
        ?>
											</small>
										  </div>
									  </div>
									</div>


									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											<div class="icheck-square"><br/>
											  <input tabindex="6" type="checkbox" id="apvc_spam_controller" name="apvc_spam_controller" 
											  <?php 
        if ( isset( $avc_config->apvc_spam_controller[0] ) && $avc_config->apvc_spam_controller[0] == 'on' ) {
            echo  'checked' ;
        }
        ?>
													><label for="square-checkbox-2"><?php 
        _e( 'Spam Controller', 'advanced-page-visit-counter' );
        ?></label>
											  <br />
											  <small class="text-muted"><?php 
        _e( '*This setting will ignore visit counts comes from spammers or continues refresh browser windows. ( by enabling this settings we count 1 visit in every 5 minutes from each ip address )', 'advanced-page-visit-counter' );
        ?></small>
											</div>
										  </div>
										</div>
									</div>
								</div>
							  </div>

							  <div class="row tab-pane" id="widgetTab" role="tabpanel" aria-labelledby="widget-tab" aria-selected="false">
								  <div class="col-md-12">
									  <div class="row">
										  <div class="col-md-6 col-lg-6">
											  <div class="card-body">
												<div class="form-group">
												  <label for="show_conter_on_front_side">
													<?php 
        _e( 'Show Counter on Front End', 'advanced-page-visit-counter' );
        ?>
													  </label><Br />
												  <select class="form-control" id="apvc_show_conter_on_front_side" name="apvc_show_conter_on_front_side">
													  <option value="" disabled selected><?php 
        _e( 'Choose your option', 'advanced-page-visit-counter' );
        ?></option>
													<option value="disable" selected=""><?php 
        _e( 'Hide', 'advanced-page-visit-counter' );
        ?></option>
													<option value="above_the_content" 
													<?php 
        if ( isset( $avc_config->apvc_show_conter_on_front_side[0] ) && $avc_config->apvc_show_conter_on_front_side[0] == 'above_the_content' ) {
            echo  'selected' ;
        }
        ?>
														><?php 
        _e( 'Above the content', 'advanced-page-visit-counter' );
        ?></option>
													<option value="below_the_content" 
													<?php 
        if ( isset( $avc_config->apvc_show_conter_on_front_side[0] ) && $avc_config->apvc_show_conter_on_front_side[0] == 'below_the_content' ) {
            echo  'selected' ;
        }
        ?>
														><?php 
        _e( 'Below the content', 'advanced-page-visit-counter' );
        ?></option>
												</select>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												  <label for="apvc_default_text_color"><?php 
        _e( 'Default Counter Text Color', 'advanced-page-visit-counter' );
        ?></label>
													<input type='text' class="color-picker" id="apvc_default_text_color" name="apvc_default_text_color" value="<?php 
        echo  esc_html( $avc_config->apvc_default_text_color[0] ) ;
        ?>" />
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												  <label><?php 
        _e( 'Default Counter Border Color', 'advanced-page-visit-counter' );
        ?></label>
													<input id="apvc_default_border_color" name="apvc_default_border_color" type='text' class="color-picker" value="<?php 
        echo  esc_html( $avc_config->apvc_default_border_color[0] ) ;
        ?>" id="apvc_default_border_color" />
												</div>
											</div>
										</div>
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												  <label><?php 
        _e( 'Default Background Color', 'advanced-page-visit-counter' );
        ?></label>
												  <input id="apvc_default_background_color" name="apvc_default_background_color" value="<?php 
        echo  esc_html( $avc_config->apvc_default_background_color[0] ) ;
        ?>" type="text" class="color-picker">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												  <label><?php 
        _e( 'Default Border Radius', 'advanced-page-visit-counter' );
        ?></label>
												  <input id="apvc_default_border_radius" name="apvc_default_border_radius" value="<?php 
        echo  esc_html( $avc_config->apvc_default_border_radius[0] ) ;
        ?>" min="0" value="0" type="number" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												  <label><?php 
        _e( 'Default Border Width', 'advanced-page-visit-counter' );
        ?></label>
												  <input id="apvc_default_border_width" name="apvc_default_border_width" min="0" value="<?php 
        echo  esc_html( $avc_config->apvc_default_border_width[0] ) ;
        ?>" value="2" type="number" class="form-control">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												  <label><?php 
        _e( 'Widget Alignment', 'advanced-page-visit-counter' );
        ?></label>
												  <Br />
												  <select name="apvc_wid_alignment" class="form-control" id="apvc_wid_alignment">
													  <option value="" disabled><?php 
        _e( 'Choose your option', 'advanced-page-visit-counter' );
        ?></option>
														<option value="left" 
														<?php 
        if ( $avc_config->apvc_wid_alignment[0] == 'left' ) {
            echo  'selected' ;
        }
        ?>
															 selected=""><?php 
        _e( 'Left - Default', 'advanced-page-visit-counter' );
        ?></option>
														<option value="right" 
														<?php 
        if ( $avc_config->apvc_wid_alignment[0] == 'right' ) {
            echo  'selected' ;
        }
        ?>
															><?php 
        _e( 'Right', 'advanced-page-visit-counter' );
        ?></option>
														<option value="center" 
														<?php 
        if ( $avc_config->apvc_wid_alignment[0] == 'center' ) {
            echo  'selected' ;
        }
        ?>
															><?php 
        _e( 'Center', 'advanced-page-visit-counter' );
        ?></option>
												  </select>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												<?php 
        $width = 0;
        
        if ( !empty($avc_config->apvc_widget_width[0]) ) {
            $width = $avc_config->apvc_widget_width[0];
        } else {
            $width = 300;
        }
        
        ?>
												  <label><?php 
        _e( 'Width of the Widget (In Pixels)', 'advanced-page-visit-counter' );
        ?></label>
												  <input id="apvc_widget_width" name="apvc_widget_width" value="<?php 
        echo  esc_html( $width ) ;
        ?>" placeholder="Width:" type="number" min="100" step="10" class="form-control">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												<?php 
        $padding = 0;
        
        if ( !empty($avc_config->apvc_widget_padding[0]) ) {
            $padding = $avc_config->apvc_widget_padding[0];
        } else {
            $padding = 10;
        }
        
        ?>
												  <label><?php 
        _e( 'Padding of the Widget (In Pixels)', 'advanced-page-visit-counter' );
        ?></label>
												  <input id="apvc_widget_padding" name="apvc_widget_padding" value="<?php 
        echo  esc_html( $padding ) ;
        ?>" placeholder="Padding:" type="number" min="1" step="1" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												  <label><?php 
        _e( 'Default Label (Total Visits of Current Page)', 'advanced-page-visit-counter' );
        ?></label>
												  <input id="apvc_default_label" name="apvc_default_label" value="<?php 
        echo  esc_html( $avc_config->apvc_default_label[0] ) ;
        ?>" placeholder="<?php 
        _e( 'Visits:', 'advanced-page-visit-counter' );
        ?>" type="text" value="Visits:" class="form-control">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												  <label><?php 
        _e( "Today's Count Label", 'advanced-page-visit-counter' );
        ?></label>
												  <input id="apvc_todays_label" name="apvc_todays_label" value="<?php 
        echo  ( isset( $avc_config->apvc_todays_label[0] ) ? $avc_config->apvc_todays_label[0] : '' ) ;
        ?>" placeholder="<?php 
        _e( "Today's Visits:", 'advanced-page-visit-counter' );
        ?>" type="text" value="Today:" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											  <div class="card-body">
												<div class="form-group">
												  <label><?php 
        _e( 'Total Counts Label (Global)', 'advanced-page-visit-counter' );
        ?></label>
												  <input id="apvc_global_label" name="apvc_global_label" value="<?php 
        echo  ( isset( $avc_config->apvc_global_label[0] ) ? $avc_config->apvc_global_label[0] : '' ) ;
        ?>" placeholder="<?php 
        _e( 'Total Visits:', 'advanced-page-visit-counter' );
        ?>" type="text" value="Total:" class="form-control">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row tab-pane" id="widgetVTab" role="tabpanel" aria-labelledby="widget-v-tab" aria-selected="false">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											<div class="icheck-square">
											  <input tabindex="6" type="checkbox" id="apvc_atc_page_count" name="apvc_atc_page_count" 
											  <?php 
        if ( isset( $avc_config->apvc_atc_page_count[0] ) && $avc_config->apvc_atc_page_count[0] == 'on' ) {
            echo  'checked' ;
        }
        ?>
													><label for="square-checkbox-2"><?php 
        _e( 'Total Visits of Current Page', 'advanced-page-visit-counter' );
        ?></label>
											  <br />
											  <small class="text-muted"><?php 
        _e( '*This will show total counts the current page.', 'advanced-page-visit-counter' );
        ?></small>
											</div>
										  </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											<div class="icheck-square">
											  <input tabindex="6" type="checkbox" id="apvc_show_global_count" name="apvc_show_global_count" 
											  <?php 
        if ( isset( $avc_config->apvc_show_global_count[0] ) && $avc_config->apvc_show_global_count[0] == 'on' ) {
            echo  'checked' ;
        }
        ?>
													><label><?php 
        _e( 'Show Global Total Counts', 'advanced-page-visit-counter' );
        ?></label>
											  <br />
											  <small class="text-muted"><?php 
        _e( '*This will show total counts for whole website.', 'advanced-page-visit-counter' );
        ?></small>
											</div>
										  </div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											<div class="icheck-square">
											  <input tabindex="6" type="checkbox" id="apvc_show_today_count" name="apvc_show_today_count" 
											  <?php 
        if ( isset( $avc_config->apvc_show_today_count[0] ) && $avc_config->apvc_show_today_count[0] == 'on' ) {
            echo  'checked' ;
        }
        ?>
													><label><?php 
        _e( "Show Today's Counts", 'advanced-page-visit-counter' );
        ?></label>
											  <br />
											  <small class="text-muted"><?php 
        _e( '*This will show total counts for whole website.', 'advanced-page-visit-counter' );
        ?></small>
											</div>
										  </div>
										</div>
									</div>
								</div>
							</div>

							<?php 
        ?>
							<div class="row tab-pane" id="widTemplates" role="tabpanel" aria-labelledby="widget_templates-tab" aria-selected="false">
								<div class="col-md-12">
									<div class="form-group card-body">
									  <label><?php 
        _e( 'Widget Templates', 'advanced-page-visit-counter' );
        ?></label>
									  <select id="apvc_widget_template" name="apvc_widget_template" class="apvc-counter-icon" style="width:100%">
									  <?php 
        $shortcodes = json_decode( $this->apvc_get_shortcodes() );
        echo  '<option value="">' . __( 'None', 'advanced-page-visit-counter' ) . '</option>' ;
        foreach ( $shortcodes as $key => $value ) {
            
            if ( in_array( $key, $avc_config->apvc_widget_template ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
            
            echo  '<option value="' . esc_html( $key ) . '" ' . $selected . '> ' . ucfirst( str_replace( '_', ' ', esc_html( $key ) ) ) . '</option>' ;
        }
        ?>
									  </select>
									  <br />
									  <small class="text-muted"><?php 
        _e( '*Check the Shortcode Library page to check the demo of all the shortcodes.<Br />*All color properties ignored if any template selected.<Br />*More than 40 templates available in the Premium version of the plugin.', 'advanced-page-visit-counter' );
        ?></small>
									</div>
								</div>
							</div>

							<div class="row tab-pane" id="adSettings" role="tabpanel" aria-labelledby="advancedSettings-tab" aria-selected="false">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											  <label><?php 
        _e( 'Use Cache Plugin:', 'advanced-page-visit-counter' );
        ?></label>
											<div class="icheck-square">
											  <input tabindex="6" type="checkbox" name="cache_active" 
											  <?php 
        if ( isset( $avc_config->cache_active[0] ) && $avc_config->cache_active[0] == 'on' ) {
            echo  'checked' ;
        }
        ?>
												><label><?php 
        _e( 'Yes', 'advanced-page-visit-counter' );
        ?></label>
											</div>
											<small class="text-muted"><?php 
        _e( "*If you use WordPress Cache Plugins, enable this setting. <Br />*Update the permalink with press Save Changes. Don't forget to clear cache from your enabled plugin.", 'advanced-page-visit-counter' );
        ?></small>

										  </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											  <label><?php 
        _e( 'Show number in Short Version eg: 1000 -> 1k:', 'advanced-page-visit-counter' );
        ?></label>
											<div class="icheck-square">
											  <input tabindex="6" type="checkbox" name="numbers_in_k" 
											  <?php 
        if ( isset( $avc_config->numbers_in_k[0] ) && $avc_config->numbers_in_k[0] == 'on' ) {
            echo  'checked' ;
        }
        ?>
												><label><?php 
        _e( 'Yes', 'advanced-page-visit-counter' );
        ?></label>
											</div>
										  </div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
										  <div class="card-body">
											  <label><?php 
        _e( 'Enable Anonymize IP', 'advanced-page-visit-counter' );
        ?></label>
											<div class="icheck-square">
											  <input tabindex="6" type="checkbox" name="ip_anonymize" 
											  <?php 
        if ( isset( $avc_config->ip_anonymize[0] ) && $avc_config->ip_anonymize[0] == 'on' ) {
            echo  'checked' ;
        }
        ?>
												><label><?php 
        _e( 'Yes', 'advanced-page-visit-counter' );
        ?></label>
											</div>
											<small class="text-muted" style="color: red !important;"><?php 
        _e( 'Anonymize the IP address for GDPR Compliance', 'advanced-page-visit-counter' );
        ?></small>
											<small class="text-muted" style="color: red !important;">***.***.***.***</small><br />
											<small class="text-muted" style="color: red !important;"><?php 
        _e( 'If you turned on this, You will not get accurate states on few widgets and filters which are related to ip addresses filters.', 'advanced-page-visit-counter' );
        ?></small>
										  </div>
										</div>
									</div>

								</div>
							</div>

						  </div><!-- card-body -->
						  <div class="row" style="float: left;">
								<div class="col-md-12">
									<div class="apvc-save-btns">
										<button type="button" id="apvc_save_settings" class="btn btn-primary btn-fw"><i class="mdi mdi-heart-outline"></i><?php 
        _e( 'Save Changes', 'advanced-page-visit-counter' );
        ?></button>
										<button type="button" id="apvc_reset_button" class="btn btn-outline-danger btn-fw"><i class="mdi mdi-refresh"></i><?php 
        _e( 'Reset Settings', 'advanced-page-visit-counter' );
        ?></button>
										<button type="button" id="apvc_reset_data_button" class="btn btn-danger btn-fw"><i class="mdi mdi-alert-outline"></i><?php 
        _e( 'Reset All Data/Counters', 'advanced-page-visit-counter' );
        ?></button>
									</div>
								</div>
							</div>
						</form>
						</div> <!--- Simple Div End -->
					  </div>
				  </div>
			</div>
		</div>

		<div class="modal fade" id="showWarning" style="top:10%;" tabindex="-1" role="dialog" aria-labelledby="showWarning" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-body text-center" style="padding: 50px">
				<?php 
        _e( 'Something went wrong! Please reload your browser and try again.', 'advanced-page-visit-counter' );
        ?><Br /><Br />
			  </div>
			</div>
		  </div>
		</div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Shortcode Generator Form.
     *
     * @since    3.0.1
     */
    public function apvc_shortcode_generator_page()
    {
        global  $wpdb ;
        ?>
		<input type="hidden" id="current_page" value="shortcode">
		<div class="container-fluid page-body-wrapper avpc-settings-page shortcodeG">
			<div class="main-panel container">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-lg-5 grid-margin stretch-card">
							<div class="card">
							  <div class="card-body">
								<h4 class="card-title text-center text-black"><?php 
        _e( 'Shortcode Preview', 'advanced-page-visit-counter' );
        ?></h4>
									<div id="shortcode_output">
										<div class="col-md-12 shLoader col-sm-12 grid-margin stretch-card">
											<div class="loader-demo-box" style="border:none !important;">
												<div class="square-box-loader">
													<div class="square-box-loader-container">
														<div class="square-box-loader-corner-top"></div>
														<div class="square-box-loader-corner-bottom"></div>
													</div>
													<div class="square-box-loader-square"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 grid-margin stretch-card">
							<div class="card">
								<ul class="nav nav-tabs tab-basic mt-3 ml-4" role="tablist">
								  <li class="nav-item">
									<a class="nav-link active" id="txt-tab" data-toggle="tab" href="#txtSettings" role="tab" aria-controls="txtSettings" aria-selected="true"><?php 
        echo  _e( 'Text Settings', 'advanced-page-visit-counter' ) ;
        ?></a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" id="visib-tab" data-toggle="tab" href="#visib_tab" role="tab" aria-controls="visib_tab" aria-selected="false"><?php 
        echo  _e( 'Visibility Options', 'advanced-page-visit-counter' ) ;
        ?></a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" id="labels-tab" data-toggle="tab" href="#labels" role="tab" aria-controls="labels" aria-selected="false"><?php 
        echo  _e( 'Labels & Icons', 'advanced-page-visit-counter' ) ;
        ?></a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" id="sh-temp-tab" data-toggle="tab" href="#sh_temp" role="tab" aria-controls="sh_temp" aria-selected="false"><?php 
        echo  _e( 'Shortcode Template', 'advanced-page-visit-counter' ) ;
        ?></a>
								  </li>
								</ul>

								<div class="card-body tab-content tab-content-basic">

									<form class="form-sample" id="apvc_generate_shortcode">
										<div class="apvc-save-btns text-right">
											<button type="button" class="apvc_generate_shortcode btn btn-primary btn-rounded  btn-fw"><i class="mdi mdi-format-paint"></i><?php 
        _e( 'Generate Shortcode', 'advanced-page-visit-counter' );
        ?></button>
										</div>

										<div class="tab-pane fade show active" id="txtSettings" role="tabpanel" aria-labelledby="txt-tab" aria-selected="false">

											<div class="row">
												<div class="col-md-6">
													<div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Border Size (in pixels)', 'advanced-page-visit-counter' );
        ?></label>
														  <Br />
														  <input type="number" class="form-control" name="border_size" value="2">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Border Radius (in pixels)', 'advanced-page-visit-counter' );
        ?></label>
														  <Br />
														  <input type="number" class="form-control" name="border_radius" value="5">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Border Style', 'advanced-page-visit-counter' );
        ?></label>
														  <Br />
														  <select name="border_style" class="form-control">
															<option value="" disabled selected><?php 
        _e( 'Choose your option', 'advanced-page-visit-counter' );
        ?></option>
															<option value="none"><?php 
        _e( 'None', 'advanced-page-visit-counter' );
        ?></option>
															<option value="dotted"><?php 
        _e( 'Dotted', 'advanced-page-visit-counter' );
        ?></option>
															<option value="dashed"><?php 
        _e( 'Dashed', 'advanced-page-visit-counter' );
        ?></option>
															<option value="solid" selected=""><?php 
        _e( 'Solid', 'advanced-page-visit-counter' );
        ?></option>
															<option value="double"><?php 
        _e( 'Double', 'advanced-page-visit-counter' );
        ?></option>
														  </select>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													  <div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Border Color', 'advanced-page-visit-counter' );
        ?></label>
														  <input name="border_color" type="text" class="color-picker">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													  <div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Font Color', 'advanced-page-visit-counter' );
        ?></label>
														  <input name="font_color" type="text" class="color-picker">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													  <div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Background Color', 'advanced-page-visit-counter' );
        ?></label>
														  <input name="background_color" type="text" class="color-picker">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													  <div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Font Size', 'advanced-page-visit-counter' );
        ?></label>
														  <input name="font_size" type="number" class="form-control" value="14" min="7">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Font Style', 'advanced-page-visit-counter' );
        ?></label>
														  <Br />
														  <select name="font_style" class="form-control" name="font_style">
															<option value="" disabled selected><?php 
        _e( 'Choose your option', 'advanced-page-visit-counter' );
        ?></option>
															<option value=""><?php 
        _e( 'Please Select', 'advanced-page-visit-counter' );
        ?></option>
															<option value="normal"><?php 
        _e( 'Normal', 'advanced-page-visit-counter' );
        ?></option>
															<option value="bold"><?php 
        _e( 'Bold', 'advanced-page-visit-counter' );
        ?></option>
															<option value="italic"><?php 
        _e( 'Italic', 'advanced-page-visit-counter' );
        ?></option>
														  </select>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													  <div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Padding', 'advanced-page-visit-counter' );
        ?></label>
														  <input class="form-control" value="5" name="padding" type="number" min="0">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													  <div class="card-body">
														<div class="form-group">
														  <label><?php 
        _e( 'Width', 'advanced-page-visit-counter' );
        ?></label>
														  <input class="form-control" placeholder="Width in pixels" value="200" name="width" type="number" min="100">
														</div>
													</div>
												</div>
											</div>

										</div>

										<div class="tab-pane fade" id="visib_tab" role="tabpanel" aria-labelledby="visib-tab" aria-selected="false">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
													  <div class="card-body">
														<div class="icheck-square">
														  <input tabindex="6" type="checkbox" name="show_today_count"><label><?php 
        _e( "Show Today's Visit Counts", 'advanced-page-visit-counter' );
        ?></label>
														  <br />
														  <small class="text-muted"><?php 
        _e( "*This will show today's count for individual post/page.", 'advanced-page-visit-counter' );
        ?></small>
														</div>
													  </div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
													  <div class="card-body">
														<div class="icheck-square">
														  <input tabindex="6" type="checkbox" name="show_global_count"><label><?php 
        _e( 'Show Global Total Counts', 'advanced-page-visit-counter' );
        ?></label>
														  <br />
														  <small class="text-muted"><?php 
        _e( '*This will show total counts for whole website.', 'advanced-page-visit-counter' );
        ?></small>
														</div>
													  </div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
													  <div class="card-body">
														<div class="icheck-square">
														  <input tabindex="6" checked="checked" type="checkbox" name="show_cr_pg_count"><label><?php 
        _e( 'Show Current Page Total', 'advanced-page-visit-counter' );
        ?></label>
														  <br />
														  <small class="text-muted"><?php 
        _e( '*This will show total counts the current page.', 'advanced-page-visit-counter' );
        ?></small>
														</div>
													  </div>
													</div>
												</div>
											</div>

										</div>

										   <div class="tab-pane fade" id="labels" role="tabpanel" aria-labelledby="labels-tab" aria-selected="false">

											   <div class="row">
												<div class="col-md-6">
													<div class="form-group">
													  <div class="card-body">
														  <label><?php 
        _e( 'Counter Label', 'advanced-page-visit-counter' );
        ?></label>
														  <input class="form-control" value="Visits:" name="counter_label" type="text">
													  </div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
													  <div class="card-body">
														  <label><?php 
        _e( "Today's Counter Label", 'advanced-page-visit-counter' );
        ?></label>
														  <input class="form-control" value="Today:" name="today_counter_label" type="text">
													  </div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
													  <div class="card-body">
														  <label><?php 
        _e( 'Global Counter Label', 'advanced-page-visit-counter' );
        ?></label>
														  <input class="form-control" value="Total:" name="global_counter_label" type="text">
													  </div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
													  <div class="card-body">
														  <label><?php 
        _e( 'Shortcode Type', 'advanced-page-visit-counter' );
        ?></label>
														  <select name="shortcode_type" id="shortcode_type" class="form-control">
														  <option value="" disabled selected><?php 
        _e( 'Choose your option', 'advanced-page-visit-counter' );
        ?></option>
															<option value="customized" selected><?php 
        _e( 'Customized', 'advanced-page-visit-counter' );
        ?></option>
															<option value="individual"><?php 
        _e( 'For Specific Post/Page', 'advanced-page-visit-counter' );
        ?></option>
														</select>
													  </div>
													</div>
												</div>
											</div>

											<div class="row shArticles">
												<div class="col-md-12">
													<div class="form-group">
														<div class="card-body">
														  <label><?php 
        _e( 'Articles', 'advanced-page-visit-counter' );
        ?></label>
														  <select class="apvc_articles_list" name="apvc_articles_list" style="width:100%">

														  </select>
														</div>
													</div>
												</div>
											</div>

											<?php 
        ?>

										</div>

										<div class="tab-pane fade" id="sh_temp" role="tabpanel" aria-labelledby="sh-temp-tab" aria-selected="false">
											<div class="col-md-12">
												<div class="form-group">
												  <label><?php 
        _e( 'Widget Templates', 'advanced-page-visit-counter' );
        ?></label>
												  <select id="apvc_widget_template" name="apvc_widget_template" class="apvc-counter-icon" style="width:100%">
												  <?php 
        $shortcodes = json_decode( $this->apvc_get_shortcodes() );
        echo  '<option>' . __( 'None', 'advanced-page-visit-counter' ) . '</option>' ;
        foreach ( $shortcodes as $key => $value ) {
            echo  '<option value="' . esc_html( $key ) . '"> ' . ucfirst( str_replace( '_', ' ', esc_html( $key ) ) ) . '</option>' ;
        }
        ?>
												  </select>
												  <br />
												  <small class="text-muted"><?php 
        _e( '*Check the Shortcode Library page to check the demo of all the shortcodes.<Br />*All color properties ignored if any template selected.<Br />*More than 40 templates available in the Premium version of the plugin.', 'advanced-page-visit-counter' );
        ?></small>
												</div>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
						<?php 
        ?>
					</div>
				</div>
			</div>
		</div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Shortcode Generator Method.
     *
     * @since    3.0.1
     */
    public function apvc_generate_shortcode()
    {
        if ( !wp_verify_nonce( $_POST['security'], 'security_nonce' ) ) {
            die( 'Permission Denied.' );
        }
        ob_start();
        $formData = $_POST['formData'];
        $formData = explode( '&', $formData );
        $finalFormData = array();
        foreach ( $formData as $key => $value ) {
            $rawFormData = explode( '=', $value );
            if ( isset( $rawFormData[0] ) ) {
                $finalFormData[$rawFormData[0]][] = urldecode( sanitize_text_field( $rawFormData[1] ) );
            }
        }
        $border_size = ( isset( $finalFormData['border_size'][0] ) ? $finalFormData['border_size'][0] : "" );
        $border_radius = ( isset( $finalFormData['border_radius'][0] ) ? $finalFormData['border_radius'][0] : "" );
        $bg_color = ( isset( $finalFormData['background_color'][0] ) ? $finalFormData['background_color'][0] : "" );
        $font_size = ( isset( $finalFormData['font_size'][0] ) ? $finalFormData['font_size'][0] : "" );
        $font_style = ( isset( $finalFormData['font_style'][0] ) ? $finalFormData['font_style'][0] : "" );
        $font_color = ( isset( $finalFormData['font_color'][0] ) ? $finalFormData['font_color'][0] : "" );
        $border_style = ( isset( $finalFormData['border_style'][0] ) ? $finalFormData['border_style'][0] : "" );
        $border_color = ( isset( $finalFormData['border_color'][0] ) ? $finalFormData['border_color'][0] : "" );
        $counter_label = ( isset( $finalFormData['counter_label'][0] ) ? $finalFormData['counter_label'][0] : "" );
        $today_counter_label = ( isset( $finalFormData['today_counter_label'][0] ) ? $finalFormData['today_counter_label'][0] : "" );
        $global_counter_label = ( isset( $finalFormData['global_counter_label'][0] ) ? $finalFormData['global_counter_label'][0] : "" );
        $padding = ( isset( $finalFormData['padding'][0] ) ? $finalFormData['padding'][0] : "" );
        $width = ( isset( $finalFormData['width'][0] ) ? $finalFormData['width'][0] : "" );
        $shType = ( isset( $finalFormData['shortcode_type'][0] ) ? $finalFormData['shortcode_type'][0] : "" );
        $shArticleID = ( isset( $finalFormData['apvc_articles_list'][0] ) ? $finalFormData['apvc_articles_list'][0] : "" );
        $show_global_count = ( isset( $finalFormData['show_global_count'][0] ) ? $finalFormData['show_global_count'][0] : "" );
        $show_today_count = ( isset( $finalFormData['show_today_count'][0] ) ? $finalFormData['show_today_count'][0] : "" );
        $show_cr_pg_count = ( isset( $finalFormData['show_cr_pg_count'][0] ) ? $finalFormData['show_cr_pg_count'][0] : "" );
        $widget_template = ( isset( $finalFormData['apvc_widget_template'][0] ) ? $finalFormData['apvc_widget_template'][0] : "" );
        if ( empty($shArticleID) ) {
            $shArticleID = 1;
        }
        
        if ( $show_global_count == 'on' ) {
            $show_global_countVar = ' global="true" ';
        } else {
            $show_global_countVar = ' global="false" ';
        }
        
        
        if ( $show_today_count == 'on' ) {
            $show_today_countVar = ' today="true" ';
        } else {
            $show_today_countVar = ' today="false" ';
        }
        
        
        if ( $show_cr_pg_count == 'on' ) {
            $show_cr_pg_countVar = ' current="true" ';
        } else {
            $show_cr_pg_countVar = ' current="false" ';
        }
        
        $shArgs = '';
        
        if ( $shType == 'individual' && !empty($shArticleID) ) {
            $shArgs = 'type="individual" article_id="' . $shArticleID . '"';
        } elseif ( $shType == 'global' ) {
            $shArgs = 'type="global"';
        } else {
            $shArgs = 'type="customized"';
        }
        
        $counter_label = ( !empty($counter_label) ? $counter_label : 'Visits: ' );
        $today_counter_label = ( !empty($today_counter_label) ? $today_counter_label : $counter_label );
        $global_counter_label = ( !empty($global_counter_label) ? $global_counter_label : $counter_label );
        $shortcode = '[apvc_embed ' . $shArgs . ' border_size="' . $border_size . '" border_radius="' . $border_radius . '" background_color="' . $bg_color . '" font_size="' . $font_size . '" font_style="' . $font_style . '" font_color="' . $font_color . '" counter_label="' . $counter_label . '" today_cnt_label="' . $today_counter_label . '" global_cnt_label="' . $global_counter_label . '" border_color="' . $border_color . '" border_style="' . $border_style . '" padding="' . $padding . '" width="' . $width . '" ' . $show_global_countVar . ' ' . $show_today_countVar . ' ' . $show_cr_pg_countVar . ' ' . $iconCR . ' ' . $iconGL . ' ' . $iconTD . ' icon_position="' . $apvc_icon_position . '" widget_template="' . $widget_template . '" ]';
        ?>
		<style>
			 .avc_visit_counter_front{
				 width: <?php 
        echo  esc_html( $width ) ;
        ?>px;
				 max-width: <?php 
        echo  esc_html( $width ) ;
        ?>px;
				padding: <?php 
        echo  esc_html( $padding ) ;
        ?>px;
				text-align: center;
				margin: 15px 0px 15px 0px;
				margin: 20px auto;
			 }
			 .shortcode_copy{ text-align: center; } .shortcode_copy a{ color: #fff !important; cursor: pointer; }
		</style>
		<div class="shortcodeBlock col-md-12">
			<div class="shortcode_text grid-margin" id="shortcode_text">
				<?php 
        echo  esc_html( $shortcode ) ;
        ?>
			</div>
			<div class="col-md-12 shortcode_output center-align" id="shortcode_output">
				<?php 
        echo  do_shortcode( $shortcode ) ;
        ?>
			</div>
			<div class="col-md-12 shortcode_copy grid-margin">
				<a class="btn btn-primary btn-rounded btn-fw text-center" id="shortcode_copy"><?php 
        _e( 'Copy Shortcode', 'advanced-page-visit-counter' );
        ?></a>
			</div>

			<?php 
        ?>
		</div>
		<?php 
        echo  ob_get_clean() ;
        wp_die();
    }
    
    public function apvc_shortcode_library()
    {
        global  $wpdb ;
        $shortcodes = json_decode( $this->apvc_get_shortcodes() );
        ?>
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel container">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-lg-12 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
								<h5 class="text-center grid-margin"><b><?php 
        _e( 'Shortcodes Library', 'advanced-page-visit-counter' );
        ?></b></h5>
									<div class="row">
									<?php 
        foreach ( $shortcodes as $key => $value ) {
            $addClass = ( isset( $value->class ) ? $value->class : '' );
            ?>
										<div class="col-lg-4 grid-margin">
											<h4 class="card-title text-center">
											<?php 
            echo  str_replace( '_', ' ', $key ) ;
            ?>
											</h4>
											<style type="text/css">
											<?php 
            echo  esc_html( $value->css ) ;
            ?>
											</style>
										<?php 
            echo  ( $value->icon == 'yes' ? $this->apvc_get_html_with_icon( $key . ' ' . $addClass ) : $this->apvc_get_html_without_icon( $key . ' ' . $addClass ) ) ;
            ?>
										</div>
									<?php 
        }
        ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
    }
    
    public function apvc_daily_cleanup_method()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $avc_config = (object) get_option( 'apvc_configurations', true );
        $dd = $avc_config->apvc_delete_rc[0];
        
        if ( !empty($dd) ) {
            $dDate = date( 'Y-m-d 00:00:00', strtotime( '-' . $dd . ' days' ) );
            return $wpdb->get_results( "DELETE FROM {$table} WHERE date<='{$dt}' " );
        }
    
    }
    
    public function apvc_upgrade_database()
    {
        global  $wpdb ;
        $history_table = $wpdb->prefix . 'avc_page_visit_history';
        $article_title = $wpdb->get_results( "SELECT article_title FROM {$history_table} WHERE article_title != ''" );
        
        if ( empty($article_title) ) {
            $sqlAlter = "ALTER TABLE {$history_table} DROP COLUMN article_title";
            $wpdb->query( $sqlAlter );
        }
        
        $addColumn = $wpdb->get_results( "SELECT country FROM {$history_table} WHERE country != ''" );
        
        if ( empty($addColumn) ) {
            $addColumn = "ALTER TABLE {$history_table} ADD country TEXT AFTER flag";
            $wpdb->query( $addColumn );
        }
        
        return wp_send_json_success();
        wp_die();
    }
    
    public function apvc_detailed_reports_on_chart()
    {
        global  $wpdb ;
        $tbl_history = APVC_DATA_TABLE;
        ?>
		<input type="hidden" id="current_page" value="detailed-reports-chart">
		<input type="hidden" id="current_article" value="<?php 
        echo  esc_html( $_GET['article_id'] ) ;
        ?>">

		<div class="container-fluid page-body-wrapper">
			<div class="main-panel container">
			  <div class="content-wrapper">

				<?php 
        ?>
					<div class="row grid-margin">
						<div class="col-12 col-md-12 col-lg-12 stretch-card">
							<div class="card">
								<h6>In premium version only.</h6>
								<img src="<?php 
        echo  plugin_dir_url( __FILE__ ) ;
        ?>images/filters-premium.png">
							</div>
						</div>
					</div>
				<?php 
        ?>

				<div class="card report_card col-md-12">
				  <div class="card-body">
					<div class="row">
						<canvas id="detailed_chart_single" style="position: relative; height:65vh; width:80vw"></canvas>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		<?php 
    }

}