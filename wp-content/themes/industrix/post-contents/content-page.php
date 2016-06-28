<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php

			the_content( __( "Read More", 'industrix' ) );

			wp_link_pages( array(
				               'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'industrix' ) . '</span>',
				               'after'       => '</div>',
				               'link_before' => '<span>',
				               'link_after'  => '</span>',
			               ) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
