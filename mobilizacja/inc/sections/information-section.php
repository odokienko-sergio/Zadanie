<?php
$info_btn             = get_field( 'info_btn' ) ?: [];
$info_btn_url         = $info_btn ['url'] ?: '';
$info_btn_title       = $info_btn ['title'] ?: '';
$info_btn_target      = $info_btn ['target'] ?: '';
$information_list_box = get_field( 'information_list_box' ) ?: [];
?>
<?php if ( $information_list_box ): ?>
<div class="information-section">
	<div class="container information-wrapper">
		<?php
		if ( ! empty( $information_list_box ) ): ?>

			<?php
			// Check rows exists.
			if ( have_rows( 'information_list_box' ) ):

				// Loop through rows.
				while ( have_rows( 'information_list_box' ) ) : the_row();

					// Load sub field value.
					$info_box_title = get_sub_field( 'info_box_title' );
					$info_box_text  = get_sub_field( 'info_box_text' );
					// Do something...
					?>

					<div class="information-box">
						<?php if ( $info_box_title ): ?>
							<div class="info-box-title">
								<i class="fa-solid fa-circle"></i>
								<?php echo wp_kses_post( $info_box_title ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $info_box_text ): ?>
							<div class="info-box-text"><?php echo wp_kses_post( $info_box_text ); ?></div>
						<?php endif; ?>
					</div>

				<?php
				endwhile;
			endif;
			?>
		<?php endif; ?>
	</div>
	<!--<div class="information-hr"></div>-->
	<div class="information-bottom-section">
		<?php if ( ! empty( $info_btn ) ): ?>
			<a href="<?php echo esc_url( $info_btn_url ); ?>"
				class="primary-btn info-btn"
				<?php echo wp_kses_post( $info_btn_target ? 'target="' . $info_btn_target . '"' : '' ); ?>
			>
				<?php echo esc_html( $info_btn_title ); ?>
			</a>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>