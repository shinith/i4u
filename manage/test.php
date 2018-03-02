<?php require_once 'template.php';
if($_SESSION["SUTYPE"]!=2)
{
header("location:".SU."users");
}
admin_header("I4UR Gadget| User Details","");
$brndobj=new MysqliDb(HOST,USER,PWD,DB);
$uid=$_GET["id"];
if($uid){
$brndobj->where("br_id",$uid);
$brndobj->join("tbl_category cgry","cgry.cat_id=brnd.cat_id","inner");
$result=$brndobj->getOne("tbl_brand brnd","br_id,br_name,cat_name");
print_r($result);
}

?>
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>assets/styles/profile/settings.min.css">
<link href="<?php echo ADMINROOT?>libs/flatpickr/flatpickr.min.css" rel="stylesheet">
<script src="<?php echo ADMINROOT?>libs/flatpickr/flatpickr.js"></script>
<script src="<?php echo ADMINROOT?>assets/cropit/jquery.cropit.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {

var cat_id=$("select option:selected").val();
        $("#category_id").val(cat_id);


$("select").change(function(){
// alert("hi");
        var cat_id=$("select option:selected").val();
        $("#category_id").val(cat_id);

});


$(document).on("submit","#createbrand",function(fm){
fm.preventDefault();

frmdata=$(this).serialize();
//pwdbtn=$("#btnPwd");
//$(pwdbtn).html("Processing...").attr("disabled","disabled");
$.ajax({"url":"<?php echo ROOT?>ajax/brand-ajax.php",type:'post', data:frmdata,success:function(response){

	console.log(response);
	try{
	
		brndjsn=$.parseJSON(response);
		alert(brndjsn.status);
		
		if(brndjsn.status=="exist"){

			$("#brndNot").html("<div class='ks-color-danger'>You have the Brand already created for this category</div>");
			location.reload();
		}
		if(brndjsn.status=="done"){
			$("#brndNot").html("<div class='ks-color-success'>New Brand created successfully</div>");
			location.reload();

		}
	}catch(exp){
		console.log(exp);
	}
 }
});

});
});
</script>

<div class="ks-column ks-page">
<div class="ks-header">
<section class="ks-title">
<h3>Create a new Brand</h3>
<div class="ks-controls">
<button type="button" class="btn btn-primary-outline ks-light ks-profile-tabs-block-toggle" data-block-toggle=".ks-profile > .ks-tabs-container">Tabs</button>
<button type="button" class="btn btn-primary-outline ks-light ks-settings-menu-block-toggle" data-block-toggle=".ks-settings-tab > .ks-menu">Menu</button>
</div>
</section>
</div>

