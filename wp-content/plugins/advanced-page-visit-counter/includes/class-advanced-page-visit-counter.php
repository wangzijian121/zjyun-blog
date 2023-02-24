<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both
 * the public-facing side of the site and the admin area.
 *
 * @link       https://pagevisitcounter.com
 * @since      3.0.1
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 */
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      3.0.1
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/includes
 * @author     Ankit Panchal <wptoolsdev@gmail.com>
 */
class Advanced_Visit_Counter
{
    /**
     * The loader that's responsible for maintaining and registering all hooks
     * that power the plugin.
     *
     * @var      Advanced_Visit_Counter_Loader $loader Maintains and registers
     *     all hooks for the plugin.
     * @since    3.0.1
     * @access   protected
     */
    protected  $loader ;
    /**
     * The unique identifier of this plugin.
     *
     * @var      string $plugin_name The string used to uniquely identify this
     *     plugin.
     * @since    3.0.1
     * @access   protected
     */
    protected  $plugin_name ;
    /**
     * The current version of the plugin.
     *
     * @var      string $version The current version of the plugin.
     * @since    3.0.1
     * @access   protected
     */
    protected  $version ;
    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout
     * the plugin. Load the dependencies, define the locale, and set the hooks
     * for the admin area and the public-facing side of the site.
     *
     * @since    3.0.1
     */
    public function __construct()
    {
        
        if ( defined( 'ADVANCED_PAGE_VISIT_COUNTER' ) ) {
            $this->version = ADVANCED_PAGE_VISIT_COUNTER;
        } else {
            $this->version = '3.0.1';
        }
        
        $this->plugin_name = 'advanced-page-visit-counter';
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }
    
    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Advanced_Visit_Counter_Loader. Orchestrates the hooks of the plugin.
     * - Advanced_Visit_Counter_i18n. Defines internationalization
     * functionality.
     * - Advanced_Visit_Counter_Admin. Defines all hooks for the admin area.
     * - Advanced_Visit_Counter_Public. Defines all hooks for the public side
     * of the site.
     *
     * Create an instance of the loader which will be used to register the
     * hooks
     * with WordPress.
     *
     * @since    3.0.1
     * @access   private
     */
    private function load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-advanced-page-visit-counter-loader.php';
        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-advanced-page-visit-counter-i18n.php';
        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-advanced-page-visit-counter-admin.php';
        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-advanced-page-visit-counter-public.php';
        $this->loader = new Advanced_Visit_Counter_Loader();
    }
    
    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Advanced_Visit_Counter_i18n class in order to set the domain
     * and to register the hook with WordPress.
     *
     * @since    3.0.1
     * @access   private
     */
    private function set_locale()
    {
        $plugin_i18n = new Advanced_Visit_Counter_i18n();
        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
    }
    
    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    3.0.1
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new Advanced_Visit_Counter_Admin( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action(
            'admin_enqueue_scripts',
            $plugin_admin,
            'enqueue_styles',
            10
        );
        $this->loader->add_action(
            'admin_enqueue_scripts',
            $plugin_admin,
            'enqueue_scripts',
            10
        );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'avc_settings_page_init' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'apvc_advanced_save_metaboxes' );
        $this->loader->add_action( 'upgrader_process_complete', $plugin_admin, 'apvc_upgrader_process_complete' );
        $this->loader->add_action( 'wp_ajax_apvc_save_settings', $plugin_admin, 'apvc_save_settings' );
        $this->loader->add_action( 'wp_ajax_apvc_reset_settings', $plugin_admin, 'apvc_reset_settings' );
        $this->loader->add_action( 'wp_ajax_apvc_reset_data_settings', $plugin_admin, 'apvc_reset_data' );
        $this->loader->add_action( 'wp_ajax_apvc_refresh_dashboard', $plugin_admin, 'apvc_refresh_dashboard' );
        $this->loader->add_action( 'wp_ajax_apvc_get_top_pages_data', $plugin_admin, 'apvc_get_top_pages_data' );
        $this->loader->add_action( 'wp_ajax_apvc_get_top_posts_data', $plugin_admin, 'apvc_get_top_posts_data' );
        $this->loader->add_action( 'wp_ajax_apvc_get_top_countries_data', $plugin_admin, 'apvc_get_top_countries_data' );
        $this->loader->add_action( 'wp_ajax_apvc_get_top_ip_address_data', $plugin_admin, 'apvc_get_top_ip_address_data' );
        $this->loader->add_action( 'wp_ajax_apvc_show_counter_options', $plugin_admin, 'apvc_show_counter_options' );
        $this->loader->add_action( 'wp_ajax_apvc_save_start_counter_op', $plugin_admin, 'apvc_save_start_counter_op' );
        $this->loader->add_action( 'wp_ajax_apvc_reset_count_art', $plugin_admin, 'apvc_reset_count_art' );
        $this->loader->add_action( 'wp_ajax_apvc_upgrade_database', $plugin_admin, 'apvc_upgrade_database' );
        $this->loader->add_action( 'wp_ajax_apvc_get_total_counts_of_the_year_data', $plugin_admin, 'apvc_get_total_counts_of_the_year_data' );
        $this->loader->add_action( 'wp_ajax_apvc_get_total_counts_of_the_month_data', $plugin_admin, 'apvc_get_total_counts_of_the_month_data' );
        $this->loader->add_action( 'wp_ajax_apvc_get_total_counts_of_the_week_data', $plugin_admin, 'apvc_get_total_counts_of_the_week_data' );
        $this->loader->add_action( 'wp_ajax_apvc_get_total_counts_daily_data', $plugin_admin, 'apvc_get_total_counts_daily_data' );
        $this->loader->add_action( 'wp_ajax_apvc_get_browsers_stats_data', $plugin_admin, 'apvc_get_browsers_stats_data' );
        $this->loader->add_action( 'wp_ajax_apvc_get_referral_stats_data', $plugin_admin, 'apvc_get_referral_stats_data' );
        $this->loader->add_action( 'wp_ajax_apvc_get_os_stats_data', $plugin_admin, 'apvc_get_os_stats_data' );
        $this->loader->add_action( 'wp_ajax_apvc_visit_length', $plugin_admin, 'apvc_most_visited_article' );
        $this->loader->add_action( 'wp_ajax_apvc_total_visitors', $plugin_admin, 'apvc_get_visitors' );
        $this->loader->add_action( 'wp_ajax_apvc_first_time_visitors', $plugin_admin, 'apvc_get_first_time_visitors' );
        $this->loader->add_action( 'wp_ajax_apvc_post_views_per_user', $plugin_admin, 'apvc_get_page_views_per_visitor' );
        $this->loader->add_action( 'wp_ajax_apvc_dashboard_updated', $plugin_admin, 'apvc_dashboard_updated' );
        $this->loader->add_action( 'wp_ajax_apvc_get_visit_stats', $plugin_admin, 'apvc_get_visit_stats' );
        $this->loader->add_action( 'wp_ajax_apvc_get_chart_data_single', $plugin_admin, 'apvc_get_chart_data_single' );
        $apvPtypes = get_post_types();
        foreach ( $apvPtypes as $pList ) {
            $this->loader->add_filter( 'manage_' . $pList . '_posts_columns', $plugin_admin, 'apvc_columns_label' );
            $this->loader->add_action(
                'manage_' . $pList . '_posts_custom_column',
                $plugin_admin,
                'apvc_columns_counts',
                10,
                2
            );
        }
        $this->loader->add_action( 'wp_ajax_apvc_generate_shortcode', $plugin_admin, 'apvc_generate_shortcode' );
        $this->loader->add_action( 'wp_ajax_apvc_get_all_articles_sh', $plugin_admin, 'apvc_get_all_articles_sh' );
        $this->loader->add_action( 'apvc_daily_cleanup', $plugin_admin, 'apvc_daily_cleanup_method' );
        $this->loader->add_action( 'admin_head', $plugin_admin, 'apvc_admin_head' );
        // $this->loader->add_action('wp_ajax_apvc_refresh_live_visitors', $plugin_admin, 'apvc_refresh_live_visitors');
    }
    
    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    3.0.1
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new Advanced_Visit_Counter_Public( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        if ( get_option( 'cache_active' ) == 'No' || empty(get_option( 'cache_active' )) ) {
            $this->loader->add_action( 'wp', $plugin_public, 'update_page_visit_stats' );
        }
        $this->loader->add_shortcode( 'avc_visit_counter', $plugin_public, 'public_avc_visit_counter' );
        $this->loader->add_shortcode( 'apvc_embed', $plugin_public, 'public_avc_visit_counter' );
        $this->loader->add_filter( 'the_content', $plugin_public, 'public_add_counter_to_content' );
        $this->loader->add_action( 'rest_api_init', $plugin_public, 'apvc_register_rest_route' );
    }
    
    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    3.0.1
     */
    public function run()
    {
        $this->loader->run();
    }
    
    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     3.0.1
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }
    
    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     3.0.1
     * @return    Advanced_Visit_Counter_Loader    Orchestrates the hooks of
     *     the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }
    
    /**
     * Retrieve the version number of the plugin.
     *
     * @since     3.0.1
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

}