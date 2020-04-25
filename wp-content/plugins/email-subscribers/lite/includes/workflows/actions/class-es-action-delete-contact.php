<?php
/**
 * Action to add contact to the selected list
 *
 * @since       4.4.1
 * @author      Icegram
 * @version     1.0
 * @package     Email Subscribers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to add contact to the selected list
 *
 * @class ES_Action_Delete_Contact
 *
 * @since 4.4.1
 */
class ES_Action_Delete_Contact extends ES_Workflow_Action {

	/**
	 * Load action admin details.
	 *
	 * @since 4.4.1
	 */
	public function load_admin_details() {
		$this->title = __( 'Delete Contact', 'email-subscribers' );
		$this->group = __( 'Contact', 'email-subscribers' );
	}

	/**
	 * Called when an action should be run
	 *
	 * @since 4.4.1
	 */
	public function run() {

		global $wpdb;

		$raw_data = $this->workflow->data_layer()->get_raw_data();
		if ( ! empty( $raw_data ) ) {
			foreach ( $raw_data as $data_type_id => $data_item ) {
				$data_type = ES_Workflow_Data_Types::get( $data_type_id );
				if ( ! $data_type || ! $data_type->validate( $data_item ) ) {
					continue;
				}
				$data = $data_type->get_data( $data_item );

				$user_id = ! empty( $data['wp_user_id'] ) ? $data['wp_user_id'] : 0;

				if ( ! empty( $user_id ) ) {
					$user = get_user_by( 'ID', $user_id );

					if ( $user instanceof WP_User ) {
						$email = $user->user_email;

						$where      = $wpdb->prepare( 'email = %s', $email );
						$contact_id = ES()->contacts_db->get_column_by_condition( 'id', $where );

						if ( $contact_id ) {

							ES()->contacts_db->delete_contacts_by_ids( $contact_id );
						}
					}
				}
			}
		}

	}

}
