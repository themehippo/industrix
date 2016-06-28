<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
<footer role="contentinfo">
	<div class="container">
		<?php if ( is_active_sidebar( 'hippo-bottom-sidebar' ) ) : ?>
			<div class="row">
				<div class="col-md-12">
					<div class="footer-widget box-wrapper ">
						<div class="row">
							<?php dynamic_sidebar( 'hippo-bottom-sidebar' ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<section class="copyright-text box-wrapper">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="copyright">
						<div class="left-copy-text">
							<?php if ( industrix_option( 'footer-text', FALSE, FALSE ) ) :
								echo wp_kses_post( industrix_option( 'footer-text' ) );
							else : ?>
								<p>
									<?php printf(
										__( 'Copyright &copy; %1$s %2$s. All Rights Reserved. Designed by <a href="%3$s" title="%4$s">%5$s</a>', 'industrix' ),
										date( 'Y' ),
										__( 'Industrix', 'industrix' ),
										esc_url( 'https://themehippo.com/' ),
										'Visit themehippo.com',
										'ThemeHippo.com' ); ?>
									<br>
									<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'industrix' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'industrix' ), 'WordPress' ); ?></a>
								</p>
							<?php endif; ?>
						</div>
						<a style="font-size: 0" href="https://themehippo.com/">Responsive free and premium WordPress theme</a>
					</div>
				</div>

				<div class="col-md-6 col-sm-6 hidden-xs">
					<div class="footer-right">
						<?php if ( industrix_option( 'footer-social-section-show', FALSE, TRUE ) ) { ?>
							<div class="social-icon pull-right footer-social">
								<ul>
									<?php if ( industrix_option( 'footer-rss-link', FALSE, TRUE ) ) { ?>
										<li>
											<a href="<?php bloginfo( 'rss2_url' ) ?>" target="_blank">
												<i class="fa fa-rss"></i>
											</a>
										</li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-facebook-link', FALSE, TRUE ) ) { ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( industrix_option( 'footer-facebook-link' ) ) ?>">
												<i class="fa fa-facebook"></i>
											</a>
										</li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-twitter-link', FALSE, TRUE ) ) { ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( industrix_option( 'footer-twitter-link' ) ) ?>">
												<i class="fa fa-twitter"></i>
											</a>
										</li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-google-plus-link', FALSE, TRUE ) ) { ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( industrix_option( 'footer-google-plus-link' ) ) ?>">
												<i class="fa fa-google-plus"></i>
											</a>
										</li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-youtube-link', FALSE, TRUE ) ) { ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( industrix_option( 'footer-youtube-link', FALSE, TRUE ) ) ?>">
												<i class="fa fa-youtube"></i></a>
										</li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-skype-link', FALSE, FALSE ) ) { ?>
										<li>
											<a target="_blank" href="<?php echo esc_url( industrix_option( 'footer-skype-link' ) ) ?>">
												<i class="fa fa-skype"></i>
											</a>
										</li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-pinterest-link', FALSE, FALSE ) ) { ?>
										<li>
											<a target="_blank"
											   href="<?php echo esc_url( industrix_option( 'footer-pinterest-link' ) ) ?>"><i
													class="fa fa-pinterest"></i></a></li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-flickr-link', FALSE, FALSE ) ) { ?>
										<li><a target="_blank"
										       href="<?php echo esc_url( industrix_option( 'footer-flickr-link' ) ) ?>"><i
													class="fa fa-flickr"></i></a></li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-linkedin-link', FALSE, FALSE ) ) { ?>
										<li><a target="_blank"
										       href="<?php echo esc_url( industrix_option( 'footer-linkedin-link' ) ) ?>"><i
													class="fa fa-linkedin"></i></a></li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-vimeo-link', FALSE, FALSE ) ) { ?>
										<li><a target="_blank"
										       href="<?php echo esc_url( industrix_option( 'footer-vimeo-link' ) ) ?>"><i
													class="fa fa-vimeo-square"></i></a></li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-instagram-link', FALSE, FALSE ) ) { ?>
										<li><a target="_blank"
										       href="<?php echo esc_url( industrix_option( 'footer-instagram-link' ) ) ?>"><i
													class="fa fa-instagram"></i></a></li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-dribbble-link', FALSE, FALSE ) ) { ?>
										<li><a target="_blank"
										       href="<?php echo esc_url( industrix_option( 'footer-dribbble-link' ) ) ?>"><i
													class="fa fa-dribbble"></i></a></li>
									<?php } ?>

									<?php if ( industrix_option( 'footer-tumblr-link', FALSE, FALSE ) ) { ?>
										<li><a target="_blank"
										       href="<?php echo esc_url( industrix_option( 'footer-tumblr-link' ) ) ?>"><i
													class="fa fa-tumblr"></i></a></li>
									<?php } ?>
								</ul>
							</div> <!-- /.social-icon -->
						<?php } ?>
					</div>
					<!-- ./footer-right -->
				</div>
				<!-- /.col-# -->
			</div>
			<!-- /.row -->
		</section>
		<!-- .copyright-text -->
	</div>
	<!-- .container -->
</footer> <!-- .contentinfo -->
</div> <!-- .contents -->
<?php do_action( 'hippo_theme_end_inner_wrapper' ); ?>
<?php
	if ( offCanvas_On_InnerPusher( industrix_option( 'offcanvas-menu-effect', FALSE, 'slide-in-on-top' ) ) ) {
		?>
		<nav class="menu-wrapper" id="offcanvasmenu">
			<button type="button" class="close-sidebar">&times;</button>
			<?php if ( industrix_option( 'offcanvas-menu-title', FALSE, FALSE ) ) { ?>
				<h2 class="icon icon-stack"><?php echo esc_html( industrix_option( 'offcanvas-menu-title' ) ) ?></h2>
			<?php } ?>
			<div>
				<div>
					<?php dynamic_sidebar( 'offcanvas-menu' ) ?>
				</div>
			</div>
		</nav>
	<?php } ?>
</div> <!-- .pusher -->
<?php do_action( 'hippo_theme_after_inner_wrapper' ); ?>
<?php if ( ! offCanvas_On_InnerPusher( industrix_option( 'offcanvas-menu-effect', FALSE, 'slide-in-on-top' ) ) ) { ?>
	<nav class="menu-wrapper" id="offcanvasmenu">
		<button type="button" class="close-sidebar">&times;</button>
		<?php if ( industrix_option( 'offcanvas-menu-title', FALSE, FALSE ) ) { ?>
			<h2 class="icon icon-stack"><?php echo esc_html( industrix_option( 'offcanvas-menu-title' ) ) ?></h2>
		<?php } ?>
		<div>
			<div>
				<?php dynamic_sidebar( 'offcanvas-menu' ) ?>
			</div>
		</div>
	</nav>
<?php } ?>
</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>