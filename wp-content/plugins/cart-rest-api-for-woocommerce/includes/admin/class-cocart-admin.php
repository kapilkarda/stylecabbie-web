<?php
/**
 * CoCart - Admin.
 *
 * @author   Sébastien Dumont
 * @category Admin
 * @package  CoCart\Admin
 * @since    1.2.0
 * @version  2.6.0
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CoCart_Admin' ) ) {

	class CoCart_Admin {

		/**
		 * Constructor
		 *
		 * @access public
		 */
		public function __construct() {
			$this->includes();
		} // END __construct()

		/**
		 * Include any classes we need within admin.
		 *
		 * @access  public
		 * @since   1.2.0
		 * @version 2.6.0
		 */
		public function includes() {
			include_once COCART_ABSPATH . 'includes/admin/class-cocart-admin-action-links.php';         // Action Links
			include_once COCART_ABSPATH . 'includes/admin/class-cocart-admin-assets.php';               // Admin Assets
			include_once COCART_ABSPATH . 'includes/admin/class-cocart-admin-plugin-screen-update.php'; // Plugin Screen Update
			include_once COCART_ABSPATH . 'includes/admin/class-cocart-admin-menus.php';                // Admin Menus
			include_once COCART_ABSPATH . 'includes/admin/class-cocart-admin-notices.php';              // Plugin Notices
			include_once COCART_ABSPATH . 'includes/admin/class-cocart-wc-admin-notices.php';           // WooCommerce Admin Notices
			include_once COCART_ABSPATH . 'includes/admin/class-cocart-wc-admin-system-status.php';     // WooCommerce System Status
		} // END includes()

	} // END class

} // END if class exists

return new CoCart_Admin();
