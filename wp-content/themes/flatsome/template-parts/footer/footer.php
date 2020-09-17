<?php do_action('flatsome_before_footer'); ?>

<!-- FOOTER 1 -->
<?php if ( is_active_sidebar( 'sidebar-footer-1' ) && get_theme_mod('footer_1', 1) ) : ?>
<div class="footer-widgets footer footer-1">
		<div class="<?php echo flatsome_footer_row_style('footer-1'); ?> mb-0">
	   		<?php dynamic_sidebar('sidebar-footer-1'); ?>        
		</div>
</div>
<?php endif; ?>

<!-- FOOTER 2 -->
<?php if ( is_active_sidebar( 'sidebar-footer-2' )  && get_theme_mod('footer_2', 1) ) : ?>
<div class="footer-widgets footer footer-2 <?php if(flatsome_option('footer_2_color') == 'dark') echo 'dark'; ?>">
		<div class="<?php echo flatsome_footer_row_style('footer-2'); ?> mb-0">
	   		<?php dynamic_sidebar('sidebar-footer-2'); ?>        
		</div>
</div>
<?php endif; ?>

<?php do_action('flatsome_after_footer'); ?>

<?php get_template_part('template-parts/footer/footer-absolute'); ?>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
    	$("button").click(function() {
		    //alert(this.name); // or alert($(this).attr('id'));Reset password
		    if(this.name=='register' || this.name=='login' || this.value=='Reset password'){
		    	$('<div class=loadingDiv></div>').prependTo(document.body);
		    	setTimeout(function(){
		    		$('<div class=loadingDiv></div>').remove(document.body);
		    	},2000)
		    }
		});
    $('a').click(function(){
        // alert($(this).attr('href'));


        var str = $(this).attr('href');
        var spl = str.split("/");
        if($(this).attr('href')=='#nav-home' || $(this).attr('href')=='#nav-profile' || spl[3]== "cart" || $(this).attr('href')=='#' || $(this).attr('href')=='#0' ){
            
           
        }
    });
});
</script>