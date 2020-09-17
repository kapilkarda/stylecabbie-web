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
<style type="text/css">
    .loadingDiv {
   position: fixed;   
   background-color: #eeeeee !important;
   z-index:1000000;
   opacity: 0.9;
   width:100%; 
   height:100%; 
   background:url("https://stylecabbie.com/wp-content/uploads/svgloading.svg") center center no-repeat;
   top: 0px;
}
</style>

<script type="text/javascript">

	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};


	//if( isMobile.any() )
	if( true )
	{ 
		jQuery(document).ready(function ($) {

	    	$("button").click(function() {
			    //alert(this.name); // or alert($(this).attr('id'));Reset password
			    if(this.name=='register' || this.name=='login' || this.value=='Reset password'){
			    	$('<div class=loadingDiv></div>').prependTo(document.body);
			    	
			    }
			});
		    $('a').click(function(){
		        // alert($(this).attr('href'));
		        console.log($(this).attr('href'));
				var str = $(this).attr('href');
		        var spl = str.split("/");
		        
		        if($(this).attr('href')=='#nav-home' || $(this).attr('href')=='#nav-profile' || spl[3]== "cart" || $(this).attr('href')=='#' || $(this).attr('href')=='#0' || $(this).attr('href')=='#tab-additional_information' || $(this).attr('href')=='https://www.stylecabbie.com/my-account/'){
		            
		           
		        }else{
		        	$('<div class=loadingDiv></div>').prependTo(document.body);
		        	setTimeout(function(){
			    		$('<div class=loadingDiv></div>').detach();
			    		console.log('timeset');
			    	},2000)
		        }
		    });
		});
	}else{
		//console.log('desktop');
	}

	//console.log('hello');
    
</script>