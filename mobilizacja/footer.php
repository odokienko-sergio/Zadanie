<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mobilizacja
 */
$footer_text    = get_field( 'footer_text', 'options' );
$copyright_box  = get_field( 'copyright_box', 'options' );
$copyright_info_box_1  = get_field( 'copyright_info_box_1', 'options' );
$copyright_info_box_2  = get_field( 'copyright_info_box_2', 'options' );
?>

<footer class="footer">
	<div class="container footer-wrapper">
		<div class="footer-block">
			<div class="logo">
				<?php the_custom_logo(); ?>
			</div>

			<?php if ( ! empty( $footer_text ) ): ?>
				<div class="footer-text">
					<?php echo wp_kses_post( $footer_text ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="footer-menu">
			<?php
			wp_nav_menu( [
				'menu'           => 'Footer',
				'theme_location' => 'menu-2',
				'container'      => false,
				'menu_class'     => 'footer__menu__box',
				'echo'           => true,
				'fallback_cb'    => 'wp_page_menu',
				'items_wrap'     => '<ul class="footer__menu__box">%3$s</ul>',
				'depth'          => 1,
			] );
			?>
		</div>
	</div>

	<?php if ( $copyright_info_box_1 || $copyright_info_box_2 || $copyright_box ): ?>
	<div class="copyright-section">
		<div class="copyright-info">
			<div class="copyright-info__box-1">
				<?php echo wp_kses_post( $copyright_info_box_1 ); ?>
			</div>
			<div class="copyright-info__box-2">
				<?php echo wp_kses_post( $copyright_info_box_2 ); ?>
			</div>
		</div>
		<div class="copyright-box"><?php echo wp_kses_post( $copyright_box ); ?></div>
	</div>
	<?php endif; ?>
</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
