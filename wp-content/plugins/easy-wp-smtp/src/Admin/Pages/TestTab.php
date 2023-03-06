<?php

namespace EasyWPSMTP\Admin\Pages;

use EasyWPSMTP\Conflicts;
use EasyWPSMTP\ConnectionInterface;
use EasyWPSMTP\Debug;
use EasyWPSMTP\MailCatcherInterface;
use EasyWPSMTP\Options;
use EasyWPSMTP\WP;
use EasyWPSMTP\Admin\PageAbstract;

/**
 * Class TestTab is part of Area, displays email testing page of the plugin.
 *
 * @since 2.0.0
 */
class TestTab extends PageAbstract {

	/**
	 * @var string Slug of a tab.
	 */
	protected $slug = 'test';

	/**
	 * Tab priority.
	 *
	 * @since 2.0.0
	 *
	 * @var int
	 */
	protected $priority = 10;

	/**
	 * Mailer debug error data.
	 *
	 * @since 2.0.0
	 *
	 * @var array
	 */
	private $debug = [];

	/**
	 * Test email POST data.
	 *
	 * @since 2.0.0
	 *
	 * @var array
	 */
	private $post_data = [];

	/**
	 * Test email connection.
	 *
	 * @since 2.0.0
	 *
	 * @var ConnectionInterface
	 */
	private $connection;

	/**
	 * @inheritdoc
	 */
	public function get_label() {

		return esc_html__( 'Email Test', 'easy-wp-smtp' );
	}

	/**
	 * @inheritdoc
	 */
	public function get_title() {

		return $this->get_label();
	}

	/**
	 * Display test email form.
	 *
	 * @since 2.0.0
	 */
	public function display() {

		$test_email_options = array_merge(
			[
				'to'      => '',
				'subject' => '',
				'message' => '',
			],
			get_option( 'easy_wp_smtp_test_email', [] )
		);

		if ( empty( $test_email_options['to'] ) ) {
			$test_email_options['to'] = wp_get_current_user()->user_email;
		}

		?>
		<form id="easy-wp-smtp-email-test-form" method="POST" action="<?php echo esc_url( $this->get_link() ); ?>">
			<?php $this->wp_nonce_field(); ?>
			<div class="easy-wp-smtp-meta-box">
				<div class="easy-wp-smtp-meta-box__header">
					<div class="easy-wp-smtp-meta-box__heading">
						<?php esc_html_e( 'Send a Test', 'easy-wp-smtp' ); ?>
					</div>
				</div>
				<div class="easy-wp-smtp-meta-box__content">
					<!-- Test Email -->
					<div id="easy-wp-smtp-setting-row-test_email" class="easy-wp-smtp-row easy-wp-smtp-setting-row easy-wp-smtp-setting-row--text">
						<div class="easy-wp-smtp-setting-row__label">
							<label for="easy-wp-smtp-setting-test_email"><?php esc_html_e( 'Send To', 'easy-wp-smtp' ); ?></label>
						</div>
						<div class="easy-wp-smtp-setting-row__field">
							<input name="easy-wp-smtp[test][email]" value="<?php echo esc_attr( $test_email_options['to'] ); ?>"
										 type="email" id="easy-wp-smtp-setting-test_email" spellcheck="false" placeholder="yourmail@example.com"
										 required
							/>
							<p class="desc">
								<?php esc_html_e( 'Enter the email address you want to send the test email to.', 'easy-wp-smtp' ); ?>
							</p>
						</div>
					</div>

					<?php
					/**
					 * Fires after "Send To" section on the test email page.
					 *
					 * @since 2.0.0
					 */
					do_action( 'easy_wp_smtp_admin_pages_test_tab_display_form_send_to_after' );
					?>

					<!-- HTML/Plain -->
					<div id="easy-wp-smtp-setting-row-test_email_html" class="easy-wp-smtp-row easy-wp-smtp-setting-row">
						<div class="easy-wp-smtp-setting-row__label">
							<label for="easy-wp-smtp-setting-test_email_html"><?php esc_html_e( 'HTML', 'easy-wp-smtp' ); ?></label>
						</div>
						<div class="easy-wp-smtp-setting-row__field">
							<label class="easy-wp-smtp-toggle" for="easy-wp-smtp-setting-test_email_html">
								<input type="checkbox" id="easy-wp-smtp-setting-test_email_html" name="easy-wp-smtp[test][html]" value="yes" checked/>
								<span class="easy-wp-smtp-toggle__switch"></span>
								<span class="easy-wp-smtp-toggle__label easy-wp-smtp-toggle__label--checked"><?php esc_html_e( 'On', 'easy-wp-smtp' ); ?></span>
								<span class="easy-wp-smtp-toggle__label easy-wp-smtp-toggle__label--unchecked"><?php esc_html_e( 'Off', 'easy-wp-smtp' ); ?></span>
							</label>
							<p class="desc">
								<?php esc_html_e( 'Enable to send this email in HTML format. Disable to send it in plain text format.', 'easy-wp-smtp' ); ?>
							</p>
						</div>
					</div>

					<!-- Custom Email -->
					<div id="easy-wp-smtp-setting-row-test_email_custom" class="easy-wp-smtp-row easy-wp-smtp-setting-row">
						<div class="easy-wp-smtp-setting-row__label">
							<label for="easy-wp-smtp-setting-test_email_custom"><?php esc_html_e( 'Custom Email', 'easy-wp-smtp' ); ?></label>
						</div>
						<div class="easy-wp-smtp-setting-row__field">
							<label class="easy-wp-smtp-toggle" for="easy-wp-smtp-setting-test_email_custom">
								<input type="checkbox" id="easy-wp-smtp-setting-test_email_custom" name="easy-wp-smtp[test][custom]" value="yes"/>
								<span class="easy-wp-smtp-toggle__switch"></span>
								<span class="easy-wp-smtp-toggle__label easy-wp-smtp-toggle__label--checked"><?php esc_html_e( 'On', 'easy-wp-smtp' ); ?></span>
								<span class="easy-wp-smtp-toggle__label easy-wp-smtp-toggle__label--unchecked"><?php esc_html_e( 'Off', 'easy-wp-smtp' ); ?></span>
							</label>
							<p class="desc">
								<?php esc_html_e( 'Replace the predefined email template with your own content.', 'easy-wp-smtp' ); ?>
							</p>
						</div>
					</div>

					<!-- Subject -->
					<div id="easy-wp-smtp-setting-row-test_email_subject" class="easy-wp-smtp-row easy-wp-smtp-setting-row easy-wp-smtp-setting-row--text" style="display: none;">
						<div class="easy-wp-smtp-setting-row__label">
							<label for="easy-wp-smtp-setting-test_email_subject"><?php esc_html_e( 'Subject', 'easy-wp-smtp' ); ?></label>
						</div>
						<div class="easy-wp-smtp-setting-row__field">
							<input name="easy-wp-smtp[test][subject]" type="text" id="easy-wp-smtp-setting-test_email_subject" value="<?php echo esc_attr( $test_email_options['subject'] ); ?>" spellcheck="false">
							<p class="desc">
								<?php esc_html_e( 'Enter a custom subject for your message.', 'easy-wp-smtp' ); ?>
							</p>
						</div>
					</div>

					<!-- Message -->
					<div id="easy-wp-smtp-setting-row-test_email_message" class="easy-wp-smtp-row easy-wp-smtp-setting-row easy-wp-smtp-setting-row--text" style="display: none;">
						<div class="easy-wp-smtp-setting-row__label">
							<label for="easy-wp-smtp-setting-test_email_message"><?php esc_html_e( 'Message', 'easy-wp-smtp' ); ?></label>
						</div>
						<div class="easy-wp-smtp-setting-row__field">
							<textarea name="easy-wp-smtp[test][message]" id="easy-wp-smtp-setting-test_email_message" spellcheck="false" rows="9"><?php echo esc_textarea( stripslashes( $test_email_options['message'] ) ); ?></textarea>
							<p class="desc">
								<?php esc_html_e( 'Write your custom email message.', 'easy-wp-smtp' ); ?>
							</p>
						</div>
					</div>
				</div>
			</div>

			<?php
			$btn       = 'easy-wp-smtp-btn--primary';
			$disabled  = '';
			$help_text = '';

			$mailer = easy_wp_smtp()->get_providers()->get_mailer(
				Options::init()->get( 'mail', 'mailer' ),
				easy_wp_smtp()->get_processor()->get_phpmailer()
			);

			if ( ! $mailer || ! $mailer->is_mailer_complete() ) {
				$btn      = 'easy-wp-smtp-btn--primary easy-wp-smtp-btn--primary--disabled';
				$disabled = 'disabled';

				$help_text = '<div class="easy-wp-smtp-test-email-submit__text">' . esc_html__( 'You cannot send an email. Mailer is not properly configured. Please check your settings.', 'easy-wp-smtp' ) . '</div>';
			}
			?>
			<div class="easy-wp-smtp-test-email-submit">
				<button type="submit" class="easy-wp-smtp-btn easy-wp-smtp-btn--lg <?php echo esc_attr( $btn ); ?>" <?php echo esc_attr( $disabled ); ?>>
					<?php esc_html_e( 'Send Test Email', 'easy-wp-smtp' ); ?>
				</button>
				<?php echo $help_text; ?>
			</div>

			<?php $this->post_form_hidden_field(); ?>
		</form>

		<?php if ( ! empty( $mailer ) && $mailer->is_mailer_complete() && isset( $_GET['auto-start'] ) ) : // phpcs:ignore ?>
			<script>
				(function( $ ) {
					var $button = $( '.easy-wp-smtp-tab-tools-test #easy-wp-smtp-email-test-form .easy-wp-smtp-btn' );

					$button.addClass( 'easy-wp-smtp-btn--loading' );

					$( '#easy-wp-smtp-email-test-form' ).submit();
				}( jQuery ));
			</script>
		<?php
		endif;

		$this->display_debug_details();
	}

