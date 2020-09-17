<div id="slider-wrapper">
	<div id="slider">
		<div class="sp es-send-email-screen" >
			<?php $from_name = get_option( 'ig_es_from_name'); ?>
			<?php $from_email = get_option( 'ig_es_from_email'); ?>
			<h1> 👍 <?php echo esc_html__( '80% done!', 'email-subscribers' ); ?></h1>
			<p><?php echo esc_html__( 'We have automatically :', 'email-subscribers' ); ?></p>
			<ol>
				<li>
					<?php
						/* translators: 1: Starting anchor tag with list URL 2: Closing anchor tag */
						echo sprintf( esc_html__( 'Created two Lists - %1$sMain%2$s and %1$sTest%2$s', 'email-subscribers'), '<a href="' . esc_url( admin_url( 'admin.php?page=es_lists' ) ) . '" target="_blank">', '</a>' );
					?>
				</li>
				<li><?php echo esc_html__( 'Added you', 'email-subscribers'); ?> <strong style="font-weight: 700;color: #4a5568;" >(<?php echo esc_html( get_option('admin_email') ); ?>)</strong> <?php echo esc_html__( 'to both lists', 'email-subscribers' ); ?> 
				</li>
				<li>
					<?php
						/* translators: 1: Starting anchor tag with forms URL 2: Closing anchor tag */
						echo sprintf( esc_html__( 'Created a %1$s subscription / lead collection optin form%2$s', 'email-subscribers'), '<a href="' . esc_url( admin_url( 'admin.php?page=es_forms') ) . '" target="_blank">', '</a>' );
					?>
				</li>
				<li> 
					<?php
						/* translators: 1: Starting anchor tag with widgets URL 2: Closing anchor tag */
						echo sprintf( esc_html__( 'Added optin form to %1$sdefault widget area%2$s to show it on your site', 'email-subscribers' ), '<a href="' . esc_url( admin_url('widgets.php') ) . '" target="_blank">', '</a>' );
					?>
				</li>
			</ol>
			<div class="es-form-wrapper">
				<div class="es-form-next" style="padding: 0.5em 0.8em; border-radius: 1.5rem;color: #737373;">
					<?php
						/* translators: 1: Starting strong tag 2: Closing strong tag 3: Line break tag */	
						echo sprintf( esc_html__(' We will create "%1$sNewsletter Broadcast%2$s" and "%1$sNew Post Notification%2$s" campaigns.  Next step is to test everything by %1$ssending test campaigns%2$s.%3$sWe\'ve already added you, but recommend adding another email to test.', 'email-subscribers'), '<strong style="font-weight: 647;color: hsl(0, 0%, 30%);" >', '</strong>', '<br />');
					?>
					<br/>
					<?php
						/* translators: 1: Starting strong tag 2: Closing strong tag */
						echo sprintf( esc_html__('But before test %1$sverify your sender details%2$s', 'email-subscribers'), '<strong style="font-weight: 647;color: hsl(0, 0%, 30%);" >', '</strong>' );
					?>
				</div>
				<form id="es-send-email-form" style="padding: 0.5em 0.8em;">
					<label><strong style="font-weight: 700;color: #4a5568;" ><?php echo esc_html__('Sender', 'email-subscribers'); ?></strong></label><br/>
					<input  type="text" name="es_from_name" class="es_from_name" value="<?php echo esc_attr( $from_name ); ?>" required style="padding: 0.5em 0.5em; border: 1px solid #dcdcdc; "/>
					<input  type="email" name="es_from_email" class="es_from_email" value="<?php echo esc_attr( $from_email ); ?>" required style="padding: 0.5em 0.5em; border: 1px solid #dcdcdc; "/><br/>
					<p style="margin: 1em 0 0.8em 0;"><label><strong style="font-weight: 700;color: #4a5568;" ><?php echo esc_html__('Add an email to send a test to:', 'email-subscribers'); ?></strong></label><br/>
					<input  type="email" placeholder="abc@gmail.com" name="es_test_email[]" class="es_email" required style="padding: 0.5em 0.5em; border: 1px solid #dcdcdc; margin-top: 0.4em; "/>
					<a id="button-send" class="button-send"><?php echo esc_html__('Create and Send test campaigns', 'email-subscribers'); ?></a>
					<img class="es-loader" src="<?php echo esc_url( ES_PLUGIN_URL . 'lite/public/images/spinner.gif' ); ?>"  style="display:none;margin-top:0.5rem"/>
					</p>
				</form>
			</div>
		</div>
		<div class="sp es-success" >
			<h1 style="color: #38a169;"><?php echo esc_html__('Test emails sent, check your inbox'); ?></h1>
			<div class="es-sent-success">
				<div class="es-gray" style="padding: 1rem 0 0 0;">
					<?php
						/* translators: %s: Site admin email */
						echo sprintf( esc_html__( 'We have sent two campaigns to %s and the email you have added.', 'email-subscribers' ), '<strong style="font-weight: 700;color: #4a5568;" >' . esc_html( get_option( 'admin_email' ) ) . '</strong>' );
					?>
					
				</div>
				<div class="es-gray"><?php echo esc_html__( 'They may take a few minutes to arrive. But do confirm you received them.', 'email-subscribers' ); ?></div>
			</div>
			<div class="emoji" style="text-align: center; font-size: 10em; opacity: 0.45;padding: 0.5rem 0 0 0;"> 📨 </div>
			<div class="es-actions">
				<div class="button button-hero es-receive-success-btn" style="width: 100%; text-align: center;padding: 0;"><?php echo esc_html__('Yes, I received the test emails', 'email-subscribers'); ?></div>
				<div style="margin-top: 0.7em;"><a href="#" class="es-secondary es-receive-error-btn"><u><?php echo esc_html__('No, I haven\'t received them yet', 'email-subscribers'); ?></u></a></div>
			</div>
		</div>
		<div class="sp es-receive-success">
			<h1> 👍 <?php echo esc_html__('We\'re done!'); ?></h1>
			<div>
				<div class="" style="color: #737373; line-height: 1.75;padding: 1rem 0 0 0;"><?php echo esc_html__('Everything is setup now. It\'s a perfect time to get better at email marketing now.', 'email-subscribers'); ?>
				 <br/><span style="font-weight: 500;"><?php echo esc_html__('Sign up ', 'email-subscribers'); ?></span><?php echo esc_html__('below to get our highly acclaimed course for free.', 'email-subscribers'); ?>
				</div>
				<form name="klawoo_subscribe" action="#" method="POST" accept-charset="utf-8" class="es-onboarding" style="margin-right: 0; margin-top: 1em; /* text-align: center; */ ">
					<input class="es-ltr" type="text" name="name" id="name" placeholder="Your Name"/> <br />
					<input class="es-ltr" type="text" name="email" id="email" placeholder="Your Email" required/> <br />
					<input type="hidden" name="list" value="hN8OkYzujUlKgDgfCTEcIA"/>
					<input type="hidden" name="form-source" value="es_email_send_success"/>
					<div style="margin-top: 0.5rem;">
						<input type="checkbox" name="es-gdpr-agree" id ="es-gdpr-agree" value="1" required="required">
						<label for="es-gdpr-agree" style="font-size: 0.9em; color: #777777; ">
						<?php
							/* translators: %s: Icegram Privacy Policy text with anchor tag */
							echo sprintf( esc_html__( 'I have read and agreed to your %s.', 'email-subscribers' ), '<a href="https://www.icegram.com/privacy-policy/" target="_blank" style="font-weight:500">' . esc_html__( 'Privacy Policy', 'email-subscribers' ) . '</a>' );
						?>
						</label>
					</div>
					<input type="submit" name="submit" id="submit" class="button button-hero" style="padding: 0; width: 320px;margin-top: 0.5rem;" value="<?php echo esc_html__( 'Signup and send me the course for free', 'email-subscribers' ); ?>">
					<div style="text-align: center; width: 56%; margin-top: 0.5em;"><a class="es-skip" href="<?php echo esc_url( admin_url( 'admin.php?page=es_dashboard&es_skip=1&option_name=email_send_success') ); ?>"><u><?php echo esc_html__('Skip and goto Dashboard', 'email-subscribers'); ?></u></a></div>
					<br>
					<p id="klawoo_response"></p>
				</form>
			</div>
		</div>
		<div class="sp es-receive-error">
			<h1><?php echo esc_html__('Check these few things below'); ?></h1>
			<ul style="padding: 1rem 0 0 0;">
				<li>
					<?php
						/* translators: 1: Starting bold tag 2: Closing bold tag */
						echo sprintf( esc_html__( '1. Check your %1$sspam%2$s or %1$sjunk%2$s folder', 'email-subscribers'), '<b style="color:#737373;font-weight:500">', '</b>' );
					?>
				</li>
				<li>
					<?php
						/* translators: 1: Starting anchor tag 2: Closing anchor tag */
						echo sprintf( esc_html__('2. %1$sSend another test email%2$s with different email address ', 'email-subscribers'), '<a href="' . esc_url( admin_url('admin.php?page=es_settings#tabs-email_sending') ) . '" target="_blank">', '</a>');
					?>
				</li>
				<li>
					<?php
						/* translators: 1: Starting strong tag 2: Closing strong tag */
						echo sprintf( esc_html__( '3. Is %1$s' . get_option('admin_email') . '%2$s email free/disposable?', 'email-subscribers' ), '<strong style="color: #4a5568;">', '</strong>' );
					?>
				</li>
				<li style="margin-top: 1rem"><a href="https://www.icegram.com/documentation/reasons-why-you-havent-received-the-test-email/?utm_source=es&utm_medium=es_onboarding&utm_campaign=view_docs_help_page" target="_blank"  style="font-weight: 600; font-size:1.06em;"> <?php echo esc_html__('Explore more', 'email-subscribers'); ?></a></li>
			</ul>
			<div class="">
				<div class="es-gray"><?php echo esc_html__('Also, it\'s a perfect time to get better at email marketing now.', 'email-subscribers'); ?>
					 <br/><span style="font-weight: 500;"><?php echo esc_html__('Sign up ', 'email-subscribers'); ?></span><?php echo esc_html__('below to get our highly acclaimed course for free.', 'email-subscribers'); ?>
				</div>
				<form name="klawoo_subscribe" action="#" method="POST" accept-charset="utf-8" class="es-onboarding" style="margin-top: 1em;">
					<input class="es-ltr" type="text" name="name" id="name" placeholder="Your Name"/> <br />
					<input class="es-ltr" type="text" name="email" id="email" placeholder="Your Email" required/> <br />
					<input type="hidden" name="list" value="hN8OkYzujUlKgDgfCTEcIA"/>
					<input type="hidden" name="form-source" value="es_email_receive_error"/>
					<div style="margin-top: 0.5rem;">
						<input type="checkbox" name="es-gdpr-agree" id ="es-gdpr-agree" value="1" required="required">
						<label for="es-gdpr-agree" style="font-size: 0.9em; color: #777777;">
						<?php
							/* translators: %s: Icegram Privacy Policy text with anchor tag */
							echo sprintf(esc_html__( 'I have read and agreed to your %s.', 'email-subscribers' ), '<a href="https://www.icegram.com/privacy-policy/" target="_blank" style="font-weight:500">' . esc_html__( 'Privacy Policy', 'email-subscribers' ) . '</a>' );
						?>
						</label>
					</div>
					<input type="submit" name="submit" id="submit" class="button button-hero" style="margin-top: 0.5em;" value="<?php echo esc_html__('Signup and send me the course for free', 'email-subscribers' ); ?>">
					<div style="text-align: center; width: 56%; margin-top: 0.5em;"><a class="es-skip" href="<?php echo esc_url( admin_url('admin.php?page=es_dashboard&es_skip=1&option_name=email_receive_error') ); ?>" ><u><?php echo esc_html__('Skip and goto Dashboard', 'email-subscribers'); ?></u></a></div>
					<br>
					<p id="klawoo_response"></p>
				</form>
			</div>
		</div>
		<div class="sp es-error" >
			<h1 style="	color: #e53e3e;">⚠️ <?php echo esc_html__('Problem sending emails - fix this first.'); ?></h1>
				<p style="font-weight: 500"><?php echo esc_html__('We faced some problems sending Test Campaigns.'); ?></p>
				<div class="es-email-sending-error"></div>
				<div style="margin-top: 1rem;"><a href="https://www.icegram.com/documentation/common-email-sending-problems/?utm_source=es&utm_medium=es_onboarding&utm_campaign=view_docs_help_page" target="_blank"  style="font-weight: 600;font-size: 1.06em;line-height: 2em; "> <?php echo esc_html__('Explore more about problems', 'email-subscribers'); ?></a></div>
				<div class="es-gray"><?php echo esc_html__('Please solve these problems, without that email sending won\'t work.'); ?></div>
				<div style="margin-top: 1em;">
					<div class="es-gray"><?php echo esc_html__('Also, it\'s a perfect time to get better at email marketing now.', 'email-subscribers'); ?>
					 <br/><span style="font-weight: 500;"><?php echo esc_html__('Sign up ', 'email-subscribers'); ?></span><?php echo esc_html__('below to get our highly acclaimed course for free.', 'email-subscribers'); ?>
					</div>
					<form name="klawoo_subscribe" action="#" method="POST" accept-charset="utf-8" class="es-onboarding">
						<input class="es-ltr" type="text" name="name" id="name" placeholder="Your Name"/> <br />
						<input class="es-ltr" type="text" name="email" id="email" placeholder="Your Email" required/> <br />
						<input type="hidden" name="list" value="hN8OkYzujUlKgDgfCTEcIA"/>
						<input type="hidden" name="form-source" value="es_email_send_error"/>
						<div style="margin-top: 0.5rem;">
							<input type="checkbox" name="es-gdpr-agree" id ="es-gdpr-agree" value="1" required="required">
							<label for="es-gdpr-agree" style="font-size: 0.9em; color: #777777; ">
							<?php
								/* translators: %s: Icegram Privacy Policy text with anchor tag */
								echo sprintf(esc_html__( 'I have read and agreed to your %s.', 'email-subscribers' ), '<a href="https://www.icegram.com/privacy-policy/" target="_blank" style="font-weight:500">' . esc_html__( 'Privacy Policy', 'email-subscribers' ) . '</a>' );
							?>
							</label>
						</div>
						<input type="submit" name="submit" id="submit" class="button button-hero" style="margin-top: 0.5rem;" value="<?php echo esc_html__( 'Signup and send me the course for free', 'email-subscribers' ); ?>">
						<div style="text-align: center; width: 56%; margin-top: 0.5em;"><a class="es-skip" href="<?php echo esc_url( admin_url('admin.php?page=es_dashboard&es_skip=1&option_name=email_send_error') ); ?>"><u><?php echo esc_html__('Skip and goto Dashboard', 'email-subscribers'); ?></u></a></div>
						<br>
						<p id="klawoo_response"></p>
					</form>
				</div>
		</div>
		
	</div>
</div>
