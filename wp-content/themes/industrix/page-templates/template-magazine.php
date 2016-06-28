<?php
	/*
	Template name: Magazine Layout
	*/

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	get_header();
?>
	<section class="page-wrapper vertical-margin">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-12 col-xs-12 no-gutter-right">
					<main class="page-content box-wrapper clearfix" role="main">
						<?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'post-contents/content', 'page' );

								if ( industrix_option( 'page-comment', FALSE, TRUE ) ) :

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || '0' != get_comments_number() ) :
										?>
										<div class="page-comment-wrapper vertical-margin">
											<?php
												comments_template();
											?>
										</div>
										<?php
									endif;
								endif;
							endwhile; ?>
					</main>
				</div>
				<div class="col-md-3 col-xs-12">
					<div class="page-sidebar box-shadow clearfix magazine-sidebar" role="complementary">
						<?php dynamic_sidebar( 'magazine-right-sidebar' ); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer();