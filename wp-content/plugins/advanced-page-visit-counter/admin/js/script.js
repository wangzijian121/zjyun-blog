(function ($) {
	'use strict';
	$(
		function () {
			var body    = $( 'body' );
			var footer  = $( '.footer' );
			var current = location.pathname.split( "/" ).slice( -1 )[0].replace( /^\/|\/$/g, '' );

			$( window ).scroll(
				function () {
					var headerBottom = '.navbar.horizontal-layout .nav-bottom';
					if ($( window ).scrollTop() >= 70) {
						$( headerBottom ).addClass( 'fixed-top' );
					} else {
						$( headerBottom ).removeClass( 'fixed-top' );
					}
				}
			);

			$( ".navbar.horizontal-layout .navbar-menu-wrapper .navbar-toggler" ).on(
				"click",
				function () {
					$( ".navbar.horizontal-layout .nav-bottom" ).toggleClass( "header-toggled" );
				}
			);

			// checkbox and radios
			// $(".form-check .form-check-label,.form-radio .form-check-label").not(".todo-form-check .form-check-label").append('<i class="input-helper"></i>');

			if ($( ".apvc-post-types-select, .apvc_articles_list" ).length) {
				$( ".apvc-post-types-select, .apvc_articles_list" ).select2();
			}
			

			if ($( '#apvc_exclude_counts, #apvc_ip_address, #apvc_exclude_show_counter' ).length) {
				$( '#apvc_exclude_counts, #apvc_ip_address, #apvc_exclude_show_counter' ).tagsInput(
					{
						'width': '100%',
						'height': '75%',
						'interactive': true,
						'defaultText': 'Add More',
						'removeWithBackspace': true,
						'minChars': 0,
						'maxChars': 20, // if not provided there is no limit
						'placeholderColor': '#666666'
					}
				);
			}

			$( '.icheck-square input' ).iCheck(
				{
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square',
					increaseArea: '20%'
				}
			);

			if ($( ".show_conter_on_fron_side" ).length) {
				$( ".show_conter_on_fron_side" ).select2();
			}

			if ($( ".color-picker" ).length) {
				$( '.color-picker' ).asColorPicker();
			}

		}
	);

})( jQuery );
