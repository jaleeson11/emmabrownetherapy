<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emma_Browne_Therapy
 */

?>

	<footer class="site-footer">
		<small class="site-footer__copyright">
			<?php
			echo esc_html( '&copy; Copyright ' );
			echo esc_html( date( 'Y ' ) );
			echo esc_html( get_option( 'blogname' ) );
			echo esc_html( '. All Rights Reserved' );
			?>
		</small><!-- .site-copyright -->
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
