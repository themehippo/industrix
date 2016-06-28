<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( post_password_required() ) :
		return;
	endif;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _nx( 'One comment', '%s comments', get_comments_number(), 'comments title', 'industrix' ),
				        number_format_i18n( get_comments_number() ) );
			?>
		</h3>

		<ul class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'       => 'li',
						'short_ping'  => TRUE,
						'avatar_size' => 74,
						'callback'    => 'industrix_comments_list'
					) );
			?>
		</ul><!-- .comment-list -->

		<?php
	endif; // have_comments()

		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<h3 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'industrix' ); ?></h3>
				<ul class="pager comment-navigation">
					<li class="previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'industrix' ) ); ?></li>
					<li class="next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'industrix' ) ); ?></li>
				</ul>

			</nav><!-- .comment-navigation -->

		<?php endif;  // Check for comment navigation   ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<div class="alert alert-warning no-comments"><?php esc_html_e( 'Comments are closed.', 'industrix' ); ?></div>
	<?php else :
		industrix_comment_form();
	endif;
	?>
</div><!-- /#comments -->