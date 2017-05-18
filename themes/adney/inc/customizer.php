<?php
/**
 * adney Theme Customizer.
 *
 * @package adney
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function adney_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// General Settings
	$wp_customize->add_section( 'general_section', array(
		'title'          => __( 'General Settings', 'adney' ),
		'capability'     => 'edit_theme_options',
		'priority' 		 => 1,
		'description'    => __('Allows you to customize general settings for Adney.', 'adney')
	) );

	$wp_customize->add_setting( 'theme_scheme_color', array(
		'type'              => 'theme_mod',
		'default'           => '#46B289',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_scheme_color',
			array(
					'label' => __( 'Site Accent Color' ,'adney'),
					'description' => __('Select Accent color for Website.', 'adney'),
					'section' => 'general_section',
					'settings'   => 'theme_scheme_color',
					'priority' 		 => 1
			)
		)
	);

	$wp_customize->add_setting( 'adney_page_layout', array(
		'type'              => 'theme_mod',
		'default'           => 'full',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'adney_sanitize_layout',
	) );

	$wp_customize->add_control(
		'adney_page_layout',
		array(
			'label'    => __( 'Page Layout', 'adney' ),
			'section'  => 'general_section',
			'settings' => 'adney_page_layout',
			'type'     => 'select',
			'choices'  => array(
					'full'  => 'Full Width Page (No Sidebar)',
					'left_sidebar' => 'Page With Left Sidebar',
					'right_sidebar' => 'Page With Right Sidebar',
			),
			'priority' 		 => 1
		)
	);

	$wp_customize->add_setting( 'adney_blog_layout', array(
		'type'              => 'theme_mod',
		'default'           => 'right_sidebar',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'adney_sanitize_layout',
	) );

	$wp_customize->add_control(
		'adney_blog_layout',
		array(
			'label'    => __( 'Blog Layout', 'adney' ),
			'section'  => 'general_section',
			'settings' => 'adney_blog_layout',
			'type'     => 'select',
			'choices'  => array(
				'full'  => __( 'Full Width blog (No Sidebar)', 'adney' ),
				'left_sidebar' => __( 'Blog With Left Sidebar', 'adney' ),
				'right_sidebar' => __( 'Blog With Right Sidebar', 'adney' ),
			),
			'priority' 		 => 2
		)
	);

	/*
	 * Homepage Settings Section
	 * */
	$wp_customize->add_section( 'homepage_section', array(
		'title'       => __( 'Homepage Settings', 'adney' ),
		'capability'  => 'edit_theme_options',
		'priority' 	  => 1,
		'description' => __('Allows you to customize Homepage settings for Adney.', 'adney'),
		'active_callback' => 'adney_is_xylus_toolkit_active',
	) );


	$wp_customize->add_setting( 'display_service', array(
		'type'              => 'theme_mod',
		'default' 			=> true,
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'adney_sanitize_checkbox'
	) );

	$wp_customize->add_control(
		'display_service',
		array(
				'label'    => __( 'Display Service Section', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'display_service',
				'type'     => 'checkbox',
				'priority' => 1
		)
	);

	$wp_customize->add_setting( 'service_title', array(
		'type'      		=> 'theme_mod',
		'default'   		=> '',
		'capability'		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control(
		'service_title',
		array(
				'label'    => __( 'Service Title', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'service_title',
				'type'     => 'text',
				'priority' => 1,
				'active_callback' => 'adney_service_callback',
		)
	);

	$wp_customize->add_setting( 'service_desc', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'wp_filter_post_kses'
	) );

	$wp_customize->add_control(
		'service_desc',
		array(
				'label'    => __( 'Service Description', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'service_desc',
				'type'     => 'textarea',
				'priority' => 1,
				'active_callback' => 'adney_service_callback',
		)
	);

	// Display Portfolio seting and control
	$wp_customize->add_setting( 'display_portfolio', array(
		'default' 			=> true,
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'adney_sanitize_checkbox'
	) );

	$wp_customize->add_control(
		'display_portfolio',
		array(
				'label'    => __( 'Display Portfolio Section', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'display_portfolio',
				'type'     => 'checkbox',
				'priority' => 2
		)
	);

	$wp_customize->add_setting( 'portfolio_title', array(
		'type'      		=> 'theme_mod',
		'default'   		=> '',
		'capability'		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control(
		'portfolio_title',
		array(
				'label'    => __( 'Portfolio Title', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'portfolio_title',
				'type'     => 'text',
				'priority' => 3,
				'active_callback' => 'adney_portfolio_callback',
		)
	);

	$wp_customize->add_setting( 'portfolio_desc', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability'		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'wp_filter_post_kses'
	) );

	$wp_customize->add_control(
		'portfolio_desc',
		array(
				'label'    => __( 'Portfolio Description', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'portfolio_desc',
				'type'     => 'textarea',
				'priority' => 4,
				'active_callback' => 'adney_portfolio_callback',
		)
	);

	// Display Team seting and control
	$wp_customize->add_setting( 'display_team', array(
		'default' 			=> true,
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'adney_sanitize_checkbox'
	) );

	$wp_customize->add_control(
		'display_team',
		array(
				'label'    => __( 'Display Team Section', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'display_team',
				'type'     => 'checkbox',
				'priority' => 5
		)
	);

	$wp_customize->add_setting( 'team_title', array(
		'type'      		=> 'theme_mod',
		'default'   		=> '',
		'capability'		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control(
		'team_title',
		array(
				'label'    => __( 'Team Title', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'team_title',
				'type'     => 'text',
				'priority' => 6,
				'active_callback' => 'adney_team_callback',
		)
	);

	$wp_customize->add_setting( 'team_desc', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'wp_filter_post_kses'
	) );

	$wp_customize->add_control(
		'team_desc',
		array(
				'label'    => __( 'Team Description', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'team_desc',
				'type'     => 'textarea',
				'priority' => 7,
				'active_callback' => 'adney_team_callback',
		)
	);

	// Display Testimonial Section
	$wp_customize->add_setting( 'display_testimonial', array(
		'default' 			=> true,
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'adney_sanitize_checkbox'
	) );

	$wp_customize->add_control(
		'display_testimonial',
		array(
				'label'    => __( 'Display Testimonial Section', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'display_testimonial',
				'type'     => 'checkbox',
				'priority' => 8
		)
	);

	// Display Clients Section
	$wp_customize->add_setting( 'display_clients', array(
		'default' 			=> true,
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'adney_sanitize_checkbox'
	) );

	$wp_customize->add_control(
		'display_clients',
		array(
				'label'    => __( 'Display Clients Section', 'adney' ),
				'section'  => 'homepage_section',
				'settings' => 'display_clients',
				'type'     => 'checkbox',
				'priority' => 9
		)
	);


	/*
	 * Footer Settings Section
	 * */
	$wp_customize->add_section( 'footer_section', array(
		'title'       => __( 'Footer Settings', 'adney' ),
		'capability'  => 'edit_theme_options',
		'priority' 	  => 1,
		'description' => __('Allows you to customize Footer settings for Adney.', 'adney')
	) );

	// Copy Right section
	$wp_customize->add_setting( 'footer_copyright', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'wp_filter_post_kses'
	) );

	$wp_customize->add_control(
		'footer_copyright',
		array(
				'label'    => __( 'Footer Copyright', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'footer_copyright',
				'type'     => 'textarea',
				'priority' => 1,
		)
	);

	// Display Call to action seting and control
	$wp_customize->add_setting( 'display_cta', array(
		'default' 			=> false,
		'capability'		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'adney_sanitize_checkbox'
	) );

	$wp_customize->add_control(
		'display_cta',
		array(
			'label'    => __( 'Display Footer Call to action section', 'adney' ),
			'section'  => 'footer_section',
			'settings' => 'display_cta',
			'type'     => 'checkbox',
			'priority' => 1
		)
	);

	$wp_customize->add_setting( 'cta_title', array(
		'type'      		=> 'theme_mod',
		'default'   		=> '',
		'capability'		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control(
		'cta_title',
		array(
				'label'    => __( 'Call to action Title', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'cta_title',
				'type'     => 'text',
				'priority' => 2,
				'active_callback' => 'adney_cta_callback',
		)
	);

	$wp_customize->add_setting( 'cta_button_text', array(
		'type' 				=> 'theme_mod',
		'default'			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control(
		'cta_button_text',
		array(
				'label'    => __( 'Call to action Button Text', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'cta_button_text',
				'type'     => 'text',
				'priority' => 3,
				'active_callback' => 'adney_cta_callback',
		)
	);

	$wp_customize->add_setting( 'cta_button_link', array(
		'type' 				=> 'theme_mod',
		'transport' 		=> 'refresh',
		'default' 			=> '',
		'sanitize_callback' => 'absint',
		'capability' 		=> 'edit_theme_options',
	) );

	$wp_customize->add_control(
		'cta_button_link',
		array(
				'label'    => __( 'Call to action Button Page link', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'cta_button_link',
				'type'     => 'dropdown-pages',
				'priority' => 4,
				'active_callback' => 'adney_cta_callback',
		)
	);

	$wp_customize->add_setting( 'display_social', array(
		'default' 			=> true,
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'adney_sanitize_checkbox'
	) );

	// Display Social Section
	$wp_customize->add_control(
		'display_social',
		array(
				'label'    => __( 'Display Footer Social Profile section', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'display_social',
				'type'     => 'checkbox',
				'priority' => 5
		)
	);

	// Facebook Setting and Control
	$wp_customize->add_setting( 'facebook_url', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control(
		'facebook_url',
		array(
				'label'    => __( 'Facebook', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'facebook_url',
				'type'     => 'url',
				'priority' => 6,
				'active_callback' => 'adney_social_callback',
		)
	);

	// Twitter Setting and Control
	$wp_customize->add_setting( 'twitter_url', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control(
		'twitter_url',
		array(
				'label'    => __( 'Twitter', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'twitter_url',
				'type'     => 'url',
				'priority' => 7,
				'active_callback' => 'adney_social_callback',
		)
	);

	// Linked In Setting and Control
	$wp_customize->add_setting( 'linkedin_url', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control(
		'linkedin_url',
		array(
				'label'    => __( 'Linked In', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'linkedin_url',
				'type'     => 'url',
				'priority' => 8,
				'active_callback' => 'adney_social_callback',
		)
	);

	// Google Setting and Control
	$wp_customize->add_setting( 'googleplus_url', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control(
		'googleplus_url',
		array(
				'label'    => __( 'Google +', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'googleplus_url',
				'type'     => 'url',
				'priority' => 9,
				'active_callback' => 'adney_social_callback',
		)
	);

	// Instagram Setting and Control
	$wp_customize->add_setting( 'instagram_url', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control(
		'instagram_url',
		array(
				'label'    => __( 'Instagram', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'instagram_url',
				'type'     => 'url',
				'priority' => 10,
				'active_callback' => 'adney_social_callback',
		)
	);

	// Instagram Setting and Control
	$wp_customize->add_setting( 'youtube_url', array(
		'type' 				=> 'theme_mod',
		'default' 			=> '',
		'capability' 		=> 'edit_theme_options',
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control(
		'youtube_url',
		array(
				'label'    => __( 'You Tube', 'adney' ),
				'section'  => 'footer_section',
				'settings' => 'youtube_url',
				'type'     => 'url',
				'priority' => 10,
				'active_callback' => 'adney_social_callback',
		)
	);

}
add_action( 'customize_register', 'adney_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function adney_customize_preview_js() {
	wp_enqueue_script( 'adney_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '', true );
}
add_action( 'customize_preview_init', 'adney_customize_preview_js' );

function adney_is_xylus_toolkit_active(){
	if( class_exists( 'Xylus_Toolkit' ) ){
		return true;
	}
	return false;
}

function adney_cta_callback( $control ) {
	if ( $control->manager->get_setting('display_cta')->value() == true ) {
		return true;
	} else {
		return false;
	}
}

function adney_social_callback( $control ) {
	if ( $control->manager->get_setting('display_social')->value() == true ) {
		return true;
	} else {
		return false;
	}
}

function adney_portfolio_callback( $control ) {
	if ( $control->manager->get_setting('display_portfolio')->value() == true ) {
		return true;
	} else {
		return false;
	}
}

function adney_team_callback( $control ){
	if ( $control->manager->get_setting('display_team')->value() == true ) {
		return true;
	} else {
		return false;
	}
}

function adney_service_callback( $control ) {
	if ( $control->manager->get_setting('display_service')->value() == true ) {
		return true;
	} else {
		return false;
	}
}

function adney_sanitize_layout( $value ) {
	if ( ! in_array( $value, array( 'full', 'left_sidebar','right_sidebar' ) ) )
		$value = 'full';

	return $value;
}

function adney_sanitize_checkbox( $input ) {
	// Boolean check
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function adney_theme_scheme_color_css() {
	$default_color   = '#46B289';
	$theme_scheme_color = get_theme_mod( 'theme_scheme_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $theme_scheme_color === $default_color ) {
		return;
	}

	$css = '
		blockquote.bq{
			border-left: solid 10px %1$s !important;
		}

		ul.list_2 li a:hover{border-bottom: solid 1px %1$s !important;}

		.pricing_plan{
			border-top: solid 5px %1$s !important;
		}
		.pricing_plan:after{
			border-top: 10px solid %1$s !important;
		}

		.pricing_plan .plan_price, .team_member .team_member_hover .team_member_info .team_member_job, .testimonials_single .author_name, .post_info .post_date, .post_title span.post_date, .portfolio_item .portfolio_item_hover .item_info em, .pages_pagination > a:hover, .benefits_1_single > i:after, .benefits_2_single > i, .tab nav .bottom-line, .site-hero .small-title, .portfolio .categories-grid .categories ul li a.active, .btn.green, .green-section, a.link:after, .section-title span:after{
			background-color: %1$s !important;
		}

		.blog_pagination .page:hover i.prev, .blog_pagination .page:hover i.next, .widget ul li:before, ul.list li:before, .btn.white, .input_1 > span.active,.textarea_1 > span.active, ul.social-icons li a:hover, .green-text, #commentform code{
			color:%1$s !important;
		}

		.form-control:focus{
			border:2px solid %1$s !important !important;
		}

		a.page-numbers:hover, span.page-numbers.current{
			border: 2px solid %1$s !important;
			background-color: %1$s !important;
			color: #fff;
		}
	';

	wp_add_inline_style( 'adney-style', sprintf( $css, $theme_scheme_color ) );
}
add_action( 'wp_enqueue_scripts', 'adney_theme_scheme_color_css', 11 );
