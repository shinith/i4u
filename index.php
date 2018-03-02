<?php
include("template.php");
head("I4UR Gadget");
?>
<script type="text/javascript">
var pages={1:"mobile",2:"tablet",3:"laptop"};	
jQuery(document).ready(function($) {
viewSelect();
jQuery(document).on("change","#catSel,#brndSel",viewSelect);
function viewSelect(){
//console.log(this);
cat=$("#catSel").val();	
$("#brndSel option,#catSel option,#modSel option").show();
$("#brndSel option").each(function(index, el) {
if($(this).data("cat")!=cat && $(this).data("cat")!="-1"){
$(this).hide();
}
	
});
brnd=$("#brndSel").val();	
console.log(brnd);
$("#modSel option").each(function(index, el) {
if($(this).data("br")!=brnd && $(this).data("br")!="-1"){
$(this).hide();
}
	
});

} 
jQuery(document).on("submit","#srchFrm",function(frm)
{
frm.preventDefault();
lction=$("#locSel").val();
catgr=$("#catSel").val();
brnd=$("#brndSel").val();
modl=$("#modSel").val();
setCookie("location",lction);
setCookie("catgry",catgr);
setCookie("brnd",brnd);
setCookie("itm",modl);

setCookie("dlocation",$("#locSel option:selected").html());
setCookie("dcatgry",$("#catSel option:selected").html());
setCookie("dbrnd",$("#brndSel option:selected").html());
setCookie("ditm",$("#modSel option:selected").html());

if(lction && catgr && brnd && modl){
window.location="<?php echo ROOT?>"+pages[$("#catSel").val()];

}else{
$("#homeNot").html("<div class='text-success'>Please select all inputs</div>");
}
});	
});	
</script>
<div id="site-content" class="site-content">

<div class="content-header content-header-left content-header-full content-header-featured wrap serhead" >
<div class="content-header-inner wrap">
<div class="wrap-inner">

<div class="page-title">
<h1 class="page-title-inner">Get Your Device Repaired </h1>

<form name="srchFrm" id="srchFrm">
<div class="form-group vc_col-sm-12 vc_col-xs-12 home-searchwrap">
<div class="input-group">

<span class="wpcf7-form-control-wrap menu-273"><select  name="locSel" class="vc_col-md-3 vc_col-sm-3 vc_col-xs-12 marlef wpcf7-form-control wpcf7-select" aria-invalid="false" id="locSel">
<option value="">Select Location</option>	
<?php 
$locobj=new MysqliDb(HOST,USER,PWD,DB);
$locar=$locobj->get("tbl_location",null,"loc_id,loc_name");
foreach ($locar as $key => $loc) {
echo "<option value='$loc[loc_id]'>$loc[loc_name]</option>";	
}
?>
</select></span>
<span class="wpcf7-form-control-wrap menu-273 ">
	<select name="catSel" id="catSel"  class="vc_col-md-2 vc_col-sm-2 vc_col-xs-12 marlef wpcf7-form-control wpcf7-select" aria-invalid="false">
<?php 
$catobj=new MysqliDb(HOST,USER,PWD,DB);
$catobj->orderBy("cat_id","ASC");
$catar=$catobj->get("tbl_category",null,"cat_id,cat_name");
foreach ($catar as $key => $cat) {
echo "<option value='$cat[cat_id]'>$cat[cat_name]</option>";	
}
?>
</select></span>
<span class="wpcf7-form-control-wrap menu-273 ">
	<select name="brndSel" id="brndSel"  class="vc_col-md-2 vc_col-sm-2 vc_col-xs-12 marlef wpcf7-form-control wpcf7-select" aria-invalid="false">
<option value='' data-cat='-1'>Select Brand</option>
<?php 
$brndobj=new MysqliDb(HOST,USER,PWD,DB);
$brndobj->orderBy("cat_id","ASC");
$brndobj->orderBy("br_id","ASC");
$brndar=$brndobj->get("tbl_brand",null,"cat_id,br_name,br_id");
foreach ($brndar as $key => $brnd) {
echo "<option value='$brnd[br_id]' data-cat='$brnd[cat_id]'>$brnd[br_name]</option>";	
}
?>
</select>
	</span>
<span class="wpcf7-form-control-wrap menu-273 ">
	<select name="modSel" id="modSel"  class="vc_col-md-2 vc_col-sm-2 vc_col-xs-12 marlef wpcf7-form-control wpcf7-select" aria-invalid="false">
