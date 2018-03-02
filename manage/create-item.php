<?php require_once 'template.php';
if($_SESSION["SUTYPE"]!=2)
{
header("location:".SU."users");
}
admin_header("I4UR Gadget | Create Item ","");
$obj=new MysqliDb(HOST,USER,PWD,DB);
$uid=$_GET["id"];
$crpimg=ADMINROOT."assets/img/avatars/avatar-12.jpg";
if($uid)
{
$obj->where("rep.item_id",$uid);
//$obj->join("tbl_item itm","itm.item_id=rep.item_id","LEFT");
$reparr=$obj->get("item_repair rep",null,"ir_amount,ir_id,ir_desc,ir_name,ir_lpos,ir_tpos");

$obj->where("itm.item_id",$uid);
$itmdet=$obj->getOne("tbl_item itm",null,"itm.item_id,item_name,br_id,cat_id");
// print_r($reparr);
}


$brand=$obj->get("tbl_brand",null,"br_id,br_name");
$category=$obj->get("tbl_category",null,"cat_id,cat_name");

?>
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>assets/styles/profile/settings.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo ROOT?>css/cropit.css">
<link href="<?php echo ADMINROOT?>libs/flatpickr/flatpickr.min.css" rel="stylesheet">
<script src="<?php echo ADMINROOT?>libs/flatpickr/flatpickr.js"></script>
<script src="<?php echo ADMINROOT?>assets/cropit/jquery.cropit.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {


var delids=[];
$("#txtcategory").change(function(){
	// $("#tbody").remove();
	var cat_id=$("#txtcategory option:selected").val();
	// alert(cat_id);
	
	$.ajax({"url":"<?php echo ROOT?>ajax/brand-ajax.php",type:'post',data:{ action: "service",dataid: cat_id},dataType:"json",success:function(response){
	console.log(response);
	$("#tbody").empty();
	for(var i=0;i<response.count;i++)
	{
		//alert(response.result[i].rep_name);
		// var j=i+1;
		// alert(j);ir_desc

		$("#tbody").append("<tr id='row"+i+"'><td class='index'>"+(i+1)+"</td><td><input type='text' class='txt' id='service_name"+i+"' name='service_name[]' value ='"+response.result[i].rep_name+"'></td><td><input type='hidden' name='service_id[]' value =''><input type='text' class='txt' id='service_name"+i+"' name='service_desc[]' value ='"+response.result[i].rep_desc+"'></td><td><input type='text' class='txt numeric' name='service_rate[]' id='service_rate"+i+"' value ='"+response.result[i].rep_amount+"'></td><td><input type='text' class='txt numeric' name='service_lpos[]' id='service_lpos"+i+"' value ='"+response.result[i].rep_lpos+"'></td><td><input type='text' class='txt numeric' name='service_tpos[]' id='service_tpos"+i+"' value ='"+response.result[i].rep_tpos+"'></td><td><a class='rmvService' href='#'>Delete</a></td></tr>");
	}
}
});



});

$(document).on("click",".rmvService",function(event) {
event.preventDefault();
delids.push($(this).data("id"));
$(this).closest('tr').remove();
setRownum();
});

$("#btn_add_service").click(function(evt){
evt.preventDefault();
var ob= $("#tbody tr").eq(0).clone();
ob.find('.txt').val('');
ob.appendTo(".table tbody:last");
console.log();
setRownum();
});

