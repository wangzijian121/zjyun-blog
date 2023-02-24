<?php
function comoxa_slider_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	
	// Subtitle Color
	$wp_customize->add_setting(
	'slider_subttl_clr', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#252525'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'slider_subttl_clr', 
			array(
				'label'      => __( 'Subtitle Color', 'clever-fox' ),
				'section'    => 'slider_setting',
			) 
		) 
	);
	
	// Description Color
	$wp_customize->add_setting(
	'slider_desc_clr', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#252525'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'slider_desc_clr', 
			array(
				'label'      => __( 'Description Color', 'clever-fox' ),
				'section'    => 'slider_setting',
			) 
		) 
	);
}

add_action( 'customize_register', 'comoxa_slider_setting' );