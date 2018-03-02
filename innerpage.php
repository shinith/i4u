<?php
include("template.php");
if(!$_COOKIE["location"]||!$_COOKIE["catgry"]||!$_COOKIE["brnd"]||!$_COOKIE["itm"])
header("location:".ROOT);
head("I4UR Gadget");
?>
<script type="text/javascript">
jQuery(document).ready(function() {
adjustScreen();
function adjustScreen(){
$windowWidth = jQuery(window).width();
$windowHeight = jQuery(window).height();
console.log("width : "+$windowWidth+" height : "+$windowHeight);	
lpos=0;tpos=0;

jQuery(".drag_element").each(function(index, el) {
myleft=parseInt(jQuery(this).css("left"),10);
mytop=parseInt(jQuery(this).css("top"),10);
console.log(myleft);
lpos=myleft;
tpos=mytop;
if($windowWidth<=767){
lpos=	myleft-($windowWidth/3);
tpos=	mytop+200;
}

//jQuery(this).css({"left":lpos+"px","top":tpos+"px"});
//console.log("position : "+index+" width : "+lpos+"offset");

});
}
jQuery(window).resize(function(event) {
adjustScreen();	
});		
	});
</script>
<div id="site-content" class="site-content">

<div class="content-header content-header-left content-header-full content-header-featured wrap">
<div class="content-header-inner wrap">
<div class="wrap-inner">

<div class="page-title">
<h1 class="page-title-inner">Serving In <?php echo $_COOKIE["dlocation"]?> </h1>
</div>
</div>

</div>
</div>

<div id="content-body" class="content-body">
<div class="content-body-inner wrap" style="padding-bottom: 0px;">
<!-- The main content -->
<main id="main-content" class="main-content" itemprop="mainContentOfPage">
<div class="main-content-inner">							
<div class="content" role="main" itemprop="mainContentOfPage">

<!-- start -->	

<div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1494649671885" ><div class="wpb_column vc_column_container vc_col-sm-12">
<div class="vc_column-inner ">
<div class="wpb_wrapper">


<div class="wpb_raw_code wpb_content_element wpb_raw_html">
<div class="wpb_wrapper">
<div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<h6 class="divider"><span class="redttl">Selected Device</span></h6>
<div class="cta pull-left" >
<h4>Mobile : <?php echo $_COOKIE["dbrnd"]?> : <?php echo $_COOKIE["ditm"]?></h4>
<i class="fa fa-long-arrow-right fa-2x"></i>
</div> 
</div>
</div>


</div></div></div>
</div>
</div>
</div></div></div></div>
<div class="vc_row-full-width vc_clearfix"></div>
<section data-vc-full-width="true" class="vc_section vc_custom_1494503938340 vc_section-has-fill" ><div class="vc_row wpb_row vc_row-fluid vc_custom_1494504026988 vc_row-o-equal-height vc_row-o-content-middle vc_row-flex"><div class="wpb_column vc_column_container vc_col-sm-12">
<div class="vc_column-inner ">
<div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<h6 class="divider">
<span class="redttl">Select the issue</span></h6>
<h2 class="no-margin-top"><span class="colwh">We fix everything</span></h2>

</div>
</div>
<div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div>

<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<p><span style="color: #bababa;">Click on the + sign to select the issue.</span></p>
<p><span style="color: #bababa;">Help us understand the issue better by answering a few questions</span></p>
<p><span style="color: #bababa;">Submit your query to get quotes once you have added all the issues</span></p>
</div>
</div>
</div>
</div>
</div>

<div class="wpb_column vc_column_container vc_col-sm-12">

<div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<div class="wrap_svl_center">
<div class="wrap_svl_center_box">

<div class="wrap_svl" id="body_drag_188">
	<?php
$itmobj=new MysqliDb(HOST,USER,PWD,DB);
$itmobj->where("item_id",$_COOKIE["itm"]);
$repar=$itmobj->get("item_repair",null,"ir_id,ir_name,ir_desc,ir_amount,ir_lpos,ir_tpos");
foreach($repar as $rep){
?>
<div class="drag_element tips" style="top:<?php echo $rep["ir_tpos"]?>%;left:<?php echo $rep["ir_lpos"]?>%;">
<div class="point_style has-hover ihotspot_tooltop_html" data-placement="n" data-html="<div class=&quot;box_view_html&quot;><h6><?php echo $rep['ir_name']?></h6>
<p><?php echo $rep['ir_desc']?></p>
</div>
">
<div class="pins_animation ihotspot_pulse" style="top:-15px;left:-15px;height:30px;width:30px"></div>
<img src="<?php echo ROOT?>images/icon-plus.svg" class="pins_image ihotspot_hastooltop" style="top:-15px;left:-15px">
<img src="<?php echo ROOT?>images/icon-plus-2.svg" class="pins_image_hover ihotspot_hastooltop" style="top:-15px;left:-15px">		 				 	</div>
</div>
<?php }?>
<div class="images_wrap vc_col-sm-6">
<img src="<?php echo ROOT?>images/<?php echo $_COOKIE["catgry"]?>-1.png" >
</div>	
<div class="images_wrap vc_col-sm-6">
<img  src="<?php echo ROOT?>images/<?php echo $_COOKIE["catgry"]?>-2.png">
</div>

</div>
</div>
</div>


</div>
</div>
</div>
</div>
</div>


<!-- <div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<div class="wrap_svl_center">
<div class="wrap_svl_center_box">
<div class="wrap_svl" id="body_drag_188">
<div class="images_wrap">
<img src="<?php echo ROOT?>images/<?php echo $_COOKIE["catgry"]?>-2.png">
</div>	



</div>
</div>
</div>


</div>
</div>
</div>
</div>
</div> -->

</div>
<div class="vc_row-full-width vc_clearfix">
	
</div><div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1494504185442 vc_row-has-fill" ><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_raw_code wpb_content_element wpb_raw_html">
<div class="wpb_wrapper">
<div class="cta">
<h4><span class="colwh">Get yourself a free quote right now by hitting the button here!</span></h4>
<i  class="fa fa-long-arrow-right fa-2x colwh"></i>
<a href="#" class="button large">Price estimate</a>
</div>
</div>
</div>
</div></div></div></div></section>
<div class="vc_row-full-width vc_clearfix"></div>

<!-- end -->




</div>


</div>
<!-- /.main-content-inner -->
</main>
<!-- /.main-content -->


</div>
<!-- /.content-body-inner -->
</div>
<!-- /.content-body -->



</div>
<!-- /.site-content -->

<?php footer();?>