<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	//----------------------------------------------------------------------
	// Theme Options, Helper
	//----------------------------------------------------------------------

	require_once get_template_directory() . "/inc/helper.php";
	require_once get_template_directory() . "/inc/industrix-menu-walker.php";

	//----------------------------------------------------------------------
	// Redux ThemeOption
	//----------------------------------------------------------------------

	if ( class_exists( 'Redux' ) ):
		require get_template_directory() . "/inc/theme-options.php";
	endif;

	//----------------------------------------------------------------------
	// WooCommerce
	//----------------------------------------------------------------------

	if ( class_exists( 'WooCommerce' ) ) :
		require_once get_template_directory() . "/inc/woocommerce.php";
	endif;

	//----------------------------------------------------------------------
	// Setting Default Content Width
	//----------------------------------------------------------------------

	if ( ! isset( $content_width ) ) :
		$content_width = apply_filters( 'industrix_content_width', 808 );
	endif;

	//----------------------------------------------------------------------
	// Load Google Font If Redux is not Active.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_fonts_url' ) ):

		function industrix_fonts_url() {
			$font_url = '';

			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'industrix' ) ) {
				$font_url = add_query_arg(
					array(
						'family' => 'Roboto Condensed:300,400',
						'subset' => 'latin'
					), "//fonts.googleapis.com/css" );
			}

			return apply_filters( 'industrix_google_font_url', $font_url );
		}
	endif;

	//----------------------------------------------------------------------
	//  Theme Setup
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_setup_theme' ) ) :

		function industrix_setup_theme() {

			// Make theme available for translation.
			load_theme_textdomain( 'industrix', get_template_directory() . '/languages' );

			// WooCommerce Support
			add_theme_support( 'woocommerce' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			// Supporting title tag
			add_theme_support( 'title-tag' );

			// Supporting custom logo
			add_theme_support( 'custom-logo', apply_filters( 'industrix-custom-logo', array(
				'height'      => 150,
				'width'       => 150,
				'flex-height' => TRUE,
			) ) );

			// Enable support for Post Thumbnails on posts and pages.
			add_theme_support( 'post-thumbnails' );

			// default post thumbnail size
			set_post_thumbnail_size( 808 );

			// project image size
			add_image_size( 'project-thumb', 230, 270, TRUE );

			// project2 image size
			add_image_size( 'project-thumb2', 278, 184, TRUE );

			// project3 image size
			add_image_size( 'project-thumb3', 350, 235, TRUE );

			// Project sidebar thumb
			add_image_size( 'project-sidebar-thumb', 215, 115, TRUE );

			// Service thumb
			add_image_size( 'service-thumb', 255, 155, TRUE );

			// Service thumb 2
			add_image_size( 'service-thumb2', 328, 540, TRUE );

			// Service thumb 3
			add_image_size( 'service-thumb3', 213, 350, TRUE );

			// welcome post image size
			add_image_size( 'welcome-post-thumb', 620, 310, TRUE );

			// latest post size
			add_image_size( 'latest-post', 140, 240, TRUE );

			// Blog post image
			add_image_size( 'post-image', 250, 185, TRUE );

			// Team image
			add_image_size( 'member-thumb', 175, 175, TRUE );

			// Slider image
			add_image_size( 'slider-img', 530, 350, TRUE );

			// Latest news image for magazine page
			add_image_size( 'latest-news-thumb', 155, 103, TRUE );

			// Category post image
			add_image_size( 'category-post', 110, 72, TRUE );

			// Register wp_nav_menu()
			register_nav_menus( apply_filters( 'industrix_register_nav_menus', array(
				'primary' => esc_html__( 'Primary Menu', 'industrix' )
			) ) );


			// Switch default core markup support
			add_theme_support( 'html5', array(
				'comment-list',
				'comment-form',
				'search-form',
				'gallery',
				'caption'
			) );

			// Enable support for Post Formats.
			add_theme_support( 'post-formats', array(
				'aside',
				'image',
				'audio',
				'video',
				'gallery',
				'quote',
				'link',
				'chat'
			) );

			// Editor style
			add_editor_style( apply_filters( 'industrix_add_editor_style', array(
				'css/editor-style.css'
			) ) );
		}

		add_action( 'after_setup_theme', 'industrix_setup_theme' );

	endif;

	//----------------------------------------------------------------------
	// Registering Sidebar
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_widgets_init' ) ) :

		function industrix_widgets_init() {

			do_action( 'industrix_before_register_sidebar' );

			register_sidebar( apply_filters( 'industrix_blog_sidebar', array(
				'name'          => esc_html__( 'Blog Sidebar Area', 'industrix' ),
				'id'            => 'hippo-blog-sidebar',
				'description'   => esc_html__( 'Appears in the blog sidebar.', 'industrix' ),
				'before_widget' => '<div id="%1$s" class="blog-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) ) );

			register_sidebar( apply_filters( 'industrix_page_sidebar', array(
				'name'          => esc_html__( 'Page Sidebar Area', 'industrix' ),
				'id'            => 'hippo-page-sidebar',
				'description'   => esc_html__( 'Appears in the page sidebar.', 'industrix' ),
				'before_widget' => '<div id="%1$s" class="page-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) ) );

			register_sidebar( apply_filters( 'industrix_bottom_sidebar', array(
				'name'          => esc_html__( 'Bottom Sidebar Area', 'industrix' ),
				'id'            => 'hippo-bottom-sidebar',
				'description'   => esc_html__( 'Appears in the bottom of site.', 'industrix' ),
				'before_widget' => '<div id="%1$s" class="col-md-3 widget %2$s"><div class="bottom-widget-wrapper">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) ) );


			register_sidebar( apply_filters( 'industrix_offcanvas_sidebar', array(
				'name'          => esc_html__( 'Off Canvas Manu', 'industrix' ),
				'id'            => 'offcanvas-menu',
				'description'   => esc_html__( 'Shown on Off Canvas Menu', 'industrix' ),
				'before_widget' => '<div class="offcanvasmenu widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'industrix_magazine_top_sidebar', array(
				'name'          => esc_html__( 'Magazine Page Banner Sidebar', 'industrix' ),
				'id'            => 'magazine-top-sidebar',
				'description'   => esc_html__( 'Appears in the Top of Magazine Layout.', 'industrix' ),
				'before_widget' => '<div class="top-sidebar">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'industrix_magazine_right_sidebar', array(
				'name'          => esc_html__( 'Magazine Page Right Sidebar', 'industrix' ),
				'id'            => 'magazine-right-sidebar',
				'description'   => esc_html__( 'Appears in the right side of Magazine Layout.', 'industrix' ),
				'before_widget' => '<div class="single-sidebar">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'industrix_shop_sidebar', array(
				'name'          => esc_html__( 'Shop Sidebar', 'industrix' ),
				'id'            => 'woosidebar',
				'description'   => esc_html__( 'Appears in the shop page', 'industrix' ),
				'before_widget' => '<div id="%1$s" class="blog-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) ) );

			register_sidebar( apply_filters( 'industrix_mega_menu_one_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget One', 'industrix' ),
				'id'            => 'mega-menu-one',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'industrix' ),
				'before_widget' => '<div class="col-md-3 megamenu-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'industrix_mega_menu_two_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget Two', 'industrix' ),
				'id'            => 'mega-menu-two',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'industrix' ),
				'before_widget' => '<div class="col-md-3 megamenu-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'industrix_mega_menu_three_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget Three', 'industrix' ),
				'id'            => 'mega-menu-three',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'industrix' ),
				'before_widget' => '<div class="col-md-3 megamenu-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'industrix_mega_menu_four_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget Four', 'industrix' ),
				'id'            => 'mega-menu-four',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'industrix' ),
				'before_widget' => '<div class="col-md-3 megamenu-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'industrix_mega_menu_five_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget Five', 'industrix' ),
				'id'            => 'mega-menu-five',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'industrix' ),
				'before_widget' => '<div class="col-md-3 megamenu-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );
			do_action( 'industrix_after_register_sidebar' );
		}

		add_action( 'widgets_init', 'industrix_widgets_init' );

	endif;

	//----------------------------------------------------------------------
	// Mega Menu default grid remove
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_widget_grid_class_to_remove' ) ) :

		function industrix_widget_grid_class_to_remove( $classes ) {
			$classes[] = 'col-md-3';

			return $classes;
		}

		add_filter( 'hippo_widget_grid_class_to_remove', 'industrix_widget_grid_class_to_remove' );
	endif;

	//----------------------------------------------------------------------
	// Mega Menu widget list
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_nav_menu_item_meta_list' ) ) :

		function industrix_nav_menu_item_meta_list( $fields ) {

			$fields[ 'widgets' ] = array(
				'type'    => 'select2',
				'label'   => esc_html__( 'MegaMenu Sidebar', 'industrix' ),
				'options' => array(
					''                => esc_html__( '-- Select --', 'industrix' ),
					'mega-menu-one'   => esc_html__( 'Mega Menu Widget One', 'industrix' ),
					'mega-menu-two'   => esc_html__( 'Mega Menu Widget Two', 'industrix' ),
					'mega-menu-three' => esc_html__( 'Mega Menu Widget Three', 'industrix' ),
					'mega-menu-four'  => esc_html__( 'Mega Menu Widget Four', 'industrix' ),
					'mega-menu-five'  => esc_html__( 'Mega Menu Widget Five', 'industrix' )
				),
				'depth'   => 0
			);

			$fields[ 'menucolumnclass' ] = array(
				'type'       => 'text',
				'label'      => esc_html__( 'Mega Menu Column Class', 'industrix' ),
				'default'    => 'col-md-10',
				'depth'      => 0,
				'dependency' => array(
					array( 'widgets' => array( 'type' => '!empty' ) )
				)
			);

			return apply_filters( 'industrix_nav_menu_item_meta_list', $fields );
		}

		add_filter( 'hippo_nav_menu_item_meta', 'industrix_nav_menu_item_meta_list' );
	endif;


	//----------------------------------------------------------------------
	// Load scripts and stylesheets
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_scripts' ) ) :

		function industrix_scripts() {

			do_action( 'industrix_before_enqueue_script' );

			// Loading google font
			if ( ! industrix_option( 'body-typography', 'font-family' ) ) :
				wp_enqueue_style( 'google-font', industrix_fonts_url() );
			endif;

			// Twitter BootStrap.
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );

			// FontAwesome.
			wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

			// hippo off canvas
			wp_enqueue_style( 'hippo-offcanvas', get_template_directory_uri() . '/css/hippo-off-canvas.css' );

			// media element
			wp_enqueue_style( 'wp-mediaelement' );

			// prettyPhoto css
			wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css' );

			// owl carousel css
			wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css' );

			// owl theme css
			wp_enqueue_style( 'owl.theme', get_template_directory_uri() . '/css/owl.theme.css' );

			// hippo icon tab style
			wp_enqueue_style( 'hippo-icontab', get_template_directory_uri() . '/css/tabstyles.css' );

			// News Ticker
			if ( industrix_option( 'news-ticker-show', FALSE, TRUE ) ) :
				wp_enqueue_style( 'news-ticker', get_template_directory_uri() . '/css/ticker-style.css' );
			endif;

			// load LESS File
			if ( class_exists( 'Hippo_Plugin_Less_Css_Init' ) ) :
				wp_enqueue_style( 'industrix-style', industrix_locate_template_uri( 'less/master.less' ) );
			else :
				wp_enqueue_style( 'industrix-style', sprintf( '%s/css-compiled/master-%s.css', get_template_directory_uri(), industrix_get_preset() ) );
			endif;

			// main stylesheet
			wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );

			/** ====================================================================
			 *  Loading JavaScripts
			 * ====================================================================
			 */

			// modernizr
			wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.8.1.min.js', array( 'jquery' ), NULL );

			// bootstrap
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', TRUE );

			// media element
			wp_enqueue_script( 'wp-mediaelement' );

			// shuffle JS
			wp_enqueue_script( 'shuffle', get_template_directory_uri() . '/js/jquery.shuffle.min.js', array( 'jquery' ), NULL, TRUE );

			// Owl carousel js 
			wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), NULL, TRUE );

			// Retina ready js 
			wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.min.js', array(), NULL, TRUE );

			// Pretty photo js
			wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array( 'jquery' ), NULL, TRUE );

			// hippo icon tab style
			wp_enqueue_script( 'hippo-icontab', get_template_directory_uri() . '/js/tab-style.js', array( 'jquery' ), NULL, TRUE );

			// Hippo offcanvas
			wp_enqueue_script( 'hippo-offcanvas', get_template_directory_uri() . '/js/hippo-off-canvas.js', array( 'jquery' ), NULL, TRUE );

			// class ie
			wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ), NULL, TRUE );

			if ( industrix_option( 'news-ticker-show', FALSE, TRUE ) ) :
				// News ticker js
				wp_enqueue_script( 'news-ticker-js', get_template_directory_uri() . '/js/jquery.ticker.js', array( 'jquery' ), NULL, TRUE );
			endif;

			if ( industrix_option( 'scroll-to-up', FALSE, TRUE ) ) :
				// Back to top
				wp_enqueue_script( 'to-top', get_template_directory_uri() . '/js/jquery.scrollUp.js', array( 'jquery' ), NULL, TRUE );
			endif;

			if ( industrix_option( 'sticky-menu' ) ) :
				// Sticky menu js
				wp_enqueue_script( 'sticky-menu', get_template_directory_uri() . '/js/sticky-menu.js', array( 'jquery' ), NULL, TRUE );
			endif;

			// Script Config
			wp_enqueue_script( 'industrix-script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), NULL, TRUE );

			// localize script
			wp_localize_script( 'industrix-script', 'industrixJSObject', apply_filters( 'industrix_js_object', array(
				'ajax_url'                => admin_url( 'admin-ajax.php' ),
				'site_url'                => site_url(),
				'theme_url'               => get_template_directory_uri(),
				'is_front_page'           => is_front_page(),
				'is_home'                 => is_home(),
				'scroll_to_top'           => industrix_option( 'scroll-to-up', FALSE, TRUE ),
				'show_news_ticker'        => industrix_option( 'news-ticker-show', FALSE, TRUE ),
				'news_ticker_title'       => industrix_option( 'news-ticker-title', FALSE, __( 'BREAKING NEWS', 'industrix' ) ),
				'offcanvas_menu_position' => 'hippo-offcanvas-' . industrix_option( 'offcanvas-menu-position', FALSE, 'left' ),
				'offcanvas_menu_effect'   => industrix_option( 'offcanvas-menu-effect', FALSE, 'slide-in-on-top' ),
			) ) );

			// comment reply
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			do_action( 'industrix_after_enqueue_script' );
		}

		add_action( 'wp_enqueue_scripts', 'industrix_scripts' );
	endif;

	//-------------------------------------------------------------------------------
	// Custom template tags for this theme.
	//-------------------------------------------------------------------------------
	require get_template_directory() . '/inc/template-tags.php';

	//-------------------------------------------------------------------------------
	// Custom functions that act independently of the theme templates.
	//-------------------------------------------------------------------------------
	require get_template_directory() . '/inc/extras.php';

	if ( is_admin() ):

		//----------------------------------------------------------------------
		// Load the TGM Plugin Installation
		//----------------------------------------------------------------------

		require get_template_directory() . "/required-plugins/index.php";

	endif;
