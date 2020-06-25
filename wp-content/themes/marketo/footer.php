<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 */
$footer_style = marketo_option( 'footer_style',marketo_defaults('footer_style') );

?>
<div class="xs-sidebar-group">
    <div class="xs-overlay bg-black"></div>
    <div class="xs-minicart-widget">
        <div class="widget-heading media">
            <h3 class="widget-title align-self-center d-flex"><?php echo esc_html__( 'Shopping cart', 'marketo' ); ?></h3>
            <div class="media-body">
                <a href="#" class="close-side-widget">
                    <i class="icon icon-cross"></i>
                </a>
            </div>
        </div>
        <div class="widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
    </div>
</div>
<?php get_template_part( 'template-parts/footer/footer', $footer_style ); ?>
<?php wp_footer(); ?>
</body>
</html>
<style type="text/css">
    .loadingDiv {
   position: fixed;   
   background-color: #eeeeee !important;
   z-index:1000000;
   opacity: 0.9;
   width:100%; 
   height:100%; 
   background:url("https://stylecabbie.com/wp-content/uploads/loading1.gif") center center no-repeat;
   top: 0px;
}
</style>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
    	$("button").click(function() {
		    //alert(this.name); // or alert($(this).attr('id'));Reset password
		    if(this.name=='register' || this.name=='login' || this.value=='Reset password'){
		    	$('<div class=loadingDiv></div>').prependTo(document.body);
		    }
		});
    $('a').click(function(){
        // alert($(this).attr('href'));


        var str = $(this).attr('href');
        var spl = str.split("/");
        if($(this).attr('href')=='#nav-home' || $(this).attr('href')=='#nav-profile' || spl[3]== "cart" || $(this).attr('href')=='#' || $(this).attr('href')=='#0' ){
            
           
        }else{
             $('<div class=loadingDiv></div>').prependTo(document.body); 
        }
    });
});
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-64201999-5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-64201999-5');
</script>


