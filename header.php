<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emma_Browne_Therapy
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'emmabrownetherapy' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="site-header__inner">
				<div class="site-branding">
					<?php the_custom_logo(); ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<span class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" role="button">
						<span class="menu-burger">
							<span class="menu-bar"></span>
							<span class="menu-bar"></span>
							<span class="menu-bar"></span>
						</span>
						<?php esc_html_e( 'Menu', 'emmabrownetherapy' ); ?>
					</span>
					<div class="main-navigation__inner">
						<ul class="main-navigation__top">
							<li class="main-navigation__top__item">
								<?php $admin_email = get_option( 'admin_email' ); ?>
								<a href="mailto: <?php echo $admin_email; ?>" class="main-navigation__top__link">
									<span class="dashicons dashicons-email"></span>
									<?php echo $admin_email; ?>
								</a>
							</li>
							<li class="main-navigation__top__item">
								<a href="tel: 07710496609" class="main-navigation__top__link">
									<span class="dashicons dashicons-phone"></span>
									<?php esc_html_e( '7710496609', 'emmabrownetherapy' ); ?>
								</a>
							</li>
						</ul>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							)
						);
						?>
					</div>
				</nav><!-- #site-navigation -->
			</div>
		</div><!-- .container -->

		<div class="hero">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$emmabrownetherapy_description = get_bloginfo( 'description', 'display' );
			if ( $emmabrownetherapy_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $emmabrownetherapy_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div>
	</header><!-- #masthead -->