function setRownum(){
	//alert("");
    $("#tbody").find("tr").each(function(index,row){
    $(this).find(".index").html(index+1);
});
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
  var formValue = new FormData($('#newfmItem')[0]);

ImageURL = $('#picEditor').cropit('export',{type: 'image/jpeg',quality: .9});
if(ImageURL){
var block = ImageURL.split(";");
var contentType = block[0].split(":")[1];
var realData = block[1].split(",")[1];
blob = b64toBlob(realData, contentType);
formValue.append("img", blob);}
formValue.append("delids", delids);
  $.ajax({
  	url: '<?php echo ROOT?>ajax/brand-ajax.php',
  	type: 'POST',
  	async: false,contentType:false,
processData:false,cache:false,
  	data: formValue,
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


crpit=$('#picEditor').cropit({"imageState": { "src":  '<?php echo $crpimg?>'  },"width":105,"height":105,"allowDragNDrop":true,"smallImage":"reject","freeMove":false,"onFileReaderError":function(){},"onImageError":imgErr,"exportZoom":2});
$(document).on("click",".imgSelect",function(){
$(this).closest("#picEditor").find(".cropit-image-input").click();
});
function imgErr(obj){

$(this)[0].$preview.addClass('has-danger');
//$(this)[0].$errmsg.html(msg);

}
});


</script>

<div class="ks-column ks-page">
<div class="ks-header">
<section class="ks-title">
<h3><?php echo $uid?"Update item details":"Create new Item"?></h3>
</section>
</div>

<div class="ks-content">
<div class="ks-body ks-profile">
<div class="ks-full ks-light">


	

	<div class="active" id="settings" >
		<form class="ks-form form-horizontal" id="newfmItem" method="post">
	<div class="col-md-12">
	<div class="col-md-3 pull-left" >
	<div id="picEditor" class="col-md-12">

	<input type="file" class="hidden cropit-image-input">
	<div class="cropit-image-preview"><div class="error-msg">The image size should be greater than 210 X 210</div></div>
	<input type="range" class="cropit-image-zoom-input">
	<input type="hidden" name="imgDr" id="imgDr" />
	<div class="change-photo">
	<div class="ks-info" style="z-index:10"> <button type="button" class="btn btn-primary imgSelect">
	<span class="fa fa-upload ks-icon"></span>
	<span class="ks-text">Upload Photo</span>
	</button></div>
	</div>
	</div>

	</div>
	<div class="col-md-9 pull-right">

	<input type="hidden" name="curImg" id="curImg" value="" />
	<input type="hidden" name="action" value="crtItem">
	<input type="hidden" name="itemid" value="<?php echo $itmdet["item_id"]?>">
	<h3 class="ks-header">Category and Brand</h3>

	<div class="form-group row">
	<div class="col-lg-4">
	<label>Select the Category</label>
	<select class="form-control required-entry" <?php echo $itmdet["item_id"]?"readonly='true'":""?> name="txtcategory" id="txtcategory">
	
	<?php foreach ($category as $key) {
$selected=$itmdet["cat_id"]==$key['cat_id']?"selected='selected'":"";
$disabled=$itmdet["item_id"]>0 &&$itmdet["cat_id"]!=$key['cat_id']?" disabled='disabled'":" ";
	 ?>
	
	<option <?php echo $selected.$disabled?> value="<?php echo $key['cat_id'] ?>"><?php echo $key['cat_name'] ?></option>
	
	<?php } ?>

	</select>
	</div>	
	<div class="col-lg-4">
	<label>Select the Brand</label>
	<select class="form-control required-entry" name="txtbrand" id="txtbrand">
	

	<?php foreach ($brand as $key) { 
$selected=$itmdet["br_id"]==$key['br_id']?"selected='selected'":"";
		?>

	<option <?php echo $selected?> value="<?php echo $key['br_id'] ?>"><?php echo $key['br_name'] ?></option>
	
	<?php }  ?>

	
	
	</select>
	</div>
	</div>

	<div class="form-group row">
	<div class="col-lg-4">
	<label>Item name</label>
	<?php if($uid){ ?>
	<input type="text" class="form-control" name="txtitem" id="txtitem" value="<?php echo $itmdet['item_name'] ?>" >
	<?php } else{ ?>
	<input type="text" class="form-control" name="txtitem" id="txtitem" value="" >
	<?php } ?>
	
	</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="col-md-12">
<h5 class="card-header">
All Services 
</h5>
<div class="card-block">
<table class="table table-bordered table-responsive tblItem">
<thead>
<tr>
<th>#</th>
<th>Service Title</th>
<th>Service Description</th>
<th>Service Charge</th>
<th>Left Position</th>
<th>Right Position</th>
<th>Option</th>
</tr>
</thead>
<tbody id="tbody">
<?php $i=0;
if($uid){ foreach ($reparr as $key) { $i++;?>
<tr>
<td class="index"><?php echo $i;?></td>
<td>
	<input type='text' class='txt' name='service_name[]' value ='<?php echo $key['ir_name'];?>'></td>
<td><input type='hidden' class='txt' name='service_id[]' value ='<?php echo $key['ir_id'];?>'>
	<input type='text' class='txt' name='service_desc[]' value ='<?php echo $key['ir_desc'];?>'></td>
<td><input type='text' class='txt' name='service_rate[]' value ='<?php echo $key['ir_amount'];?>'></td>
<td><input type='text' class='txt' name='service_lpos[]' value ='<?php echo $key['ir_lpos'];?>'></td>
<td><input type='text' class='txt' name='service_tpos[]' value ='<?php echo $key['ir_tpos'];?>'></td>
<td><a class='rmvService' href='#' data-id="<?php echo $key['ir_id'];?>">Delete</a></td>
</tr>
<?php } }?>



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
</form>
	</div>





	

</div>
</div>
</div>
</div>

<?php
admin_footer();
