<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );