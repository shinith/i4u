<?php 
include("includes/config.php");
include("includes/MysqliDb.php");
function head(){
?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="UTF-8" />
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<title>Mobile repair | Laptop repair | Online repair services</title>


<link rel='stylesheet' id='theme-components-css'  href='<?php echo ROOT?>css/components8a54.css?ver=1.0.0' type='text/css' media='all' />
<link rel='stylesheet' id='theme-css'  href='<?php echo ROOT?>css/style8a54.css?ver=1.0.0' type='text/css' media='all' />
<link rel='stylesheet' id='ihotspot-css'  href='<?php echo ROOT?>css/ihotspot.min19f6.css?ver=1.0.7' type='text/css' media='all' />
<link rel="stylesheet"	href="css/mystyle.css" 	type="text/css" media="all">
<link rel='stylesheet' id='js_composer_front-css'  href='<?php echo ROOT?>css/js_composer.min3c21.css?ver=5.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css'  href='<?php echo ROOT?>css/font-awesome.min3c21.css?ver=5.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='theme-fonts-css'  href='http://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic&amp;subset=cyrillic%2Cgreek-ext%2Ccyrillic-ext%2Cgreek%2Cvietnamese%2Clatin%2Clatin-ext&amp;ver=4.8.1' type='text/css' media='all' />
<script type="text/javascript">
var AJAX="<?php echo ROOT?>ajax/";
</script>
<script type='text/javascript' src='<?php echo ROOT?>js/jquery/jqueryb8ff.js?ver=1.12.4'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/jquery/jquery-migrate.min330a.js?ver=1.4.1'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/jquery.themepunch.tools.min.js?ver=5.4.3.1'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/jquery.themepunch.revolution.min.js?ver=5.4.3.1'></script>
<script type="text/javascript" src="<?php echo ROOT?>js/common.js"></script>
<script type="text/javascript">function setREVStartSize(e){
try{ var i=jQuery(window).width(),t=9999,r=0,n=0,l=0,f=0,s=0,h=0;					
if(e.responsiveLevels&&(jQuery.each(e.responsiveLevels,function(e,f){f>i&&(t=r=f,l=e),i>f&&f>r&&(r=f,n=e)}),t>r&&(l=n)),f=e.gridheight[l]||e.gridheight[0]||e.gridheight,s=e.gridwidth[l]||e.gridwidth[0]||e.gridwidth,h=i/s,h=h>1?1:h,f=Math.round(h*f),"fullscreen"==e.sliderLayout){var u=(e.c.width(),jQuery(window).height());if(void 0!=e.fullScreenOffsetContainer){var c=e.fullScreenOffsetContainer.split(",");if (c) jQuery.each(c,function(e,i){u=jQuery(i).length>0?u-jQuery(i).outerHeight(!0):u}),e.fullScreenOffset.split("%").length>1&&void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0?u-=jQuery(window).height()*parseInt(e.fullScreenOffset,0)/100:void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0&&(u-=parseInt(e.fullScreenOffset,0))}f=u}else void 0!=e.minHeight&&f<e.minHeight&&(f=e.minHeight);e.c.closest(".rev_slider_wrapper").css({height:f})					
}catch(d){console.log("Failure at Presize of Slider:"+d)}
};</script>

</head>
<body class="page-template page-template-tmpl page-template-template-projects page-template-tmpltemplate-projects-php page page-id-81 sliding-desktop-off sliding-overlay layout-wide sidebar-none projects projects-grid-alt wpb-js-composer js-comp-ver-5.1.1 vc_responsive" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<div id="site" class="site wrap header-position-top">



<div id="site-header" class="site-header site-header-classic header-brand-left header-transparent">

<div id="site-topbar" class="site-topbar">
<div class="site-topbar-inner wrap">

<!-- <a href="javascript:;" data-target="off-canvas-left" class="off-canvas-toggle">
<span></span>
</a> -->

<div class="topbar-text">
<ul class="list-info">
<li><div>
<span><strong><i class="fa fa-check-square"></i><a href="#">save money</a></strong> Cheapest Phone Repair</span></div>
</li>
<li><div>
<span><strong><i class="fa fa-headphones"></i><a href="#">customer support</a></strong> Toll Free 1000 101 454555</span></div>
</li>
<li><div>
<span><strong><i class="fa fa-clock-o"></i><a href="#">open 7 days a week</a></strong> Monday - Sunday 09:00 - 18:00</span></div>
</li>
</ul>				</div>
<!-- /.topbar-text -->

<!-- <div class="topbar-nav">	

<ul class="menu menu-extras">
<li class="search-box">
<a href="#"><i class="fa fa-search"></i></a>
<div class="widget widget_search"><form role="search" method="get" class="search-form" action="#">
<label>
<span class="screen-reader-text">Search for:</span>
<input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s" />
</label>
<input type="submit" class="search-submit" value="Search" />
</form></div></li>														<li class="shopping-cart">
<a href="#">
<i class="fa fa-shopping-bag"></i>

<span class="shopping-cart-items-count no-items"></span>
</a>
<div class="sub-menu">
<div class="widget_shopping_cart_content">


<p class="woocommerce-mini-cart__empty-message">No products in the cart.</p>


</div>
</div>
</li>
<li class="shopping-cart">
<a href="login.html">


<b>	Log In</b>				
</a>
<div class="sub-menu">
<div class="widget_shopping_cart_content">


<p class="woocommerce-mini-cart__empty-message">Lorem Ipsum is simply dummy</p>


</div>
</div>
</li>
</ul>


</div> -->

</div>
</div>

<div class="site-header-inner wrap">

<div class="header-brand">
<a href="<?php echo ROOT?>" alt="demo" > <img srcset="<?php echo ROOT ?>images/logo.png" alt="I4UR Gadget" class="logo logoDark" />
</a>
</div>

<nav class="navigator" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

<a href="javascript:;" data-target="off-canvas-right" class="off-canvas-toggle">
<span></span>
</a>

<div class="social-icons"><a href="#" data-tooltip=""><i class="fa fa-twitter"></i></a><a href="#" data-tooltip=""><i class="fa fa-facebook"></i></a><a href="#" data-tooltip=""><i class="fa fa-youtube-play"></i></a><a href="#" data-tooltip=""><i class="fa fa-instagram"></i></a></div>
<ul id="menu-main-menu" class="menu menu-primary">

<li id="menu-item-292" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-292"><a href="#">Home</a></li>	
<li id="menu-item-292" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-292"><a href="about.html">About Us</a></li>		
<li id="menu-item-427" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-427"><a href="#">Services</a>
<ul  class="sub-menu">
<li id="menu-item-372" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-372"><a href="#">IOS Mobile Repair</a></li>
<li id="menu-item-369" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-369"><a href="#">Android Mobile Repair</a></li>
<li id="menu-item-370" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-370"><a href="#">Laptop Repair</a></li>
</ul>
</li>
<li id="menu-item-164" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="contact.html">Reach Us</a></li>
</ul>					


</nav>

</div>
<!-- /.site-header-inner -->
</div>
<!-- /.site-header -->


<div id="site-header-sticky" class="wrap site-header-sticky header-brand-left header-full header-shadow">
<div class="site-header-inner wrap">

<div class="header-brand">
<a href="<?php echo ROOT?>" alt="I4UR Gadget">
<img srcset="<?php echo ROOT ?>images/logo.png" alt="I4UR Gadget" class="logo logoDark" />				</a>
</div>

<nav class="navigator" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
<div class="social-icons"><a href="#" data-tooltip=""><i class="fa fa-twitter"></i></a><a href="#" data-tooltip=""><i class="fa fa-facebook"></i></a><a href="#" data-tooltip=""><i class="fa fa-youtube-play"></i></a><a href="#" data-tooltip=""><i class="fa fa-instagram"></i></a></div>
<ul id="menu-main-menu-1" class="menu menu-primary"><li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-81 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-83"><a href="#">Home</a>

</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="about.html">About Us</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-427"><a href="../buy-sell-trade/index.html">Services</a>
<ul  class="sub-menu">
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-372"><a href="#">IOS Mobile Repair</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-369"><a href="#">Android Mobile Repair</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-370"><a href="#">Laptop Repair</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="contact.html">Reach Us</a></li>
</ul>						<a href="javascript:;" data-target="off-canvas-right" class="off-canvas-toggle">
<span></span>
</a>

<!-- <ul class="menu menu-extras">
<li class="search-box">
<a href="#"><i class="fa fa-search"></i></a>
<div class="widget widget_search"><form role="search" method="get" class="search-form" action="#">
<label>
<span class="screen-reader-text">Search for:</span>
<input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s" />
</label>
<input type="submit" class="search-submit" value="Search" />
</form></div></li>																<li class="shopping-cart">
<a href="#">
<i class="fa fa-shopping-bag"></i>

<span class="shopping-cart-items-count no-items"></span>
</a>
<div class="sub-menu">
<div class="widget_shopping_cart_content">


<p class="woocommerce-mini-cart__empty-message">No products in the cart.</p>


</div>
</div>
</li><li class="shopping-cart">
<a href="#">


<b>	Log In</b>				
</a>
<div class="sub-menu">
<div class="widget_shopping_cart_content">
<p class="woocommerce-mini-cart__empty-message">Lorem Ipsum is simply dummy</p>


</div>
</div>
</li>
</ul> -->

					

</nav>

</div>
<!-- /.site-header-inner -->
</div>
<!-- /.site-header -->	
<?php }	
function footer(){
?>
<div id="site-footer" class="site-footer">
<div class="go-to-top wrap">
<a href="javascript:;"><span>Go to Top</span></a>
</div>


<div class="footer-widgets">
<div class="footer-widgets-inner wrap">
<div class="footer-aside-wrap">

<aside data-width="3">
<div id="nav_menu-4" class="widget widget_nav_menu"><h3 class="widget-title">Quick Links </h3><div class="menu-repair-container"><ul id="menu-repair" class="menu"><li id="menu-item-472" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-472"><a href="#">Apple Repair</a></li>
<li id="menu-item-473" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-473"><a href="#">Xiaomi Repair</a></li>
<li id="menu-item-474" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-474"><a href="#">Nexus Repair</a></li>
<li id="menu-item-475" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-475"><a href="#">Motorola Repair</a></li>
<li id="menu-item-476" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-476"><a href="#">OnePlus Repair</a></li>
<li id="menu-item-477" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-477"><a href="#">LeEco Repair</a></li>
<li id="menu-item-478" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-478"><a href="#">Oppo Repair</a></li>
<li id="menu-item-479" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-479"><a href="#">Vivo Repair</a></li>

</ul></div></div>					</aside>
<aside data-width="3">
<div id="nav_menu-4" class="widget widget_nav_menu"><h3 class="widget-title">JUSTLIKENEW </h3><div class="menu-repair-container"><ul id="menu-repair" class="menu"><li id="menu-item-472" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-472"><a href="#">Home</a></li>
<li id="menu-item-473" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-473"><a href="#">Corporate</a></li>
<li id="menu-item-474" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-474"><a href="#"> Book a Repair</a></li>
<li id="menu-item-475" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-475"><a href="#">  Blog</a></li>
<li id="menu-item-476" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-476"><a href="#"> Careers</a></li>
<li id="menu-item-477" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-477"><a href="#">Privacy Policy</a></li>
<li id="menu-item-478" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-478"><a href="#">Shipping Policy</a></li>
<li id="menu-item-479" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-479"><a href="#">Cancellation & Return Policy
</a></li>
</ul></div></div>					</aside>
<aside data-width="3">
<div id="nav_menu-4" class="widget widget_nav_menu"><h3 class="widget-title">Support </h3><div class="menu-repair-container"><ul id="menu-repair" class="menu"><li id="menu-item-472" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-472"><a href="#">Book Warranty</a></li>
<li id="menu-item-473" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-473"><a href="#"> Warranty Policy</a></li>
<li id="menu-item-474" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-474"><a href="#"> FAQ's</a></li>
<li id="menu-item-475" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-475"><a href="#">  Terms & Conditions</a></li>
<li id="menu-item-476" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-476"><a href="#"> Track Order</a></li>
<li id="menu-item-477" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-477"><a href="about.html">About Us</a></li>
<li id="menu-item-478" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-478"><a href="contact.html">Contact Us</a></li>
<li id="menu-item-479" class="footli menu-item menu-item-type-post_type menu-item-object-nproject menu-item-479"><a href="#">Coupon Partners
</a></li>
</ul></div></div>					</aside>
<aside data-width="3">
<div id="nav_menu-4" class="widget widget_nav_menu"><h3 class="widget-title">ENQUIRY  </h3><div class="menu-repair-container"><form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-74" method="post" data-id="74" data-name="Sign-up"><div class="mc4wp-form-fields"><p>
<input class="no-margin-top" name="EMAIL" placeholder="Your email address" required="" type="email">
</p>

<p>
<input value="Sign up" type="submit">
</p><div style="display: none;"><input name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" type="text"></div><input name="_mc4wp_timestamp" value="1503901304" type="hidden"><input name="_mc4wp_form_id" value="74" type="hidden"><input name="_mc4wp_form_element_id" value="mc4wp-form-1" type="hidden"></div><div class="mc4wp-response"></div></form></div></div>					</aside>


<aside data-width="12" style="padding-top: 30px;">
<div id="nav_menu-4" class="widget widget_nav_menu"><h3 class="widget-title">Payements  </h3><div class="menu-repair-container">
<img src="<?php echo ROOT?>images/payments.png" alt="payments" style="padding-bottom: 8px;
">
<p>JustLikeNew is India’s most trusted smartphone service network. Contact us for Apple Repair, iPhone Repair, Samsung Repair, Nexus Repair, Motorola Repair,One Plus Repair, Xiaomi Repair. JustLikeNew can do LCD Display Repair, Glass Replacement, Touchscreen Repair, Speaker Repair, Microphone Repair, Network Repair, Water Damage Repair, Charging Repair, Battery Replacement, Software Reapir. Models we repair: iPhone 5, Iphone 5s, iPhone 6, iPhone 6s, iPhone 6 plus, iPhone 6S plus, Samsung S6, Samsung S7, Samsung s5, Samsung Note 2/3/4, One Plus One, One Plus two, One Plus Three, Nexus 4, Nexus 5, nexus 6, Mi 3, Mi4,Mi4i,Redmi Note, Asus Zenfone 5, Le 1s, Le Max and all other models. </p>

</div></div>					</aside>



</div>
</div>
</div>
<div class="footer-copyright footer-copyright-center">
<div class="footer-copyright-inner wrap">
<div class="social-icons"><a href="#" data-tooltip=""><i class="fa fa-twitter"></i></a><a href="#" data-tooltip=""><i class="fa fa-facebook"></i></a><a href="#" data-tooltip=""><i class="fa fa-youtube-play"></i></a><a href="#" data-tooltip=""><i class="fa fa-instagram"></i></a></div>				 Copyright © 2017
<a href="http://alityart.in/" target="_blank">alityart</a>
- i4urgadget. All rights reserved. 			</div>
</div>
</div>
<!-- /#site-footer -->
</div>
<!-- /.site-wrapper -->


<!-- <div id="off-canvas-left" class="off-canvas off-canvas-left">
<a href="javascript:;" data-target="off-canvas-left" class="off-canvas-toggle">
<span></span>
</a>
<div class="off-canvas-wrap">
<div id="text-11" class="widget widget_text"><h3 class="widget-title">About Demo</h3>			<div class="textwidget">We are a family owned business that provides fast, warrantied repairs for all your mobile devices.</div>
</div><div id="text-12" class="widget widget_text"><h3 class="widget-title">Brooklyn Area</h3>			<div class="textwidget"><p>location</p>
<p><i class="fa fa-phone"></i>  1000 101-454555 <br />
<i class="fa fa-envelope"></i>  <a href="#">demol@rgeg.com</a><br /></p>
<strong>Store Hours<br /></strong>
Mon - Sun 09:00 - 18:00
</div>
</div><div id="text-13" class="widget widget_text"><h3 class="widget-title">San Francisco Area</h3>			<div class="textwidget"><p>location</p>
<p><i class="fa fa-phone"></i>  1001 101-454555 <br />
<i class="fa fa-envelope"></i>  <a href="#">demo@hhhhh.com</a><br /></p>
<strong>Store Hours<br /></strong>
Mon - Sun 09:00 - 18:00</div>
</div>		</div>
</div>

<div id="off-canvas-right" class="off-canvas sliding-menu">
<a href="javascript:;" data-target="off-canvas-right" class="off-canvas-toggle">
<span></span>
</a>

<div class="off-canvas-wrap">
<ul id="menu-mobile-menu" class="menu menu-sliding"><li id="menu-item-454" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-2 current_page_item menu-item-454"><a href="#">Home</a></li>
<li id="menu-item-455" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-455"><a href="about.html">About Us</a></li>
<li id="menu-item-458" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-458"><a href="#">Repairs</a></li>
<li id="menu-item-456" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-456"><a href="#">Blog</a></li>
<li id="menu-item-457" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-457"><a href="contact.html">Reach Us</a></li>
<li id="menu-item-459" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-459"><a href="#">Shop</a></li>
</ul>		</div>
</div>

<div id="frame">
<span class="frame_top"></span>
<span class="frame_right"></span>
<span class="frame_bottom"></span>
<span class="frame_left"></span>
</div> -->

			
<script type="text/javascript">

function revslider_showDoubleJqueryError(sliderID) {
var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
jQuery(sliderID).show().html(errorMessage);
}
</script>

<script type='text/javascript' src='<?php echo ROOT?>js/components8a54.js?ver=1.0.0'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/theme8a54.js?ver=1.0.0'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/core.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/datepicker.mine899.js?ver=1.11.4'></script>

<script type='text/javascript' src='<?php echo ROOT?>js/widget.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/mouse.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/slider.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/button.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/jquery.ihotspot.min19f6.js?ver=1.0.7'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/wp-embed.mina288.js?ver=4.8.1'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/js_composer_front.min3c21.js?ver=5.1.1'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/shortcodes-3rd8a54.js?ver=1.0.0'></script>
<script type='text/javascript' src='<?php echo ROOT?>js/shortcodes8a54.js?ver=1.0.0'></script>
</body>
</html>
<?php }?>