<option value='' data-br='-1'>Select Model</option>
<?php 
$itmobj=new MysqliDb(HOST,USER,PWD,DB);
$itmobj->orderBy("cat_id","ASC");
$itmobj->orderBy("br_id","ASC");
$itmar=$itmobj->get("tbl_item",null,"cat_id,br_id,item_id,item_name");
foreach ($itmar as $key => $itm) {
echo "<option data-cat='$itm[cat_id]' data-br='$itm[br_id]' value='$itm[item_id]'>$itm[item_name]</option>";	
}
?>
</select>
	</span>
<span class="input-group-addon">
<button class="vc_col-md-2 vc_col-sm-2 vc_col-xs-12 add btn btn-primary xsser marlef" type="submit">Proceed</button>
</span>
</div>
<div id="homeNot"></div>
</div>
</form>

</div>
</div>

</div>
</div>

<div id="content-body" class="content-body">
<div class="content-body-inner wrap">
<!-- The main content -->
<main id="main-content" class="main-content" itemprop="mainContentOfPage">
<div class="main-content-inner">							
<div class="content" role="main" itemprop="mainContentOfPage">

<!-- start -->	

<section data-vc-full-width="true" data-vc-full-width-init="true" class="vc_section fix-overflow vc_custom_1494474487413 vc_section-has-fill" style=""><div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-7"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="vc_empty_space mar70" ><span class="vc_empty_space_inner"></span></div>

<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<h6 class="divider"><span class="redttl">Smartfix</span></h6>
<h2 class="no-margin-top"><span class="colwh">Expert repairs. done fast.</span></h2>

</div>
</div>
<div class="vc_empty_space mar20"><span class="vc_empty_space_inner"></span></div>

<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<p><span class="colgr">Fast, Affordable Tablet, Laptop, Game Console and Cell Phone Repair. Your gadgets play a major role in your professional, personal and school life. When your phone, tablet, or laptop breaks you want an expert to handle the repair. That’s where we come in. With over a decade of experience in the electronics repair industry, <strong><span class="colwh"">SmartFix</span></strong> can get the job done quickly and effectively.</span></p>

</div>
</div>
<div class="vc_empty_space mar70" ><span class="vc_empty_space_inner"></span></div>

<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<p><a class="button link white" href="#">Who we are</a></p>

</div>
</div>
<div class="vc_empty_space mar70" ><span class="vc_empty_space_inner"></span></div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-5"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="vc_row wpb_row vc_inner vc_row-fluid featured-box vc_custom_1494473043575"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<h6 class="divider"><span class="redttl">Why choose us</span></h6>
<h2 class="no-margin-top">Trusted source for iphone repair</h2>

</div>
</div>
<div class="vc_empty_space mar20" ><span class="vc_empty_space_inner"></span></div>
<ul class="iconlist iconlist iconlist-icon-small "><li><div class="iconlist-item-icon"><img src="images/icon-check.png" alt="icon-check"></div><div class="iconlist-item-content"><h6>FREE DIAGNOSTIC</h6>
</div></li><li><div class="iconlist-item-icon"><img src="images/icon-check.png" alt="icon-check"></div><div class="iconlist-item-content"><h6>WE OFFER THE BEST PRICES</h6>
</div></li><li><div class="iconlist-item-icon"><img src="images/icon-check.png" alt="icon-check"></div><div class="iconlist-item-content"><h6>QUICK/CONVENIENT REPAIR PROCESS</h6>
</div></li><li><div class="iconlist-item-icon"><img src="images/icon-check.png" alt="icon-check"></div><div class="iconlist-item-content"><h6>180-DAY WARRANTY</h6>
</div></li></ul></div></div></div></div></div></div></div></div></section>

<div class="vc_row-full-width vc_clearfix"></div>

<div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1496044539387 vc_row-has-fill vc_row-o-equal-height vc_row-o-content-middle vc_row-flex" ><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<h6 class="divider dark">Repair within 30’</h6>
<h2 class="no-margin-top">How it works</h2>

</div>
</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-9"><div class="vc_column-inner "><div class="wpb_wrapper"><ul class="iconlist iconlist iconlist-icon-large "><li><div class="iconlist-item-icon">
<img src="images/005-search.svg" alt="005-search"></div>
<div class="iconlist-item-content"><span class="colwh">
<strong>01. </strong></span><span class="colwh">Select your device brand needs repair.</span></div></li><li><div class="iconlist-item-icon"><img src="images/001-signs.svg" alt="001-signs"></div><div class="iconlist-item-content"><span class="colwh"><strong>02. </strong></span><span class="colwh">Select a convenient location for the repair.</span></div></li><li><div class="iconlist-item-icon"><img src="images/001-wrench.svg" alt="001-wrench"></div><div class="iconlist-item-content"><span class="colwh"><strong>03. </strong></span><span class="colwh">Repair professionals get in touch with you.</span></div></li></ul></div></div></div></div>

