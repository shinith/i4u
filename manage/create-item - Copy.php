<?php require_once 'template.php';
if($_SESSION["SUTYPE"]!=2)
{
header("location:".SU."users");
}
admin_header("I4UR Gadget| Create Item ","");
$obj=new MysqliDb(HOST,USER,PWD,DB);
// $uid=$_GET["id"];
$crpimg=ADMINROOT."assets/img/avatars/avatar-12.jpg";
$brand=$obj->get("tbl_brand",null,"br_id,br_name");
$category=$obj->get("tbl_category",null,"cat_id,cat_name");
?>
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>assets/styles/profile/settings.min.css">
<link href="<?php echo ADMINROOT?>libs/flatpickr/flatpickr.min.css" rel="stylesheet">
<script src="<?php echo ADMINROOT?>libs/flatpickr/flatpickr.js"></script>
<script src="<?php echo ADMINROOT?>assets/cropit/jquery.cropit.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {

	crpit=$('#picEditor').cropit({"imageState": { "src":  '<?php echo $crpimg?>'  },"width":128,"height":128,"allowDragNDrop":true,"smallImage":"reject","freeMove":false,"onFileReaderError":function(){},"onImageError":imgErr});
$(document).on("click",".imgSelect",function(){
$(this).closest("#picEditor").find(".cropit-image-input").click();
});

// $('.txt').focus(function(){
//     $(this).css('border','1px solid gray');
// }).blur(function() {
//     //do what you need
//     $(this).css('border','none');
// });


$("#txtcategory").change(function(){
	// $("#tbody").remove();
	var cat_id=$("#txtcategory option:selected").val();


	// alert(cat_id);
	
$.ajax({"url":"<?php echo ROOT?>ajax/brand-ajax.php",type:'post',data:{ dataid : cat_id,},dataType:"json",success:function(response){
	console.log(response);
	$("#tbody").empty();

	for(var i=0;i<response.count;i++)
	{
		//alert(response.result[i].rep_name);
		// var j=i+1;
		// alert(j);

		$("#tbody").append("<tr id='row"+i+"'><td class='index'>"+(i+1)+"</td><td><input type='text' class='txt' id='service_name"+i+"' name='service_name[]' value ='"+response.result[i].rep_name+"'></td><td><input type='text' class='txt' name='service_rate[]' id='service_rate"+i+"' value ='"+response.result[i].rep_amount+"'></td><td><input type='text' class='txt' name='service_lpos[]' id='service_lpos"+i+"' value ='"+response.result[i].rep_lpos+"'></td><td><input type='text' class='txt' name='service_tpos[]' id='service_tpos"+i+"' value ='"+response.result[i].rep_tpos+"'></td><td><a href='ADMINROOT'>Delete</a></td></tr>");
	}
	// var data=response.result;
	// alert(response.count);

}
});

});

$("#btn_add_service").click(function(){
var ob= $("#row1").clone();
ob.find('.txt').val('');
ob.appendTo(".table tbody:last");
setRownum();
});

function setRownum(){
    $("#tbody").find("tr").each(function(index,row){
    $(this).find(".index").html(index+1);
});
}



function imgErr(obj){

$(this)[0].$preview.addClass('has-danger');
//$(this)[0].$errmsg.html(msg);

}


// $(document).on("submit","#frmItem",function(fm){
// fm.preventDefault();
// pwdvalid=true;
// var frmdata=$(this).serialize();
// alert(frmdata);
// // $.ajax({"url":"<?php echo ROOT?>ajax/brand-ajax.php",type:'post', data:frmdata,success:function(response){
// 	// console.log(response);
	
// // }
// // });
// });
$( "#newfmItem" ).on( "submit", function( event ) {
  event.preventDefault();
 frmdata=$(this).serialize();
  $.ajax({
  	url: '<?php echo ROOT?>ajax/brand-ajax.php',
  	type: 'POST',
  	data: frmdata,
  })
  .done(function(response) {
  	console.log(response);
  })
  .fail(function() {
  	console.log("error");
  })
  .always(function() {
  	console.log("complete");
  });
  
});



});


</script>

<div class="ks-column ks-page">
<div class="ks-header">
<section class="ks-title">
<h3>Create New Item</h3>
</section>
</div>

<div class="ks-content">
<div class="ks-body ks-profile">
<div class="ks-tabs-container ks-tabs-default ks-tabs-no-separator ks-full ks-light">
<ul class="nav ks-nav-tabs">
<li class="nav-item">
<a class="nav-link active" href="#" data-toggle="tab" data-target="#settings" aria-expanded="true">General</a> </li>
</ul>

	<form class="ks-form" id="newfmItem" method="post">

	<div class="tab-pane active" id="settings" role="tabpanel" aria-expanded="true">
	<div class="ks-settings-tab col-md-12">
	<div class="ks-menu col-md-3">
	<div id="picEditor" class="agent-photos col-md-12">

	<input type="file" class="hidden cropit-image-input">
	<div class="cropit-image-preview ks-avatar"><div class="error-msg"></div></div>
	<input type="range" class="cropit-image-zoom-input">
	<input type="hidden" name="imgDr" id="imgDr" />
	<div class="change-photo">
	<div class="ks-info"> <button type="button" class="btn btn-primary imgSelect">
	<span class="fa fa-upload ks-icon"></span>
	<span class="ks-text">Upload Photo</span>
	</button></div>
	</div>
	</div>

	</div>
	<div class="col-md-9">

	<input type="hidden" name="curImg" id="curImg" value="" />
	<input type="hidden" name="action" value="crtItem"><!-- ks-uppercase ks-light -->
	<h3 class="ks-header">Admin Details</h3>

	<div class="form-group row">
	<div class="col-lg-4">
	<label>Select the Category</label>
	<select class="form-control required-entry" name="txtcategory" id="txtcategory">
		<option>Select the Category</option>
	<?php foreach ($category as $key) { ?>
	
	<option value="<?php echo $key['cat_id'] ?>"><?php echo $key['cat_name'] ?></option>
	
	<?php } ?>

	</select>
	</div>	
	<div class="col-lg-4">
	<label>Select the Brand</label>
	<select class="form-control required-entry" name="txtbrand" id="txtbrand">
	<?php foreach ($brand as $key) { ?>

	<option value="<?php echo $key['br_id'] ?>"><?php echo $key['br_name'] ?></option>
	
	<?php } ?>

	
	</select>
	</div>
	</div>

	<div class="form-group row">
	<div class="col-lg-4">
	<label>Item name</label>
	<input type="text" class="form-control" name="txtitem" id="txtitem" value="" >
	</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="col-md-12">
<h5 class="card-header">
All Services 
</h5>
<div class="card-block">
<table class="table table-bordered table-responsive">
<thead>
<tr>
<th width="1px">#</th>
<th>Service Description</th>
<th>Service Charge</th>
<th>Left Position</th>
<th>Right Position</th>
<th>Option</th>
</tr>
</thead>
<tbody id="tbody">

</tbody>
<tfoot><tr ><td colspan="6" align="right"><button type="submit" id="btn_add_service" class="btn btn-primary">Add Service</button></td></tr></tfoot>
</table>
<div class="form-group row">
	<div class="col-lg-12">
	<button name="btnSave" id="btnSave" type="submit" class="btn btn-success">Save &amp; update</button>
	</div>
	<div id="profNot"></div>

	</div>
	</div>
</div>


	</div>

	</div>





	
</form>
</div>
</div>
</div>
</div>

<?php
admin_footer();
