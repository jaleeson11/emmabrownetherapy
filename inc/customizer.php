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
}
add_action( 'customize_register', 'emmabrownetherapy_custom_sections' );
