<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emma_Browne_Therapy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( ! empty( get_the_content() ) ) :
		?>
		<div class="container">
			<div class="entry-content">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'emmabrownetherapy' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'emmabrownetherapy' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php emmabrownetherapy_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .container -->
		<?php
	endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->
