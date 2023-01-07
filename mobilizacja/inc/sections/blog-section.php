<?php
$blog_title  = get_field( 'blog_title' ) ?: '';

$blog_btn        = get_field( 'blog_btn' ) ?: [];
$blog_btn_url    = $blog_btn ['url'] ?: '';
$blog_btn_title  = $blog_btn ['title'] ?: '';
$blog_btn_target = $blog_btn ['target'] ?: '';

$my_posts = get_posts( array(
	'numberposts'      => - 1,
	'category'         => 0,
	'orderby'          => 'date',
	'order'            => 'ASC',
	'post_type'        => 'post',
	'suppress_filters' => true,
) );
?>
<?php if ( $blog_title || $blog_btn_url || $my_posts ): ?>
<div class="blog-section">
	<div class="blog-wrapper">
		<?php if ( $blog_title ): ?>
		<h3 class="title-section blog-title">
			<?php echo wp_kses_post( $blog_title ); ?>
		</h3>
		<?php endif; ?>

		<?php if ( $blog_btn_url ): ?>
			<a href="<?php echo esc_url( $blog_btn_url ); ?>"
				class="primary-btn blog-btn"
				<?php echo wp_kses_post( $blog_btn_target ? 'target="' . $blog_btn_target . '"' : '' ); ?>
			>
				<?php echo esc_html( $blog_btn_title ); ?>
			</a>
		<?php endif; ?>
	</div>

	<div class="container blog-container">
		<?php
		global $post;
		foreach ( $my_posts as $post ) {
			setup_postdata( $post );

			$the_title = get_the_title();
			?>
			<div class="post">
				<?php the_post_thumbnail(); ?>

				<div class="post-block">
					<?php if ( $the_title ): ?>
						<h4 class="post-title"><?php echo wp_kses_post( $the_title ); ?></h4>
					<?php endif; ?>

					<div class="post-info">
						<span class="post-date"><?php the_date(); ?></span>
						<a href="<?php the_permalink( $post ); ?>" class="read-more-btn">Czytaj <i class="fa-solid fa-arrow-right"></i></a>
					</div>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
		?>
	</div>
</div>
<?php endif; ?>