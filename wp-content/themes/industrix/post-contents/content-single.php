<article id="post-<?php the_ID(); ?>" <?php post_class( ( is_sticky() ? 'sticky-post' : '' ) ); ?>>

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

	<?php if ( has_tag() ) { ?>
		<div class="tags clearfix">
			<?php echo get_the_tag_list( '', '' ); ?>
		</div>
	<?php } ?>


	<div class="post-article">
		<?php industrix_post_thumbnail(); ?>

		<?php if ( is_search() ) { ?>

			<div class="entry-summary clearfix">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		<?php } else { ?>

			<div class="entry-content clearfix vertical-margin">
				<?php
					the_content( __( "Read More", 'industrix' ) );
					industrix_link_pages();
				?>
			</div><!-- .entry-content -->
		<?php } ?>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->

<?php

	if ( is_single() ) {

		if ( get_the_author_meta( 'description' ) ) {
			get_template_part( 'author-bio' );
		}
		industrix_post_navigation();
	}


	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || '0' != get_comments_number() ) :
		?>
		<div class="post-comment-wrapper vertical-margin">
			<?php
				comments_template();
			?>
		</div>
		<?php
	endif;