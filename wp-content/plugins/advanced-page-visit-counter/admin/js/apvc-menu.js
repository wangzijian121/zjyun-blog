(function ($) {
	'use strict';

	var parm = '';// getUrlParameter("apvc_page");

	jQuery( ".toplevel_page_apvc-dashboard-page .wp-submenu li a" ).each(
		function (index) {
			if (jQuery( this ).text() === 'Trending') {
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=trending" );
			} else if (jQuery( this ).text() === 'Reports') {
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=reports" );
			} else if (jQuery( this ).text() === 'Countries') {
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=country_reports" );
			} else if (jQuery( this ).text() === 'Shortcode Generator') {
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=shortcode_generator" );
			} else if (jQuery( this ).text() === 'Shortcode Templates') {
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=shortcode_library" );
			} else if (jQuery( this ).text() === 'Clean Up Data') {
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=cleanup_data" );
			} else if (jQuery( this ).text() === 'Import') {
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=import_data" );
			} else if (jQuery( this ).text() === 'Export') {
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=export_data" );
			} else if (jQuery( this ).text() === 'Settings') {
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=settings" );
			} else if (jQuery( this ).text() === 'Contact Us') {
				jQuery( this ).attr( "href", "https://pagevisitcounter.com/" );
				jQuery( this ).attr( "target", "_blank" );
			}
		}
	);

})( jQuery );
