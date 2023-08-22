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
	<meta name="description" content="<?php if ( is_single() ) {
		single_post_title( '', true );
	} else {
		bloginfo( 'name' ); echo " - "; bloginfo( 'description' );
	} ?>">
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
								<?php $admin_email = esc_html( get_option( 'admin_email' ) ); ?>
								<a href="mailto: <?php echo $admin_email; ?>" class="main-navigation__top__link">
									<span class="dashicons dashicons-email"></span>
									<?php echo $admin_email; ?>
								</a>
							</li>
							<li class="main-navigation__top__item">
								<a href="tel: 07710496609" class="main-navigation__top__link">
									<span class="dashicons dashicons-phone"></span>
									<?php esc_html( '07710496609' ); ?>
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
			</div><!-- .site-header__inner -->
		</div><!-- .container -->

		<?php emmabrownetherapy_hero(); ?>
	</header><!-- #masthead -->
