<?php

/**
 * This addon Adds the REST API endpoint for WooCommerce Payment via PayPal Standard.
 *
 * @since      1.4.0
 *
 * @link https://docs.woocommerce.com/document/paypal-standard/ PayPal Standard
 *
 * @package    Wc_Rest_Payment
 * @subpackage Wc_Rest_Payment/includes/gateways
 * @author     Jacktator
 */

class WC_REST_Gateway_PayPal {

	/**
	 * The ID of the corresponding WooCommerce Payment Gateway.
	 *
	 * @since    1.4.0
	 * @var      string    $id    The ID of the corresponding Gateway.
	 *
	 * @link https://github.com/woocommerce/woocommerce/blob/master/includes/gateways/paypal/class-wc-gateway-paypal.php#L40 Gateway ID
	 * @author Jacktator
	 *
	 */
	public $gateway_id = 'paypal';

	/**
	 * The version of this plugin.
	 *
	 * @since    1.4.0
	 * @var      string    $version    The current version of corresponding Gateway.
	 *
	 * @link https://github.com/woocommerce/woocommerce/blob/master/includes/gateways/paypal/class-wc-gateway-paypal.php#L9 Gateway Version
	 * @author Jacktator
	 */
	private $gateway_version = '2.3.0';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.1.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct() {

	}

	/**
	 * Add Action to precheck, prepare params before the Gateway calls 'process_payment'
	 *
	 * @since 1.4.0
	 * @author Jacktator
	 */
	public function wrp_pre_process_payment($parameters) {
		// Silence is gold.

		$parameters['pre_process_result'] = true;
		return $parameters;
	}

}