	/**
	 * @inheritdoc
	 */
	public function process_post( $data ) {

		$this->check_admin_referer();

		$this->post_data = $data;

		$connection = easy_wp_smtp()->get_connections_manager()->get_primary_connection();

		/**
		 * Filters test email connection object.
		 *
		 * @since 2.0.0
		 *
		 * @param ConnectionInterface $connection The Connection object.
		 * @param array               $data       Post data.
		 */
		$this->connection = apply_filters( 'easy_wp_smtp_admin_pages_test_tab_process_post_connection', $connection, $data );

		if ( ! empty( $data['test']['email'] ) ) {
			$data['test']['email'] = filter_var( $data['test']['email'], FILTER_VALIDATE_EMAIL );
		}

		$is_html = true;
		if ( empty( $data['test']['html'] ) ) {
			$is_html = false;
		}

		if ( empty( $data['test']['email'] ) ) {
			WP::add_admin_notice(
				esc_html__( 'Test failed. Please use a valid email address and try to resend the test email.', 'easy-wp-smtp' ),
				WP::ADMIN_NOTICE_WARNING
			);
			return;
		}

		$phpmailer = easy_wp_smtp()->get_processor()->get_phpmailer();

		// Set SMTPDebug level, default is 3 (commands + data + connection status).
		$phpmailer->SMTPDebug = apply_filters( 'easy_wp_smtp_admin_test_email_smtp_debug', 3 );

		if ( $is_html ) {
			add_filter( 'wp_mail_content_type', array( __CLASS__, 'set_test_html_content_type' ) );
		}

		$to = $data['test']['email'];

		if ( ! empty( $data['test']['custom'] ) && ! empty( $data['test']['subject'] ) ) {
			$subject = $data['test']['subject'];
		} else {
			if ( $is_html ) {
				/* translators: %s - email address a test email will be sent to. */
				$subject = 'Easy WP SMTP: HTML ' . sprintf( esc_html__( 'Test email to %s', 'easy-wp-smtp' ), $data['test']['email'] );
			} else {
				/* translators: %s - email address a test email will be sent to. */
				$subject = 'Easy WP SMTP: ' . sprintf( esc_html__( 'Test email to %s', 'easy-wp-smtp' ), $data['test']['email'] );
			}
		}

		// Force processing for test email even if email sending is blocked.
		easy_wp_smtp()->get_processor()->set_force_processing( true );

		// Start output buffering to grab smtp debugging output.
		ob_start();

		// Send the test mail.
		$result = wp_mail(
			$to,
			$subject,
			$this->get_email_message( $is_html ),
			array(
				'X-Mailer-Type:EasyWPSMTP/Admin/Test',
			)
		);

		$smtp_debug = ob_get_clean();

		easy_wp_smtp()->get_processor()->set_force_processing( false );

		if ( $is_html ) {
			remove_filter( 'wp_mail_content_type', array( __NAMESPACE__, 'set_test_html_content_type' ) );
		}

		/*
		 * Notify a user about the results.
		 */
		if ( $result ) {
			$result_message = esc_html__( 'Test plain text email was sent successfully!', 'easy-wp-smtp' );

			if ( $is_html ) {
				$result_message = sprintf(
				/* translators: %s - "HTML" in bold. */
					esc_html__( 'Test %s email was sent successfully! Please check your inbox to make sure it is delivered.', 'easy-wp-smtp' ),
					'<strong>HTML</strong>'
				);
			}

			WP::add_admin_notice(
				$result_message,
				WP::ADMIN_NOTICE_SUCCESS
			);
		} else {
			// Grab the smtp debugging output.
			$this->debug['smtp_debug'] = $smtp_debug;
			$this->debug['smtp_error'] = wp_strip_all_tags( $phpmailer->ErrorInfo );
			$this->debug['error_log']  = $this->get_debug_messages( $phpmailer, $smtp_debug );
		}

		// Update test email data.
		$test_email_options = get_option( 'easy_wp_smtp_test_email', [] );

		$test_email_options['to'] = filter_var( $to, FILTER_SANITIZE_EMAIL );

		if ( ! empty( $data['test']['custom'] ) ) {
			$test_email_options['subject'] = sanitize_text_field( $subject );

			if ( ! empty( $data['test']['message'] ) ) {
				$test_email_options['message'] = sanitize_textarea_field( $data['test']['message'] );
			}
		}

		update_option( 'easy_wp_smtp_test_email', $test_email_options, false );
	}

	/**
	 * Get the email message that should be sent.
	 *
	 * @since 2.0.0
	 *
	 * @param bool $is_html Whether to send an HTML email or plain text.
	 *
	 * @return string
	 */
	private function get_email_message( $is_html = true ) {

		if ( ! empty( $this->post_data['test']['custom'] ) && ! empty( $this->post_data['test']['message'] ) ) {
			return $this->post_data['test']['message'];
		}

		// Default plain text version of the email.
		$message = self::get_email_message_text();

		if ( $is_html ) {
			$message = $this->get_email_message_html();
		}

		return $message;
	}

