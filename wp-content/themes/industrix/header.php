<?php
defined( 'ABSPATH' ) or die( 'Keep Silent' );
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
<div class="wrapper" id="wrapper">
	<?php do_action( 'hippo_theme_before_inner_wrapper' ); ?>
	<!-- content push wrapper -->
	<div class="inner-wrapper pusher">
		<?php do_action( 'hippo_theme_start_inner_wrapper' ); ?>
		<!-- this is the wrapper for the content -->
		<div class="contents">
			<header class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-8">
							<div class="logo">
								<?php industrix_custom_logo() ?>
							</div><!-- .logo -->
						</div>

						<div class="col-md-9 col-sm-8 col-xs-4">

							<?php if ( has_action( 'wpml_add_language_selector' ) ) : ?>
								<div class="ml-languate pull-right">
									<?php do_action( 'wpml_add_language_selector' ); ?>
								</div>
							<?php endif; ?>

							<div class="login pull-right">
								<div id="css-modal-area">
									<div class="css-panel">
										<div class="modal-button-icon">

											<?php if ( ! is_user_logged_in() ) : ?>
												<a data-toggle="modal" href="#cssModal">
													<i class="fa fa-lock"></i>
												</a>

												<?php if ( get_option( 'users_can_register' ) ) : ?>
													<a data-toggle="modal" href="#cssRegi">
														<i class="fa fa-user"></i>
													</a>
												<?php endif; ?>
											<?php endif; ?>
										</div>
										<!-- .modal-button-icon -->

									</div>
									<!-- .css-panel -->
								</div>
								<!-- .css-modal-area -->
							</div>
							<!-- .login -->

							<div class="pull-right hidden-xs">
								<?php if ( industrix_option( 'social-section-show', FALSE, TRUE ) ) : ?>

									<div class="social-icon">
										<ul>
											<?php if ( industrix_option( 'rss-link', FALSE, TRUE ) ) { ?>
												<li>
													<a href="<?php echo esc_url( industrix_option( 'rss-link', FALSE, get_bloginfo( 'rss2_url' ) ) ); ?>"
													   target="_blank"><i
															class="fa fa-rss"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'facebook-link', FALSE, TRUE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'facebook-link' ) ); ?>"><i
															class="fa fa-facebook"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'twitter-link', FALSE, TRUE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'twitter-link' ) ); ?>"><i
															class="fa fa-twitter"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'google-plus-link', FALSE, TRUE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'google-plus-link' ) ); ?>"><i
															class="fa fa-google-plus"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'youtube-link', FALSE, TRUE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'youtube-link' ) ); ?>"><i
															class="fa fa-youtube"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'skype-link', FALSE, FALSE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'skype-link' ) ); ?>"><i
															class="fa fa-skype"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'pinterest-link', FALSE, FALSE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'pinterest-link' ) ); ?>"><i
															class="fa fa-pinterest"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'flickr-link', FALSE, FALSE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'flickr-link' ) ); ?>"><i
															class="fa fa-flickr"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'linkedin-link', FALSE, FALSE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'linkedin-link' ) ); ?>"><i
															class="fa fa-linkedin"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'vimeo-link', FALSE, FALSE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'vimeo-link' ) ); ?>"><i
															class="fa fa-vimeo-square"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'instagram-link', FALSE, FALSE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'instagram-link' ) ); ?>"><i
															class="fa fa-instagram"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'dribbble-link', FALSE, FALSE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'dribbble-link' ) ); ?>"><i
															class="fa fa-dribbble"></i></a></li>
											<?php } ?>

											<?php if ( industrix_option( 'tumblr-link', FALSE, FALSE ) ) { ?>
												<li><a target="_blank"
												       href="<?php echo esc_url( industrix_option( 'tumblr-link' ) ); ?>"><i
															class="fa fa-tumblr"></i></a></li>
											<?php } ?>

										</ul>
									</div> <!-- .social-icon -->
								<?php endif; ?>

								<?php if ( industrix_option( 'cart-icon', FALSE, FALSE ) and function_exists( 'WC' ) ) : ?>
									<div class="cart-notify">
										<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
											<i class="fa fa fa-shopping-basket"></i>
										</a>

										<div class="woocommerce mini-cart-details cart-details">
											<?php if ( industrix_option( 'minicart-title-show', FALSE, FALSE ) ) : ?>
												<span><?php echo esc_html( industrix_option( 'mini-cart-title', FALSE, esc_html__( 'Cart', 'industrix' ) ) ); ?></span>
											<?php endif; ?>

											<div class="mini-cart-contents widget_shopping_cart_content">
												<?php woocommerce_mini_cart() ?>
											</div>
										</div>
									</div> <!-- /.cart-notify -->
								<?php endif; ?>
							</div>
							<!-- .pull-right -->
						</div>
						<!-- .col-md-# -->
					</div>
					<!-- .row -->
				</div>
				<!-- .container -->
			</header>
			<!-- .header-top -->

			<section id="navigation">
				<div class="container">
					<div class="navbar navbar-default mainnav box-wrapper">
						<div class="navbar-header">
							<!-- offcanvas-trigger-effects -->
							<div id="offcanvas-trigger-effects" class="column">
								<button type="button" class="navbar-toggle visible-xs" data-toggle="offcanvas"
								        data-target="navbar-collapse" data-placement="right"
								        data-effect="offcanvas-effect">
									<i class="fa fa-bars"></i>
								</button>
							</div>
							<!-- offcanvas-trigger-effects -->

							<div class="head-search">
								<form role="search" method="get" id="searchform" class="form-search"
								      action="<?php echo home_url(); ?>">
									<div class="search">
										<i class="fa fa-search"></i>
										<input type="search" size="20" class="form-control " maxlength="20"
										       value="<?php the_search_query(); ?>" name="s" id="s"/>
									</div>
								</form>
							</div>
							<!-- .head-search -->
						</div>
						<!-- .navbar-header -->

						<nav class="navbar-collapse collapse" role="navigation">
							<?php wp_nav_menu( array(
								                   'container'      => FALSE,
								                   'theme_location' => 'primary',
								                   'items_wrap'     => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
								                   'walker'         => new Industrix_Menu_Walker(),
								                   'fallback_cb'    => 'Industrix_Menu_Walker::fallback'
							                   )
							);
							?>
						</nav>
					</div>
					<!-- .navbar -->
				</div>
				<!-- .container -->
			</section>
			<!-- #navigation -->
<?php
	get_header( 'page' );
?>