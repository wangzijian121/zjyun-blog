<?php
function avitech_slider_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	
	// Head
	$wp_customize->add_setting(
		'hdr_info_clr_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'avril_sanitize_text',
			'priority' => 8,
		)
	);

	$wp_customize->add_control(
	'hdr_info_clr_head',
		array(
			'type' => 'hidden',
			'label' => __('Colors','clever-fox'),
			'section' => 'above_header',
		)
	);
	
	// Info Color
	$wp_customize->add_setting(
	'hdr_info_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 8,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'hdr_info_color', 
			array(
				'label'      => __( 'Info  Color', 'clever-fox' ),
				'section'    => 'above_header'
			) 
		) 
	);
	
	// Head
	$wp_customize->add_setting(
		'slider_clr_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'avril_sanitize_text',
			'priority' => 8,
		)
	);

	$wp_customize->add_control(
	'slider_clr_head',
		array(
			'type' => 'hidden',
			'label' => __('Colors','clever-fox'),
			'section' => 'slider_setting',
		)
	);
	
	// Title Color
	$wp_customize->add_setting(
	'slide_ttl_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 8,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'slide_ttl_color', 
			array(
				'label'      => __( 'Title Color', 'clever-fox' ),
				'section'    => 'slider_setting'
			) 
		) 
	);
	
	// Subtitle Color
	$wp_customize->add_setting(
	'slide_subttl_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 8,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'slide_subttl_color', 
			array(
				'label'      => __( 'Subtitle Color', 'clever-fox' ),
				'section'    => 'slider_setting'
			) 
		) 
	);
	
	// Description Color
	$wp_customize->add_setting(
	'slide_desc_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 8,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'slide_desc_color', 
			array(
				'label'      => __( 'Description Color', 'clever-fox' ),
				'section'    => 'slider_setting'
			) 
		) 
	);
}
add_action( 'customize_register', 'avitech_slider_setting' );