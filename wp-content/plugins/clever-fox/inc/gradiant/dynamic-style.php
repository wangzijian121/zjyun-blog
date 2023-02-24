<?php
if( ! function_exists( 'cleverfox_gradiant_dynamic_styles' ) ):
    function cleverfox_gradiant_dynamic_styles() {
		$output_css = '';
		
		$theme = wp_get_theme(); // gets the current theme
		
		/**
		 * Logo Width 
		 */
		 $logo_width			= get_theme_mod('logo_width','140');		 
		if($logo_width !== '') { 
				$output_css .=".logo img, .mobile-logo img {
					max-width: " .esc_attr($logo_width). "px;
				}\n";
			}
		
		/**
		 * Slider
		 */
		 $overlay_color	= '0.6';
		if ( 'Comoxa' == $theme->name){
			$overlay_color	= '0';
		}
		$slider_opacity						 = get_theme_mod('slider_opacity',$overlay_color);
		
		$output_css .=".theme-slider {
			background: rgba(0, 0, 0, $slider_opacity);
		}\n";
		
		
		/**
		 * CTA
		 */
		 $cta_bg_setting		= get_theme_mod('cta_bg_setting',esc_url(CLEVERFOX_PLUGIN_URL . 'inc/gradiant/images/slider/img01.jpg')); 
		$cta_bg_position	= get_theme_mod('cta_bg_position','scroll');	
				$output_css .=".cta-section {
					background-image: url(".esc_url($cta_bg_setting).");
					background-attachment: " .esc_attr($cta_bg_position). ";
				}\n";
		
		
		
		/**
		 *  Typography Body
		 */
		 $gradiant_body_text_transform	 	 = get_theme_mod('gradiant_body_text_transform','inherit');
		 $gradiant_body_font_style	 		 = get_theme_mod('gradiant_body_font_style','inherit');
		 $gradiant_body_font_size	 		 = get_theme_mod('gradiant_body_font_size','15');
		 $gradiant_body_line_height		 = get_theme_mod('gradiant_body_line_height','1.5');
		
		 $output_css .=" body{ 
			font-size: " .esc_attr($gradiant_body_font_size). "px;
			line-height: " .esc_attr($gradiant_body_line_height). ";
			text-transform: " .esc_attr($gradiant_body_text_transform). ";
			font-style: " .esc_attr($gradiant_body_font_style). ";
		}\n";		 
		
		/**
		 *  Typography Heading
		 */
		 for ( $i = 1; $i <= 6; $i++ ) {	
			 $gradiant_heading_text_transform 	= get_theme_mod('gradiant_h' . $i . '_text_transform','inherit');
			 $gradiant_heading_font_style	 	= get_theme_mod('gradiant_h' . $i . '_font_style','inherit');
			 $gradiant_heading_font_size	 		 = get_theme_mod('gradiant_h' . $i . '_font_size');
			 $gradiant_heading_line_height		 	 = get_theme_mod('gradiant_h' . $i . '_line_height');
			 
			 $output_css .=" h" . $i . "{ 
				font-size: " .esc_attr($gradiant_heading_font_size). "px;
				line-height: " .esc_attr($gradiant_heading_line_height). ";
				text-transform: " .esc_attr($gradiant_heading_text_transform). ";
				font-style: " .esc_attr($gradiant_heading_font_style). ";
			}\n";
		 }
		 
		 
		 /**
		 * Slider
		 */
		if ( 'Comoxa' == $theme->name){
			 $slider_subttl_clr			= get_theme_mod('slider_subttl_clr','#252525');
			 $slider_desc_clr			= get_theme_mod('slider_desc_clr','#252525');		 
				if(!empty($slider_subttl_clr)) { 
					$output_css .=".theme-slider .theme-content h1 {
						color: " .esc_attr($slider_subttl_clr). ";
					}\n";
				}
				
				if(!empty($slider_desc_clr)) { 
					$output_css .=".theme-slider .theme-content p {
						color: " .esc_attr($slider_desc_clr). ";
					}\n";
				}	
		}	
			
	 wp_add_inline_style( 'gradiant-style', $output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'cleverfox_gradiant_dynamic_styles' );
?>