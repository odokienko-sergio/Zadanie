<?php
$main_title = get_field( 'main_title' ) ?: '';
$main_txt   = get_field( 'main_txt' ) ?: '';

$placeholder_btn        = get_field( 'placeholder_btn' ) ?: [];
$placeholder_btn_url    = $placeholder_btn['url'] ?: '';
$placeholder_btn_title  = $placeholder_btn['title'] ?: '';
$placeholder_btn_target = $placeholder_btn['target'] ?: '';

$number_btn        = get_field( 'number_btn' ) ?: [];
$number_btn_url    = $number_btn['url'] ?: '';
$number_btn_title  = $number_btn['title'] ?: '';
$number_btn_target = $number_btn['target'] ?: '';


$main_section_img = get_field( 'main_section_img' );
?>
<?php if ( $main_title || $main_txt || $main_section_img || $placeholder_btn_url || $number_btn_url): ?>
<div class="header__main-section">
	<div class="container main-section__wrapper">
		<div class="header__main-section__text">
			<?php if ( $main_title ): ?>
			<h1 class="title"><?php echo wp_kses_post( $main_title ); ?></h1>
			<?php endif; ?>

			<?php if ( $main_txt ): ?>
			<div class="description">
				<?php echo wp_kses_post( $main_txt ); ?>
			</div>
			<?php endif; ?>

			<?php if ( $placeholder_btn_url || $number_btn_url): ?>
			<div class="buttons">
				<?php if ( $placeholder_btn_url ): ?>
				<a href="<?php echo esc_url( $placeholder_btn_url ); ?>"
					class="primary-btn"
					<?php echo wp_kses_post( $placeholder_btn_target ? 'target="' . $placeholder_btn_target . '"' : '' ); ?>
				>
					<?php echo esc_html( $placeholder_btn_title ); ?>
				</a>
				<?php endif; ?>

				<?php if ( $number_btn_url ): ?>
				<a href="<?php echo esc_url( $number_btn_url ); ?>"
					class="number"
					<?php echo wp_kses_post( $number_btn_target ? 'target="' . $number_btn_target . '"' : '' ); ?>
				>
					<?php echo esc_html( $number_btn_title ); ?>
				</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>

		</div>
		<?php if ( $main_section_img ): ?>
			<div class="header__main-section__img">
				<?php
				echo wp_get_attachment_image(
					$main_section_img['ID'] ?: 0,
					'full',
					false,
					array(
						'class' => 'main_section_img',
					)
				);
				?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

