<?php
require_once 'template.php';
$ubtn=$_SESSION["SUTYPE"]==2?"<a type='button' class='btn btn-info' href='".ADMINROOT."create-admin.php'>Create New User</a>":"";
admin_header("I4UR Gadgets | Admins",$ubtn);
$empobj=new MysqliDb(HOST,USER,PWD,DB);
$empobj->orderBy("ad.admin_id");
$empobj->join("tbl_adminlog al","al.admin_id=ad.admin_id","LEFT");
$empobj->groupBy("ad.admin_id");
$userarr=$empobj->get("tbl_admin ad",null,"ad.admin_id,admin_name,admin_date,admin_type,admin_email,admin_mobile,admin_status,MAX(al.al_intime) AS al_intime");

//print_r($userarr);exit;
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
<h3>Vyapar fromations users</h3>
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
<th>Type</th>
<th>Date of Join</th>
<th>Last login</th>
<th>Status</th>
<?php if($_SESSION["SUTYPE"]==2){?>
<th>Option</th>
<?php }?>
</tr>
</thead>
<tbody>
<?php
foreach ($userarr as $user){
$count++;
?>
<tr>
<td scope="row"><?php echo $count; ?></td>
<td> <?php echo $user['admin_name']?></td>
<td> <?php echo $user['admin_type']==2?"Admin":"User"?></td>
<td> <?php echo date("d M,Y",strtotime($user['admin_date']))?></td>
<td> <?php echo $user['al_intime']?date("d M,Y h:i a",strtotime($user['al_intime'])):"--"?></td>
<td> <?php echo $user['admin_status']==9?"<div class='ks-color-danger'>inactive</div>":"<div class='ks-color-success'>active</div>"?></td>
<?php if($_SESSION["SUTYPE"]==2){?>
<td>

	<a href='<?php echo ADMINROOT."create-admin.php?id=".$user['admin_id']?>'>Edit</a>
<a data-toggle="modal" data-target="#delConfirm" data-action="delUder" data-title="User" data-delid="<?php echo $user['admin_id']?>" href="#">Delete</a>
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
