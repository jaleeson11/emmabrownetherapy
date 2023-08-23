<?php
/**
 * Emma Browne Therapy Theme Customizer
 *
 * @package Emma_Browne_Therapy
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function emmabrownetherapy_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'emmabrownetherapy_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'emmabrownetherapy_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'emmabrownetherapy_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function emmabrownetherapy_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function emmabrownetherapy_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function emmabrownetherapy_customize_preview_js() {
	wp_enqueue_script( 'emmabrownetherapy-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), EMMABROWNETHERAPY_VERSION, true );
}
add_action( 'customize_preview_init', 'emmabrownetherapy_customize_preview_js' );

/**
 * Add custom customizer sections.
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object. 
 */
function emmabrownetherapy_custom_sections( $wp_customize ) {
	$wp_customize->add_panel(
		'theme_options',
		array(
			'title'       => 'Theme Options',
			'description' => 'Theme modifications for custom content can be done here',
		)
	);

	$wp_customize->add_section(
		'about_me',
		array(
			'title' => 'About Me',
			'panel' => 'theme_options',
		)
	);

	$wp_customize->add_setting(
		'about_me_heading',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'about_me_heading' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'about_me_heading',
			array(
				'type'     => 'text',
				'section'  => 'about_me',
				'label'    => 'Heading',
			)
		)
	);

	$wp_customize->add_setting(
		'about_me_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'about_me_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'about_me_text',
			array(
				'type'     => 'textarea',
				'section'  => 'about_me',
				'label'    => 'Text',
			)
		)
	);

	$wp_customize->add_setting(
		'about_me_button_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'about_me_button_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'about_me_button_text',
			array(
				'type'     => 'text',
				'section'  => 'about_me',
				'label'    => 'Button Text',
			)
		)
	);

	$wp_customize->add_setting( 'about_me_button_link' );
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'about_me_button_link',
			array(
				'type'        => 'dropdown-pages',
				'section'     => 'about_me',
				'label'       => 'Button Link',
				'description' => 'The page that the button links to',
			)
		)
	);

	$wp_customize->add_setting( 'about_me_image' );
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'about_me_image',
			array(
				'section'  => 'about_me',
				'label'    => 'Image',
			)
		)
	);

	$wp_customize->add_section(
		'my_approach',
		array(
			'title' => 'My Approach',
			'panel' => 'theme_options',
		)
	);

	$wp_customize->add_setting(
		'my_approach_heading',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'my_approach_heading' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'my_approach_heading',
			array(
				'type'     => 'text',
				'section'  => 'my_approach',
				'label'    => 'Heading',
			)
		)
	);

	$wp_customize->add_setting(
		'my_approach_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'my_approach_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'my_approach_text',
			array(
				'type'     => 'textarea',
				'section'  => 'my_approach',
				'label'    => 'Text',
			)
		)
	);

	$wp_customize->add_setting(
		'my_approach_button_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'my_approach_button_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'my_approach_button_text',
			array(
				'type'     => 'text',
				'section'  => 'my_approach',
				'label'    => 'Button Text',
			)
		)
	);

	$wp_customize->add_setting( 'my_approach_button_link' );
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'my_approach_button_link',
			array(
				'type'        => 'dropdown-pages',
				'section'     => 'my_approach',
				'label'       => 'Button Link',
				'description' => 'The page that the button links to',
			)
		)
	);

	$wp_customize->add_section(
		'location',
		array(
			'title' => 'Location',
			'panel' => 'theme_options',
		)
	);

	$wp_customize->add_setting(
		'location_heading',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'location_heading' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'location_heading',
			array(
				'type'     => 'text',
				'section'  => 'location',
				'label'    => 'Heading',
			)
		)
	);

	$wp_customize->add_setting(
		'location_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'location_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'location_text',
			array(
				'type'     => 'textarea',
				'section'  => 'location',
				'label'    => 'Text',
			)
		)
	);

	$wp_customize->add_setting(
		'location_button_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'location_button_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'location_button_text',
			array(
				'type'     => 'text',
				'section'  => 'location',
				'label'    => 'Button Text',
			)
		)
	);

	$wp_customize->add_setting( 'location_image' );
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'location_image',
			array(
				'section'  => 'location',
				'label'    => 'Image',
			)
		)
	);

	$wp_customize->add_section(
		'sessions_fees',
		array(
			'title' => 'Sessions & Fees',
			'panel' => 'theme_options',
		)
	);

	$wp_customize->add_setting(
		'sessions_fees_heading',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'sessions_fees_heading' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sessions_fees_heading',
			array(
				'type'     => 'text',
				'section'  => 'sessions_fees',
				'label'    => 'Heading',
			)
		)
	);

	$wp_customize->add_setting(
		'sessions_fees_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'sessions_fees_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sessions_fees_text',
			array(
				'type'     => 'textarea',
				'section'  => 'sessions_fees',
				'label'    => 'Text',
			)
		)
	);

	$wp_customize->add_setting(
		'sessions_fees_button_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'sessions_fees_button_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sessions_fees_button_text',
			array(
				'type'     => 'text',
				'section'  => 'sessions_fees',
				'label'    => 'Button Text',
			)
		)
	);

	$wp_customize->add_setting( 'sessions_fees_button_link' );
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sessions_fees_button_link',
			array(
				'type'        => 'dropdown-pages',
				'section'     => 'sessions_fees',
				'label'       => 'Button Link',
				'description' => 'The page that the button links to',
			)
		)
	);

	$wp_customize->add_section(
		'contact',
		array(
			'title' => 'Contact',
			'panel' => 'theme_options',
		)
	);

	$wp_customize->add_setting(
		'contact_heading',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'contact_heading' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'contact_heading',
			array(
				'type'     => 'text',
				'section'  => 'contact',
				'label'    => 'Heading',
			)
		)
	);

	$wp_customize->add_setting(
		'contact_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'contact_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'contact_text',
			array(
				'type'     => 'textarea',
				'section'  => 'contact',
				'label'    => 'Text',
			)
		)
	);

	$wp_customize->add_setting(
		'contact_button_text',
		array(
			'default'           => emmabrownetherapy_theme_defaults( 'contact_button_text' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'contact_button_text',
			array(
				'type'     => 'text',
				'section'  => 'contact',
				'label'    => 'Button Text',
			)
		)
	);

	$wp_customize->add_setting( 'contact_image' );
	
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'contact_image',
			array(
				'section'     => 'contact',
				'label'       => 'Image',
				'height'      => 500,
				'width'       => 500,
				'flex_width'  => true,
				'flex_height' => true,
			)
		)
	);
}
add_action( 'customize_register', 'emmabrownetherapy_custom_sections' );
