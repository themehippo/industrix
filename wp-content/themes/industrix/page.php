<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	get_header();
?>

	<section class="page-wrapper vertical-margin">
		<div class="container">
			<div class="row">
				<?php
					$layout     = industrix_option( 'page-layout', FALSE, 'right-sidebar' );
					$grid_class = 'col-md-12';

					if ( $layout == 'right-sidebar' ) {
						$grid_class = ( is_active_sidebar( 'hippo-page-sidebar' ) )
							? 'col-md-9 col-sm-8'
							: $grid_class;

					} elseif ( $layout == 'left-sidebar' ) {
						$grid_class = ( is_active_sidebar( 'hippo-page-sidebar' ) )
							? 'col-md-9 col-md-push-3 col-sm-8 col-sm-push-4'
							: $grid_class;
					}
				?>
				<div class="<?php echo esc_attr( $grid_class ); ?>">
					<main class="page-content clearfix box-wrapper" role="main">

						<?php while ( have_posts() ) {
							the_post();
							get_template_part( 'post-contents/content', 'page' );

							if ( industrix_option( 'page-comment', FALSE, TRUE ) ) {

								// If comments are open or we have at least one comment, load up the comment template

								if ( comments_open() || get_comments_number() ) { ?>

									<div class="page-comment-wrapper vertical-margin">
										<?php
											comments_template();
										?>
									</div>
									<?php
								}
							}
						} // end of the loop. ?>

					</main>
				</div>
				<?php get_sidebar( 'page' ); ?>
			</div>
		</div>
	</section>

<?php get_footer();