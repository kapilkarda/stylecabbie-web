<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Settings') ) {

	class FPD_Settings {

		public static $radykal_settings;

		public function __construct() {

			add_action( 'init', array( &$this, 'init') );

		}

		public function init() {

			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-general-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-default-element-options-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-labels-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-fonts-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-color-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-advanced-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-wc-settings.php');
			require_once(FPD_PLUGIN_DIR.'/inc/settings/class-automated-export-settings.php');

			add_action( 'radykal_settings_after_sub_nav', array(&$this, 'after_sub_nav'), 10 );
			add_action( 'radykal_settings_header_end', array(&$this, 'header_end'), 10 );
			add_action( 'radykal_before_options_save', array(&$this, 'before_options_saved') );

			//create new settings instance
			$tabs = array(
				'general' => __('General', 'radykal'),
				'element_properties' => __('Element Properties', 'radykal'),
				'colors' => __('Colors', 'radykal'),
				'fonts' => __('Fonts', 'radykal'),
				'labels' => __('Labels', 'radykal'),
			);

			if( function_exists('get_woocommerce_currency') ) {
				$tabs['woocommerce'] = __('WooCommerce', 'radykal');
			}

			$tabs['automated-export'] = __('Automated Export', 'radykal');
			$tabs['advanced'] = __('Advanced', 'radykal');

			$tabs = apply_filters( 'fpd_settings_tabs', $tabs );

			self::$radykal_settings = new Radykal_Settings( array(
					'page_id' => 'fpd_settings',
					'tabs' => $tabs
				)
			);

			//first add blocks
			$blocks = apply_filters('fpd_settings_blocks', array(
				'general' => array(
					'display' => __('Display', 'radykal'),
					'modules' => __('Modules', 'radykal'),
					'actions' => __('Actions', 'radykal'),
					'social-share' => __('Social Share', 'radykal'),
				),
				'element_properties' => array(
					'images' => __('Custom Images & Designs', 'radykal'),
					'custom-images' => __('Custom Images', 'radykal'),
					'all-images' => __('All Images', 'radykal'),
					'custom-texts' => __('Custom Texts', 'radykal'),
					'all-texts' => __('All Texts', 'radykal'),
					'general' => __('General', 'radykal'),
				),
				'fonts' => array(
					'fonts' => __('Fonts for the typeface dropdown', 'radykal'),
				),
				'colors' => array(
					'color-names' => __('Color Names', 'radykal'),
					'color-prices' => __('Color Prices', 'radykal'),
					'color-general' => __('General', 'radykal'),
				),
				'woocommerce' => array(
					'product-page' => __('Product Page', 'radykal'),
					'cart' => __('Cart', 'radykal'),
					'order' => __('Order', 'radykal'),
					'catalog-listing' => __('Catalog Listing', 'radykal'),
					'global-product-designer' => __('Global Product Designer', 'radykal'),
					'cross-sells' => __('Cross-Sells', 'radykal'),
				),
				'automated-export' => array(
					'ae-general' => __('Automated-export', 'radykal'),
				),
				'advanced' => array(
					'misc' => __('Miscellanous', 'radykal'),
					'troubleshooting' => __('Troubleshooting', 'radykal'),
				),
			));

			self::$radykal_settings->add_blocks($blocks);

			self::$radykal_settings->add_blocks_description(array(
				'images' 		=> __('Default properties for custom images added by the customers and designs added from the Design module.', 'radykal'),
				'custom-images' => __('Additional properties for custom images (Uploads, Facebook, Instagram, Pixabay, Depositphotos) added by the customers.', 'radykal'),
				'all-images' 	=> __('Additional properties for all image layers.', 'radykal'),
				'custom-texts'	=> __('Default properties for texts added by the customers.', 'radykal'),
				'all-texts' 	=> __('Additional properties for all text layers.', 'radykal'),
				'cross-sells' 	=> __('Whenever a customer adds a product to the cart, the linked Cross-Sells products will be displayed.', 'radykal'),
			));

			//add general settings
			$general_options = FPD_Settings_General::get_options();
			self::$radykal_settings->add_block_options( 'display', $general_options['display']);
			self::$radykal_settings->add_block_options( 'modules', $general_options['modules']);
			self::$radykal_settings->add_block_options( 'actions', $general_options['actions']);
			self::$radykal_settings->add_block_options( 'social-share', $general_options['social-share']);

			//add default element options settings
			$element_properties = FPD_Settings_Default_Element_Options::get_options();
			self::$radykal_settings->add_block_options( 'images', $element_properties['images']);
			self::$radykal_settings->add_block_options( 'custom-images', $element_properties['custom-images']);
			self::$radykal_settings->add_block_options( 'all-images', $element_properties['all-images']);
			self::$radykal_settings->add_block_options( 'custom-texts', $element_properties['custom-texts']);
			self::$radykal_settings->add_block_options( 'all-texts', $element_properties['all-texts']);
			self::$radykal_settings->add_block_options( 'general', $element_properties['general']);

			//add fonts settings
			$fonts_options = FPD_Settings_Fonts::get_options();
			self::$radykal_settings->add_block_options( 'fonts', $fonts_options['fonts']);

			//add advanced color settings
			$advanced_color_options = FPD_Settings_Colors::get_options();
			self::$radykal_settings->add_block_options( 'color-names', $advanced_color_options['color-names']);
			self::$radykal_settings->add_block_options( 'color-prices', $advanced_color_options['color-prices']);
			self::$radykal_settings->add_block_options( 'color-general', $advanced_color_options['color-general']);

			//add wc settings
			$wc_options = FPD_Settings_WooCommerce::get_options();
			self::$radykal_settings->add_block_options( 'product-page', $wc_options['product-page']);
			self::$radykal_settings->add_block_options( 'cart', $wc_options['cart']);
			self::$radykal_settings->add_block_options( 'order', $wc_options['order']);
			self::$radykal_settings->add_block_options( 'catalog-listing', $wc_options['catalog-listing']);
			self::$radykal_settings->add_block_options( 'global-product-designer', $wc_options['global-product-designer']);
			self::$radykal_settings->add_block_options( 'cross-sells', $wc_options['cross-sells']);

			//add automated export settings
			$automated_export_options = FPD_Settings_Automated_Export::get_options();
			self::$radykal_settings->add_block_options( 'ae-general', $automated_export_options['ae-general']);

			//add advanced settings
			$advanced_options = FPD_Settings_Advanced::get_options();
			self::$radykal_settings->add_block_options( 'misc', $advanced_options['misc']);
			self::$radykal_settings->add_block_options( 'troubleshooting', $advanced_options['troubleshooting']);

			//$fonts_options = FPD_Settings_Fonts::get_options();
			self::$radykal_settings->add_block_options( 'plus', $fonts_options['fonts']);

			do_action( 'fpd_block_options_end' );

		}

		public function after_sub_nav( $page_id ) {

			$all_settings = self::$radykal_settings->settings;
			$select_data = array();

			foreach($all_settings as $tab => $block) {

				foreach($block as $block_key => $block_options) {

					$select_data_options = array();
					foreach($block_options as $option) {

						if( isset($option['default']) ) {

							array_push($select_data_options, array(
								'id' => $option['id'],
								'text' => $option['title'],
								'url' => admin_url('admin.php?page=fpd_settings&tab='.$tab.'#'.$block_key)
							));

						}

					}

					array_push($select_data, array(
						'text' => self::$radykal_settings->tabs[$tab] . ' → ' . self::$radykal_settings->block_titles[$block_key],
						'children' => $select_data_options
					));

				}

			}

			?>

			<div class="fpd-right">
				<select id="fpd-search-settings" style="width: 300px">
					<option></option>
				</select>
			</div>
			<script type="text/javascript">

				jQuery(document).ready(function() {

					jQuery('#fpd-search-settings').select2({
						data: <?php echo json_encode($select_data); ?>,
						placeholder: "<?php _e( 'Search for an option', 'radykal'); ?>"

					})
					.on('select2:select', function(evt) {
						window.open(evt.params.data.url, '_self')
					});

				});

			</script>

			<?php

		}

		public function header_end( $page_id ) {

			if( isset($_GET['tab']) && $_GET['tab'] === 'labels' ) {

				//get active languages from WPML
				$languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc&skip_missing=0' );

				if( isset($_GET['lang_code']) ) //get lang code from url
					$current_lang_code = $_GET['lang_code'];
				else if($languages) { //get first lang code from wpml languages
					$first = reset($languages);
					$current_lang_code = $first['language_code'];
				}
				else { //get locale code
					$current_lang_code = FPD_Settings_Labels::get_current_lang_code();
				}

				echo '<p class="description">'.__('Translate all labels in the frontend.', 'radykal').'</p>';

				//output all WPML languages in sub menu
				if (!empty($languages) && sizeof($languages) > 0 ):
				?>
				<ul class="subsubsub">
					<?php
					foreach($languages as $key => $language) {
						echo '<li><a class="'.($key == $current_lang_code ? 'current' : '').'" href="'.add_query_arg( 'lang_code', $key).'"><img src="'.$languages[$key]['country_flag_url'].'" />'.$languages[$key]['translated_name'].'</a>|</li>';
					}
					?>
				</ul>
				<br class="clear" />
				<?php
				endif;

				//FPD_Settings_Labels::update_all_languages();
				$default_lang = FPD_Settings_Labels::get_default_lang();
				$current_lang = FPD_Settings_Labels::get_current_lang($current_lang_code);

				$textarea_keys = array(
					'uploaded_image_size_alert',
					'not_supported_device_info',
					'info_content',
					'login_required_info'
				);

				foreach($default_lang as $section => $fields) {

					//PLUS
					if($section == 'plus' && !class_exists('Fancy_Product_Designer_Plus'))
						continue;

					if($section == 'woocommerce' && !class_exists('WooCommerce'))
						continue;

					$section_title = $section === 'misc' ? 'Miscellaneous' : $section;
					echo '<h3>'. str_replace('_', ' ',$section_title ).'</h3>';
					echo '<table class="form-table" id="'.$section.'">';

					$textarea_rows = array();
					foreach($fields as $key => $value) {

						$trans_val = isset($current_lang[$section][$key]) ? $current_lang[$section][$key] : $value;

						if( in_array($key, $textarea_keys) ) {
							$textarea_rows[$key] = $trans_val;
							continue;
						}

						$label_title = str_replace('_', ' ', $key);
						$label_title = str_replace(':', ': ', $label_title);
						?>
						<tr>
							<th scope="row"><?php echo $label_title; ?></th>
							<td class="radykal-option-type--text">
								<input type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo $trans_val; ?>" class="widefat" />
							</td>
						</tr>
						<?php
					}

					//add textareas at the end of the table
					foreach($textarea_rows as $key => $trans_val) {

						$label_title = str_replace('_', ' ', $key);
						$label_title = str_replace(':', ': ', $label_title);

						echo '<tr><th scope="row">'. $label_title .'</th><td class="radykal-option-type--text"><textarea id="'. $key .'" name="'. $key .'" rows="3" class="large-text">'. $trans_val .'</textarea><span class="description">'. __('HTML Tags Supported', 'radykal'). '</span></td></tr>';

					}

					echo '</table>';

				}
				?>

				<input type="hidden" name="fpd_translation_str" class="large-text" />
				<input type="hidden" name="fpd_lang_code" value="<?php echo $current_lang_code; ?>" />
				<script>

				jQuery(document).ready(function() {

					jQuery('[name="radykal_save_options_fpd_settings"]').click(function(evt) {

						var json = {};

						jQuery('#radykal-options-form-fpd_settings table').each(function(i, table) {

							var $table = jQuery(table);
							json[table.id] = {};

							$table.find('input, textarea').each(function(j, field) {

								json[table.id][field.name] = field.value.replace(/(?:\r\n|\r|\n)/g, '<br />');;

							});

						});

						jQuery('[name="fpd_translation_str"]').val(JSON.stringify(json))
						.parent('form').submit();

						evt.preventDefault();

					});

				});

				</script>

				<?php

			}

		}

		public function before_options_saved( $page_id ) {

			if( isset($_POST['fpd_translation_str']) && isset($_POST['fpd_lang_code']) ) {

				check_admin_referer( $page_id.'_nonce' );

				if( isset($_POST['radykal_reset_options_'.$page_id]) ) {
					FPD_Settings_Labels::reset($_POST['fpd_lang_code']);
				}
				else {
					update_option('fpd_lang_'.$_POST['fpd_lang_code'], stripslashes($_POST['fpd_translation_str']) );
				}

			}

		}
	}
}

new FPD_Settings();
?>