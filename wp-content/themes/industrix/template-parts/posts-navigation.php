<?php ?>

<div class="row next-previous-posts clearfix">

	<?php if ( get_next_posts_link() ) { ?>
		<div class="col-xs-6 pull-left">
			<div class="previous-post">
				<div class="post-heading">
					<h2><?php next_posts_link( __( '<i class="fa fa-long-arrow-left"></i> Older Entries', 'industrix' ) ); ?></h2></a>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php if ( get_previous_posts_link() ) { ?>
		<div class="col-xs-6 pull-right">
			<div class="next-post">
				<div class="post-heading">
					<h2><?php previous_posts_link( __( 'Newer Entries <i class="fa fa-long-arrow-right"></i>', 'industrix' ) ); ?></h2></a>
				</div>
			</div>
		</div>
	<?php } ?>
</div>