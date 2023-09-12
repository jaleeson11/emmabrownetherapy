<?php
/**
 * Emma Browne Therapy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Emma_Browne_Therapy
 */

if ( ! defined( 'EMMABROWNETHERAPY_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'EMMABROWNETHERAPY_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function emmabrownetherapy_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Emma Browne Therapy, use a find and replace
		* to change 'emmabrownetherapy' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'emmabrownetherapy', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'emmabrownetherapy' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'emmabrownetherapy_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'emmabrownetherapy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function emmabrownetherapy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'emmabrownetherapy_content_width', 640 );
}
add_action( 'after_setup_theme', 'emmabrownetherapy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function emmabrownetherapy_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'emmabrownetherapy' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'emmabrownetherapy' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
// add_action( 'widgets_init', 'emmabrownetherapy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function emmabrownetherapy_scripts() {
	wp_enqueue_style( 'emmabrownetherapy-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', array(), EMMABROWNETHERAPY_VERSION );
	wp_enqueue_style( 'emmabrownetherapy-style', get_stylesheet_uri(), array(), EMMABROWNETHERAPY_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'emmabrownetherapy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), EMMABROWNETHERAPY_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'emmabrownetherapy_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }

/**
 * Theme defaults.
 */
function emmabrownetherapy_theme_defaults( $setting ) {
	$defaults = array(
		'about_me_heading'     => __( 'Welcome', 'emmabrownetherapy' ),
		'about_me_text' 	   => __( 'Hi, I\'m Emma. I am a professionally qualified counsellor and psychotherapist. I hold an MA in integrative counselling and psychotherapy for children, adolescents and families from the University of Roehampton (Distinction). I am a registered Member of the British Association of Counselling and Psychotherapy (BACP).', 'emmabrownetherapy' ),
		'about_me_button_text' => __( 'Find Out More About Me', 'emmabrownetherapy' ),
		'my_approach_heading'  => __( 'Counselling and psychotherapy for young people from the age of 10 to 24', 'emmabrownetherapy' ),
		'my_approach_text'     => __( 'My counselling and psychotherapy sessions offer a compassionate space for young people to share and explore their feelings, difficulties and experiences with play and creative media available for all.', 'emmabrownetherapy' ),
		'my_approach_button_text' => __( 'Learn More About My Approach', 'emmabrownetherapy' ),
		'location_heading'     => __( 'Location', 'emmabrownetherapy' ),
		'location_text'        => __( 'I work in-person in a comfortable room at the Greenwood Centre in Hampton Hill (1a School Road, Hampton Hill, TW12 1QL).', 'emmabrownetherapy' ),
		'location_button_text' => __( 'More Info On My Practice Location', 'emmabrownetherapy' ),
		'sessions_fees_heading'  => __( 'Sessions & Fees', 'emmabrownetherapy' ),
		'sessions_fees_text'     => __( 'I offer weekly 45 minute sessions. The counselling and psychotherapy can be short-term or over a longer period for more complex difficulties, meeting the individual needs of each young person.', 'emmabrownetherapy' ),
		'sessions_fees_button_text' => __( 'More About The Therapy Process & Fees', 'emmabrownetherapy' ),
		'contact_heading'     => __( 'Contact', 'emmabrownetherapy' ),
		'contact_text'        => __( 'Please get in touch via telephone or email to arrange a free 30 minute consultation to discuss the young person’s needs and ask any questions they or you may have about the counselling and psychotherapy process.', 'emmabrownetherapy' ),
	);

	return $defaults[$setting];
}

/**
 * Disable search functionality.
 */
function emmabrownetherapy_disable_search( $query, $error = true ) {
	if ( is_search() ) {
		$query->is_search = false;   
		$query->query_vars['s'] = false;
		$query->query['s'] = false;

		if ( $error ) {
			$query->is_404 = true;
		}
	}
}
add_action( 'parse_query', 'emmabrownetherapy_disable_search' );

/**
 * Disable comments.
 */
function emmabrownetherapy_disable_comments() {
	// Redirect any user trying to access comments page
    global $pagenow;
     
    if ( $pagenow === 'edit-comments.php' ) {
        wp_safe_redirect( admin_url() );
        exit;
    }
 
    // Remove comments metabox from dashboard
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
 
    // Disable support for comments and trackbacks in post types
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
}
add_action( 'admin_init', 'emmabrownetherapy_disable_comments' );

/**
 * Remove comments page in menu.
 */
function emmabrownetherapy_remove_comments_from_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'emmabrownetherapy_remove_comments_from_menu' );

/**
 * Remove comments links from admin bar.
 */
function emmabrownetherapy_remove_comments_from_admin_bar() {
	if ( is_admin_bar_showing() ) {
        remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
    }
}
add_action( 'init', 'emmabrownetherapy_remove_comments_from_admin_bar' );

/**
 * Redirect templates.
 */
function emmabrownetherapy_redirect() {
	if ( is_author() || is_archive() ) {
		wp_safe_redirect( home_url(), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'emmabrownetherapy_redirect' );

/**
 * Disable tags.
 */
function emmabrownetherapy_disable_tags() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action('init', 'emmabrownetherapy_disable_tags');

/**
 * Disable categories.
 */
function emmabrownetherapy_disable_categories() {
    unregister_taxonomy_for_object_type( 'category', 'post' );
}
add_action('init', 'emmabrownetherapy_disable_categories');

/**
 * Adds phone number field to user profile.
 */
function emmabrownetherapy_phone_field( $user ) { 
	?>
	<h3>Contact Info</h3>
    <table class="form-table">
		<tr>
            <th>
				<label for="phone">Phone Number</label>
			</th>
            <td>
            	<input type="tel" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
		</tr>
	</table>
	<?php
}
add_action( 'show_user_profile', 'emmabrownetherapy_phone_field' );
add_action( 'edit_user_profile', 'emmabrownetherapy_phone_field' );

/**
 * Saves phone number field to user profile.
 */
function emmabrownetherapy_phone_field_save( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'phone', $_POST['phone'] );
}
add_action( 'personal_options_update', 'emmabrownetherapy_phone_field_save' );
add_action( 'edit_user_profile_update', 'emmabrownetherapy_phone_field_save' );
