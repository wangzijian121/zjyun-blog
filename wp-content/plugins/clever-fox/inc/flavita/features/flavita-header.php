<?php
function flavita_lite_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	// Header Navigation Contact
	$wp_customize->add_setting(
		'hdr_nav_contact_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_html',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'hdr_nav_contact_head',
		array(
			'type' => 'hidden',
			'label' => __('Contact Info','gradiant-pro'),
			'section' => 'header_navigation',
		)
	);
	
	//hdr_nav_contact_content
	$wp_customize->add_setting(
		'hdr_nav_contact_content'
			,array(
			'default'     	=> '<div class="contact-icon"><i class="fa fa-wechat"></i></div><a href="#" class="contact-info"> <span class="title">Hotline Number</span><span class="text">0123-456-789</span></a>',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'hdr_nav_contact_content',
		array(
			'type' => 'textarea',
			'label' => __('Contact Info','gradiant-pro'),
			'section' => 'header_navigation',
		)
	);
	
	//hdr_nav_contact_content2
	$wp_customize->add_setting(
		'hdr_nav_contact_content2'
			,array(
			'default'     	=> '<div class="contact-icon"><i class="fa fa-clock-o"></i></div><a href="#" class="contact-info"><span class="title">Office Hours</span><span class="text">9:00-7:00 {Sun:Closed}</span></a>',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'hdr_nav_contact_content2',
		array(
			'type' => 'textarea',
			'label' => __('Contact Info 2','gradiant-pro'),
			'section' => 'header_navigation',
		)
	);
	
	
	//hdr_nav_contact_content3
	$wp_customize->add_setting(
		'hdr_nav_contact_content3'
			,array(
			'default'     	=> '<div class="contact-icon"><i class="fa fa-envelope"></i></div><div class="contact-info"><span class="title">Email Us</span></div><div class="contact-info"><a href="#"><span class="text">example.com</span></a></div>',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'hdr_nav_contact_content3',
		array(
			'type' => 'textarea',
			'label' => __('Contact Info 3','gradiant-pro'),
			'section' => 'header_navigation',
		)
	);
}
add_action( 'customize_register', 'flavita_lite_header_settings' );

// Header selective refresh
function flavita_lite_header_partials( $wp_customize ){
	
	// hdr_nav_contact_content
	$wp_customize->selective_refresh->add_partial( 'hdr_nav_contact_content', array(
		'selector'            => '.nav-area .menu-right .widget-contact .ct-area1',
		'settings'            => 'hdr_nav_contact_content',
		'render_callback'  => 'gradiant_hdr_nav_contact_content_render_callback',
	) );
	
	// hdr_nav_contact_content2
	$wp_customize->selective_refresh->add_partial( 'hdr_nav_contact_content2', array(
		'selector'            => '.nav-area .menu-right .widget-contact .ct-area2',
		'settings'            => 'hdr_nav_contact_content2',
		'render_callback'  => 'gradiant_hdr_nav_contact2_content_render_callback',
	) );
	
	// hdr_nav_contact_content3
	$wp_customize->selective_refresh->add_partial( 'hdr_nav_contact_content3', array(
		'selector'            => '.nav-area .menu-right .widget-contact .ct-area3',
		'settings'            => 'hdr_nav_contact_content3',
		'render_callback'  => 'gradiant_hdr_nav_contact3_content_render_callback',
	) );
	}

add_action( 'customize_register', 'flavita_lite_header_partials' );

// hdr_nav_contact_content
function gradiant_hdr_nav_contact_content_render_callback() {
	return get_theme_mod( 'hdr_nav_contact_content' );
}

// hdr_nav_contact_content2
function gradiant_hdr_nav_contact_content2_render_callback() {
	return get_theme_mod( 'hdr_nav_contact_content2' );
}

// hdr_nav_contact_content3
function gradiant_hdr_nav_contact_content3_render_callback() {
	return get_theme_mod( 'hdr_nav_contact_content3' );
}

