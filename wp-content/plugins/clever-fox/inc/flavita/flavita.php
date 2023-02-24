<?php
/**
 * @package   Gradiant
 */

require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/extras.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/dynamic-style.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/sections/above-header.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/flavita/sections/header-contact.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/sections/above-footer.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/features/gradiant-header.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/flavita/features/flavita-header.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/features/gradiant-footer.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/features/gradiant-slider.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/comoxa/features/comoxa-service.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/flavita/features/gradiant-client.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/features/gradiant-cta.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/features/gradiant-typography.php';

if ( ! function_exists( 'cleverfox_gradiant_frontpage_sections' ) ) :
	function cleverfox_gradiant_frontpage_sections() {	
		require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/sections/section-slider.php';
		require CLEVERFOX_PLUGIN_DIR . 'inc/gradiant/sections/section-cta.php';
		require CLEVERFOX_PLUGIN_DIR . 'inc/comoxa/sections/section-service.php';
		require CLEVERFOX_PLUGIN_DIR . 'inc/flavita/sections/section-client.php';
    }
	add_action( 'gradiant_sections', 'cleverfox_gradiant_frontpage_sections' );
endif;


function cleverfox_gradiant_enqueue_scripts() {
	wp_enqueue_style('animate',CLEVERFOX_PLUGIN_URL .'/inc/assets/css/animate.css');
}
add_action( 'wp_enqueue_scripts', 'cleverfox_gradiant_enqueue_scripts' );