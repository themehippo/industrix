<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$current_page_template = basename( get_page_template_slug() );

	if ( is_page() and ! in_array( $current_page_template, industrix_home_page_templates() ) ) {
		?>
		<div class="page-header-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="custom-page-header box-wrapper" role="banner">
							<?php if ( $current_page_template == 'template-magazine.php' ) {
								dynamic_sidebar( 'magazine-top-sidebar' );
							} else {
								?>
								<div class="custom"
								     style="background-image: url('<?php echo industrix_title_image( 'http://placehold.it/1100x200' ) ?>'); background-size: cover;">
									<h1><?php echo industrix_title_text() ?></h1>
								</div>
								<?php
							}
							?>


							<?php if ( industrix_option( 'breadcrumb', FALSE, TRUE ) ) { ?>
								<div class="breadcrumb-box">
									<?php industrix_breadcrumbs() ?>
								</div> <!-- .breadcrumb-box -->
							<?php } ?>


							<?php if ( $current_page_template == 'template-magazine.php' ) {
								?>
								<?php if ( industrix_option( 'news-ticker-show', FALSE, TRUE ) ) { ?>
									<div class="newsticker-wrapper">
										<ul id="news-ticker" class="js-hidden">
											<?php
												// WP_Query arguments
												$args = array(
													'posts_per_page' => industrix_option( 'news-ticker', FALSE, 5 ),
													'post_type'      => 'post',
													'post_status'    => 'publish',
													'order'          => 'DESC',
													'post__not_in'   => get_option( 'sticky_posts' ),
												);


												// The Query
												$query      = new WP_Query( $args );
												$total_post = $query->post_count;

												// The Loop
												if ( $query->have_posts() ) {
													while ( $query->have_posts() ) {
														$query->the_post();
														$post = get_post();

														?>

														<li class="news-item"><a
																href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</li>
														<?php
													}
												}
												wp_reset_postdata();
											?>
										</ul>
										<!-- /.news-ticker -->
									</div> <!-- .newsticker-wrapper -->
								<?php } ?>
								<?php
							} ?>
						</div>
						<!-- /.custom-page-header -->
						<!-- .custom-page-header -->
					</div>
					<!-- /.col-# -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</div> <!-- .page-header-wrapper -->
		<?php
	}

	if ( ! is_page() ) {

		if ( industrix_option( 'show-blog-header', FALSE, TRUE ) ) {
			?>
			<div class="page-header-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="custom-page-header box-wrapper" role="banner">
								<div class="custom"
								     style="background-image: url('<?php echo industrix_title_image( 'http://placehold.it/1100x200' ) ?>'); background-size: cover;">
									<h1><?php echo industrix_title_text() ?></h1>
								</div>

								<?php if ( industrix_option( 'breadcrumb', FALSE, TRUE ) ) { ?>
									<div class="breadcrumb-box">
										<?php echo industrix_breadcrumbs() ?>
									</div> <!-- .breadcrumb-box -->
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}