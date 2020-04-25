<?php

namespace SW_WAPF\Includes\Classes {

    class Helper
    {

        public static function get_all_roles() {

            $roles = get_editable_roles();

            return Enumerable::from($roles)->select(function($role, $id) {
                return array('id' => $id,'text' => $role['name']);
            })->toArray();
        }

        public static function cpt_to_string($cpt){

            return __('Product','sw-wapf');

        }

        public static function get_fieldgroup_counts(){

	        $count_cache = array('publish' => 0, 'draft' => 0, 'trash' => 0, 'all' => 0);

	        foreach(wapf_get_setting('cpts') as $cpt) {
		        $count = wp_count_posts($cpt);
		        $count_cache['publish'] += $count->publish;
		        $count_cache['trash'] += $count->trash;
		        $count_cache['draft'] += $count->draft;
	        }

	        $count_cache['all'] = $count_cache['publish'] + $count_cache['draft'];

	        return $count_cache;
        }

        public static function thing_to_html_attribute_string($thing){

            $encoded = wp_json_encode($thing);
            return function_exists('wc_esc_json') ? wc_esc_json($encoded) : _wp_specialchars($encoded, ENT_QUOTES, 'UTF-8', true);

        }

        public static function format_pricing_hint($type, $amount) {

            if(empty($amount))
                $amount = 0;

            $price_display_options = Woocommerce_Service::get_price_display_options();

            $price_output = sprintf(
                $price_display_options['format'],
                $price_display_options['symbol'],
                number_format($amount,$price_display_options['decimals'], $price_display_options['decimal'],$price_display_options['thousand'])
            );

            $sign = '+';

            return sprintf('%s%s',$sign,$price_output);

        }

        public static function normalize_string_decimal($number)
        {
            return preg_replace('/\.(?=.*\.)/', '', (str_replace(',', '.', $number)));
        }

    }
}