<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
	get_header();
?>
	<section class="main-content vertical-margin">

		<div class="container">
			<div class="row">
				<?php

					$layout = industrix_option( 'blog-layout', FALSE, 'right-sidebar' );

					$grid_class = 'col-md-12';

					if ( $layout == 'right-sidebar' ) {

						$grid_class = ( is_active_sidebar( 'hippo-blog-sidebar' ) )
							? 'col-md-9 col-sm-8 col-xs-12'
							: $grid_class;

					} elseif ( $layout == 'left-sidebar' ) {
						$grid_class = ( is_active_sidebar( 'hippo-blog-sidebar' ) )
							? 'ls-content col-md-9 col-md-push-3 col-sm-8 col-sm-push-4'
							: $grid_class;
					} ?>
				<div class="<?php echo $grid_class ?>">
					<main class="post-content box-wrapper clearfix" role="main">


						<?php while ( have_posts() ) {

							the_post();
							if ( function_exists( 'hippo_set_post_views' ) ) {
								hippo_set_post_views();
							}

							get_template_part( 'post-contents/content', 'single' );

						} ?>

					</main>
				</div>

				<?php get_sidebar(); ?>
			</div>
		</div>

	</section> <!-- #main-content -->
<?php get_footer();