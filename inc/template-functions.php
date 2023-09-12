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
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</a>
				</h1>
				<p class="hero__heading h1">
					<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
				</p><!-- .hero__heading -->
				<?php
			else :
				?>
				<small class="hero__sub-heading">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</a>
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
	$image_id = get_theme_mod( $section . '_image' );
	$image = array(
		'about_me' => array(
			'alt_text' => __( 'Portrait of Emma with a warm smile', 'emmabrownetherapy' ),
			'reverse'  => false
		),
		'location' => array(
			'alt_text' => __( 'Cozy therapy practice room with comfortable seating', 'emmabrownetherapy' ),
			'reverse'  => true
		),
		'contact' => array(
			'alt_text' => __( 'A vibrant assortment of crayons, pencils, and pens.', 'emmabrownetherapy' ),
			'reverse'  => false
		),
	)
	?>
	<div class="image-cta <?php echo $image[$section]['reverse'] ? 'image-cta--reverse' : ''; ?>">
		<div class="image-cta__content">
			<h2 class="image-cta__heading">
				<?php echo esc_html( get_theme_mod( $section . '_heading', emmabrownetherapy_theme_defaults( $section . '_heading' ) ), 'emmabrownetherapy' ); ?>
			</h2>
			<p class="image-cta__text">
				<?php echo esc_html( get_theme_mod( $section . '_text', emmabrownetherapy_theme_defaults( $section . '_text' ) ), 'emmabrownetherapy' ); ?>
			</p>
			<?php
			if ( $section === 'contact' ) :
				?>
				<ul class="image-cta__contact">
					<li class="image-cta__contact__item">
						<?php $admin_email = esc_html( get_option( 'admin_email' ) ); ?>
						<a href="mailto: <?php echo $admin_email; ?>" class="image-cta__contact__link">
							<span class="dashicons dashicons-email"></span>
							<?php echo $admin_email; ?>
						</a>
					</li>
					<?php
					$phone = get_the_author_meta( 'phone', 1 );
					if ( !is_null( $phone ) ) :
						?>
						<li class="image-cta__contact__item">
							<a href="tel: <?php echo esc_html( $phone ); ?>" class="image-cta__contact__link">
								<span class="dashicons dashicons-phone"></span>
								<?php echo esc_html( $phone ); ?>
							</a>
						</li>
						<?php
					endif;
					?>
				</ul>
				<?php
			else :
				?>
				<a href="<?php echo esc_url( get_the_permalink( get_theme_mod( $section . '_button_link', get_page_by_title( ucwords( str_replace( '_', ' ', $section ) ) )->ID ) ) ); ?>" class="site-button">
					<?php echo esc_html( get_theme_mod( $section . '_button_text', emmabrownetherapy_theme_defaults( $section . '_button_text' ) ), 'emmabrownetherapy' ); ?>
				</a>
				<?php
			endif;
			?>	
		</div>
		<?php if ( $image_id ) : ?>
			<img class="image-cta__image" src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'medium_large' ) ); ?>" alt="<?php echo get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>">
		<?php else : ?>
			<img class="image-cta__image" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . str_replace( '_', '-', $section ) . '-default.jpg' ); ?>" alt="<?php echo esc_html( $image[$section]['alt_text'] ); ?>">
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Returns html for banner component.
 */
function emmabrownetherapy_banner( $section )
{
	$banner_image_right = array(
		'my_approach' => false,
		'sessions_fees' => true
	);
	?>
	<div class="banner">
		<div class="container">
			<h2 class="banner__heading">
				<?php echo esc_html( get_theme_mod( $section . '_heading', emmabrownetherapy_theme_defaults( $section . '_heading' ) ), 'emmabrownetherapy' ); ?>
			</h2>
			<p class="banner__text">
				<?php echo esc_html( get_theme_mod( $section . '_text', emmabrownetherapy_theme_defaults( $section . '_text' ) ), 'emmabrownetherapy' ); ?>
			</p>
			<a href="<?php echo esc_url( get_the_permalink( get_theme_mod( $section . '_button_link', get_page_by_path( str_replace( '_', '-', $section ) )->ID ) ) ); ?>" class="site-button site-button--alt">
				<?php echo esc_html( get_theme_mod( $section . '_button_text', emmabrownetherapy_theme_defaults( $section . '_button_text' ) ), 'emmabrownetherapy' ); ?>
			</a>
		</div>
		<span class="banner__image <?php echo $banner_image_right[$section] ? 'banner__image--right' : ''; ?>" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/banner-background.png' ); ?>');"></span>
	</div>
	<?php
}
