<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists('FPD_Admin_Status') ) {

	class FPD_Admin_Status {

		public function output() {

			?>
			<div class="wrap" id="fpd-manage-status">

				<h2 class="fpd-clearfix">
					<?php _e('Status', 'radykal'); ?>
					<?php fpd_admin_display_version_info(); ?>
				</h2>
				<br class="clear">

				<table class="fpd-status-table widefat" cellspacing="0">
					<thead>
						<tr>
							<th colspan="2"><strong>Server Environment</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<em><?php esc_html_e('PHP Version', 'radykal'); ?></em>
								<span class="fpd-admin-tooltip" title="<?php esc_attr_e('The PHP version installed on your server.', 'radykal'); ?>"><i class="fpd-icon-info-outline"></i></span>
							</td>
							<td>
								<?php echo PHP_VERSION ?>
							</td>
						</tr>
						<tr>
							<td>
								<em><?php esc_html_e('Web Server Info', 'radykal'); ?></em>
								<span class="fpd-admin-tooltip" title="<?php esc_attr_e('The current server software that is used on your web hosting.', 'radykal'); ?>"><i class="fpd-icon-info-outline"></i></span>
							</td>
							<td>
								<?php esc_html_e( $_SERVER['SERVER_SOFTWARE'] ); ?>
							</td>
						</tr>
						<tr>
							<td>
								<em><?php esc_html_e('Memory Limit', 'radykal'); ?></em>
								<span class="fpd-admin-tooltip" title="<?php esc_attr_e('The maximum amount of memory in bytes that a script is allowed to allocate.', 'radykal'); ?>"><i class="fpd-icon-info-outline"></i></span>
							</td>
							<td>
								<?php esc_html_e( ini_get('memory_limit') ); ?>
							</td>
						</tr>
						<tr>
							<td>
								<em><?php esc_html_e('POST Max. Size', 'radykal'); ?></em>
								<span class="fpd-admin-tooltip" title="<?php esc_attr_e('The largest filesize that can be sent via one POST.', 'radykal'); ?>"><i class="fpd-icon-info-outline"></i></span>
							</td>
							<td>
								<?php esc_html_e( ini_get('post_max_size') ); ?>
							</td>
						</tr>
						<tr>
							<td>
								<em><?php esc_html_e('Uploaded Max. Filesize', 'radykal'); ?></em>
								<span class="fpd-admin-tooltip" title="<?php esc_attr_e('The maximum size of an uploaded file.', 'radykal'); ?>"><i class="fpd-icon-info-outline"></i></span>
							</td>
							<td>
								<?php esc_html_e( ini_get('upload_max_filesize') ); ?>
							</td>
						</tr>
						<tr>
							<td>
								<em><?php esc_html_e('Max. Execution Time', 'radykal'); ?></em>
								<span class="fpd-admin-tooltip" title="<?php esc_attr_e('The maximum time in seconds a script is allowed to run.', 'radykal'); ?>"><i class="fpd-icon-info-outline"></i></span>
							</td>
							<td>
								<?php esc_html_e( ini_get('max_execution_time') ); ?>
							</td>
						</tr>
						<?php

							$classes_funcs = array(
								array(
									'type' => 'class',
									'name' => 'ZipArchive',
									'info' => __('Necessary for zipping/unzipping exported or imported products.', 'radykal')
								),
								array(
									'type' => 'function',
									'name' => 'getimagesize',
									'info' => __('Checks if file is an image.', 'radykal')
								),
								array(
									'type' => 'function',
									'name' => 'exif_read_data',
									'info' => __('Gets the orientation of an uploaded image. Required to rotate images uploaded from mobile devices correctly.', 'radykal')
								),
								array(
									'type' => 'function',
									'name' => 'curl_exec',
									'info' => __('Writes files on the server.', 'radykal')
								),
								array(
									'type' => 'INI',
									'name' => 'allow_url_fopen',
									'info' => __('Allows to read remote files.', 'radykal')
								)
							);

							foreach($classes_funcs as $cf) {

								$success_label = __( 'Installed', 'radykal' );
								$error_label = __( 'Not Installed', 'radykal' );

								if( $cf['type'] == 'INI' ) {
									$success_label = __( 'Activated', 'radykal' );
									$error_label = __( 'Disabled', 'radykal' );
								}

								if( $cf['type'] == 'class' && class_exists($cf['name']) )
									$status = '<span class="fpd-success-text"><span class="dashicons dashicons-yes"></span> '. $success_label .' </span>';
								else if( $cf['type'] == 'function' && function_exists($cf['name']) )
									$status = '<span class="fpd-success-text"><span class="dashicons dashicons-yes"></span> '. $success_label .' </span>';
								else if( $cf['type'] == 'INI' && (bool) ini_get($cf['name']) )
									$status = '<span class="fpd-success-text"><span class="dashicons dashicons-yes"></span> '. $success_label .' </span>';
								else
									$status = '<span class="fpd-error-text"><span class="dashicons dashicons-no"></span> '. $error_label .' </span>';

								echo '<tr><td><em>'. $cf['type'].'</em>: '.$cf['name'].'<span class="fpd-admin-tooltip" title="'. esc_attr($cf['info']) .'"><i class="fpd-icon-info-outline"></i></span></td><td>'. $status .'</td></tr>';

							}

							do_action( 'fpd_status_server_table_end' );
						?>
					</tbody>
				</table>
				<p class="description"><?php _e( 'If any class or function is missing, please install these. Otherwise Fancy Product Designer may not work correctly. If you do not know how to install/activate the PHP classes/functions, please ask your server hoster!', 'radykal' ); ?></p>
				<br /><br />

				<table class="fpd-status-table widefat" cellspacing="0">
					<thead>
						<tr>
							<th colspan="3"><strong>Tools</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<em><?php _e('Reset Image Sources', 'radykal'); ?></em>
								<span class="fpd-admin-tooltip" title="<?php esc_attr_e('Use this tool when you move your site to another domain or the protocol has been updated.', 'radykal'); ?>"><i class="fpd-icon-info-outline"></i></span>
							</td>
							<td>
								<input type="text" id="fpd-old-domain" class="widefat" placeholder="<?php esc_attr_e('Enter the old domain incl. protocol (http or https), e.g. https://domain.com', 'radykal'); ?>" />
							</td>
							<td>
								<button class="button-secondary" id="fpd-reset-image-sources"><?php _e('Reset', 'radykal'); ?></button>
							</td>
						</tr>
						<?php do_action( 'fpd_status_tools_table_end' ); ?>
					</tbody>
				</table>
				<div id="fpd-updated-infos" class="fpd-hidden">
					<h4><?php _e('Updated Entries in Database Tables'); ?></h4>
					<ul>
						<li><?php _e('Views'); ?>: <span id="fpd-updated-views"></span></li>
						<li><?php _e('Templates'); ?>: <span id="fpd-updated-templates"></span></li>
						<li><?php _e('Shortcode Orders'); ?>: <span id="fpd-updated-sc-orders"></span></li>
						<li><?php _e('WooCommerce Orders'); ?>: <span id="fpd-updated-wc-orders"></span></li>
					</ul>
				</div>

			</div>
			<script type="text/javascript">

				jQuery(document).ready(function() {


					jQuery('#fpd-reset-image-sources').click(function(evt) {

						evt.preventDefault();

						var $this = jQuery(this),
							$updatedInfo = jQuery('#fpd-updated-infos').addClass('fpd-hidden');
							oldDomain = jQuery('#fpd-old-domain').val();

						var regexURL = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
						if(!regexURL.test(oldDomain)) {

							fpdMessage("<?php _e('Entered string is not a valid URL!', 'radykal'); ?>", 'error');
							return;
						}

						$this.addClass('fpd-loading');
						jQuery.ajax({
							url: fpd_admin_opts.adminAjaxUrl,
							data: {
								action: 'fpd_resetimagesources',
								_ajax_nonce: fpd_admin_opts.ajaxNonce,
								old_domain: oldDomain
							},
							type: 'post',
							dataType: 'json',
							success: function(data) {

								if(data && data.new_domain) {
									$updatedInfo.removeClass('fpd-hidden');
									$updatedInfo.find('#fpd-updated-views').html(data.updated_views);
									$updatedInfo.find('#fpd-updated-templates').html(data.updated_templates);
									$updatedInfo.find('#fpd-updated-sc-orders').html(data.updated_sc_orders);
									$updatedInfo.find('#fpd-updated-wc-orders').html(data.updated_wc_orders);
								}

								$this.removeClass('fpd-loading');

							}
						});


					})

				});

			</script>
			<?php

		}
	}
}

new FPD_Admin_Status();

?>