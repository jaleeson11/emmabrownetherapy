<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emma_Browne_Therapy
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		
		?>

		<div class="container">

			<section>
				<div class="image-cta">
					<?php
					$image_url = get_theme_mod( 'about_me_image' );
					$image_id  = attachment_url_to_postid( $image_url );
					?>

					<div class="image-cta__content">
						<h2 class="image-cta__heading">
							<?php echo esc_html_e( get_theme_mod( 'about_me_heading', emmabrownetherapy_theme_defaults( 'about_me_heading' ) ), 'emmabrownetherapy' ); ?>
						</h2>
						<p class="image-cta__text">
							<?php echo esc_html_e( get_theme_mod( 'about_me_text', emmabrownetherapy_theme_defaults( 'about_me_text' ) ), 'emmabrownetherapy' ); ?>
						</p>
						<a href="<?php echo esc_url( get_the_permalink( get_theme_mod( 'about_me_button_link', get_page_by_title( 'About Me' )->ID ) ) ); ?>" class="site-button">
							<?php echo esc_html_e( get_theme_mod( 'about_me_button_text', emmabrownetherapy_theme_defaults( 'about_me_button_text' ) ), 'emmabrownetherapy' ); ?>
						</a>
					</div>
					<?php if ( $image_url ) : ?>
						<img class="image-cta__image" src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'medium_large' ) ); ?>" alt="<?php echo get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>">
					<?php else : ?>
						<img class="image-cta__image" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-me-default.jpg' ); ?>" alt="Portrait of Emma with a warm smile">
					<?php endif; ?>
				</div>
			</section>
			
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