<div class="vc_row-full-width vc_clearfix"></div>



<div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1494647103800 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<h6 class="divider center"><span class="redttl">Our Services</span></h6>
<h2 class="no-margin-top counter" >Services at your convenience</h2>

</div>
</div>
<div class="vc_empty_space mar20" ><span class="vc_empty_space_inner"></span></div>
<div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper">
<!-- BEGIN .imagebox -->
<div class="imagebox  ">

<div class="box-image">
<a href="#" target="">
<img class="" src="images/mail-in-400x540.jpg" alt="mail-in" title="mail-in" height="540" width="400">			</a>
</div>

<div class="box-content">

<h3 class="box-title">Come in store.</h3>

<div class="box-desc">
<p>We’ve got locations around the New York area, so you can pop in and see us almost anywhere. Come in &amp; experience our fast &amp; friendly service!</p>
</div>


<div class="box-button">
<a class="button link" href="#" target="">
<span>Find Locations</span>
</a>
</div>

</div>
</div>
<!-- End .imagebox -->

</div></div></div><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper">
<!-- BEGIN .imagebox -->
<div class="imagebox  ">

<div class="box-image">
<a href="#" target="">
<img class="" src="images/call-400x540.jpg" alt="call" title="call" height="540" width="400">			</a>
</div>

<div class="box-content">

<h3 class="box-title">Mail in / On location.</h3>

<div class="box-desc">
<p>No time to visit us in person? No problem! Make an appointment with us and we will come to your location to handle your issue on the spot.</p>
</div>


<div class="box-button">
<a class="button link" href="#" target="">
<span>Make an appointment</span>
</a>
</div>

</div>
</div>
<!-- End .imagebox -->

</div></div></div></div></div></div></div></div>

<div class="vc_row-full-width vc_clearfix"></div>


<div class="vc_row-full-width vc_clearfix"></div>

<div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1494489874737 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<h6 class="divider center"><span class="redttl">Have questions?</span></h6>
<h2 class="no-margin-top counter" >Frequently asked Questions</h2>

</div>
</div>
<div class="vc_empty_space mar20" ><span class="vc_empty_space_inner"></span></div>
<div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div><div class="wpb_column vc_column_container vc_col-sm-8"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="vc_toggle vc_toggle_default vc_toggle_color_default  vc_toggle_size_md">
<div class="vc_toggle_title"><h4>How long will my phone take to repair?</h4><i class="vc_toggle_icon"></i></div>
<div class="vc_toggle_content"><p>If you visit our walk in centre most repairs are undertaken within 24 – 48 hours subject to parts availability. If you need your phone back sooner a 24 Hour Express Service is available for only £9.95, your mobile phone repair is then given priority treatment.</p>
</div>
</div>
<div class="vc_toggle vc_toggle_default vc_toggle_color_default  vc_toggle_size_md vc_toggle_active">
<div class="vc_toggle_title"><h4>Will I lose any data from my Mobile Phone?</h4><i class="vc_toggle_icon"></i></div>
<div class="vc_toggle_content"><p>We endeavour to keep all information intact, unless it is necessary to remove as a part of the repair. These repairs usually include software problems or liquid damage. If your data is particularly important please do let us know when you send in your mobile phone.</p>
</div>
</div>
<div class="vc_toggle vc_toggle_default vc_toggle_color_default  vc_toggle_size_md">
<div class="vc_toggle_title"><h4>What kind of parts do you use for repairs?</h4><i class="vc_toggle_icon"></i></div>
<div class="vc_toggle_content"><p>We only use 100% genuine parts where possible. If original parts are not available we will source the next best thing OEM parts from the same factories that produce the parts.</p>
</div>
</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div></div><div class="vc_empty_space mar20" ><span class="vc_empty_space_inner"></span></div>

<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<p class="counter" ><a class="button large white" href="#">View all faq’s</a></p>

</div>
</div>
</div></div></div></div>
<div class="vc_row-full-width vc_clearfix"></div>

<div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1494821436813 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element " >
<div class="wpb_wrapper">
<h6 class="divider center"><span class="redttl">Testimonials</span></h6>
<h2 class="no-margin-top counter" ><span class="colwh">Real customer reviews</span></h2>

