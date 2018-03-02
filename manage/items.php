<?php
require_once 'template.php';
$ubtn=$_SESSION["SUTYPE"]==2?"<a type='button' class='btn btn-info' href='".ADMINROOT."create-item.php'>Create New Item</a>":"";
admin_header("I4UR Gadget | Items",$ubtn);
$empobj=new MysqliDb(HOST,USER,PWD,DB);
// $empobj->orderBy("ad.admin_id");
$empobj->join("tbl_category cgry","cgry.cat_id=itm.cat_id","LEFT");

$empobj->join("tbl_brand brnd","brnd.br_id=itm.br_id","LEFT");
$empobj->orderBy("itm.item_id");
$itemarr=$empobj->get("tbl_item itm",null,"itm.item_id,item_name,br_name,cat_name");
//echo $empobj->getLastQuery();
// print_r($itemarr);
//exit;
?>
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>libs/bootstrap-datepicker/css/bootstrap-datepicker.css">
<script type="text/javascript" src="<?php echo ADMINROOT?>libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/jquery.form.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$(".dp").datepicker({"format":"dd-mm-yyyy"});


$(document).on("submit","#frmUser",function(evt){
evt.preventDefault();
filevalid=true;
msg="";
$("#frmUser .form-control").each(function(index,element){
	if(!$(element).val()){
	filevalid=false;
	}
});
if(filevalid){
$("#btnSave").attr({"disabled":"disabled"}).html("Processing....");

$("#frmUser").ajaxSubmit({"url":"<?php echo ROOT?>ajax/user-ajax.php",type:"POST",
success:function(response){
console.log(response);
try{
$("#btnSave").removeAttr("disabled").html("Save");
resparray=$.parseJSON(response);
if(resparray.status=="done")
{
$("#usrNot").html("<div class='ks-color-success'>User profile updated successfully</div>");
window.location.reload(true);
}
else if(resparray.status=="exist")
{
$("#usrNot").html("<div class='ks-color-danger'>Specified email ID in use please try with some other email ID</div>");
}
else
{
$("#usrNot").html("<div class='ks-color-danger'>Something went wrong please try again</div>");
}

}
catch(err){}
}
});
}else{
$("#usrNot").html("<div class='ks-color-danger'>"+msg+"Please check all fields</div>");
}
});
});
</script>
<div class="ks-column ks-page ">
<div class="ks-header">
<section class="ks-title">
<h3>I4UR Gadgets Items</h3>
</section>
</div>
<div class="ks-content">
<div class="ks-body">
<div class="container-fluid ks-rows-section">

<div class="ks-content">
<div class="ks-body tables-page">
<div class="container-fluid ks-rows-section">
<div class="row">
<div class="col-lg-12" >
<div id='docPnl' style="display: none;" class="card panel panel-primary block-default">
<h5 class="card-header" id="docPnTitle">Create new user</h5>
<div class="card-block">

</div>
</div>
<div class="card panel panel-default panel-table">
<div class="card-block">
<table class="table table-bordered">
<thead>
<tr>
<th width="1">#</th>
<th>Name.</th>
<th>Brand</th>
<th>Category</th>
<!-- <th>Last login</th>
<th>Status</th> -->
<?php if($_SESSION["SUTYPE"]==2){?>
<th>Option</th>
<?php }?>
</tr>
</thead>
<tbody>
<?php
foreach ($itemarr as $user){
$count++;
?>
<tr>
<td scope="row"><?php echo $count; ?></td>
<td> <?php echo $user['item_name']?></td>
<td> <?php echo $user['br_name'] ?></td>
<td> <?php echo $user['cat_name'] ?></td>
<!-- <td> <?php echo $user['al_intime']?date("d M,Y h:i a",strtotime($user['al_intime'])):"--"?></td> -->
<!-- <td> <?php echo $user['admin_status']==9?"<div class='ks-color-danger'>inactive</div>":"<div class='ks-color-success'>active</div>"?></td> -->
<?php if($_SESSION["SUTYPE"]==2){?>
<td>

	<a href='<?php echo ADMINROOT."create-item.php?id=".$user['item_id']?>'>Edit</a>
<a data-toggle="modal" data-target="#delConfirm" data-action="delItem" data-title="User" data-delid="<?php echo $user['item_id']?>" href="#">Delete</a>
</td>
<?php }?>
</tr><?php }?>

</tbody>
</table>
</div>
</div>
</div>

</div>



</div>
</div>
</div>



</div>
</div>
</div>
</div>
<?php admin_footer(); ?>
