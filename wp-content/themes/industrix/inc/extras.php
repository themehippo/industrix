<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	//----------------------------------------------------------------------
	// Get list of available home page templates
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_home_page_templates' ) ):

		function industrix_home_page_templates() {

			// Index for body class and value for real page template file name;
			return apply_filters( 'industrix_home_page_templates', array(
				'template-home'            => 'template-home.php',
				'template-home-shadowless' => 'template-home-shadowless.php',
				'template-home-three'      => 'template-home-three.php'
			) );
		}

	endif;

	//----------------------------------------------------------------------
	// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_page_menu_args' ) ) :

		function industrix_page_menu_args( $args ) {

			$args[ 'show_home' ] = TRUE;

			return $args;
		}

		add_filter( 'wp_page_menu_args', 'industrix_page_menu_args' );
	endif;


	//----------------------------------------------------------------------
	// Adds custom classes to the array of body classes.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_body_classes' ) ) :

		function industrix_body_classes( $classes ) {
			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			$classes[] = industrix_get_preset();

			$current_page_template = basename( get_page_template_slug() );

			foreach ( industrix_home_page_templates() as $class_name => $filename ) :
				if ( trim( $filename ) == $current_page_template ) :
					$classes[] = $class_name;
				endif;
			endforeach;

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) :
				$classes[] = 'hfeed';
			endif;

			if ( is_home() or is_archive() or is_search() ) :
				if ( is_active_sidebar( 'industrix-blog-sidebar' ) ):
					$classes[] = 'blog-' . industrix_option( 'blog-layout', FALSE, 'sidebar-right' );
				else:
					$classes[] = 'blog-sidebar-no';
				endif;
			endif;

			if ( is_singular( 'post' ) ) :

				if ( industrix_option( 'industrix-single-post-sidebar', FALSE, TRUE ) ):
					$classes[] = 'blog-' . industrix_option( 'blog-layout', FALSE, 'sidebar-right' );
				else:
					$classes[] = 'blog-sidebar-no';
				endif;

			endif;

			if ( is_page() ) :
				if ( is_active_sidebar( 'industrix-page-sidebar' ) ):
					$classes[] = 'page-' . industrix_option( 'page-layout', FALSE, 'sidebar-right' );
				else:
					$classes[] = 'page-sidebar-no';
				endif;
			endif;

			if ( ! industrix_option( 'layout-type', FALSE, FALSE ) ) :
				$classes[] = 'shadowless-layout';
			endif;

			//$classes[] = industrix_option( 'layout-type', FALSE, 'full-width' );

			return apply_filters( 'industrix_body_classes', $classes );
		}

		add_filter( 'body_class', 'industrix_body_classes', 9999 );
	endif;

	//----------------------------------------------------------------------
	// Adds custom classes to the array of post classes.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_post_classes' ) ) :

		function industrix_post_classes( $classes ) {

			if ( ! is_home() && ! is_paged() && is_sticky() ) {
				$classes[] = 'sticky';
			}

			if ( industrix_post_thumbnail( TRUE ) or has_post_thumbnail() ) {
				$classes[] = 'has-post-thumbnail';
			}

			return apply_filters( 'industrix_post_classes', $classes );
		}

		add_filter( 'post_class', 'industrix_post_classes', 9999 );
	endif;


	//----------------------------------------------------------------------
	// Sets the authordata global when viewing an author archive.
	// This provides backwards compatibility with
	// http://core.trac.wordpress.org/changeset/25574
	// It removes the need to call the_post() and rewind_posts() in an author
	// template to print information about the author.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_setup_author' ) ) :
		function industrix_setup_author() {
			global $wp_query;

			if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
				$GLOBALS[ 'authordata' ] = get_userdata( $wp_query->post->post_author );
			}
		}

		add_action( 'wp', 'industrix_setup_author' );
	endif;


	//----------------------------------------------------------------------
	// Display page break button in editor
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_wp_page_paging' ) ) :

		function industrix_wp_page_paging( $mce_buttons ) {
			if ( get_post_type() == 'post' or get_post_type() == 'page' ) {
				$pos = array_search( 'wp_more', $mce_buttons, TRUE );
				if ( $pos !== FALSE ) {
					$buttons     = array_slice( $mce_buttons, 0, $pos + 1 );
					$buttons[]   = 'wp_page';
					$mce_buttons = array_merge( $buttons, array_slice( $mce_buttons, $pos + 1 ) );
				}
			}

			return apply_filters( 'industrix_mce_buttons', $mce_buttons );
		}

		add_filter( 'mce_buttons', 'industrix_wp_page_paging' );
	endif;


	//----------------------------------------------------------------------
	// Set post view on single page display
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_call_post_views_set_fn' ) ) :
		function industrix_call_post_views_set_fn( $contents ) {

			if ( function_exists( 'hippo_set_post_views' ) and is_single() ) :
				hippo_set_post_views();
			endif;

			return $contents;
		}

		add_filter( 'the_content', 'industrix_call_post_views_set_fn' );
	endif;

	//----------------------------------------------------------------------
	// Post excerpt length, Post excerpt more
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_custom_excerpt_length' ) ) :

		function industrix_custom_excerpt_length( $length ) {
			return apply_filters( 'industrix_custom_excerpt_length', 10, $length );
		}

		add_filter( 'excerpt_length', 'industrix_custom_excerpt_length', 999 );
	endif;

	//----------------------------------------------------------------------
	// Post excerpt more
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_custom_excerpt_more' ) ) :

		function industrix_custom_excerpt_more( $more ) {
			return ' ';
		}

		add_filter( 'excerpt_more', 'industrix_custom_excerpt_more' );

	endif;