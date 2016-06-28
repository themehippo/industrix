<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
<?php if ( ! is_user_logged_in() ) : ?>
	<div class="modal fade" id="cssModal" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content css-content-block">
				<button type="button" class="close" data-dismiss="modal"
				        aria-hidden="true">&times;</button>

				<h3><?php esc_html_e( 'Login to your account', 'industrix' ) ?></h3>

				<?php if ( get_option( 'users_can_register' ) ) { ?>

					<div class="css-note">
						<p><?php esc_html_e( 'Don\'t have an account yet? ', 'industrix' ) ?>
							<a data-toggle="modal" data-dismiss="modal"
							   href="#cssRegi">
								<?php esc_html_e( 'Register now!', 'industrix' ) ?></a>
						</p>
					</div>
					<!-- .css-note -->
				<?php } ?>

				<div class="popup-loginform-wrapper">
					<?php wp_login_form(); ?>
					<ul id="css_ul">
						<li>
							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot your password?', 'industrix' ) ?></a>
						</li>
					</ul>
				</div>
				<!-- .popup-loginform-wrapper -->
			</div>
			<!-- .modal-content -->
		</div>
		<!-- .modal-dialog -->
	</div><!-- #cssModal -->

	<?php if ( get_option( 'users_can_register' ) ) : ?>
		<!-- Register Modal -->
		<div class="modal fade" id="cssRegi" role="dialog"
		     aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content css-content-block">
					<div class="form-wrapper">
						<button type="button" class="close" data-dismiss="modal"
						        aria-hidden="true">&times;</button>

						<form action="<?php echo wp_registration_url(); ?>" method="post">

							<div class="css-field">
								<div class="css-label ">
									<?php esc_html_e( 'Username *', 'industrix' ) ?>
								</div>

								<div class="css-input">
									<input type="text" name="user_login" id="user_login" class="input"/>
								</div>
							</div>

							<div class="clear"></div>

							<div class="css-field">
								<div class="css-label "><?php esc_html_e( 'Email *', 'industrix' ) ?></div>

								<div class="css-input ">
									<input type="text" name="user_email" id="user_email" class="input"/>
								</div>
							</div>
							<?php do_action( 'register_form' ); ?>
							<div class="submit-btn">
								<input type="submit" value="<?php esc_html_e( 'Register', 'industrix' ) ?>" id="register"/>
							</div>
						</form>
					</div>
					<!-- .form-wrapper -->
				</div>
				<!-- .modal-content -->
			</div>
			<!-- .modal-dialog -->
		</div> <!-- .modal -->
		<?php
	endif;
endif; ?>