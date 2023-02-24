<?php
function techine_lite_header_setting( $wp_customize ){
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	
	// Company
	$wp_customize->add_setting(
		'hdr_top_Company'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'conceptly_sanitize_text',
			'priority' => 13,
		)
	);

	$wp_customize->add_control(
	'hdr_top_Company',
		array(
			'type' => 'hidden',
			'label' => __('Company','clever-fox'),
			'section' => 'header_contact',
		)
	);
	
	//Hide/Show// 
	$wp_customize->add_setting( 
		'hs_hdr_company' , 
			array(
			'default' => '1',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 14,
		) 
	);
	
	$wp_customize->add_control( new Conceptly_Customizer_Toggle_Control( $wp_customize, 
	'hs_hdr_company', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'clever-fox' ),
			'section'     => 'header_contact',
			'type'        => 'ios', // light, ios, flat
		) 
	));
	
	// icon  // 
	$wp_customize->add_setting(
    	'hdr_company_icon',
    	array(
	        'default'			=> __('fa-user','clever-fox'),
			'sanitize_callback' => 'conceptly_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 15,
		)
	);	

	$wp_customize->add_control(new Conceptly_Icon_Picker_Control($wp_customize,  
		'hdr_company_icon',
		array(
		    'label'   => __('Company Icon','clever-fox'),
		    'section' => 'header_contact',
			'iconset' => 'fa',
		))  
	);	
	// Title // 
	$wp_customize->add_setting(
    	'hdr_company_ttl',
    	array(
	        'default'			=> __('Welcome to Best Consulting Services Company','clever-fox'),
			'sanitize_callback' => 'conceptly_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 16,
		)
	);	

	$wp_customize->add_control( 
		'hdr_company_ttl',
		array(
		    'label'   		=> __('Title','clever-fox'),
		    'section' 		=> 'header_contact',
			'description'   => __( '', 'clever-fox' ),
			'type'		 =>	'textarea'
		)  
	);
};
add_action( 'customize_register', 'techine_lite_header_setting' );

// header selective refresh
function techine_clverfox_header_section_partials( $wp_customize ){
	
	// hdr_company_ttl	
	$wp_customize->selective_refresh->add_partial( 
	'hdr_company_ttl', array(
		'selector'            => '#header-top .li',
		'settings'            => 'hdr_company_ttl',
		'render_callback'  => 'header_section_hdr_company_ttl_render_callback',
	) );
	
}
add_action( 'customize_register', 'techine_clverfox_header_section_partials' );

// hdr_company_ttl
function header_section_hdr_company_ttl_render_callback() {
	return get_theme_mod( 'hdr_company_ttl' );
}
