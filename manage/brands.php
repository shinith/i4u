<?php
require_once 'template.php';
$ubtn=$_SESSION["SUTYPE"]==2?"<a type='button' class='btn btn-info' href='".ADMINROOT."create-brand.php'>Create New Brand</a>":"";
admin_header("I4UR Gadget | Brands",$ubtn);
$empobj=new MysqliDb(HOST,USER,PWD,DB);
// $empobj->orderBy("br_nam");
$empobj->join("tbl_category cgry","cgry.cat_id=brnd.cat_id","inner");
// $empobj->groupBy("br_id");
$result=$empobj->get("tbl_brand brnd",null,"br_id,br_name,cat_name");

// print_r($brand);

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
<h3>I4UR Gadget Brands</h3>
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
<th>Brand Name</th>
<th>Category</th>
<th>Option</th>
</tr>
</thead>
<tbody>
<?php
foreach ($result as $brand){
$count++;
?>
<tr>
<td scope="row"><?php echo $count; ?></td>
<td> <?php echo $brand['br_name']?></td>
<td> <?php echo $brand['cat_name']?></td>
<td>
	<a href='<?php echo ADMINROOT."create-brand.php?"."id=".$brand['br_id']?>'>Edit</a>
<a data-toggle="modal" data-target="#delConfirm" data-action="delBrand" data-title="Brand" data-delid="<?php echo $brand['br_id']?>" href="#">Delete</a>
</td>
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
