<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sk8.tech
 * @since      1.1.0
 *
 * @package    Wc_Rest_Payment
 * @subpackage Wc_Rest_Payment/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wc_Rest_Payment
 * @subpackage Wc_Rest_Payment/public
 * @author     SK8Tech <support@sk8.tech>
 */
class Wc_Rest_Payment_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.1.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register Single REST API Route to handle 'process_payment'
	 *
	 * @author Jacktator
	 * @since 1.4.0
	 */
	public function wrp_register_rest_api_route() {
		/**
		 * Handle Process Payment request.
		 */
		register_rest_route('wc/v2', 'process_payment', array(
			'methods' => 'POST',
			'callback' => array($this, 'wrp_process_payment'),
		));
	}

	/**
	 * Find the selected Gateway, and process payment
	 *
	 * @author Jacktator
	 * @since 1.4.0
	 */
	public function wrp_process_payment($request = null) {

		// Create a Response Object
		$response = array();

		// Get JSON parameters
		$parameters = $request->get_json_params();
		$order_id = sanitize_text_field($parameters['order_id']);
		$payment_method = sanitize_text_field($parameters['payment_method']);

		$error = new WP_Error();

		// Perform Pre Checks
		if (!class_exists('WooCommerce')) {
			$error->add(400, __("Failed to process payment. WooCommerce either missing or deactivated.", 'wc-rest-payment'), array('status' => 400));
			return $error;
		}
		if (empty($order_id)) {
			$error->add(401, __("Order ID 'order_id' is required.", 'wc-rest-payment'), array('status' => 400));
			return $error;
		} else if (wc_get_order($order_id) == false) {
			$error->add(402, __("Order ID 'order_id' is invalid. Order does not exist.", 'wc-rest-payment'), array('status' => 400));
			return $error;
		} else if (wc_get_order($order_id)->get_status() !== 'pending' && wc_get_order($order_id)->get_status() !== 'failed') {
			$error->add(403, __("Order status is '" . wc_get_order($order_id)->get_status() . "', meaning it had already received a successful payment. Duplicate payments to the order is not allowed. The allow status it is either 'pending' or 'failed'. ", 'wc-rest-payment'), array('status' => 400));
			return $error;
		}
		if (empty($payment_method)) {
			$error->add(404, __("Payment Method 'payment_method' is required.", 'wc-rest-payment'), array('status' => 400));
			return $error;
		}

		// Find Gateway
		$avaiable_gateways = WC()->payment_gateways->get_available_payment_gateways();
		$gateway = $avaiable_gateways[$payment_method];

		if (empty($gateway)) {
			$all_gateways = WC()->payment_gateways->payment_gateways();
			$gateway = $all_gateways[$payment_method];

			if (empty($gateway)) {
				$error->add(405, __("Failed to process payment. WooCommerce Gateway '" . $payment_method . "' is missing.", 'wc-rest-payment'), array('status' => 400));
				return $error;
			} else {
				$error->add( 406, __( "Failed to process payment. WooCommerce Gateway '" . $payment_method . "' exists, but is not available.", 'wc-rest-payment' ), array( 'status' => 400 ) );
				return $error;
			}
		} else if ( ! has_filter( 'wrp_pre_process_' . $payment_method . '_payment' ) ) {
			$error->add( 407, __( "Failed to process payment. WooCommerce Gateway '" . $payment_method . "' exists, but 'WC REST Payment - Stripe Gateway' is not available.", 'wc-rest-payment' ), array( 'status' => 400 ) );

			return $error;
		} else {

			// Pre Process Payment
			$parameters = apply_filters( 'wrp_pre_process_' . $payment_method . '_payment', $parameters );

			if ( $parameters['pre_process_result'] === true ) {

				// Process Payment
				$payment_result = $gateway->process_payment($order_id);
				if ( $payment_result['result'] === "success" ) {
					$response['code']    = 200;
					$response['message'] = __("Payment Successful.", "wc-rest-payment");
					$response['data']    = $payment_result;

					// Return Successful Response
					return new WP_REST_Response($response, 200);
				} else {
					return new WP_Error( 500, 'Payment Failed, Check WooCommerce Status Log for further information.', $payment_result );
				}
			} else {
				return new WP_Error( 408, 'Payment Failed, Pre Process Failed.', $parameters['pre_process_result'] );
			}

		}

	}

	/**
	 * Add the endpoints to the API.
	 *
	 * Deprecated, use 'wrp_register_rest_api_route' instead.
	 *
	 * @deprecated
	 *
	 * @author Jack
	 * @since 1.1.0
	 *
	 */
	public function add_api_routes() {
		/**
		 * Handle Process Payment request.
		 */
		register_rest_route('wc/v2', 'payment', array(
			'methods' => 'POST',
			'callback' => array($this, 'process_payment'),
		));
	}

	/**
	 * Get the payment token and order id in the request body and Process Payment
	 *
	 * Deprecated, use 'wrp_process_payment' instead.
	 *
	 * @deprecated
	 *
	 * @author Jack
	 *
	 * @since    1.1.0
	 *
	 * @param [type] $request [description]
	 *
	 * @return [type] [description]
	 */
	public function process_payment($request = null) {

		$response = array();
		$parameters = $request->get_json_params();
		$payment_method = sanitize_text_field($parameters['payment_method']);
		$order_id = sanitize_text_field($parameters['order_id']);
		$payment_token = sanitize_text_field($parameters['payment_token']);
		$error = new WP_Error();

		if (empty($payment_method)) {
			$error->add(400, __("Payment Method 'payment_method' is required.", 'wc-rest-payment'), array('status' => 400));
			return $error;
		}
		if (empty($order_id)) {
			$error->add(401, __("Order ID 'order_id' is required.", 'wc-rest-payment'), array('status' => 400));
			return $error;
		} else if (wc_get_order($order_id) == false) {
			$error->add(402, __("Order ID 'order_id' is invalid. Order does not exist.", 'wc-rest-payment'), array('status' => 400));
			return $error;
		} else if (wc_get_order($order_id)->get_status() !== 'pending') {
			$error->add(403, __("Order status is NOT 'pending', meaning order had already received payment. Multiple payment to the same order is not allowed. ", 'wc-rest-payment'), array('status' => 400));
			return $error;
		}
		if (empty($payment_token)) {
			$error->add(404, __("Payment Token 'payment_token' is required.", 'wc-rest-payment'), array('status' => 400));
			return $error;
		}

		switch ($payment_method) {
		case "stripe":
			$wc_gateway_stripe = new WC_Gateway_Stripe();
			$_POST['stripe_token'] = $payment_token;
			$payment_result = $wc_gateway_stripe->process_payment($order_id);
			if ($payment_result['result'] === "success") {
				$response['code'] = 200;
				$response['message'] = __("Your Payment was Successful. ", "wc-rest-payment");
			} else {
				$response['code'] = 411;
				$response['message'] = __("Please enter valid card details", "wc-rest-payment");
			}
			break;
		case "paypal_express":
			// @see: https://github.com/woocommerce/woocommerce-gateway-paypal-express-checkout/blob/20cd2ba6f66d64106354b1dee314e201b441bc5a/includes/abstracts/abstract-wc-gateway-ppec.php
			// @author: Jack
			$checkout = wc_gateway_ppec()->checkout;
			$order = wc_get_order($order_id);

			try {
				// Get details
				$checkout_details = $checkout->get_checkout_details($payment_token);
				$checkout_context = array(
					'start_from' => 'checkout',
					'order_id' => $order_id,
				);
				if ($checkout->needs_billing_agreement_creation($checkout_context)) {
					$checkout->create_billing_agreement($order, $checkout_details);
				}
				// Complete the payment now.
				$payer_id = sanitize_text_field($parameters['payer_id']);
				$checkout->do_payment($order, $payment_token, $payer_id);

				$response['code'] = 200;
				$response['message'] = __("Your Payment was Successful. ", "wc-rest-payment");

			} catch (PayPal_Missing_Session_Exception $e) {
				// For some reason, our session data is missing. Generally,
				// if we've made it this far, this shouldn't happen.
				$response['code'] = 421;
				$response['message'] = __("Sorry, an error occurred while trying to process your payment. Please try again.", "wc-rest-payment");
			} catch (PayPal_API_Exception $e) {
				// Did we get a 10486 or 10422 back from PayPal?  If so, this
				// means we need to send the buyer back over to PayPal to have
				// them pick out a new funding method.
				$response['code'] = 422;
				$response['message'] = __("Sorry, an error occurred while trying to process your payment. Please regenerate paypal_express_token.", "wc-rest-payment");
			}
			break;
		default:
			$response['code'] = 405;
			$response['message'] = __("Please select an available payment method. Supported payment method can be found at https://wordpress.org/plugins/wc-rest-payment/#description", "wc-rest-payment");
		}

		return new WP_REST_Response($response, 123);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Rest_Payment_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Rest_Payment_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wc-rest-payment-public.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Rest_Payment_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Rest_Payment_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wc-rest-payment-public.js', array('jquery'), $this->version, false);

	}

}
