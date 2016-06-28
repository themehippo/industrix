<?php
	/**
	 * The Template for displaying all single products
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see           https://docs.woothemes.com/document/template-structure/
	 * @author        WooThemes
	 * @package       WooCommerce/Templates
	 * @version       1.6.4
	 */

	get_header(); ?>
<section class="woocommerce-page-wrapper vertical-margin">

	<div class="container">
		<div class="row">

			<?php

				$layout     = industrix_option( 'shop-layout', FALSE, 'right-sidebar' );
				$grid_class = 'col-md-12';

				if ( $layout == 'right-sidebar' ) {

					$grid_class = ( is_active_sidebar( 'woosidebar' ) )
						? 'col-md-9 col-sm-8'
						: $grid_class;

				} elseif ( $layout == 'left-sidebar' ) {
					$grid_class = ( is_active_sidebar( 'woosidebar' ) )
						? 'ls-content col-md-9 col-md-push-3 col-sm-8 col-sm-push-4'
						: $grid_class;
				}
			?>

			<div class="<?php echo esc_attr( $grid_class ); ?>">

				<?php
					/**
					 * woocommerce_before_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action( 'woocommerce_before_main_content' );
				?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

				<?php
					/**
					 * woocommerce_after_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action( 'woocommerce_after_main_content' );
				?>

			</div>
			<!-- /.col-md-9 -->

			<!-- Product sidebbar -->
			<?php
				/**
				 * woocommerce_sidebar hook.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
			?>

		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section>
<?php get_footer( 'shop' ); ?>
