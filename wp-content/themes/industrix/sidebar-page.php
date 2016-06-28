<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$layout = industrix_option( 'page-layout', FALSE, 'right-sidebar' );
	if ( $layout == 'right-sidebar' and is_active_sidebar( 'hippo-page-sidebar' ) ) {
		?>
		<div class="col-md-3 col-sm-4 no-left-gutter">
			<div class="page-sidebar clearfix box-wrapper right-sidebar" role="complementary">
				<?php dynamic_sidebar( 'hippo-page-sidebar' ); ?>
			</div>
		</div>
		<?php
	} elseif ( $layout == 'left-sidebar' and is_active_sidebar( 'hippo-page-sidebar' ) ) {
		?>
		<div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 no-right-gutter">
			<div class="page-sidebar clearfix box-wrapper left-sidebar" role="complementary">
				<?php dynamic_sidebar( 'hippo-page-sidebar' ); ?>
			</div>
		</div>
		<?php
	}