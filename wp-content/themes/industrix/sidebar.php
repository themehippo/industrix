<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$layout = industrix_option( 'blog-layout', FALSE, 'right-sidebar' );

	if ( $layout == 'right-sidebar' and is_active_sidebar( 'hippo-blog-sidebar' ) ) {
		?>
		<div class="col-md-3 col-sm-4 col-xs-12 blog-right-sidebar no-left-gutter">
			<div class="box-wrapper primary-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'hippo-blog-sidebar' ); ?>
			</div>
		</div>
		<?php
	} elseif ( $layout == 'left-sidebar' and is_active_sidebar( 'hippo-blog-sidebar' ) ) {
		?>
		<div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 col-xs-12 blog-left-sidebar no-right-gutter">
			<div class="box-wrapper primary-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'hippo-blog-sidebar' ); ?>
			</div>
		</div>
		<?php
	}