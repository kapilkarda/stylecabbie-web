<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(isset($_GET['id']) && isset($_GET['token'])){
	wp_set_auth_cookie($_GET['id'], true, 'true', $_GET['token']);
	$creds = array(
        'user_login'    => $_GET['email'],
        'user_password' => $_GET['password'],
        'remember'      => true
    );
 
    $user = wp_signon($creds, false);
    wp_set_current_user($_GET['id'], $_GET['email']);

}
	get_header( 'shop' );
?>

	<?php

		/**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked marketo_wc_breadcrumb - 10
		 */
		do_action( 'marketo_wc_breadcrumb' );


		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked marketo_wc_related_products - 10 (outputs related products)
		 */
		if(!(isset($_GET['id'])) && !(isset($_GET['token']))){
			do_action( 'marketo_wc_related_products' );
		}
	?>


<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
?>

<?php
	if(isset($_GET['id']) && isset($_GET['token'])){
?>
		<script type="text/javascript">
			localStorage.setItem('isMobile', "1");
			localStorage.setItem('token', '<?php echo $_GET['token']; ?>');
			localStorage.setItem('user_id', '<?php echo $_GET['id']; ?>');
		</script>
<?php
	}
?>

<script type="text/javascript">
	var isMobile =  localStorage.getItem('isMobile');
	if(isMobile=="1"){
		document.getElementsByTagName('header')[0].style.display = 'none';
		document.getElementsByClassName('xs-top-bar')[0].style.display = 'none !important';
		document.getElementsByTagName('footer')[0].style.display = 'none';
		jQuery('.tabmenu-area').hide();
		jQuery('.xs-breadcumb').hide();
		jQuery('.woocommerce-tabs').hide();
		jQuery('.product_meta').hide();
		setTimeout( function() {
			jQuery('.yith-wcwl-add-to-wishlist').hide();
		},2000);
	}
</script>