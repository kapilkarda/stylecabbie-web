<?php
/**
 * Abstract class for actions.
 *
 * @author      Icegram
 * @since       4.4.1
 * @version     1.0
 * @package     Email Subscribers
 */

/**
 * Abstract Class ES_Workflow_Action
 *
 * All workflow actions extend this class.
 *
 * @since 4.4.1
 */
abstract class ES_Workflow_Action {

	/**
	 * The action's unique name/slug.
	 *
	 * @since 4.4.1
	 * @var string
	 */
	public $name;

	/**
	 * The action's title.
	 *
	 * @since 4.4.1
	 * @var string
	 */
	public $title;

	/**
	 * The action's description.
	 *
	 * @since 4.4.1
	 * @var string
	 */
	public $description;

	/**
	 * The action's group.
	 *
	 * @since 4.4.1
	 * @var string
	 */
	public $group;

	/**
	 * The action's fields objects.
	 *
	 * @since 4.4.1
	 * @var Field[]
	 */
	public $fields;

	/**
	 * Array containing the action's option values.
	 *
	 * @since 4.4.1
	 * @var array
	 */
	public $options;

	/**
	 * The workflow the action belongs to.
	 *
	 * This prop may not be set depending on the context.
	 *
	 * @since 4.4.1
	 * @var Workflow
	 */
	public $workflow;

	/**
	 * Knows if admin details have been loaded.
	 *
	 * @since 4.4.1
	 * @var bool
	 */
	protected $has_loaded_admin_details = false;

	/**
	 * Called when an action should be run.
	 *
	 * @since 4.4.1
	 * @throws Exception When an error occurs.
	 */
	abstract public function run();

	/**
	 * Action constructor.
	 *
	 * @since 4.4.1
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * This method no longer has an explicit purpose and is deprecated.
	 *
	 * @since 4.4.1
	 *
	 * @deprecated
	 */
	public function init() {}

	/**
	 * Method to load the action's fields.
	 *
	 * @since 4.4.1
	 */
	public function load_fields() {}

	/**
	 * Method to set the action's admin props.
	 *
	 * Admin props include: title, group and description.
	 *
	 * @since 4.4.1
	 */
	protected function load_admin_details() {}

	/**
	 * Loads the action's admin props.
	 *
	 * @since 4.4.1
	 */
	protected function maybe_load_admin_details() {
		if ( ! $this->has_loaded_admin_details ) {
			$this->load_admin_details();
			$this->has_loaded_admin_details = true;
		}
	}

	/**
	 * Get the action's title.
	 *
	 * @since 4.4.1
	 * @param bool $prepend_group Action group.
	 * @return string $title Action group title
	 */
	public function get_title( $prepend_group = false ) {
		$this->maybe_load_admin_details();
		$group = $this->get_group();
		$title = $this->title ? $this->title : '';

		if ( $prepend_group && __( 'Other', 'email-subscribers' ) !== $group ) {
			return $group . ' - ' . $title;
		}

		return $title;
	}

	/**
	 * Get the action's group.
	 *
	 * @since 4.4.1
	 * @return string
	 */
	public function get_group() {
		$this->maybe_load_admin_details();
		return $this->group ? $this->group : __( 'Other', 'email-subscribers' );
	}

	/**
	 * Get the action's description.
	 *
	 * @since 4.4.1
	 * @return string
	 */
	public function get_description() {
		$this->maybe_load_admin_details();
		return $this->description ? $this->description : '';
	}

	/**
	 * Get the action's name.
	 *
	 * @since 4.4.1
	 * @return string
	 */
	public function get_name() {
		return $this->name ? $this->name : '';
	}

	/**
	 * Set the action's name.
	 *
	 * @since 4.4.1
	 *
	 * @param string $name Action name.
	 */
	public function set_name( $name ) {
		$this->name = $name;
	}

	/**
	 * Get the action's description HTML.
	 *
	 * @since 4.4.1
	 * @return string
	 */
	public function get_description_html() {
		if ( ! $this->get_description() ) {
			return '';
		}

		return '<p class="ig-es-field-description">' . $this->get_description() . '</p>';
	}

	/**
	 * Adds a field to the action.
	 *
	 * Should only be called in the load_fields() method.
	 *
	 * @since 4.4.1
	 * @param Field $field Action field object.
	 */
	protected function add_field( $field ) {
		$field->set_name_base( 'ig_es_workflow_data[actions]' );
		$this->fields[ $field->get_name() ] = $field;
	}

	/**
	 * Gets specific field belonging to the action.
	 *
	 * @since 4.4.1
	 * @param string $name field name.
	 *
	 * @return ES_Field|false
	 */
	public function get_field( $name ) {
		$this->get_fields();

		if ( ! isset( $this->fields[ $name ] ) ) {
			return false;
		}

		return $this->fields[ $name ];
	}

	/**
	 * Gets the action's fields.
	 *
	 * @since 4.4.1
	 * @return ES_Field[]
	 */
	public function get_fields() {
		if ( ! isset( $this->fields ) ) {
			$this->fields = array();
			$this->load_fields();
		}

		return $this->fields;
	}

	/**
	 * Set the action's options.
	 *
	 * @since 4.4.1
	 * @param array $options Options array.
	 */
	public function set_options( $options ) {
		$this->options = $options;
	}

	/**
	 * Returns an option for use when running the action.
	 *
	 * Option value will already have been sanitized by it's field ::sanitize_value() method.
	 *
	 * @since 4.4.1
	 * @param string $field_name Field name.
	 *
	 * @return mixed Will vary depending on the field type specified in the action's fields.
	 */
	public function get_option( $field_name ) {

		$value = $this->get_option_raw( $field_name );

		return apply_filters( 'ig_es_action_option', $value, $field_name, $this );
	}

	/**
	 * Get an option for use when editing the action.
	 *
	 * The value will be already sanitized by the field object.
	 * This is used to displaying an option value for editing.
	 *
	 * @since 4.4.1
	 *
	 * @param string $field_name Field name.
	 *
	 * @return mixed
	 */
	public function get_option_raw( $field_name ) {
		if ( isset( $this->options[ $field_name ] ) ) {
			return $this->options[ $field_name ];
		}

		return false;
	}

}
