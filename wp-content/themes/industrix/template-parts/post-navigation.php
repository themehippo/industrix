<?php

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( FALSE, '', TRUE );
	$next     = get_adjacent_post( FALSE, '', FALSE );

	if ( ! $next and ! $previous ) {
		return;
	}
?>

<div class="next-previous-post row clearfix">
	<!-- Previous Post -->
	<div class="col-sm-6 col-xs-12">
		<?php if ( $previous ) { ?>
			<div class="previous-post">
				<div class="previous-btn">
					<a href="<?php echo get_permalink( $previous->ID ); ?>"><i
							class="fa fa-long-arrow-left"></i> <?php _e( 'Previous Post', 'industrix' ) ?>
					</a>
				</div>
				<div class="post-heading">
					<a href="<?php echo get_permalink( $previous->ID ); ?>">
						<h2><?php echo get_the_title( $previous->ID ); ?></h2></a>
				</div>
			</div>
		<?php } ?>
	</div>


	<!-- Next Post -->
	<div class="col-sm-6 col-xs-12">
		<?php if ( $next ) { ?>
			<div class="next-post">
				<div class="next-btn">
					<a href="<?php echo get_permalink( $next->ID ); ?>"><?php _e( 'Next Post', 'industrix' ) ?>
						<i class="fa fa-long-arrow-right"></i></a>
				</div>
				<div class="post-heading">
					<a href="<?php echo get_permalink( $next->ID ); ?>">
						<h2><?php echo get_the_title( $next->ID ); ?></h2></a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
