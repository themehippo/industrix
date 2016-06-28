<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$layout = industrix_option( 'shop-layout', FALSE, 'right-sidebar' );
	if ( $layout == 'right-sidebar' and is_active_sidebar( 'woosidebar' ) ) {
		?>
		<div class="col-md-3 col-sm-4 no-left-gutter">
			<div class="clearfix box-wrapper woo-sidebar primary-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'woosidebar' ); ?>
			</div>
		</div>
		<?php
	} elseif ( $layout == 'left-sidebar' and is_active_sidebar( 'woosidebar' ) ) {
		?>
		<div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 no-right-gutter">
			<div class="clearfix box-wrapper woo-sidebar primary-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'woosidebar' ); ?>
			</div>
		</div>
		<?php
	}