</div>
</div>
<div class="vc_empty_space mar70" ><span class="vc_empty_space_inner"></span></div>
<!-- BEGIN: .elements-carousel -->
<div class="elements-carousel gap-large " data-config="{&quot;items&quot;:2,&quot;itemsTablet&quot;:[768,2],&quot;itemsMobile&quot;:[479,1],&quot;autoPlay&quot;:false,&quot;stopOnHover&quot;:true,&quot;mouseDrag&quot;:true,&quot;touchDrag&quot;:true,&quot;responsive&quot;:true,&quot;scrollPerPage&quot;:false,&quot;slideSpeed&quot;:200,&quot;paginationSpeed&quot;:200,&quot;rewindSpeed&quot;:200,&quot;navigation&quot;:true,&quot;rewindNav&quot;:true,&quot;pagination&quot;:false,&quot;paginationNumbers&quot;:false,&quot;dragBeforeAnimFinish&quot;:true,&quot;addClassActive&quot;:true,&quot;autoHeight&quot;:true,&quot;navigationText&quot;:[&quot;Previous&quot;,&quot;Next&quot;],&quot;itemsScaleUp&quot;:true}">
<div class="elements-carousel-wrap">

<div class="testimonial  has-image">			
<div class="testimonial-author">

<div class="testimonial-image">
<img src="images/t2.jpg" alt="Richard" />
</div>
<span class="author-name">Richard</span>
<span class="author-info"><span class="subtitle">New York, NY </span></span>
</div>
<div class="testimonial-content">
<blockquote>
<p><span class="colgr">Thanks John, I was really pleased with SmartFix&#8217;s service. Would definitely recommend you and have already given out some of your business cards that were left with me. All the best for your future success.</span></p>
</blockquote>
</div>
</div>

<div class="testimonial  has-image">			
<div class="testimonial-author">

<div class="testimonial-image">
<img src="images/t3.jpg" alt="Jeffrey" />
</div>
<span class="author-name">Jeffrey</span>
<span class="author-info"><span class="subtitle">Brooklyn, NY </span></span>
</div>
<div class="testimonial-content">
<blockquote>
<p><span class="colgr">Thank you so much cell savers for not only saving me time and money but making it so easy for me to coordinate my work schedule with fixing my phone. Hopefully my phone won’t drop again but if it does I know who to contact.</span></p>
</blockquote>
</div>
</div>

<div class="testimonial  has-image">			
<div class="testimonial-author">

<div class="testimonial-image">
<img src="images/t1.jpg" alt="Kathryn" />
</div>
<span class="author-name">Kathryn</span>
<span class="author-info"><span class="subtitle">New York, NY </span></span>
</div>
<div class="testimonial-content">
<blockquote>
<p><span class="colgr">Thank you for giving my computer a spring clean. It is running faster, my home screen is neater and the colour stays as it should. You’ll definitely be my person to call again should I need you. Looking forward to my new printer.</span></p>
</blockquote>
</div>
</div>
</div>
</div>
<!-- END: .elements-carousel -->
</div></div></div></div>




<div class="vc_row-full-width vc_clearfix"></div>
<div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1494817837116" ><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="wpb_text_column wpb_content_element ">
<div class="wpb_wrapper">
<h6 class="divider center"><span class="redttl">Fun facts</span></h6>
<h2 class="no-margin-top counter">Amazing facts about SmartFix</h2>

</div>
</div>
<div class="vc_empty_space mar70" ><span class="vc_empty_space_inner"></span></div>
<div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="counter "><div class="counter-inner">
<h3 class="counter-content">
<span class="counter-prefix"></span>
<span class="counter-value">0</span>
<span class="counter-suffix">Years</span>
</h3>
<div class="counter-title">Years of experiences</div></div></div><div class="vc_empty_space" ><span class="vc_empty_space_inner"></span></div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="counter "><div class="counter-inner">
<h3 class="counter-content">
<span class="counter-prefix"></span>
<span class="counter-value">0</span>
<span class="counter-suffix"></span>
</h3>
<div class="counter-title">Cracks covered</div></div></div><div class="vc_empty_space" ><span class="vc_empty_space_inner"></span></div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="counter "><div class="counter-inner">
<h3 class="counter-content">
<span class="counter-prefix"></span>
<span class="counter-value">0</span>
<span class="counter-suffix"></span>
</h3>
<div class="counter-title">Devices repaired</div></div></div><div class="vc_empty_space" ><span class="vc_empty_space_inner"></span></div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="counter "><div class="counter-inner">
<h3 class="counter-content">
<span class="counter-prefix"></span>
<span class="counter-value">0</span>
<span class="counter-suffix">%</span>
</h3>
<div class="counter-title">Satisfied customers</div></div></div><div class="vc_empty_space" ><span class="vc_empty_space_inner"></span></div>
</div></div></div></div></div></div></div></div>
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