(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	jQuery( document ).on(
		"click",
		"#update_clear",
		function () {
			window.location.href = apvc_ajax.admin_d_url + "&clr=yes";
		}
	);

	setTimeout(
		function () {
			jQuery( '.alert-success' ).hide( 500 );
		},
		2000
	);
	// jQuery(".toplevel_page_apvc-dashboard-page .wp-submenu .wp-first-item a").html("Statistics");
	// var st = jQuery(".toplevel_page_apvc-dashboard-page li a").html();
	var parm = getUrlParameter( "apvc_page" );

	jQuery( ".toplevel_page_apvc-dashboard-page .wp-submenu li a" ).each(
		function (index) {

			if (jQuery( this ).text() === 'Trending') {
				if (parm == 'trending') {
					apvcRemoveClass( jQuery( this ) );
				}
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=trending" );
			} else if (jQuery( this ).text() === 'Reports') {
				if (parm == 'reports') {
					apvcRemoveClass( jQuery( this ) );
				}
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=reports" );
			} else if (jQuery( this ).text() === 'Countries') {
				if (parm == 'country_reports') {
					apvcRemoveClass( jQuery( this ) );
				}
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=country_reports" );
			} else if (jQuery( this ).text() === 'Shortcode Generator') {
				if (parm == 'shortcode_generator') {
					apvcRemoveClass( jQuery( this ) );
				}
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=shortcode_generator" );
			} else if (jQuery( this ).text() === 'Shortcode Templates') {
				if (parm == 'shortcode_library') {
					apvcRemoveClass( jQuery( this ) );
				}
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=shortcode_library" );
			} else if (jQuery( this ).text() === 'Clean Up Data') {
				if (parm == 'cleanup_data') {
					apvcRemoveClass( jQuery( this ) );
				}
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=cleanup_data" );
			} else if (jQuery( this ).text() === 'Import') {
				if (parm == 'import_data') {
					apvcRemoveClass( jQuery( this ) );
				}
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=import_data" );
			} else if (jQuery( this ).text() === 'Export') {
				if (parm == 'export_data') {
					apvcRemoveClass( jQuery( this ) );
				}
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=export_data" );
			} else if (jQuery( this ).text() === 'Settings') {
				if (parm == 'settings') {
					apvcRemoveClass( jQuery( this ) );
				}
				jQuery( this ).attr( "href", "admin.php?page=apvc-dashboard-page&apvc_page=settings" );
			}

		}
	);

	function apvcRemoveClass(obj) {
		jQuery( ".toplevel_page_apvc-dashboard-page .wp-first-item" ).removeClass( "current" );
		jQuery( obj ).closest( "li" ).addClass( "current" );
	}

	/*********************** NEW VERSION ***********************/
	var lineChartStyleOption_1 = {
		scales: {
			yAxes: [{
				display: false
			}],
			xAxes: [{
				display: false
			}]
		},
		legend: {
			display: false
		},
		elements: {
			point: {
				radius: 1
			},
			line: {
				tension: 0
			}
		},
		stepsize: 100
	};
	var lineChartStyleOption_2 = {
		scales: {
			yAxes: [{
				display: false
			}],
			xAxes: [{
				display: false
			}]
		},
		legend: {
			display: false
		},
		elements: {
			point: {
				radius: 0
			},
			line: {
				tension: 0
			}
		},
		stepsize: 100
	};
	var current_page           = jQuery( "#current_page" ).val();

	jQuery( document ).on(
		"click",
		"#apvc_update_db",
		function (e) {
			e.preventDefault();
			jQuery.ajax(
				{
					type: "post",
					url: apvc_ajax.ajax_url,
					data: {action: "apvc_upgrade_database"},
					success: function (response) {
						alert( "Database upgraded successfully." );
						window.location.reload();
					}
				}
			);
		}
	);

	// apvc_filter_chart_dash

	jQuery( document ).on(
		"change",
		"#apvc_filter_chart_dash",
		function (e) {
			e.preventDefault();
			var chFlag = jQuery( "#apvc_chart_prem" ).val();

			if (chFlag == undefined) {
				alert( "This feature is only available with premium version." );
			} else {
				
			}
		}
	);

	if (current_page == 'detailed-reports-chart') {

		var articleID = jQuery( "#current_article" ).val();

		

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_chart_data_single", article: articleID, security: apvc_ajax.security_nonce},
				success: function (response) {
					let RLresponse = jQuery.parseJSON( response );
					let Vchart     = jQuery.parseJSON( RLresponse.chart );
					new Chart(
						document.getElementById( "detailed_chart_single" ),
						{
							type: 'line',
							data: {
								labels: Vchart.labels,
								datasets: [{
									data: Vchart.visitors,
									label: "Visitors",
									borderColor: primaryColor,
									backgroundColor: primaryColor,
									fill: false
								},
								{
									data: Vchart.visits,
									label: "Visits",
									borderColor: dangerColor,
									backgroundColor: dangerColor,
									fill: false
								}
								]
							}
						}
					);
				}
			}
		);

		if ($( ".countriesDropdown, .devicesDropdown, .browsersDropdown, .osDropdown" ).length) {
			$( ".countriesDropdown, .devicesDropdown, .browsersDropdown, .osDropdown" ).select2();
		}
		if ($( ".countriesDropdownCL" ).length) {
			$( ".countriesDropdownCL" ).select2();
		}
	}

	

	if ($( ".apvc-counter-icon" ).length) {
		$( ".apvc-counter-icon" ).select2();
	}

	jQuery( document ).on(
		'click',
		".resetCloseBtn",
		function () {
			jQuery( "#resetCnt" ).modal( "hide" );
		}
	);

	jQuery( document ).on(
		'click',
		".reset_cnt",
		function () {
			var art_id = jQuery( this ).attr( "art_id" );
			jQuery( "#art_id_btn" ).attr( "art_id", art_id );
		}
	);

	jQuery( document ).on(
		"click",
		".resetCnt",
		function (e) {
			e.preventDefault();
			jQuery( 'body' ).css( 'cursor', 'progress' );
			var artID = jQuery( this ).attr( "art_id" );
			jQuery.ajax(
				{
					type: "post",
					url: apvc_ajax.ajax_url,
					data: {action: "apvc_reset_count_art", artID: artID, security: apvc_ajax.security_nonce},
					success: function (response) {
						if (response.success == true) {
							jQuery( '.resetCnt' ).text( "Success" );
							jQuery( 'body' ).css( 'cursor', 'default' );
							setTimeout(
								function () {
									window.location.reload();
								},
								500
							);
						}
					}
				}
			);
		}
	);

	jQuery( document ).on(
		"click",
		".set_start_cnt",
		function (e) {
			e.preventDefault();
			var artID = jQuery( this ).attr( "art_id" );
			jQuery.ajax(
				{
					type: "post",
					url: apvc_ajax.ajax_url,
					data: {action: "apvc_show_counter_options", artID: artID,security: apvc_ajax.security_nonce},
					success: function (response) {
						jQuery( ".setCntPreview" ).html( response );
					}
				}
			);
		}
	);

	jQuery( document ).on(
		"click",
		".setCntSaveBtn",
		function (e) {
			e.preventDefault();
			jQuery( 'body' ).css( 'cursor', 'progress' );

			var cnt_act    = jQuery( "input[name=apvc_active_counter]:checked" ).val();
			var start_from = jQuery( "input[name=count_start_from]" ).val();
			var wid_label  = jQuery( "input[name=widget_label]" ).val();
			var art_id     = jQuery( "input[name=art_id]" ).val();

			jQuery.ajax(
				{
					type: "post",
					url: apvc_ajax.ajax_url,
					data: {
						action: "apvc_save_start_counter_op",
						cnt_act: cnt_act,
						start_from: start_from,
						wid_label: wid_label,
						art_id: art_id,
						security: apvc_ajax.security_nonce
					},
					success: function (response) {
						if (response.success == true) {
							jQuery( ".setCntSaveBtn" ).text( "Saved.." );
							jQuery( 'body' ).css( 'cursor', 'default' );
							setTimeout(
								function () {
									window.location.reload();
								},
								500
							);
						}
					}
				}
			);
		}
	);

	jQuery( document ).on(
		'click',
		".setCntCloseBtn",
		function () {
			jQuery( "#setCnt" ).modal( "hide" );
			var reset = '<div class="loader-demo-box" style="border: none !important;"><div class="square-box-loader"><div class="square-box-loader-container"><div class="square-box-loader-corner-top"></div><div class="square-box-loader-corner-bottom"></div></div><div class="square-box-loader-square"></div></div></div>';
			setTimeout(
				function () {
					jQuery( ".setCntPreview" ).html( reset );
				},
				500
			);
		}
	);

	/************************ Settings Page ***********************/
	jQuery( document ).on(
		"click",
		"#apvc_save_settings",
		function (e) {
			e.preventDefault();
			var formData = jQuery( '#apvc_settings_form' ).serialize();
			var apvc_default_label = jQuery("#apvc_default_label").val();
			var apvc_todays_label = jQuery("#apvc_todays_label").val();
			var apvc_global_label = jQuery("#apvc_global_label").val();
			var default_label = apvc_default_label;
			var todays_label = apvc_todays_label;
			var global_label = apvc_global_label;
			var range_posts = jQuery("#apvc_exclude_counts").val();
			var range_ip_add = jQuery("#apvc_ip_address").val();
			var ex_show_counter = jQuery("#apvc_exclude_show_counter").val();

			jQuery.ajax(
				{
					type: "post",
					url: apvc_ajax.ajax_url,
					data: {action: "apvc_save_settings", formData: formData, ex_show_counter:ex_show_counter, range_posts:range_posts, range_ip_add:range_ip_add, default_label: default_label, todays_label:todays_label, global_label:global_label, security: apvc_ajax.security_nonce},
					success: function (response) {
						console.log(response);
						if (response == 'success') {
							var url              = window.location.href + "&m=success";
							window.location.href = url;
						}
					}
				}
			);
		}
	);
	jQuery( document ).on(
		"click",
		".confirm-reset-settings",
		function (e) {
			e.preventDefault();
			jQuery.ajax(
				{
					type: "post",
					url: apvc_ajax.ajax_url,
					data: {action: "apvc_reset_settings",security: apvc_ajax.security_nonce},
					success: function (response) {
						alert( response );
						if (response == 'success') {
							var url              = window.location.href + "&m=success&t=reset";
							window.location.href = url;
						} else {
							jQuery( "#showWarning" ).modal( "show" );
						}
					}
				}
			);
		}
	);
	jQuery( document ).on(
		"click",
		"#apvc_reset_button",
		function (e) {
			e.preventDefault();
			showSwal( 'warning-message-and-cancel' );
		}
	);
	jQuery( document ).on(
		"click",
		".confirm-reset-data-settings",
		function (e) {
			e.preventDefault();
			jQuery.ajax(
				{
					type: "post",
					url: apvc_ajax.ajax_url,
					data: {action: "apvc_reset_data_settings",security: apvc_ajax.security_nonce},
					success: function (response) {
						if (response == 'success') {
							var url              = window.location.href + "&m=success&t=reset_data";
							window.location.href = url;
						}
					}
				}
			);
		}
	);
	jQuery( document ).on(
		"click",
		"#apvc_reset_data_button",
		function (e) {
			e.preventDefault();
			showSwal( 'warning-message-and-cancel-data' );
		}
	);
	/************************ Settings Page End ***********************/

	/************************ Generate Shortcode ***********************/
	jQuery( document ).on(
		"click",
		".apvc_generate_shortcode",
		function (e) {
			e.preventDefault();
			jQuery( ".shLoader" ).show();
			var formData = jQuery( '#apvc_generate_shortcode' ).serialize();
			jQuery.ajax(
				{
					type: "post",
					url: apvc_ajax.ajax_url,
					data: {action: "apvc_generate_shortcode", formData: formData,security: apvc_ajax.security_nonce},
					success: function (response) {
						jQuery( ".shLoader" ).hide();
						if (response != '') {
							jQuery( "#shortcode_output" ).html( response );
						}
					}
				}
			);
		}
	);

	jQuery( document ).on(
		'click',
		"#shortcode_copy",
		function (e) {
			e.preventDefault();
			var el    = document.getElementById( "shortcode_text" );
			var range = document.createRange();
			range.selectNodeContents( el );
			var sel = window.getSelection();
			sel.removeAllRanges();
			sel.addRange( range );
			document.execCommand( 'copy' );
			showSwal( 'success-message' );
		}
	);

	/************************ Generate Shortcode End ***********************/
	function getUrlParameter(sParam) {
		var sPageURL      = window.location.search.substring( 1 ),
			sURLVariables = sPageURL.split( '&' ),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split( '=' );
			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? '-' : decodeURIComponent( sParameterName[1] );
			}
		}
	};

	function abbrNum(number, decPlaces) {
		// 2 decimal places => 100, 3 => 1000, etc
		decPlaces = Math.pow( 10, decPlaces );

		if (apvc_ajax.show_in_k == '' || apvc_ajax.show_in_k == 'No') {
			return number;
		}

		// Enumerate number abbreviations
		var abbrev = ["k", "m", "b", "t"];

		// Go through the array backwards, so we do the largest first
		for (var i = abbrev.length - 1; i >= 0; i--) {

			// Convert array index to "1000", "1000000", etc
			var size = Math.pow( 10, (i + 1) * 3 );

			// If the number is bigger or equal do the abbreviation
			if (size <= number) {
				// Here, we multiply by decPlaces, round, and then divide by decPlaces.
				// This gives us nice rounding to a particular decimal place.
				number = Math.round( number * decPlaces / size ) / decPlaces;

				// Handle special case where we round up to the next abbreviation
				if ((number == 1000) && (i < abbrev.length - 1)) {
					number = 1;
					i++;
				}

				// Add the letter for the abbreviation
				number += abbrev[i];

				// We are done... stop
				break;
			}
		}

		return number;
	}

	if (current_page == 'trending') {

		var d   = getUrlParameter( 'd' );
		var e   = getUrlParameter( 'e' );
		var pts = getUrlParameter( 'pts' );
		if (pts == "-") {
			pts = "";
		}
		var psts = getUrlParameter( 'psts' );
		if (psts == "-") {
			psts = "";
		}

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_top_pages_data", d: d, e: e, security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_top_pages_data" ).html( response );
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_top_posts_data", d: d, e: e, pts: pts, security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_top_posts_data" ).html( response );
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_top_countries_data", d: d, e: e, psts: psts, pts: pts, security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_top_countries_data" ).html( response );
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_top_ip_address_data", d: d, e: e, psts: psts, pts: pts, security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_top_ip_address_data" ).html( response );
				}
			}
		);

	} else if (current_page == 'shortcode') {

		setTimeout(
			function () {
				jQuery.ajax(
					{
						type: "post",
						url: apvc_ajax.ajax_url,
						data: {action: "apvc_get_all_articles_sh", security: apvc_ajax.security_nonce},
						success: function (response) {
							if ( response.success === true ) {
								jQuery( ".apvc_articles_list" ).append( response.data );
								jQuery( ".apvc_articles_list" ).select2();
							}
						}
					}
				);
			},
			500
		);

	} else if (current_page == 'dashboard') {

		jQuery( "#getPremium" ).modal( "show" );

		jQuery( document ).on(
			'click',
			'#noReject',
			function (e) {
				e.preventDefault();
				if (jQuery( "#dnd_show_prom" ).prop( "checked" ) == true) {
					window.location.href = apvc_ajax.admin_d_url + "&promo=off";
				}
				jQuery( "#getPremium" ).modal( "hide" );
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_visit_stats",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( ".c-loader" ).remove();
					let RLresponse = jQuery.parseJSON( response );
					let Vchart     = jQuery.parseJSON( RLresponse.chart );

					new Chart(
						document.getElementById( "visitStatsChart" ),
						{
							type: 'line',
							data: {
								labels: Vchart.labels,
								datasets: [{
									data: Vchart.visitors,
									label: "Visitors",
									borderColor: primaryColor,
									backgroundColor: primaryColor,
									fill: false
								}, {
									data: Vchart.visits,
									label: "Visits",
									borderColor: dangerColor,
									backgroundColor: dangerColor,
									fill: false
								}
								]
							}
						}
					);
				}
			}
		);
		jQuery( document ).on(
			"click",
			"#apvc_update_dash",
			function (e) {
				jQuery( 'body' ).css( 'cursor', 'progress' );
				jQuery.ajax(
					{
						type: "post",
						url: apvc_ajax.ajax_url,
						data: {action: "apvc_refresh_dashboard",security: apvc_ajax.security_nonce},
						complete: function (response) {
							jQuery( ".hm_dash_heading h5" ).html( "<span style='color: red;'>" + apvc_translation.refresh_dashboard + "</span>" );
							jQuery( 'body' ).css( 'cursor', 'default' );
							setTimeout(
								function () {
									window.location.reload();
								},
								2000
							);
						}
					}
				);
			}
		);

		setInterval(
			function () {
				jQuery.ajax(
					{
						type: "get",
						url: apvc_ajax.ajax_url,
						data: {action: "apvc_dashboard_updated",security: apvc_ajax.security_nonce},
						complete: function (response) {
							jQuery( "#apvc_dash_updated" ).html( response.responseText );
						}
					}
				);
			},
			5000
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_visit_length",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_visit_length" ).html( response );
				}
			}
		);
		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_total_visitors",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_total_visitors" ).html( response );
				}
			}
		);
		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_first_time_visitors",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_first_time_visitors" ).html( response );
				}
			}
		);
		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_post_views_per_user",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_post_views_per_user" ).html( response );
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_visit_length", day: 30, security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_visit_length_t" ).html( response );
				}
			}
		);
		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_total_visitors", day: 30, security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_total_visitors_t" ).html( response );
				}
			}
		);
		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_first_time_visitors", day: 30, security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_first_time_visitors_t" ).html( response );
				}
			}
		);
		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_post_views_per_user", day: 30, security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_post_views_per_user_t" ).html( response );
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_total_counts_of_the_year_data",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#total_counts_year_data" ).html( response );
					if ($( '#apvc_total_visits_yearly' ).length) {
						var lineChartCanvas      = $( "#apvc_total_visits_yearly" ).get( 0 ).getContext( "2d" );
						var gradientStrokeFill_1 = lineChartCanvas.createLinearGradient( 1, 2, 1, 400 );
						gradientStrokeFill_1.addColorStop( 0, '#fff' );
						gradientStrokeFill_1.addColorStop( 1, infoColor );

						var list      = jQuery( '#apvc_total_visits_yearly' ).attr( "months" ).split( "," );
						var lineChart = new Chart(
							lineChartCanvas,
							{
								type: 'line',
								data: {
									labels: list,
									datasets: [{
										label: 'Visits',
										data: list,
										borderColor: infoColor,
										backgroundColor: gradientStrokeFill_1,
										borderWidth: 2,
										fill: true
									}]
								},
								options: lineChartStyleOption_2
							}
						);
					}
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_total_counts_of_the_month_data" ,security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#total_counts_month_data" ).html( response );

					if ($( '#apvc_total_visits_monthly' ).length) {
						var lineChartCanvas      = $( "#apvc_total_visits_monthly" ).get( 0 ).getContext( "2d" );
						var gradientStrokeFill_1 = lineChartCanvas.createLinearGradient( 1, 2, 1, 400 );
						gradientStrokeFill_1.addColorStop( 0, '#fff' );
						gradientStrokeFill_1.addColorStop( 1, primaryColor );

						var Mlist     = jQuery( '#apvc_total_visits_monthly' ).attr( "month" ).split( "," );
						var lineChart = new Chart(
							lineChartCanvas,
							{
								type: 'line',
								data: {
									labels: Mlist,
									datasets: [{
										label: 'Visits',
										data: Mlist,
										borderColor: primaryColor,
										backgroundColor: gradientStrokeFill_1,
										borderWidth: 2,
										fill: true
									}]
								},
								options: lineChartStyleOption_2
							}
						);
					}
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_total_counts_of_the_week_data",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#total_counts_weeks_data" ).html( response );

					if ($( '#apvc_total_visits_weekly' ).length) {
						var lineChartCanvas      = $( "#apvc_total_visits_weekly" ).get( 0 ).getContext( "2d" );
						var gradientStrokeFill_1 = lineChartCanvas.createLinearGradient( 1, 2, 1, 400 );
						gradientStrokeFill_1.addColorStop( 0, '#fff' );
						gradientStrokeFill_1.addColorStop( 1, successColor );

						var Wlist     = jQuery( '#apvc_total_visits_weekly' ).attr( "weeks" ).split( "," );
						var lineChart = new Chart(
							lineChartCanvas,
							{
								type: 'line',
								data: {
									labels: Wlist,
									datasets: [{
										label: 'Visits',
										data: Wlist,
										borderColor: successColor,
										backgroundColor: gradientStrokeFill_1,
										borderWidth: 2,
										fill: true
									}]
								},
								options: lineChartStyleOption_2
							}
						);
					}
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_total_counts_daily_data",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#total_counts_daily_data" ).html( response );

					if ($( '#apvc_total_visits_daily' ).length) {
						var lineChartCanvas      = $( "#apvc_total_visits_daily" ).get( 0 ).getContext( "2d" );
						var gradientStrokeFill_1 = lineChartCanvas.createLinearGradient( 1, 2, 1, 400 );
						gradientStrokeFill_1.addColorStop( 0, '#fff' );
						gradientStrokeFill_1.addColorStop( 1, dangerColor );

						var Dlist     = jQuery( '#apvc_total_visits_daily' ).attr( "days" ).split( "," );
						var lineChart = new Chart(
							lineChartCanvas,
							{
								type: 'line',
								data: {
									labels: Dlist,
									datasets: [{
										label: 'Visits',
										data: Dlist,
										borderColor: dangerColor,
										backgroundColor: gradientStrokeFill_1,
										borderWidth: 2,
										fill: true
									}]
								},
								options: lineChartStyleOption_2
							}
						);
					}
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_browsers_stats_data",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_browser_stats_data" ).html( response );
					if ($( "#apvcBrowsersStatsChart" ).length) {
						var ch_value = jQuery( "#apvcBrowsersStatsChart" ).attr( "ch_value" ).split( ',' );
						var ch_keys  = jQuery( "#apvcBrowsersStatsChart" ).attr( "ch_keys" ).split( ',' );

						var apvcBrowsersStatsChart = $( "#apvcBrowsersStatsChart" ).get( 0 ).getContext( "2d" );
						var doughnutPieData        = {
							datasets: [{
								data: ch_value,
								backgroundColor: [
								primaryColor,
								secondaryColor,
								successColor,
								warningColor,
								dangerColor,
								infoColor,
								darkColor,
								lightColor
								],
								borderColor: [
								primaryColor,
								secondaryColor,
								successColor,
								warningColor,
								dangerColor,
								infoColor,
								darkColor,
								lightColor
								],
							}],

							// These labels appear in the legend and in the tooltips when hovering different arcs
							labels: ch_keys
						};
						var doughnutPieOptions = {
							cutoutPercentage: 75,
							animationEasing: "easeOutBounce",
							animateRotate: true,
							animateScale: false,
							responsive: true,
							maintainAspectRatio: true,
							showScale: true,
							legend: {
								display: false
							},
							layout: {
								padding: {
									left: 0,
									right: 0,
									top: 0,
									bottom: 0
								}
							}
						};
						var doughnutChart      = new Chart(
							apvcBrowsersStatsChart,
							{
								type: 'doughnut',
								data: doughnutPieData,
								options: doughnutPieOptions
							}
						);
					}
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_referral_stats_data",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_referral_stats_data" ).html( response );
					if ($( "#trafficReferralChart" ).length) {
						var ref_value = jQuery( "#trafficReferralChart" ).attr( "ref_value" ).split( ',' );
						var ref_keys  = jQuery( "#trafficReferralChart" ).attr( "ref_keys" ).split( ',' );

						var doughnutChartCanvas = $( "#trafficReferralChart" ).get( 0 ).getContext( "2d" );
						var doughnutPieData     = {
							datasets: [{
								data: ref_value,
								backgroundColor: [
								primaryColor,
								secondaryColor,
								successColor,
								warningColor,
								dangerColor,
								infoColor,
								darkColor,
								lightColor
								],
								borderColor: [
								primaryColor,
								secondaryColor,
								successColor,
								warningColor,
								dangerColor,
								infoColor,
								darkColor,
								lightColor
								],
							}],

							// These labels appear in the legend and in the tooltips when hovering different arcs
							labels: ref_keys
						};
						var doughnutPieOptions = {
							cutoutPercentage: 75,
							animationEasing: "easeOutBounce",
							animateRotate: true,
							animateScale: false,
							responsive: true,
							maintainAspectRatio: true,
							showScale: true,
							legend: {
								display: false
							},
							layout: {
								padding: {
									left: 0,
									right: 0,
									top: 0,
									bottom: 0
								}
							}
						};
						var doughnutChart      = new Chart(
							doughnutChartCanvas,
							{
								type: 'doughnut',
								data: doughnutPieData,
								options: doughnutPieOptions
							}
						);
					}
				}
			}
		);

		jQuery.ajax(
			{
				type: "post",
				url: apvc_ajax.ajax_url,
				data: {action: "apvc_get_os_stats_data",security: apvc_ajax.security_nonce},
				success: function (response) {
					jQuery( "#apvc_os_stats_data" ).html( response );
					if ($( "#osSourceChart" ).length) {
						var os_value = jQuery( "#osSourceChart" ).attr( "os_value" ).split( ',' );
						var os_keys  = jQuery( "#osSourceChart" ).attr( "os_keys" ).split( ',' );

						var doughnutChartCanvas = $( "#osSourceChart" ).get( 0 ).getContext( "2d" );
						var doughnutPieData     = {
							datasets: [{
								data: os_value,
								backgroundColor: [
								primaryColor,
								secondaryColor,
								successColor,
								warningColor,
								dangerColor,
								infoColor,
								darkColor,
								lightColor
								],
								borderColor: [
								primaryColor,
								secondaryColor,
								successColor,
								warningColor,
								dangerColor,
								infoColor,
								darkColor,
								lightColor
								],
							}],

							// These labels appear in the legend and in the tooltips when hovering different arcs
							labels: os_keys
						};
						var doughnutPieOptions = {
							cutoutPercentage: 75,
							animationEasing: "easeOutBounce",
							animateRotate: true,
							animateScale: false,
							responsive: true,
							maintainAspectRatio: true,
							showScale: true,
							legend: {
								display: false
							},
							layout: {
								padding: {
									left: 0,
									right: 0,
									top: 0,
									bottom: 0
								}
							}
						};
						var doughnutChart      = new Chart(
							doughnutChartCanvas,
							{
								type: 'doughnut',
								data: doughnutPieData,
								options: doughnutPieOptions
							}
						);
					}
				}
			}
		);

	}

	jQuery( document ).on(
		"change",
		"#shortcode_type",
		function (e) {
			e.preventDefault();
			if (jQuery( this ).val() == 'individual') {
				jQuery( ".shArticles" ).show();
			} else {
				jQuery( ".shArticles" ).hide();
			}
		}
	);

	/************************ Generate Shortcode End ***********************/

})( jQuery );