	/**
	 * Get the HTML prepared message for test email.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	private function get_email_message_html() {

		ob_start();
		?>
		<!doctype html>
		<html lang="en">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width">
			<title>Easy WP SMTP Test Email</title>
			<style type="text/css">@media only screen and (max-width: 599px) {table.body .container {width: 95% !important;}.header {padding: 15px 15px 12px 15px !important;}.header img {width: 200px !important;height: auto !important;}.content, .aside {padding: 30px 40px 20px 40px !important;}}</style>
		</head>
		<body style="height: 100% !important; width: 100% !important; min-width: 100%; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; -webkit-font-smoothing: antialiased !important; -moz-osx-font-smoothing: grayscale !important; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #3A3A56; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: normal; padding: 0; margin: 0; Margin: 0; font-size: 14px; mso-line-height-rule: exactly; line-height: 140%; background-color: #F2F2F4; text-align: center;">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" class="body" style="border-collapse: collapse; border-spacing: 0; vertical-align: top; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; height: 100% !important; width: 100% !important; min-width: 100%; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; -webkit-font-smoothing: antialiased !important; -moz-osx-font-smoothing: grayscale !important; background-color: #F2F2F4; color: #3A3A56; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: normal; padding: 0; margin: 0; Margin: 0; text-align: left; font-size: 14px; mso-line-height-rule: exactly; line-height: 140%;">
			<tr style="padding: 0; vertical-align: top; text-align: left;">
				<td align="center" valign="top" class="body-inner easy-wp-smtp" style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #3A3A56; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: normal; padding: 0; margin: 0; Margin: 0; font-size: 14px; mso-line-height-rule: exactly; line-height: 140%; text-align: center;">
					<!-- Container -->
					<table border="0" cellpadding="0" cellspacing="0" class="container" style="border-collapse: collapse; border-spacing: 0; padding: 0; vertical-align: top; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; width: 600px; margin: 0 auto 30px auto; Margin: 0 auto 30px auto; text-align: inherit;">
						<!-- Header -->
						<tr style="padding: 0; vertical-align: top; text-align: left;">
							<td align="center" valign="middle" class="header" style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #3A3A56; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: normal; margin: 0; Margin: 0; font-size: 14px; mso-line-height-rule: exactly; line-height: 140%; text-align: center; padding: 30px 30px 30px 30px;">
								<img src="<?php echo esc_url( easy_wp_smtp()->plugin_url . '/assets/images/email/easy-wp-smtp.png' ); ?>" width="308" alt="Easy WP SMTP Logo" style="outline: none; text-decoration: none; max-width: 100%; clear: both; -ms-interpolation-mode: bicubic; display: inline-block !important; width: 308px;">
							</td>
						</tr>
						<!-- Content -->
						<tr style="padding: 0; vertical-align: top; text-align: left;">
							<td align="left" valign="top" class="content" style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #3A3A56; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: normal; margin: 0; Margin: 0; text-align: left; font-size: 14px; mso-line-height-rule: exactly; line-height: 140%; background-color: #ffffff; padding: 60px 60px 60px 60px; border-radius: 6px;">
								<div class="success" style="text-align: center;">
									<p class="check" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #3A3A56; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: normal; padding: 0; font-size: 14px; mso-line-height-rule: exactly; line-height: 140%; margin: 0 auto 20px auto; Margin: 0 auto 20px auto; text-align: center;">
										<img src="<?php echo esc_url( easy_wp_smtp()->plugin_url . '/assets/images/email/icon-check.png' ); ?>" width="62" alt="Success" style="outline: none; text-decoration: none; max-width: 100%; clear: both; -ms-interpolation-mode: bicubic; display: block; margin: 0 auto 0 auto; Margin: 0 auto 0 auto; width: 62px;">
									</p>
									<p class="text-extra-large text-center congrats" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #3A3A56; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: bold; padding: 0; mso-line-height-rule: exactly; line-height: 140%; font-size: 20px; text-align: center; margin: 0 0 40px 0; Margin: 0 0 40px 0;">
										Congrats, test email was sent successfully!
									</p>
									<p class="text-large" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #3A3A56; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: normal; padding: 0; text-align: left; mso-line-height-rule: exactly; line-height: 140%; margin: 0 0 20px 0; Margin: 0 0 20px 0; font-size: 16px;">
										Thank you for using Easy WP SMTP. We're on a mission to make sure your emails actually get delivered.
									</p>
									<p class="signature" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #3A3A56; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: normal; padding: 0; font-size: 14px; mso-line-height-rule: exactly; line-height: 140%; text-align: left; margin: 20px 0 5px 0; Margin: 20px 0 5px 0;">
										<img src="<?php echo esc_url( easy_wp_smtp()->plugin_url . '/assets/images/email/signature.png' ); ?>" width="180" alt="Signature" style="outline: none; text-decoration: none; max-width: 100%; clear: both; -ms-interpolation-mode: bicubic; width: 180px; display: block; margin: 0 0 0 0; Margin: 0 0 0 0;">
									</p>
									<p style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #6F6F84; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: normal; padding: 0; text-align: left; font-size: 14px; mso-line-height-rule: exactly; line-height: 140%; margin: 0 0 0px 0; Margin: 0 0 0px 0;">
										<strong>Jared Atchison</strong><br>
										CEO, SendLayer
									</p>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</body>
		</html>

		<?php
		$message = ob_get_clean();

		return $message;
	}

	/**
	 * Get the plain text prepared message for test email.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public static function get_email_message_text() {

		return 'Congrats, test email was sent successfully!

Thank you for using Easy WP SMTP. We\'re on a mission to make sure your emails actually get delivered.

- Jared Atchison
CEO, SendLayer';
	}

	/**
	 * Set the HTML content type for a test email.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public static function set_test_html_content_type() {

		return 'text/html';
	}

	/**
	 * Prepare debug information, that will help users to identify the error.
	 *
	 * @since 2.0.0
	 *
	 * @param MailCatcherInterface $phpmailer  The MailCatcher object.
	 * @param string               $smtp_debug The SMTP debug message.
	 *
	 * @return string
	 */
	protected function get_debug_messages( $phpmailer, $smtp_debug ) {

		$connection_options = $this->connection->get_options();
		$conflicts          = new Conflicts();

		$this->debug['mailer'] = $connection_options->get( 'mail', 'mailer' );

		/*
		 * Versions Debug.
		 */

		$versions_text = '<strong>Versions:</strong><br>';

		$versions_text .= '<strong>WordPress:</strong> ' . get_bloginfo( 'version' ) . '<br>';
		$versions_text .= '<strong>WordPress MS:</strong> ' . ( is_multisite() ? 'Yes' : 'No' ) . '<br>';
		$versions_text .= '<strong>PHP:</strong> ' . PHP_VERSION . '<br>';
		$versions_text .= '<strong>Easy WP SMTP:</strong> ' . EasyWPSMTP_PLUGIN_VERSION . '<br>';

		/*
		 * Mailer Debug.
		 */

		$mailer_text = '<strong>Params:</strong><br>';

		$mailer_text .= '<strong>Mailer:</strong> ' . $this->debug['mailer'] . '<br>';
		$mailer_text .= '<strong>Constants:</strong> ' . ( $connection_options->is_const_enabled() ? 'Yes' : 'No' ) . '<br>';

		if ( $conflicts->is_detected() ) {
			$conflict_plugin_names = implode( ', ', $conflicts->get_all_conflict_names() );

			$mailer_text .= '<strong>Conflicts:</strong> ' . esc_html( $conflict_plugin_names ) . '<br>';
		}

		// Display different debug info based on the mailer.
		$mailer = easy_wp_smtp()->get_providers()->get_mailer( $this->debug['mailer'], $phpmailer, $this->connection );

		if ( $mailer ) {
			$mailer_text .= $mailer->get_debug_info();
		}

		$phpmailer_error = $phpmailer->ErrorInfo; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

		// Append any PHPMailer errors to the mailer debug (except SMTP mailer, which has the full error output below).
		if (
			! empty( $phpmailer_error ) &&
			! $connection_options->is_mailer_smtp()
		) {
			$mailer_text .= '<br><br><strong>PHPMailer Debug:</strong><br>' .
			                wp_strip_all_tags( $phpmailer_error ) .
			                '<br>';
		}

		/*
		 * General Debug.
		 */

		$debug_text = implode( '<br>', Debug::get() );
		Debug::clear();
		if ( ! empty( $debug_text ) ) {
			$debug_text = '<br><strong>Debug:</strong><br>' . $debug_text . '<br>';
		}

		/*
		 * SMTP Debug.
		 */

		$smtp_text = '';
		if ( $connection_options->is_mailer_smtp() ) {
			$smtp_text = '<strong>SMTP Debug:</strong><br>';
			if ( ! empty( $smtp_debug ) ) {
				$smtp_text .= '<pre>' . $smtp_debug . '</pre>';
			} else {
				$smtp_text .= '[empty]';
			}
		}

		$errors = apply_filters(
			'easy_wp_smtp_admin_test_get_debug_messages',
			array(
				$versions_text,
				$mailer_text,
				$debug_text,
				$smtp_text,
			)
		);

		return '<pre>' . implode( '<br>', array_filter( $errors ) ) . '</pre>';
	}

