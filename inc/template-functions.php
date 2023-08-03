<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Emma_Browne_Therapy
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function emmabrownetherapy_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'emmabrownetherapy_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function emmabrownetherapy_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'emmabrownetherapy_pingback_header' );

/**
 * Returns html for page hero.
 * 
 * @return bool.
 */
function emmabrownetherapy_hero() {
	$image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' );
	
	if ( ! $image_url ) {
		$image_url = get_template_directory_uri() . '/assets/images/hero-default.jpg';
	} 
	?>

	<div class="hero" style="background-image: url( '<?php echo esc_url( $image_url ); ?>' );">

		<div class="hero__content">

			<?php 
			if ( is_front_page() ) : 
				?>
				<h1 class="hero__sub-heading small">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</h1>
				<p class="hero__heading h1">
					<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
				</p><!-- .hero__heading -->
				<?php
			else :
				?>
				<small class="hero__sub-heading">
					<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
				</small>
				<h1 class="hero__heading">
					<?php echo wp_kses_post( get_the_title() ); ?>
				</h1>
				<?php
			endif;
			?>

		</div><!-- .hero__content -->

	</div><!-- .hero -->
	<?php
}
