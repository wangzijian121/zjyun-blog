<?php
function gradiant_client_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Client  Section
	=========================================*/
	$wp_customize->add_section(
		'client_setting', array(
			'title' => esc_html__( 'Client Section', 'gradiant-pro' ),
			'priority' => 8,
			'panel' => 'gradiant_frontpage_sections',
		)
	);

	// Setting Head
	$wp_customize->add_setting(
		'client_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'client_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','clever-fox'),
			'section' => 'client_setting',
		)
	);
	
	// Hide / Show 
	$wp_customize->add_setting(
		'client_hs'
			,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'client_hs',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','clever-fox'),
			'section' => 'client_setting',
		)
	);
	
	// Client Header Section // 
	$wp_customize->add_setting(
		'client_headings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'client_headings',
		array(
			'type' => 'hidden',
			'label' => __('Header','gradiant-pro'),
			'section' => 'client_setting',
		)
	);
	
	// Client Title // 
	$wp_customize->add_setting(
    	'client_title',
    	array(
	        'default'			=> 'We are <span class="primary-color">Working With</span>',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'client_title',
		array(
		    'label'   => __('Title','gradiant-pro'),
		    'section' => 'client_setting',
			'type'           => 'text',
		)  
	);
	
	// Client Description // 
	$wp_customize->add_setting(
    	'client_description',
    	array(
	        'default'			=> __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','gradiant-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'client_description',
		array(
		    'label'   => __('Description','gradiant-pro'),
		    'section' => 'client_setting',
			'type'           => 'textarea',
		)  
	);

	// Client content Section // 
	
	$wp_customize->add_setting(
		'client_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gradiant_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'client_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','gradiant-pro'),
			'section' => 'client_setting',
		)
	);
	
	/**
	 * Customizer Repeater for add client
	 */
	
		$wp_customize->add_setting( 'client_contents', 
			array(
			 'sanitize_callback' => 'gradiant_repeater_sanitize',
			 'transport'         => $selective_refresh,
			 'priority' => 8,
			 'default' => gradiant_get_client_default()
			)
		);
		
		$wp_customize->add_control( 
			new Gradiant_Repeater( $wp_customize, 
				'client_contents', 
					array(
						'label'   => esc_html__('Client','gradiant-pro'),
						'section' => 'client_setting',
						'add_field_label'                   => esc_html__( 'Add New Client', 'gradiant-pro' ),
						'item_name'                         => esc_html__( 'Client', 'gradiant-pro' ),
						'customizer_repeater_image_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
			
	//Pro feature
		class Gradiant_client_section_upgrade extends WP_Customize_Control {
			public function render_content() { 
			?>
				<a class="customizer_client_upgrade_section up-to-pro" href="https://www.nayrathemes.com/flavita-pro/" target="_blank" style="display: none;"><?php _e('Upgrade to Pro','clever-fox'); ?></a>
			<?php
			}
		}
		
		$wp_customize->add_setting( 'gradiant_client_upgrade_to_pro', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			'priority' => 5,
		));
		$wp_customize->add_control(
			new Gradiant_client_section_upgrade(
			$wp_customize,
			'gradiant_client_upgrade_to_pro',
				array(
					'section'				=> 'client_setting',
				)
			)
		);		
}

add_action( 'customize_register', 'gradiant_client_setting' );

// client selective refresh
function gradiant_home_client_section_partials( $wp_customize ){	
	// client title
	$wp_customize->selective_refresh->add_partial( 'client_title', array(
		'selector'            => '.client-home .heading-default h3',
		'settings'            => 'client_title',
		'render_callback'  => 'gradiant_client_title_render_callback',
	
	) );
	
	// client description
	$wp_customize->selective_refresh->add_partial( 'client_description', array(
		'selector'            => '.client-home .heading-default p',
		'settings'            => 'client_description',
		'render_callback'  => 'gradiant_client_desc_render_callback',
	
	) );
	// client content
	$wp_customize->selective_refresh->add_partial( 'client_contents', array(
		'selector'            => '.client-home .partner-carousel'
	
	) );
	
	}

add_action( 'customize_register', 'gradiant_home_client_section_partials' );

// client title
function gradiant_client_title_render_callback() {
	return get_theme_mod( 'client_title' );
}

// client description
function gradiant_client_desc_render_callback() {
	return get_theme_mod( 'client_description' );
}