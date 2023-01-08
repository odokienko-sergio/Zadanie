<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mobilizacja
 */

$header_button        = get_field( 'header_button', 'options' ) ?: [];
$header_button_url    = $header_button['url'] ?: '';
$header_button_title  = $header_button['title'] ?: '';
$header_button_target = $header_button['target'] ?: '';

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
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'mobilizacja' ); ?></a>

	<header class="header">
		<div class="header__top-section">
			<div class="container">
				<div class="logo">
					<?php the_custom_logo(); ?>
				</div>
				<div class="menu">
					<input id="menu__toggle" type="checkbox"/>
					<label class="menu__btn" for="menu__toggle">
						<span></span>
					</label>
					<?php
					wp_nav_menu( [
						'menu'           => 'Main',
						'theme_location' => 'menu-1',
						'container'      => false,
						'menu_class'     => 'menu__box',
						'echo'           => true,
						'fallback_cb'    => 'wp_page_menu',
						'items_wrap'     => '<ul class="menu__box">%3$s</ul>',
						'depth'          => 2,
					] );
					?>
				</div>

			</div>
		</div>

		<?php
		//$classPage = 'home';
		//if($classPage !== 'home'){
		//	get_template_part( 'inc/sections/main-section' );// display none; або прибрати усі діви коли вони пусті
		//}
		?>
		<?php get_template_part( 'inc/sections/main-section' ); ?>
	</header><!-- #masthead -->
