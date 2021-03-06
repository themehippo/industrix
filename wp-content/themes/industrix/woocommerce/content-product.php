<?php
	/**
	 * The template for displaying product content within loops
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see     https://docs.woothemes.com/document/template-structure/
	 * @author  WooThemes
	 * @package WooCommerce/Templates
	 * @version 2.6.1
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $product, $woocommerce_loop;

	// Ensure visibility
	if ( empty( $product ) || ! $product->is_visible() ) {
		return;
	}
?>
<div class="col-md-4 col-sm-6 col-xs-12">
	<div <?php post_class(); ?>>
		<?php
			/**
			 * woocommerce_before_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );

			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item hook
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</div>
</div>

<?php if ( ( absint( $woocommerce_loop[ 'loop' ] ) % 3 ) == 0 ): ?>
	<div class="clearfix visible-md-block visible-lg-block"></div>
<?php endif; ?>

<?php if ( ( absint( $woocommerce_loop[ 'loop' ] ) % 2 ) == 0 ): ?>
	<div class="clearfix visible-sm-block"></div>
<?php endif; ?>

