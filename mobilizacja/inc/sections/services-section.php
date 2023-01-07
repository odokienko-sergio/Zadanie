<?php
$services_title = get_field( 'services_title' );
$my_posts = get_posts( array(
	'numberposts'      => - 1,
	'category'         => 0,
	'orderby'          => 'date',
	'order'            => 'ASC',
	'post_type'        => 'services',
	'suppress_filters' => true,
) );
?>
<?php if ( $services_title || $my_posts): ?>
<div class="services-section">
	<?php if ( $services_title ): ?>
	<div class="services-wrapper">
		<h3 class="title-section services-main-title">
			<?php echo wp_kses_post( $services_title ); ?>
		</h3>
	</div>
	<?php endif; ?>

	<div class="container">
			<?php

			global $post;
			foreach ( $my_posts as $post ) {
				setup_postdata( $post );
				$the_title  = get_the_title();
				?>
				<div class="services-box">
					<?php the_post_thumbnail(); ?>
					<?php if ( $the_title ): ?>
						<h5 class="services-box-title"><?php the_title(); ?></h5>
					<?php endif; ?>

					<?php the_content(); ?>
				</div>
				<?php
			}
			wp_reset_postdata();
			?>
	</div>
</div>
<?php endif; ?>