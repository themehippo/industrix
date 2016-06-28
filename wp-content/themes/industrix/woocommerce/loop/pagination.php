<?php
	/**
	 * Pagination - Show numbered pagination for catalog pages.
	 *
	 * @author        WooThemes
	 * @package       WooCommerce/Templates
	 * @version       2.2.2
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}
?>
<div class="woocommerce-pagination box-shadow">
	<?php

		$product_page_items = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'      => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, FALSE ) ) ) ),
			'format'    => '',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => __( '<i class="fa fa-angle-double-left"></i> Previous', 'industrix' ),
			'next_text' => __( 'Next <i class="fa fa-angle-double-right"></i>', 'industrix' ),
			'type'      => 'array',
			'end_size'  => 3,
			'mid_size'  => 3
		) ) );


		$pagination = "<ul class=\"pagination page-numbers\">\n\t<li>";
		$pagination .= join( "</li>\n\t<li>", $product_page_items );
		$pagination .= "</li>\n</ul>\n";

		echo $pagination;

	?>

</div>
