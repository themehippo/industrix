<article id="post-<?php the_ID(); ?>" <?php post_class( ( is_sticky() ? 'sticky-post' : '' ) ); ?>>

	<div class="row">

		<?php if ( has_post_thumbnail() || industrix_post_thumbnail( TRUE ) ) { ?>
			<div class="col-md-4 col-sm-12 col-xs-12 clear">
				<div class="post-thumb">
					<?php industrix_post_thumbnail(); ?>
				</div>
				<!-- .post-thumb -->
			</div>

		<?php } ?>


		<?php if ( has_post_thumbnail() || industrix_post_thumbnail( TRUE ) ) { ?>

		<div class="col-md-8 col-sm-12 col-xs-12">

			<?php } else { ?>

			<div class="col-md-12 col-sm-12 col-xs-12">

				<?php } ?>


				<div class="post">

					<header class="entry-header">
						<?php
							if ( is_single() ) {
								the_title( '<h2 class="article-title">', '</h2>' );
							} else {
								the_title( '<h2 class="article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
							}
						?>
					</header>
					<!-- .entry-header -->

					<div class="post-meta clearfix">
						<?php industrix_posted_on() ?>
					</div>

					<?php if ( is_search() ) { ?>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->

					<?php } else { ?>

						<div class="entry-content">
							<?php
								the_content( __( "Read More", 'industrix' ) );
								industrix_link_pages();
							?>
						</div><!-- .entry-content -->
					<?php } ?>
				</div><!-- .post -->
			</div>
		</div>
</article><!-- #post-<?php the_ID(); ?> -->