(function ($) {
	showSwal = function (type) {
		'use strict';
		if (type === 'success-message') {
			swal(
				{
					title: apvc_translation.success,
					text: apvc_translation.shortcode_copied,
					icon: 'success',
					timer: 2000,
					button: false,
				}
			);

		} else if (type === 'file-success-message') {
			swal(
				{
					title: apvc_translation.success,
					text: apvc_translation.import_completed,
					icon: 'success',
					timer: 2000,
					button: false,
				}
			);

		} else if (type === 'file-failed-message') {
			swal(
				{
					title: apvc_translation.failed,
					text: apvc_translation.import_failed,
					icon: 'error',
					timer: 2000,
					button: false,
				}
			);

		} else if (type === 'delete-success-message') {
			swal(
				{
					title: apvc_translation.success,
					text: apvc_translation.shortcode_delete,
					icon: 'success',
					timer: 2000,
					button: false,
				}
			);
		} else if (type === 'file-delete-success-message') {
			swal(
				{
					title: apvc_translation.success,
					text: apvc_translation.file_delete,
					icon: 'success',
					timer: 2000,
					button: false,
				}
			);
		} else if (type === 'file-export-success') {
			swal(
				{
					title: apvc_translation.success,
					text: apvc_translation.export_completed,
					icon: 'success',
					timer: 2000,
					button: false,
				}
			);
		} else if (type === 'file-cleanup-success') {
			swal(
				{
					title: apvc_translation.success,
					text: apvc_translation.cleanup_completed,
					icon: 'success',
					timer: 2000,
					button: false,
				}
			);
		} else if (type === 'basic') {
			swal(
				{
					text: apvc_translation.valid_date,
					icon: 'warning',
					timer: 3000,
					button: false,
				}
			);
		} else if (type === 'valid-file') {
			swal(
				{
					text: apvc_translation.valid_file,
					icon: 'warning',
					timer: 3000,
					button: false,
				}
			);
		} else if (type === 'date_warning') {

			swal(
				{
					text: apvc_translation.date_warning,
					icon: 'warning',
					timer: 3000,
					button: false,
				}
			);
		} else if (type === 'data_warning') {
			swal(
				{
					text: apvc_translation.data_warning,
					icon: 'warning',
					timer: 3000,
					button: false,
				}
			);
		} else if (type === 'warning-message-and-cancel') {
			swal(
				{
					title: apvc_translation.are_you_sure,
					text: apvc_translation.are_you_sure_text,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3f51b5',
					cancelButtonColor: '#ff4081',
					confirmButtonText: apvc_translation.confirm_btn,
					buttons: {
						cancel: {
							text: apvc_translation.cancel_btn,
							value: null,
							visible: true,
							className: "btn btn-danger",
							closeModal: true,
						},
						confirm: {
							text: apvc_translation.okay_btn,
							value: true,
							visible: true,
							className: "btn btn-primary confirm-reset-settings",
							closeModal: true
						}
					}
				}
			)
		} else if (type === 'warning-message-and-cancel-data') {
			swal(
				{
					title: apvc_translation.are_you_sure,
					text: apvc_translation.are_you_sure_text,
					icon: 'error',
					showCancelButton: true,
					confirmButtonColor: '#3f51b5',
					cancelButtonColor: '#ff4081',
					confirmButtonText: apvc_translation.confirm_btn,
					buttons: {
						cancel: {
							text: apvc_translation.cancel_btn,
							value: null,
							visible: true,
							className: "btn btn-danger",
							closeModal: true,
						},
						confirm: {
							text: apvc_translation.okay_btn,
							value: true,
							visible: true,
							className: "btn btn-primary confirm-reset-data-settings",
							closeModal: true
						}
					}
				}
			)
		} else if (type === 'custom-html') {
			swal(
				{
					content: {
						element: "input",
						attributes: {
							placeholder: apvc_translation.shortcode_save,
							type: "text",
							class: 'form-control',
							id: "shortcode_name",
						},
					},
					button: {
						text: apvc_translation.okay_btn,
						value: true,
						visible: true,
						className: "btn btn-primary save_shortcode_ok"
					}
				}
			);
		}

	}

})( jQuery );
