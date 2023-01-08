<?php
$possibilities_title = get_field( 'possibilities_title' );
$possibilities_img   = get_field( 'possibilities_img' );
$possibilities_list  = get_field( 'possibilities_list' ) ?: [];
?>
<?php if ( $possibilities_img || $possibilities_title || $possibilities_list ): ?>
	<div class="possibilities-section">
		<div class="container possibilities-section__wrapper">
			<?php if ( $possibilities_img ): ?>
				<div class="possibilities-section__img">
					<?php
					echo wp_get_attachment_image(
						$possibilities_img['ID'] ?: 0,
						'full',
						false,
						array(
							'class' => 'possibilities_img',
						)
					);
					?>
				</div>
			<?php endif; ?>

			<div class="possibilities-section__text">
				<?php if ( $possibilities_title ): ?>
					<h2 class="title-section possibilities-title"><?php echo wp_kses_post( $possibilities_title ); ?></h2>
				<?php endif; ?>

				<?php
				if ( ! empty( $possibilities_list ) ): ?>
					<div class="possibilities-list">
						<?php
						// Check rows exists.
						if ( have_rows( 'possibilities_list' ) ):

							// Loop through rows.
							while ( have_rows( 'possibilities_list' ) ) : the_row();

								// Load sub field value.
								$list_item = get_sub_field( 'list_item' );
								// Do something...
								?>

								<?php if ( $list_item ): ?>
									<div class="list-item"><i
											class="fa-solid fa-check"></i><?php echo wp_kses_post( $list_item ); ?>
									</div>
								<?php endif; ?>

							<?php
							endwhile;
						endif;
						?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
<?php endif; ?>