	/**
	 * Returns debug information for detection, processing, and display.
	 *
	 * @since 2.0.0
	 *
	 * @return array
	 */
	protected function get_debug_details() {

		$connection_options = $this->connection->get_options();
		$smtp_host          = $connection_options->get( 'smtp', 'host' );
		$smtp_port          = $connection_options->get( 'smtp', 'port' );
		$smtp_encryption    = $connection_options->get( 'smtp', 'encryption' );

		$details = [
			// [any] - cURL error 60/77.
			[
				'mailer'      => 'any',
				'errors'      => [
					[ 'cURL error 60' ],
					[ 'cURL error 77' ],
				],
				'title'       => esc_html__( 'SSL certificate issue.', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'This means your web server cannot reliably make secure connections (make requests to HTTPS sites).', 'easy-wp-smtp' ),
					esc_html__( 'Typically this error is returned when web server is not configured properly.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					esc_html__( 'Contact your web hosting provider and inform them your site has an issue with SSL certificates.', 'easy-wp-smtp' ),
					esc_html__( 'The exact error you can provide them is in the Error log, available at the bottom of this page.', 'easy-wp-smtp' ),
					esc_html__( 'Ask them to resolve the issue then try again.', 'easy-wp-smtp' ),
				],
			],
			// [any] - cURL error 6/7.
			[
				'mailer'      => 'any',
				'errors'      => [
					[ 'cURL error 6' ],
					[ 'cURL error 7' ],
				],
				'title'       => esc_html__( 'Could not connect to host.', 'easy-wp-smtp' ),
				'description' => [
					! empty( $smtp_host )
						? sprintf( /* translators: %s - SMTP host address. */
							esc_html__( 'This means your web server was unable to connect to %s.', 'easy-wp-smtp' ),
							$smtp_host
						)
						: esc_html__( 'This means your web server was unable to connect to the host server.', 'easy-wp-smtp' ),
					esc_html__( 'Typically this error is returned your web server is blocking the connections or the SMTP host denying the request.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					sprintf( /* translators: %s - SMTP host address. */
						esc_html__( 'Contact your web hosting provider and ask them to verify your server can connect to %s. Additionally, ask them if a firewall or security policy may be preventing the connection.', 'easy-wp-smtp' ),
						$smtp_host
					),
					esc_html__( 'If using "Other SMTP" Mailer, triple check your SMTP settings including host address, email, and password.', 'easy-wp-smtp' ),
					esc_html__( 'If using "Other SMTP" Mailer, contact your SMTP host to confirm they are accepting outside connections with the settings you have configured (address, username, port, security, etc).', 'easy-wp-smtp' ),
				],
			],
			// [any] - cURL error XX (other).
			[
				'mailer'      => 'any',
				'errors'      => [
					[ 'cURL error' ],
				],
				'title'       => esc_html__( 'Could not connect to your host.', 'easy-wp-smtp' ),
				'description' => [
					! empty( $smtp_host )
						? sprintf( /* translators: %s - SMTP host address. */
							esc_html__( 'This means your web server was unable to connect to %s.', 'easy-wp-smtp' ),
							$smtp_host
						)
						: esc_html__( 'This means your web server was unable to connect to the host server.', 'easy-wp-smtp' ),
					esc_html__( 'Typically this error is returned when web server is not configured properly.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					esc_html__( 'Contact your web hosting provider and inform them you are having issues making outbound connections.', 'easy-wp-smtp' ),
					esc_html__( 'The exact error you can provide them is in the Error log, available at the bottom of this page.', 'easy-wp-smtp' ),
					esc_html__( 'Ask them to resolve the issue then try again.', 'easy-wp-smtp' ),
				],
			],
			// [smtp] - SMTP Error: Count not authenticate.
			[
				'mailer'      => 'smtp',
				'errors'      => [
					[ 'SMTP Error: Could not authenticate.' ],
				],
				'title'       => esc_html__( 'Could not authenticate your SMTP account.', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'This means we were able to connect to your SMTP host, but were not able to proceed using the email/password in the settings.', 'easy-wp-smtp' ),
					esc_html__( 'Typically this error is returned when the email or password is not correct or is not what the SMTP host is expecting.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					esc_html__( 'Triple check your SMTP settings including host address, email, and password. If you have recently reset your password you will need to update the settings.', 'easy-wp-smtp' ),
					esc_html__( 'Contact your SMTP host to confirm you are using the correct username and password.', 'easy-wp-smtp' ),
					esc_html__( 'Verify with your SMTP host that your account has permissions to send emails using outside connections.', 'easy-wp-smtp' ),
					sprintf(
						wp_kses( /* translators: %s - URL to the easywpsmtp.com doc page. */
							__( 'Visit <a href="%s" target="_blank" rel="noopener noreferrer">our documentation</a> for additional tips on how to resolve this error.', 'easy-wp-smtp' ),
							[
								'a' => [
									'href'   => [],
									'target' => [],
									'rel'    => [],
								],
							]
						),
						// phpcs:ignore WordPress.Arrays.ArrayDeclarationSpacing.AssociativeArrayFound
						esc_url( easy_wp_smtp()->get_utm_url( 'https://easywpsmtp.com/docs/setting-up-the-other-smtp-mailer/#auth-type', [ 'medium' => 'email-test', 'content' => 'Other SMTP auth debug - our documentation' ] ) )
					),
				],
			],
			// [smtp] - Sending bulk email, hitting rate limit.
			[
				'mailer'      => 'smtp',
				'errors'      => [
					[ 'We do not authorize the use of this system to transport unsolicited' ],
				],
				'title'       => esc_html__( 'Error due to unsolicited and/or bulk e-mail.', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'This means the connection to your SMTP host was made successfully, but the host rejected the email.', 'easy-wp-smtp' ),
					esc_html__( 'Typically this error is returned when you are sending too many e-mails or e-mails that have been identified as spam.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					esc_html__( 'Check the emails that are sending are sending individually. Example: email is not sending to 30 recipients. You can install any WordPress e-mail logging plugin to do that.', 'easy-wp-smtp' ),
					esc_html__( 'Contact your SMTP host to ask about sending/rate limits.', 'easy-wp-smtp' ),
					esc_html__( 'Verify with them your SMTP account is in good standing and your account has not been flagged.', 'easy-wp-smtp' ),
				],
			],
			// [smtp] - Unauthenticated senders not allowed.
			[
				'mailer'      => 'smtp',
				'errors'      => [
					[ 'Unauthenticated senders not allowed' ],
				],
				'title'       => esc_html__( 'Unauthenticated senders are not allowed.', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'This means the connection to your SMTP host was made successfully, but you should enable Authentication and provide correct Username and Password.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					esc_html__( 'Go to Easy WP SMTP plugin Settings page.', 'easy-wp-smtp' ),
					esc_html__( 'Enable Authentication', 'easy-wp-smtp' ),
					esc_html__( 'Enter correct SMTP Username (usually this is an email address) and Password in the appropriate fields.', 'easy-wp-smtp' ),
				],
			],
			// [smtp] - certificate verify failed.
			// Has to be defined before "SMTP connect() failed" error, since this is a more specific error,
			// which contains the "SMTP connect() failed" error message as well.
			[
				'mailer'      => 'smtp',
				'errors'      => [
					[ 'certificate verify failed' ],
				],
				'title'       => esc_html__( 'Misconfigured server certificate.', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'This means OpenSSL on your server isn\'t able to verify the host certificate.', 'easy-wp-smtp' ),
					esc_html__( 'There are a few reasons why this is happening. It could be that the host certificate is misconfigured, or this server\'s OpenSSL is using an outdated CA bundle.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					esc_html__( 'Verify that the host\'s SSL certificate is valid.', 'easy-wp-smtp' ),
					sprintf(
						wp_kses( /* translators: %s - URL to the PHP openssl manual */
							__( 'Contact your hosting support, show them the "full Error Log for debugging" below and share this <a href="%s" target="_blank" rel="noopener noreferrer">link</a> with them.', 'easy-wp-smtp' ),
							[
								'a' => [
									'href'   => [],
									'target' => [],
									'rel'    => [],
								],
							]
						),
						'https://www.php.net/manual/en/migration56.openssl.php'
					),
				],
			],
			// [smtp] - SMTP connect() failed.
			[
				'mailer'      => 'smtp',
				'errors'      => [
					[ 'SMTP connect() failed' ],
				],
				'title'       => esc_html__( 'Could not connect to the SMTP host.', 'easy-wp-smtp' ),
				'description' => [
					! empty( $smtp_host )
						? sprintf( /* translators: %s - SMTP host address. */
							esc_html__( 'This means your web server was unable to connect to %s.', 'easy-wp-smtp' ),
							$smtp_host
						)
						: esc_html__( 'This means your web server was unable to connect to the host server.', 'easy-wp-smtp' ),
					esc_html__( 'Typically this error is returned for one of the following reasons:', 'easy-wp-smtp' ),
					'<ul>'
						. '<li>' .
							esc_html__( 'SMTP settings are incorrect (wrong port, security setting, incorrect host).', 'easy-wp-smtp' )
						. '</li>'
						. '<li>' .
							esc_html__( 'Your web server is blocking the connection.', 'easy-wp-smtp' )
						. '</li>'
						. '<li>' .
							esc_html__( 'Your SMTP host is rejecting the connection.', 'easy-wp-smtp' )
						. '</li>'
					. '</ul>',
				],
				'steps'       => [
					esc_html__( 'Triple check your SMTP settings including host address, email, and password, port, and security.', 'easy-wp-smtp' ),
					sprintf(
						wp_kses( /* translators: %1$s - SMTP host address, %2$s - SMTP port, %3$s - SMTP encryption. */
							__( 'Contact your web hosting provider and ask them to verify your server can connect to %1$s on port %2$s using %3$s encryption. Additionally, ask them if a firewall or security policy may be preventing the connection - many shared hosts block certain ports.<br><strong>Note: this is the most common cause of this issue.</strong>', 'easy-wp-smtp' ),
							[
								'a'      => [
									'href'   => [],
									'rel'    => [],
									'target' => [],
								],
								'strong' => [],
								'br'     => [],
							]
						),
						$smtp_host,
						$smtp_port,
						'none' === $smtp_encryption ? esc_html__( 'no', 'easy-wp-smtp' ) : $smtp_encryption
					),
					esc_html__( 'Contact your SMTP host to confirm you are using the correct username and password.', 'easy-wp-smtp' ),
					esc_html__( 'Verify with your SMTP host that your account has permissions to send emails using outside connections.', 'easy-wp-smtp' ),
				],
			],
			// [mailgun] - Please activate your Mailgun account.
			[
				'mailer'      => 'mailgun',
				'errors'      => [
					[ 'Please activate your Mailgun account' ],
				],
				'title'       => esc_html__( 'Mailgun failed.', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'It seems that you forgot to activate your Mailgun account.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					esc_html__( 'Check your inbox you used to create a Mailgun account. Click the activation link in an email from Mailgun.', 'easy-wp-smtp' ),
					esc_html__( 'If you do not see activation email, go to your Mailgun control panel and resend the activation email.', 'easy-wp-smtp' ),
				],
			],
			// [mailgun] - Forbidden.
			[
				'mailer'      => 'mailgun',
				'errors'      => [
					[ 'Forbidden' ],
				],
				'title'       => esc_html__( 'Mailgun failed.', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'Typically this error occurs because there is an issue with your Mailgun settings, in many cases Private API Key, Domain Name, or Region is incorrect.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					sprintf(
						wp_kses( /* translators: %1$s - Mailgun API Key area URL. */
							__( 'Go to your Mailgun account and verify that your <a href="%1$s" target="_blank" rel="noopener noreferrer">Private API Key</a> is correct.', 'easy-wp-smtp' ),
							[
								'a' => [
									'href'   => [],
									'rel'    => [],
									'target' => [],
								],
							]
						),
						'https://app.mailgun.com/app/account/security/api_keys'
					),
					sprintf(
						wp_kses( /* translators: %1$s - Mailgun domains area URL. */
							__( 'Verify your <a href="%1$s" target="_blank" rel="noopener noreferrer">Domain Name</a> is correct.', 'easy-wp-smtp' ),
							[
								'a' => [
									'href'   => [],
									'rel'    => [],
									'target' => [],
								],
							]
						),
						'https://app.mailgun.com/app/sending/domains'
					),
					esc_html__( 'Verify your domain Region is correct.', 'easy-wp-smtp' ),
				],
			],
			// [mailgun] - Free accounts are for test purposes only.
			[
				'mailer'      => 'mailgun',
				'errors'      => [
					[ 'Free accounts are for test purposes only' ],
				],
				'title'       => esc_html__( 'Mailgun failed.', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'Your Mailgun account does not have access to send emails.', 'easy-wp-smtp' ),
					esc_html__( 'Typically this error occurs because you have not set up and/or complete domain name verification for your Mailgun account.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					sprintf(
						wp_kses( /* translators: %s - Mailgun documentation URL. */
							__( 'Go to our how-to guide for setting up <a href="%s" target="_blank" rel="noopener noreferrer">Mailgun with Easy WP SMTP</a>.', 'easy-wp-smtp' ),
							[
								'a' => [
									'href'   => [],
									'rel'    => [],
									'target' => [],
								],
							]
						),
						// phpcs:ignore WordPress.Arrays.ArrayDeclarationSpacing.AssociativeArrayFound
						esc_url( easy_wp_smtp()->get_utm_url( 'https://easywpsmtp.com/docs/setting-up-the-mailgun-mailer/', [ 'medium' => 'email-test', 'content' => 'Mailgun with Easy WP SMTP' ] ) )
					),
					esc_html__( 'Complete the steps in section "2. Verify Your Domain".', 'easy-wp-smtp' ),
				],
			],
			// [SMTP.com] - The "channel - not found" issue.
			[
				'mailer'      => 'smtpcom',
				'errors'      => [
					[ 'channel - not found' ],
				],
				'title'       => esc_html__( 'SMTP.com API Error.', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'Your Sender Name option is incorrect.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					esc_html__( 'Please make sure you entered an accurate Sender Name in Easy WP SMTP plugin settings.', 'easy-wp-smtp' ),
				],
			],
		];

		/**
		 * [any] - PHP 7.4.x and PCRE library issues.
		 *
		 * @see https://wordpress.org/support/topic/cant-send-emails-using-php-7-4/
		 */
		if (
			version_compare( phpversion(), '7.4', '>=' ) &&
			defined( 'PCRE_VERSION' ) &&
			version_compare( PCRE_VERSION, '10.0', '>' ) &&
			version_compare( PCRE_VERSION, '10.32', '<=' )
		) {
			$details[] = [
				'mailer'      => 'any',
				'errors'      => [
					[ 'Invalid address:  (setFrom)' ],
				],
				'title'       => esc_html__( 'PCRE library issue', 'easy-wp-smtp' ),
				'description' => [
					esc_html__( 'It looks like your server is running PHP version 7.4.x with an outdated PCRE library (libpcre2) that has a known issue with email address validation.', 'easy-wp-smtp' ),
					esc_html__( 'There is a known issue with PHP version 7.4.x, when using libpcre2 library version lower than 10.33.', 'easy-wp-smtp' ),
				],
				'steps'       => [
					esc_html__( 'Contact your web hosting provider and inform them you are having issues with libpcre2 library on PHP 7.4.', 'easy-wp-smtp' ),
					esc_html__( 'They should be able to resolve this issue for you.', 'easy-wp-smtp' ),
					esc_html__( 'For a quick fix, until your web hosting resolves this, you can downgrade to PHP version 7.3 on your server.', 'easy-wp-smtp' ),
				],
			];
		}

		// Error detection logic.
		foreach ( $details as $data ) {

			// Check for appropriate mailer.
			if ( 'any' !== $data['mailer'] && $this->debug['mailer'] !== $data['mailer'] ) {
				continue;
			}

			$match = false;

			// Attempt to detect errors.
			foreach ( $data['errors'] as $error_group ) {
				foreach ( $error_group as $error_message ) {
					$match = false !== strpos( $this->debug['error_log'], $error_message );
					if ( ! $match ) {
						break;
					}
				}
				if ( $match ) {
					break;
				}
			}

			if ( $match ) {
				return $data;
			}
		}

		// Return defaults.
		return [
			'title'       => esc_html__( 'An issue was detected.', 'easy-wp-smtp' ),
			'description' => [
				esc_html__( 'This means your test email was unable to be sent.', 'easy-wp-smtp' ),
				esc_html__( 'Typically this error is returned for one of the following reasons:', 'easy-wp-smtp' ),
				'<ul>'
					. '<li>' .
						esc_html__( 'Plugin settings are incorrect (wrong SMTP settings, invalid Mailer configuration, etc).', 'easy-wp-smtp' )
					. '</li>'
					. '<li>' .
						esc_html__( 'Your web server is blocking the connection.', 'easy-wp-smtp' )
					. '</li>'
					. '<li>' .
						esc_html__( 'Your host is rejecting the connection.', 'easy-wp-smtp' )
					. '</li>'
				. '</ul>',
			],
			'steps'       => [
				esc_html__( 'Triple check the plugin settings, consider reconfiguring to make sure everything is correct (eg bad copy and paste).', 'easy-wp-smtp' ),
				wp_kses(
					__( 'Contact your web hosting provider and ask them to verify your server can make outside connections. Additionally, ask them if a firewall or security policy may be preventing the connection - many shared hosts block certain ports.<br><strong>Note: this is the most common cause of this issue.</strong>', 'easy-wp-smtp' ),
					[
						'strong' => [],
						'br'     => [],
					]
				),
				esc_html__( 'Try using a different mailer.', 'easy-wp-smtp' ),
			],
		];
	}

	/**
	 * Displays all the various error and debug details.
	 *
	 * @since 2.0.0
	 */
	protected function display_debug_details() {

		if ( empty( $this->debug ) ) {
			return;
		}

		$debug        = $this->get_debug_details();
		$allowed_tags = [
			'a'      => [
				'href'   => [],
				'rel'    => [],
				'target' => [],
			],
			'p'      => [],
			'strong' => [],
			'b'      => [],
			'i'      => [],
			'br'     => [],
			'code'   => [],
			'ul'     => [],
			'ol'     => [],
			'li'     => [],
			'pre'    => [],
		];

		?>
		<div class="easy-wp-smtp-test-email-debug">
			<div id="message" class="notice-error notice-inline">
				<p><?php esc_html_e( 'There was a problem while sending the test email.', 'easy-wp-smtp' ); ?></p>
			</div>

			<h2><?php echo esc_html( $debug['title'] ); ?></h2>

			<?php
			foreach ( $debug['description'] as $description ) {
				$description = wp_kses( $description, $allowed_tags );
				if ( substr( $description, 0, 1 ) !== '<' ) {
					echo '<p>' . $description . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					echo $description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			?>

			<h2><?php esc_html_e( 'Recommended next steps:', 'easy-wp-smtp' ); ?></h2>

			<ol>
				<?php foreach ( $debug['steps'] as $step ) : ?>
					<li><?php echo wp_kses( $step, $allowed_tags ); ?></li>
				<?php endforeach; ?>
			</ol>

			<h2><?php esc_html_e( 'Need support?', 'easy-wp-smtp' ); ?></h2>

			<p>
				<?php
				printf(
					wp_kses( /* translators: %s - Easy WP SMTP support forum URL. */
						__( 'You can <a href="%s" target="_blank" rel="noopener noreferrer">create a support thread</a> on the WordPress.org support forums.', 'easy-wp-smtp' ),
						array(
							'a' => array(
								'href'   => array(),
								'rel'    => array(),
								'target' => array(),
							),
						)
					),
					'https://wordpress.org/support/plugin/easy-wp-smtp/'
				);
				?>
			</p>

			<p>
				<em><?php esc_html_e( 'Please copy the error log message below into the support ticket.', 'easy-wp-smtp' ); ?></em>
			</p>

			<p class="easy-wp-smtp-btn-group">
				<button type="button" class="easy-wp-smtp-error-log-toggle easy-wp-smtp-btn easy-wp-smtp-btn--secondary">
					<?php esc_html_e( 'View Full Error Log', 'easy-wp-smtp' ); ?>
				</button>
				<button type="button" class="easy-wp-smtp-error-log-copy easy-wp-smtp-btn easy-wp-smtp-btn--tertiary">
					<span class="easy-wp-smtp-error-log-copy-front">
						<?php esc_html_e( 'Copy Error Log', 'easy-wp-smtp' ); ?>
					</span>
					<span class="easy-wp-smtp-error-log-copy-back">
						<?php esc_html_e( 'Copied', 'easy-wp-smtp' ); ?>
					</span>
				</button>
			</p>

			<div class="easy-wp-smtp-error-log notice-error notice-inline">
				<?php echo wp_kses( $this->debug['error_log'], $allowed_tags ); ?>
			</div>
		</div>

		<!-- Scroll to the error container. -->
		<script>
			jQuery( function( $ ) {
				$( 'html, body' ).animate( {
					scrollTop: $( ".easy-wp-smtp-test-email-debug" ).offset().top - 50
				}, 500 );
			} );
		</script>
		<?php
	}
}