<?php
/**
 * CoCart - WooCommerce Admin: Need Help?
 *
 * Adds a note to ask the client if they need help with CoCart.
 *
 * @author   Sébastien Dumont
 * @category Admin
 * @package  CoCart\Admin\WooCommerce Admin\Notes
 * @since    2.3.0
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CoCart_WC_Admin_Need_Help_Note extends CoCart_WC_Admin_Notes {

	/**
	 * Name of the note for use in the database.
	 */
	const NOTE_NAME = 'cocart-wc-admin-need-help';

	/**
	 * Constructor
	 */
	public function __construct() {
		self::add_note( self::NOTE_NAME, 8 * DAY_IN_SECONDS );
	}

	/**
	 * Add note.
	 *
	 * @access public
	 * @static
	 * @param $note_name  Note name.
	 * @param $seconds    How many seconds since CoCart was installed before the notice is shown.
	 * @param $source     Source of the note.
	 */
	public static function add_note( $note_name = '', $seconds = '', $source = 'cocart' ) {
		parent::add_note( $note_name, $seconds, $source );

		$args = self::get_note_args();

		// If no arguments return then we cant create a note.
		if ( is_array( $args ) && empty( $args ) ) {
			return;
		}

		// Otherwise, create new note.
		self::create_new_note( $args );
	} // END add_note()

	/**
	 * Get note arguments.
	 *
	 * @access public
	 * @static
	 * @return array
	 */
	public static function get_note_args() {
		$args = array(
			'title'   => __( 'Need help with CoCart?', 'cart-rest-api-for-woocommerce' ),
			'content' => __( 'You can ask a question on the support forum, discuss with other CoCart developers in the Slack community or get priority support.', 'cart-rest-api-for-woocommerce' ),
			'name'    => self::NOTE_NAME,
			'actions' => array(
				array(
					'name'    => 'cocart-learn-more-support',
					'label'   => __( 'Learn more', 'cart-rest-api-for-woocommerce' ),
					'url'     => 'https://cocart.xyz/support/?utm_source=inbox',
					'status'  => Automattic\WooCommerce\Admin\Notes\WC_Admin_Note::E_WC_ADMIN_NOTE_UNACTIONED,
					'primary' => true
				)
			)
		);

		return $args;
	} // END get_note_args()

} // END class

return new CoCart_WC_Admin_Need_Help_Note();