<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Settings_Automated_Export') ) {

	class FPD_Settings_Automated_Export {

		public static function get_options() {

			return apply_filters('fpd_automated_export_settins', array(

				'ae-general' => array(

					array(
						'title' => __('Output Details', 'radykal'),
						'type' => 'section-title',
						'id' => 'file-output-section',
					),

					array(
						'title' 	=> __( 'Output File', 'radykal' ),
						'description' 		=> __( 'Set the output file that will you or your customers will receive.', 'radykal' ),
						'id' 		=> 'fpd_ae_output_file',
						'default'	=> 'default',
						'type' 		=> 'select',
						'class'		=> 'radykal-select2',
						'css'		=> 'width: 300px',
						'options'   => self::get_export_types()
					),

					array(
						'title' => __('File Receiving', 'radykal'),
						'type' => 'section-title',
						'id' => 'file-receiving-section',
						'description' => class_exists( 'WooCommerce' ) ? __( 'In WooCommerce the customer will receive the file(s) when the order is paid/completed.', 'radykal') : ''
					),

					array(
						'title' 	=> __( 'Download Link in E-Mail (Recommended)', 'radykal' ),
						'description'	 => __( 'A download link will be added in the mail. ', 'radykal' ),
						'id' 		=> 'fpd_ae_email_download_link',
						'default'	=> 'yes',
						'type' 		=> 'checkbox',
					),

					array(
						'title' 	=> __( 'E-Mail Attachment', 'radykal' ),
						'description'	 => __( 'The file(s) will be sent as attachment(s) in the E-Mail. Depending on the files size and the amount of files that need to generated might take a while and your server will reach its <a href="http://php.net/manual/en/function.set-time-limit.php" target="_blank">maximum execution time</a>. So test if your common order process is convenient for this method.', 'radykal' ),
						'id' 		=> 'fpd_ae_email_attachment',
						'default'	=> 'no',
						'type' 		=> 'checkbox',
					),

					array(
						'title' => __('Recipients', 'radykal'),
						'type' => 'section-title',
						'id' => 'recipients-section'
					),

					array(
						'title' 	=> __( 'Administrator', 'radykal' ),
						'description'	 => __( 'The administrator will receive the file when a new order is made.', 'radykal' ),
						'id' 		=> 'fpd_ae_recipient_admin',
						'default'	=> 'yes',
						'type' 		=> 'checkbox',
					),

					array(
						'title' 	=> __( 'Customer', 'radykal' ),
						'description'	 => __( 'Only in WooCommerce. The customer will receive the file when the WooCommerce order is completed/paid.', 'radykal' ),
						'id' 		=> 'fpd_ae_recipient_customer',
						'default'	=> 'no',
						'type' 		=> 'checkbox',
					),

					array(
						'title' => __('ADMIN solution', 'radykal'),
						'type' => 'section-title',
						'id' => 'admin-section'
					),

					array(
						'title' => __( 'API Key', 'radykal' ),
						'description' 		=> 'Enter the ADMIN API key. You can find it in the Site Configurations of a connected website in ADMIN.',
						'id' 		=> 'fpd_ae_admin_api_key',
						'css' 		=> 'width: 100%;',
						'type' 		=> 'text',
						'default'	=> '',
						'value' => ''
					),

				)

			));

		}

		public static function get_export_types() {

			return array(
				'pdf' => 'PDF',
				'jpeg' => 'JPEG',
				'png' => 'PNG',
				'zip_pdf_fonts' => __('Archive containing PDF and used fonts', 'radykal')
			);

		}

		public static function get_recipients() {

			return array(
				'admin' => __('Administrator', 'radykal'),
				'customer' =>  __('Customer', 'radykal')
			);

		}

	}

}