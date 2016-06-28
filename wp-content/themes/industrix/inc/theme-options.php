<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	// This is your option name where all the Redux data is stored.
	$redux_opt_name = industrix_option_name();

	//===============================================================================
	//  SET ARGUMENTS
	// For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
	//===============================================================================

	$theme = wp_get_theme(); // For use with some settings. Not necessary.

	$args = array(
		// TYPICAL -> Change these values as you need/desire
		'opt_name'                  => $redux_opt_name,
		// This is where your data is stored in the database industrix also becomes your global variable name.
		'display_name'              => $theme->get( 'Name' ),
		// Name that appears at the top of your panel
		'display_version'           => $theme->get( 'Version' ),
		// Version that appears at the top of your panel
		'menu_type'                 => 'menu',
		//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
		'allow_sub_menu'            => TRUE,
		// Show the sections below the admin menu item or not
		'menu_title'                => sprintf( esc_html__( '%s Options', 'industrix' ), $theme->get( 'Name' ) ),
		'page_title'                => sprintf( esc_html__( '%s Theme Options', 'industrix' ), $theme->get( 'Name' ) ),
		// You will need to generate a Google API key to use this feature.
		// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
		'google_api_key'            => '',
		// Set it you want google fonts to update weekly. A google_api_key value is required.
		'google_update_weekly'      => FALSE,
		// Must be defined to add google fonts to the typography module
		'async_typography'          => FALSE,
		// Use a asynchronous font on the front end or font string
		'disable_google_fonts_link' => FALSE,
		// Disable this in case you want to create your own google fonts loader
		'admin_bar'                 => TRUE,
		// Show the panel pages on the admin bar
		'admin_bar_icon'            => 'dashicons-admin-generic',
		// Choose an icon for the admin bar menu
		'admin_bar_priority'        => 50,
		// Choose an priority for the admin bar menu
		'global_variable'           => '',
		// Set a different name for your global variable other than the opt_name
		'dev_mode'                  => FALSE,
		'forced_dev_mode_off'       => FALSE,
		// Show the time the page took to load, etc
		'update_notice'             => TRUE,
		// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
		'customizer'                => TRUE,
		// Enable basic customizer support
		//'open_expindustrixed'     => true,                    // Allow you to start the panel in an expindustrixed way initially.
		//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

		// OPTIONAL -> Give you extra features
		'page_priority'             => '40',
		// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
		'page_parent'               => 'themes.php',
		// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
		'page_permissions'          => 'manage_options',
		// Permissions needed to access the options panel.
		'menu_icon'                 => '',
		// Specify a custom URL to an icon
		'last_tab'                  => '',
		// Force your panel to always open to a specific tab (by id)
		'page_icon'                 => 'icon-themes',
		// Icon displayed in the admin panel next to your menu_title
		'page_slug'                 => '',
		// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
		'save_defaults'             => TRUE,
		// On load save the defaults to DB before user clicks save or not
		'default_show'              => FALSE,
		// If true, shows the default value next to each field that is not the default value.
		'default_mark'              => '',
		// What to print by the field's title if the value shown is default. Suggested: *
		'show_import_export'        => TRUE,
		// Shows the Import/Export panel when not used as a field.

		// CAREFUL -> These options are for advanced use only
		'transient_time'            => 60 * MINUTE_IN_SECONDS,
		'output'                    => TRUE,
		// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
		'output_tag'                => TRUE,
		// Allows dynamic CSS to be generated for customizer industrix google fonts, but stops the dynamic CSS from going to the head
		'footer_credit'             => sprintf( esc_html__( '%s Theme Options', 'industrix' ), $theme->get( 'Name' ) ),
		// Disable the footer credit of Redux. Please leave if you can help it.

		// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
		'database'                  => '',
		// possible: options, theme_mods, theme_mods_expindustrixed, transient. Not fully functional, warning!
		'use_cdn'                   => TRUE,
		// If you prefer not to use the CDN for Select2, Ace Editor, industrix others, you may download the Redux Vendor Support plugin yourself industrix run locally or embed it in your code.

		// HINTS
		'hints'                     => array(
			'icon'          => 'el el-question-sign',
			'icon_position' => 'right',
			'icon_color'    => 'lightgray',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'red',
				'shadow'  => TRUE,
				'rounded' => FALSE,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'click mouseleave',
				),
			),
		)
	);


	// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
	$args[ 'admin_bar_links' ][] = array(
		'href'  => 'https://themehippo.com/documentation/industrix/',
		'title' => sprintf( esc_html__( '%s Theme Documentation', 'industrix' ), $theme->get( 'Name' ) ),
	);

	$args[ 'admin_bar_links' ][] = array(
		'href'  => 'https://themehippo.com/tickets/',
		'title' => sprintf( esc_html__( '%s Theme Support', 'industrix' ), $theme->get( 'Name' ) ),
	);

	Redux::setArgs( $redux_opt_name, apply_filters( 'hippo_theme_option_args', $args ) );

	//===============================================================================
	//  END ARGUMENTS
	//===============================================================================

	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-cogs',
		'title'  => esc_html__( 'General Settings', 'industrix' ),
		'fields' => array(
			array(
				'id'       => 'layout-type',
				'type'     => 'switch',
				'title'    => esc_html__( 'Layout Type', 'industrix' ),
				'subtitle' => esc_html__( 'Chose your layout type.', 'industrix' ),
				'on'       => 'Shadow',
				'off'      => 'Shadowless',
				'default'  => FALSE,
			),
			array(
				'id'       => 'breadcrumb',
				'type'     => 'switch',
				'title'    => esc_html__( 'Breadcrumb', 'industrix' ),
				'subtitle' => esc_html__( 'Show or Hide Your website Breadcrumb', 'industrix' ),
				'on'       => 'Show',
				'off'      => 'Hide',
				'default'  => TRUE,
			),

			array(
				'id'       => 'page-comment',
				'type'     => 'switch',
				'title'    => esc_html__( 'Page Comment', 'industrix' ),
				'subtitle' => esc_html__( 'Enable or Disabled Your website Page Comment.', 'industrix' ),
				'on'       => 'Enable',
				'off'      => 'Disabled',
				'default'  => TRUE,
			),
		)
	) );


	// Off canvas menu style
	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-lines',
		'title'  => esc_html__( 'Offcanvas Settings', 'industrix' ),
		'fields' => array(

			array(
				'id'       => 'offcanvas-menu-title',
				'type'     => 'text',
				'title'    => esc_html__( 'Offcanvas Menu Title', 'industrix' ),
				'subtitle' => esc_html__( 'Change Offcanvas Menu Title', 'industrix' ),
				'default'  => esc_html__( 'Sidebar Menu', 'industrix' ),
			),
			array(
				'id'      => 'offcanvas-menu-position',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Offcanvas menu position', 'industrix' ),
				'options' => array(
					'left'  => array(
						'alt' => 'Left Side',
						'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
					),
					'right' => array(
						'alt' => 'Right Side',
						'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
					),
				),
				'default' => 'left'
			),
			array(
				'id'      => 'offcanvas-menu-effect',
				'type'    => 'select',
				'title'   => esc_html__( 'Offcanvas menu Effect', 'industrix' ),
				'options' => array(
					'slide-in-on-top' => esc_html__( 'Slide in on top', 'industrix' ),
					'reveal'          => esc_html__( 'Reveal', 'industrix' ),
				),
				'default' => 'slide-in-on-top',
			),
		)
	) );

	// Preset manager
	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-brush',
		'title'  => esc_html__( 'Preset Settings', 'industrix' ),
		'id'     => 'hippo_preset_manager',
		'fields' => array(

			array(
				'id'       => 'preset',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Theme Preset', 'industrix' ),
				'subtitle' => esc_html__( 'Theme Presets', 'industrix' ),
				'default'  => 'preset1',
				'options'  => array(
					'preset1' => array(
						'alt' => 'Preset 1',
						'img' => get_template_directory_uri() . '/img/presets/preset1.png'
					),
					'preset2' => array(
						'alt' => 'Preset 2',
						'img' => get_template_directory_uri() . '/img/presets/preset2.png'
					),
					'preset3' => array(
						'alt' => 'Preset 3',
						'img' => get_template_directory_uri() . '/img/presets/preset3.png'
					),
					'preset4' => array(
						'alt' => 'Preset 4',
						'img' => get_template_directory_uri() . '/img/presets/preset4.png'
					),
					'preset5' => array(
						'alt' => 'Preset 5',
						'img' => get_template_directory_uri() . '/img/presets/preset5.png'
					)
				),
			)
		)
	) );


	// header background setting
	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-picture',
		'title'  => esc_html__( 'Header Background', 'industrix' ),
		'fields' => array(
			array(
				'id'       => 'title-blog-image',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Blog Background.', 'industrix' ),
				'subtitle' => esc_html__( 'Change Blog Title Background. Dimension: 1400px &times; 200px', 'industrix' )
			),
			array(
				'id'       => 'title-single-image',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Single Blog Background.', 'industrix' ),
				'subtitle' => esc_html__( 'Change Blog Details Title Background. Dimension: 1400px &times; 200px', 'industrix' )
			),
			array(
				'id'       => 'title-page-image',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Page Background.', 'industrix' ),
				'subtitle' => esc_html__( 'Change Page Title Background. Dimension: 1400px &times; 200px', 'industrix' )
			),
			array(
				'id'       => 'title-author-image',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Author Background.', 'industrix' ),
				'subtitle' => esc_html__( 'Change Author Title Background. Dimension: 1400px &times; 200px', 'industrix' )
			),
			array(
				'id'       => 'title-tag-image',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Tags Background.', 'industrix' ),
				'subtitle' => esc_html__( 'Change Tags Title Background. Dimension: 1400px &times; 200px', 'industrix' )
			),
			array(
				'id'       => 'title-category-image',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Category Background.', 'industrix' ),
				'subtitle' => esc_html__( 'Change Category Title Background. Dimension: 1400px &times; 200px', 'industrix' )
			),
			array(
				'id'       => 'title-search-image',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Search Background.', 'industrix' ),
				'subtitle' => esc_html__( 'Change Search Title Background. Dimension: 1400px &times; 200px', 'industrix' )
			),
			array(
				'id'       => 'title-404-image',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( '404 Background.', 'industrix' ),
				'subtitle' => esc_html__( 'Change 404 Title Background. Dimension: 1400px &times; 200px', 'industrix' )
			),
			array(
				'id'       => 'title-archive-image',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Archive Background.', 'industrix' ),
				'subtitle' => esc_html__( 'Change Archive Title Background. Dimension: 1400px &times; 200px', 'industrix' )
			),
		)
	) );

	// social settings
	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-group-alt',
		'title'  => esc_html__( 'Social Settings', 'industrix' ),
		'fields' => array(

			array(
				'id'       => 'social-section-show',
				'type'     => 'switch',
				'title'    => esc_html__( 'Show Social Section ?', 'industrix' ),
				'subtitle' => esc_html__( 'Show or Hide Social Section in Navbar.', 'industrix' ),
				'on'       => 'Show',
				'off'      => 'Hide'
			),
			array(
				'id'       => 'rss-link',
				'type'     => 'switch',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Show RSS Link', 'industrix' ),
				'subtitle' => esc_html__( 'Show or Hide RSS Link.', 'industrix' ),
				'on'       => esc_html__( 'Show', 'industrix' ),
				'off'      => esc_html__( 'Hide', 'industrix' ),
				'default'  => TRUE,
			),

			array(
				'id'       => 'facebook-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Facebook Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Facebook icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'twitter-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Twitter Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Twitter icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'google-plus-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Google Plus Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Google Plus icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'youtube-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Youtube Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Youtube icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'skype-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Skype Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Skype icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'pinterest-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Pinterest Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Pinterest icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'flickr-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Flickr Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Flickr icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'linkedin-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Linkedin Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Linkedin icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'vimeo-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Vimeo Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Vimeo icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'instagram-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Instagram Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Instagram icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'dribbble-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Dribbble Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Dribbble icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'tumblr-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Tumblr Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Tumblr icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),
		)
	) );


	// blog settings
	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-file-edit',
		'title'  => esc_html__( 'Blog Settings', 'industrix' ),
		'fields' => array(

			array(
				'id'       => 'show-blog-header',
				'type'     => 'switch',
				'title'    => esc_html__( 'Blog Header', 'industrix' ),
				'subtitle' => esc_html__( 'Blog Header Image and breadcrumbs', 'industrix' ),
				'on'       => 'Enable',
				'off'      => 'Disable',
				'default'  => TRUE,
			),

			array(
				'id'       => 'blog-title',
				'type'     => 'text',
				'title'    => esc_html__( 'Blog Subtitle', 'industrix' ),
				'subtitle' => esc_html__( 'Write blog sub title here.', 'industrix' )
			),

			array(
				'id'       => 'blog-layout',
				'type'     => 'image_select',
				'compiler' => TRUE,
				'title'    => esc_html__( 'Blog Layout', 'industrix' ),
				'subtitle' => esc_html__( 'Blog layout content and sidebar alignment. Choose from Fullwidth, Left sidebar or Right sidebar layout.', 'industrix' ),
				'options'  => array(
					'no-sidebar'    => array(
						'alt' => '1 Column',
						'img' => ReduxFramework::$_url . 'assets/img/1col.png'
					),
					'left-sidebar'  => array(
						'alt' => '2 Column Left',
						'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
					),
					'right-sidebar' => array(
						'alt' => '2 Column Right',
						'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
					)
				),
				'default'  => 'right-sidebar'
			),

			array(
				'id'       => 'blog-page-nav',
				'type'     => 'switch',
				'title'    => esc_html__( 'Blog Pagination or Navigation', 'industrix' ),
				'subtitle' => esc_html__( 'Blog pagination style, posts pagination or newer / older posts', 'industrix' ),
				'on'       => esc_html__( 'Pagination', 'industrix' ),
				'off'      => esc_html__( 'Navigation', 'industrix' ),
				'default'  => TRUE
			),
		)
	) );

	// Page settings
	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-file-edit',
		'title'  => esc_html__( 'Page Settings', 'industrix' ),
		'fields' => array(

			array(
				'id'       => 'page-layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Page Layout', 'industrix' ),
				'subtitle' => esc_html__( 'Page layout content and sidebar alignment. Choose from Fullwidth, Left sidebar or Right sidebar layout.', 'industrix' ),
				'options'  => array(
					'no-sidebar'    => array(
						'alt' => '1 Column',
						'img' => ReduxFramework::$_url . 'assets/img/1col.png'
					),
					'left-sidebar'  => array(
						'alt' => '2 Column Left',
						'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
					),
					'right-sidebar' => array(
						'alt' => '2 Column Right',
						'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
					)
				),
				'default'  => 'right-sidebar'
			),

		)
	) );

	// Show Option Of Woocommerce is enabled :)
	if ( class_exists( 'WooCommerce' ) ):
		Redux::setSection( $redux_opt_name, array(
			'icon'   => 'el-icon-shopping-cart',
			'title'  => esc_html__( 'Shop Settings', 'industrix' ),
			'fields' => array(
				array(
					'id'       => 'shop-title',
					'type'     => 'text',
					'title'    => esc_html__( 'Shop Subtitle', 'industrix' ),
					'subtitle' => esc_html__( 'Write shop sub title here.', 'industrix' ),
					'default'  => 'Shop',
				),
				array(
					'id'       => 'title-shop-image',
					'type'     => 'media',
					'preview'  => 'true',
					'title'    => esc_html__( 'Shop Header Background.', 'industrix' ),
					'subtitle' => esc_html__( 'Change Shop Header Background. Dimension: 1400px &times; 200px', 'industrix' )
				),
				array(
					'id'       => 'cart-icon',
					'type'     => 'switch',
					'title'    => esc_html__( 'Cart Icon', 'industrix' ),
					'subtitle' => esc_html__( 'Show or Hide cart icon on header', 'industrix' ),
					'on'       => esc_html__( 'Show', 'industrix' ),
					'off'      => esc_html__( 'Hide', 'industrix' ),
					'default'  => TRUE,
				),
				array(
					'id'      => 'minicart-title-show',
					'type'    => 'switch',
					'title'   => esc_html__( 'Show Minicart Title?', 'industrix' ),
					'on'      => esc_html__( 'Show', 'industrix' ),
					'off'     => esc_html__( 'Hide', 'industrix' ),
					'default' => TRUE,
				),
				array(
					'id'       => 'mini-cart-title',
					'type'     => 'text',
					'required' => array( 'minicart-title-show', '=', '1' ),
					'title'    => esc_html__( 'Mini Cart Title', 'industrix' ),
				),
				array(
					'id'       => 'shop-layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Shop Layout', 'industrix' ),
					'subtitle' => esc_html__( 'Shop layout content and sidebar alignment. Choose from Full width, Left sidebar or Right sidebar layout.', 'industrix' ),
					'options'  => array(
						'no-sidebar'    => array(
							'alt' => '1 Column',
							'img' => ReduxFramework::$_url . 'assets/img/1col.png'
						),
						'left-sidebar'  => array(
							'alt' => '2 Column Left',
							'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
						),
						'right-sidebar' => array(
							'alt' => '2 Column Right',
							'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
						)
					),
					'default'  => 'right-sidebar'
				),
			)
		) );
	endif;
	// footer settings
	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-photo',
		'title'  => esc_html__( 'Footer Settings', 'industrix' ),
		'fields' => array(
			array(
				'id'       => 'footer-text',
				'type'     => 'editor',
				'title'    => esc_html__( 'Footer Copyright Text', 'industrix' ),
				'subtitle' => esc_html__( 'Write footer copyright text here.', 'industrix' )
			),

			// Footer Social button

			array(
				'id'       => 'footer-social-section-show',
				'type'     => 'switch',
				'title'    => esc_html__( 'Show Footer Social Section', 'industrix' ),
				'subtitle' => esc_html__( 'Show or Hide Social Section in footer.', 'industrix' ),
				'on'       => 'Show',
				'off'      => 'Hide'
			),
			array(
				'id'       => 'footer-rss-link',
				'type'     => 'switch',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Show RSS Link', 'industrix' ),
				'subtitle' => esc_html__( 'Show or Hide RSS Link.', 'industrix' ),
				'on'       => esc_html__( 'Show', 'industrix' ),
				'off'      => esc_html__( 'Hide', 'industrix' ),
				'default'  => TRUE,
			),

			array(
				'id'       => 'footer-facebook-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Facebook Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Facebook icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-twitter-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Twitter Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Twitter icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-google-plus-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Google Plus Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Google Plus icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-youtube-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Youtube Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Youtube icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-skype-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Skype Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Skype icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-pinterest-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Pinterest Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Pinterest icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-flickr-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Flickr Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Flickr icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-linkedin-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Linkedin Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Linkedin icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-vimeo-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Vimeo Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Vimeo icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-instagram-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Instagram Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Instagram icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-dribbble-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Dribbble Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Dribbble icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'footer-tumblr-link',
				'type'     => 'text',
				'required' => array( 'footer-social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Tumblr Link', 'industrix' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Tumblr icon. Leave blank to hide icon.', 'industrix' ),
				'default'  => ""
			),

			array(
				'id'       => 'scroll-to-up',
				'type'     => 'switch',
				'title'    => esc_html__( 'Scroll to Top', 'industrix' ),
				'subtitle' => esc_html__( 'Enable or Disabled Your website Scroll to Top.', 'industrix' ),
				'on'       => 'Enable',
				'off'      => 'Disabled',
				'default'  => TRUE,
			),
		)
	) );


	//   Redux::setSection( $redux_opt_name, array());

	//===============================================================================
	//  END SETTINGS
	//===============================================================================

