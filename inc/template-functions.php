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
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</small>
				<h1 class="hero__heading">
					<?php echo wp_kses_post( get_the_title() ); ?>
				</h1>
				<?php
				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
						<?php emmabrownetherapy_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php
				endif;
			endif;
			?>

		</div><!-- .hero__content -->

	</div><!-- .hero -->
	<?php
}

/**
 * Returns html for image cta component.
 */
function emmabrownetherapy_image_cta( $section )
{
	$image_url = get_theme_mod( $section . '_image' );
	$image_id  = attachment_url_to_postid( $image_url );
	$image = array(
		'about_me' => array(
			'alt_text' => 'Portrait of Emma with a warm smile',
			'reverse'  => false
		),
		'location' => array(
			'alt_text' => 'Cozy therapy practice room with comfortable seating',
			'reverse'  => true
		),
	)
	?>
	<div class="image-cta <?php echo $image[$section]['reverse'] ? 'image-cta--reverse' : ''; ?>">
		<div class="image-cta__content">
			<h2 class="image-cta__heading">
				<?php echo esc_html_e( get_theme_mod( $section . '_heading', emmabrownetherapy_theme_defaults( $section . '_heading' ) ), 'emmabrownetherapy' ); ?>
			</h2>
			<p class="image-cta__text">
				<?php echo esc_html_e( get_theme_mod( $section . '_text', emmabrownetherapy_theme_defaults( $section . '_text' ) ), 'emmabrownetherapy' ); ?>
			</p>
			<a href="<?php echo esc_url( get_the_permalink( get_theme_mod( $section . '_button_link', get_page_by_title( ucwords( str_replace( '_', ' ', $section ) ) )->ID ) ) ); ?>" class="site-button">
				<?php echo esc_html_e( get_theme_mod( $section . '_button_text', emmabrownetherapy_theme_defaults( $section . '_button_text' ) ), 'emmabrownetherapy' ); ?>
			</a>
		</div>
		<?php if ( $image_url ) : ?>
			<img class="image-cta__image" src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'medium_large' ) ); ?>" alt="<?php echo get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>">
		<?php else : ?>
			<img class="image-cta__image" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . str_replace( '_', '-', $section ) . '-default.jpg' ); ?>" alt="<?php echo $image[$section]['alt_text']; ?>">
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Returns html for banner component.
 */
function emmabrownetherapy_banner( $section )
{
	?>
	<div class="banner">
		<div class="container">
			<h2 class="banner__heading">
				<?php echo esc_html_e( get_theme_mod( $section . '_heading', emmabrownetherapy_theme_defaults( $section . '_heading' ) ), 'emmabrownetherapy' ); ?>
			</h2>
			<p class="banner__text">
				<?php echo esc_html_e( get_theme_mod( $section . '_text', emmabrownetherapy_theme_defaults( $section . '_text' ) ), 'emmabrownetherapy' ); ?>
			</p>
			<a href="<?php echo esc_url( get_the_permalink( get_theme_mod( $section . '_button_link', get_page_by_title( ucwords( str_replace( '_', ' ', $section ) ) )->ID ) ) ); ?>" class="site-button site-button--alt">
				<?php echo esc_html_e( get_theme_mod( $section . '_button_text', emmabrownetherapy_theme_defaults( $section . '_button_text' ) ), 'emmabrownetherapy' ); ?>
			</a>
		</div>
		<span class="banner__image" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/banner-background.png' ); ?>');"></span>
	</div>
	<?php
}