<div class="ks-content">
<div class="ks-body ks-profile">
<?php if($profile["admin_id"]){?>
<!-- 	<div class="ks-header">
<div class="ks-user">
<img src="<?php echo $crpimg?>" class="ks-avatar" width="100" height="100">

<div class="ks-info">
<div class="ks-name"><?php echo $profile["admin_name"]." ".$profile["admin_lname"]?></div>
<div class="ks-description"><h5><?php echo $profile["cmp_name"]?></h5></div>
</div>

</div>

</div> -->
<?php }?>
<div class="ks-tabs-container ks-tabs-default ks-tabs-no-separator ks-full ks-light">
<ul class="nav ks-nav-tabs">
<?php if($profile["admin_id"]){?>
<li class="nav-item">
<a class="nav-link <?php echo $_GET["action"]=="pwd"?"":"active"?>" href="#" data-toggle="tab" data-target="#overview" aria-expanded="true">General</a>
</li>
<li class="nav-item">
<a class="nav-link " href="#" data-toggle="tab" data-target="#settings" aria-expanded="true">Edit Profile</a> </li>
<li class="nav-item">
<a class="nav-link <?php echo $_GET["action"]=="pwd"?"active":""?>" href="#" data-toggle="tab" data-target="#chPwd" aria-expanded="true">Change Password</a></li>
<?php }else{
?>
<li class="nav-item">
<a class="nav-link active" href="#" data-toggle="tab" data-target="#settings" aria-expanded="true">General</a> </li>
<?php
}?>
</ul>
<div class="tab-content">
	<?php if($profile["admin_id"]){?>
<div class="tab-pane <?php echo $_GET["action"]!="pwd"?"active":""?>" id="overview" role="tabpanel" aria-expanded="true">
<div class="row">
<!-- <div class="col-lg-1">

<div class="ks-description"><h5>Name:</h5></div>
<div class="ks-description"><strong>Address:</strong> </div> <br>
<div class="ks-description"><strong>Email Id:</strong> </div> <br>
<div class="ks-description"><strong>Phone#:</strong> </div> <br>

</div>
 -->
<!-- <div class="col-lg-4">

<div class="ks-description"><h5><?php echo $profile["admin_name"]." ".$profile["admin_lname"]?></h5></div>
<div class="ks-description"><?php echo $profile["admin_address"]?$profile["admin_address"]:"--"?></div><br>
<div class="ks-description"><?php echo $profile["admin_email"]?></div> <br>
<div class="ks-description"><?php echo $profile["admin_mobile"]?></div> <br>

</div> -->



</div>



</div>
<!-- <div class="tab-pane" id="settings" role="tabpanel" aria-expanded="true">
<div class="ks-settings-tab">
<div class="ks-menu">
<div id="picEditor" class="agent-photos col-md-12">
</div>
</div>

</div> -->
<!-- <form class="ks-form" id="frmUProfile" method="post">

<input type="hidden" name="userid" value="<?php echo $profile["admin_id"]?>">

<input type="hidden" name="curImg" id="curImg" value="<?php echo $profile["admin_img"]?>" />

<input type="hidden" name="action" value=""><!-- ks-uppercase ks-light -->
<h3 class="ks-header">Edit Profile</h3>




<div class="form-group row">

<div class="offset-md-3 col-md-5">
<button class="btn btn-success" id="btnPwd">Change Password</button>
<div id="pwdNot"></div>
</div>
</div>
</form>

</div> -->
<?php } else{?>
	<div class="tab-pane active" id="settings" role="tabpanel" aria-expanded="true">
	<div class="ks-settings-tab">
	<div class="ks-menu">
	<div id="picEditor" class="agent-photos col-md-12">

	<!-- <input type="file" class="hidden cropit-image-input">
	<div class="cropit-image-preview ks-avatar"><div class="error-msg"></div></div>
	<input type="range" class="cropit-image-zoom-input">
	<input type="hidden" name="imgDr" id="imgDr" />
	<div class="change-photo">
	<div class="ks-info"> <button type="button" class="btn btn-primary imgSelect">
	<span class="fa fa-upload ks-icon"></span>
	<span class="ks-text">Upload Photo</span>
	</button></div>
	 --></div>
	</div>

	</div>
	<form class="ks-form" id="createbrand" method="post">
	<input type="hidden" name="curImg" id="curImg" value="<?php echo $profile["admin_img"]?>" />
	<input type="hidden" name="action" value="newBrand"><!-- ks-uppercase ks-light -->
	<input type="hidden" name="category_selected" id="category_id" value="">
	
	<h3 class="ks-header">Brand Details</h3>

	<div class="form-group row">
	<div class="col-lg-4">
	<label>Select the Category</label>
	<select class="form-control required-entry" name="txtFname" id="txtFname" value="<?php echo $profile["admin_name"]?>">
	<?php 
	if($result)
	{
	foreach ($result as $key) { ?>
	<option value="<?php echo $key['cat_id'];?>"><?php echo $key['cat_name'];?></option>
	<?php	} ?>
	</select>
	<!-- <input type="text" class="form-control required-entry" name="txtFname" id="txtFname" value="<?php echo $profile["admin_name"]?>"> -->
	</div>
	<div class="col-lg-4">
	<label>Brand Name</label>
	<input type="text" class="form-control required-entry" name="txtbname" id="txtbname" value="<?php echo $result["br_name"]?>">
	
	<?php } else{ 
	foreach ($brand as $key) { ?>
	<option value="<?php echo $key['cat_id'];?>"><?php echo $key['cat_name'];?></option>
	<?php	} ?>
	</select>
	<!-- <input type="text" class="form-control required-entry" name="txtFname" id="txtFname" value="<?php echo $profile["admin_name"]?>"> -->
	</div>
	<div class="col-lg-4">
	<label>Brand Name</label>
	<input type="text" class="form-control required-entry" name="txtbname" id="txtbname" value="<?php echo $profile["admin_lname"]?>">
	<?php } ?>

	</div>
	</div>
	
	<div class="form-group row">
	<div class="col-lg-12">
	<button name="btnSave" id="btnSave" type="submit" class="btn btn-success">Save &amp; update</button>
	</div>
	<div id="brndNot"></div>
	</div>
	</form>
	</div>

	</div>
<?php }?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
admin_footer();
?>