<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
	get_header();
?>

	<main id="main-content" class="main-content blog-wrapper vertical-margin">
		<div class="container">
			<div class="row">
				<?php
					$layout     = industrix_option( 'blog-layout', FALSE, 'right-sidebar' );
					$grid_class = 'col-md-12';

					if ( $layout == 'right-sidebar' ) {

						$grid_class = ( is_active_sidebar( 'hippo-blog-sidebar' ) )
							? 'col-md-9 col-sm-8 col-xs-12'
							: $grid_class;

					} elseif ( $layout == 'left-sidebar' ) {
						$grid_class = ( is_active_sidebar( 'hippo-blog-sidebar' ) )
							? 'col-md-9 col-md-push-3 col-sm-8 col-sm-push-4 no-left-gutter'
							: $grid_class;
					}
				?>
				<div class="<?php echo $grid_class ?>">
					<div class="posts-content box-wrapper clearfix" role="main">

						<?php if ( is_author() ) { ?>

							<header class="archive-header">
								<div class="user-area">
									<?php
										echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'industrix_author_bio_avatar_size', 100 ) );
									?>

									<h2><?php the_author(); ?></h2>

									<?php if ( get_the_author_meta( 'description' ) ) : ?>
										<div class="user-description">
											<p><?php the_author_meta( 'description' ); ?></p>
										</div>
									<?php endif; ?>


									<div class="user-info">
                                        <span class="user-url"><?php esc_html_e( 'Website URL: ', 'industrix' ) ?><a
		                                        href="<?php the_author_meta( 'user_url' ); ?>"><?php the_author_meta( 'user_url' ); ?></a></span>

                                        <span class="user-email"><?php esc_html_e( 'Email: ', 'industrix' ) ?><a
		                                        href="mailto:<?php the_author_meta( 'user_email' ); ?>"><?php the_author_meta( 'user_email' ); ?></a></span>

									</div>
								</div>
							</header>
							<!-- .archive-header -->

						<?php } ?>

						<?php
							if ( have_posts() ) {
								// Start the Loop.
								while ( have_posts() ) {
									the_post();
									get_template_part( 'post-contents/content', get_post_format() );
								}

								// Posts Pagination
								if ( industrix_option( 'blog-page-nav', FALSE, TRUE ) ) {
									industrix_posts_pagination();
								} else {
									industrix_posts_navigation();
								}

							} else {
								// If no content, include the "No posts found" template.
								get_template_part( 'post-contents/content', 'none' );
							}
						?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</main>
<?php get_footer();