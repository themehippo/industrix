<?php
	/**
	 * Product Loop Start
	 *
	 * @author        WooThemes
	 * @package       WooCommerce/Templates
	 * @version       2.0.0
	 */

	global $woocommerce_loop;

	$box_shadow_class = 'box-shadow';
	if ( $woocommerce_loop[ 'name' ] == 'related' ) {
		$box_shadow_class = '';
	}
?>

<div class="products <?php echo esc_attr( $box_shadow_class ) ?>">
	<div class="row">