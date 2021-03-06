<?php require_once 'template.php';
admin_header("I4UR Gadget| Admin Profile","");
$probj=new MysqliDb(HOST,USER,PWD,DB);
// $probj->where("u.user_id",$_SESSION["USER"]);
$probj->where("admin_id",$_SESSION["SUSER"]);
$profile=$probj->getOne("tbl_admin","admin_name,admin_lname,admin_email,admin_mobile,admin_address,admin_img");
$crpimg=($profile["admin_img"]?ROOT."uploads/".$profile["admin_img"]:ADMINROOT."assets/img/avatars/avatar-12.jpg");
// $probj->join("vf_company cm","cm.user_id=u.user_id");
// $profile=$probj->getOne("tbl_admin u","user_fname,user_lname,user_mail,user_number,user_desig,user_address,user_city,user_state,user_country,user_pin,user_head,user_img,cm.cmp_name,cm.cmp_city,cm.cmp_state,cm.cmp_country");
//echo $probj->getLastQuery();
// $crpimg=($profile["user_img"]?ROOT."uploads/".$profile["user_img"]:ADMINROOT."assets/img/avatars/avatar-12.jpg");

?>
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>assets/styles/profile/settings.min.css">
<script src="<?php echo ADMINROOT?>assets/cropit/jquery.cropit.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	crpit=$('#picEditor').cropit({"imageState": { "src":  '<?php echo $crpimg?>'  },"width":128,"height":128,"allowDragNDrop":true,"smallImage":"reject","freeMove":false,"onFileReaderError":function(){},"onImageError":imgErr});
$(document).on("click",".imgSelect",function(){
$(this).closest("#picEditor").find(".cropit-image-input").click();
});
function imgErr(obj){

$(this)[0].$preview.addClass('has-error');
//$(this)[0].$errmsg.html(msg);

}
//txtCnPwd txtNpwd txtCurPwd frmPwd chPwd
$(document).on("submit","#frmPwd",function(fm){
fm.preventDefault();
pwdvalid=true;
msg="";
$("#pwdNot").html("");
if(!$("#txtCurPwd").val())
{
pwdvalid=false;
msg="Please enter current password<br>";
}
if(!$("#txtNpwd").val())
{
pwdvalid=false;
msg="Please enter new password<br>";
}
if($("#txtCnPwd").val()!=$("#txtNpwd").val())
{
pwdvalid=false;
msg="New password and confirm password must be identical<br>";
}
if(pwdvalid){
frmdata=$(this).serialize();
pwdbtn=$("#btnPwd");
$(pwdbtn).html("Processing...").attr("disabled","disabled");
$.ajax({"url":"<?php echo ROOT?>ajax/account-ajax.php",type:'post', data:frmdata,success:function(response){
	console.log(response);
	$(pwdbtn).html("Change password").removeAttr("disabled");
	try{
		pwdjsn=$.parseJSON(response);
		if(pwdjsn.status=="error"){
			$("#pwdNot").html("<div class='ks-color-danger'>Your current password not matching</div>");
		}
		if(pwdjsn.status=="done"){
			$("#pwdNot").html("<div class='ks-color-success'>Yourpassword updated successfully</div>");
		}
	}catch(exp){}
}
});
}else{
$("#pwdNot").html("<div class='ks-color-danger'>"+msg+"</div>");
}
});

$(document).on("change","#selCountry",function(){
$("#selState").html("<option value=''>Select State</option>");
cnt=$(this).find("option:selected").data("cnt")
$.ajax({"url":"<?php echo ROOT?>ajax/company-ajax.php",type:'post', data:{"action":"getState","country":cnt},success:function(response){
	//console.log(response);
	try{
		jsnst=$.parseJSON(response);
		$.each(jsnst,function(indx,st){
		$("<option>").val(st).html(st).appendTo('#selState');

		});
	}catch(ex){}
}
});
});
$(document).on("submit","#frmUProfile",function(evt){
evt.preventDefault();
valid=true;
msg="";
btn=$("#btnSave")
$("#profNot").html("");
$('.has-error').removeClass('has-error');
$(this).find(".required-entry").each(function(index,elm){
if(!$(this).val()){
$(this).parent().addClass('has-error');
fldvalid=false;
valid=false;
msg="Please check All required fields<br>";
}
});
var eml = /^([A-Za-z0-9_\\.])+\@([A-Za-z0-9_\\.])+\.([A-Za-z]{2,4})$/;
if (!eml.test($.trim($("#txtEmail").val())))
{
$("#txtEmail").parent().addClass('has-error');
msg+="Enter a valid email ID<br>";
valid=false;
}
if(valid){
	btn.attr("disabled","disabled").html("Processsing...");
var formValue = new FormData($('#frmUProfile')[0]);

ImageURL = $('#picEditor').cropit('export',{type: 'image/jpeg',quality: .9});
if(ImageURL){
var block = ImageURL.split(";");
var contentType = block[0].split(":")[1];
var realData = block[1].split(",")[1];
blob = b64toBlob(realData, contentType);
formValue.append("img", blob);}
$.ajax({"url":"<?php echo ROOT?>ajax/account-ajax.php",type:'post',async: false,contentType:false,
processData:false,cache:false, data:formValue,success:function(returnData){
	console.log(returnData);
btn.removeAttr("disabled").html("GET STARTED");
$("#btnAddservice").removeAttr("disabled").html("ADD SERVICE");
console.log(returnData);
try{
$("#btnSave").removeAttr("disabled").html("Save");
resparray=$.parseJSON(returnData);
if(resparray.status=="done")
{
window.location.reload(true);
}
else if(resparray.status=="exist")
{
$("#profNot").html("<div class='ks-color-danger'>This email ID already in use</div>");
}
else
{
$("#profNot").html("<div class='ks-color-danger'>Something went wrong please try again</div>");
}
}
catch(exp){}
}
});

}
else{
$("#profNot").html("<div class='ks-color-danger'>"+msg+"</div>");
}
});

});

</script>

<div class="ks-column ks-page">
<div class="ks-header">
<section class="ks-title">
<h3>Profile Settings</h3>
<div class="ks-controls">
<button type="button" class="btn btn-primary-outline ks-light ks-profile-tabs-block-toggle" data-block-toggle=".ks-profile > .ks-tabs-container">Tabs</button>
<button type="button" class="btn btn-primary-outline ks-light ks-settings-menu-block-toggle" data-block-toggle=".ks-settings-tab > .ks-menu">Menu</button>
</div>
</section>
</div>

<div class="ks-content">
<div class="ks-body ks-profile">
<div class="ks-header">
<div class="ks-user">
<img src="<?php echo $crpimg?>" class="ks-avatar" width="100" height="100">

<div class="ks-info">
<div class="ks-name"><?php echo $profile["user_fname"]." ".$profile["user_lname"]?></div>
<div class="ks-description"><h5><?php echo $profile["cmp_name"]?></h5></div>
<div class="ks-description"><?php echo $profile["cmp_city"]." ".$profile["cmp_country"]?></div> <br>
<!--  -->
</div>

</div>

</div>
<div class="ks-tabs-container ks-tabs-default ks-tabs-no-separator ks-full ks-light">
<ul class="nav ks-nav-tabs">
<li class="nav-item">
<a class="nav-link <?php echo $_GET["action"]=="pwd"?"":"active"?>" href="#" data-toggle="tab" data-target="#overview" aria-expanded="true">General</a></li>

<li class="nav-item">
<a class="nav-link" href="#" data-toggle="tab" data-target="#settings" aria-expanded="false">Edit Profile</a> </li>
<li class="nav-item">
<a class="nav-link <?php echo $_GET["action"]=="pwd"?"active":""?>" href="#" data-toggle="tab" data-target="#chPwd" aria-expanded="false">Change Password</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane <?php echo $_GET["action"]=="pwd"?"":"active"?>" id="overview" role="tabpanel" aria-expanded="false">
<div class="row">


<div class="col-lg-1">

<div class="ks-description"><h5>Name:</h5></div>
<div class="ks-description"><strong>Company:</strong> </div>      <br>
<div class="ks-description"><strong>Address:</strong> </div> <br>
<div class="ks-description"><strong>Email Id:</strong> </div> <br>
<div class="ks-description"><strong>Phone #:</strong> </div> <br>

</div>

<div class="col-lg-4">

<div class="ks-description"><h5><?php echo $profile["user_fname"]." ".$profile["user_lname"]?></h5></div>
<div class="ks-description"><?php echo $profile["cmp_name"]?></div>      <br>
<div class="ks-description"><?php echo $profile["user_address"]?></div> <br>
<div class="ks-description"><?php echo $profile["user_mail"]?></div> <br>
<div class="ks-description"><?php echo $profile["user_number"]?></div> <br>

</div>



</div>



</div>
<div class="tab-pane" id="settings" role="tabpanel" aria-expanded="true">
<div class="ks-settings-tab">
<div class="ks-menu">
<div id="picEditor" class="agent-photos col-md-12">

<input type="file" class="hidden cropit-image-input">
<div class="cropit-image-preview ks-avatar"><div class="error-msg"></div></div>
<input type="range" class="cropit-image-zoom-input">
<input type="hidden" name="imgDr" id="imgDr" />
<div class="change-photo">
<div class="ks-info"> <button type="button" class="btn btn-primary imgSelect">
<span class="fa fa-upload ks-icon"></span>
<span class="ks-text">Change Picture</span>
</button></div>
</div>
</div>

</div>
<form class="ks-form" id="frmUProfile" method="post">
<input type="hidden" name="curImg" id="curImg" value="<?php echo $logres["user_img"]?>" />
<input type="hidden" name="action" value="userUpdate"><!-- ks-uppercase ks-light -->
<h3 class="ks-header">Edit Profile</h3>

<div class="form-group row">
<div class="col-lg-4">
<label>First Name</label>
<input type="text" class="form-control" name="txtFname" id="txtFname" value="<?php echo $profile["user_fname"]?>">
</div>
<div class="col-lg-4">
<label>Last Name</label>
<input type="text" class="form-control" name="txtLname" id="txtLname" value="<?php echo $profile["user_lname"]?>">

</div>
</div>
<div class="form-group row">
<div class="col-lg-4">
<label>Email</label>
<input type="email" class="form-control" name="txtEmail" id="txtEmail" value="<?php echo $profile["user_mail"]?>" >
</div>
<div class="col-lg-4">
<label>Phone Number</label>
<input type="text" class="form-control" name="txtPhone" id="txtPhone" value="<?php echo $profile["user_number"]?>" >
</div>

</div>
<div class="form-group row">
<div class="col-lg-4">
<label>Company Name</label>
<input type="text" class="form-control" name="txtCname" id="txtCname" value="<?php echo $profile["cmp_name"]?>" >
</div>
<div class="col-lg-4">
<label>Designation</label>
<input type="text" class="form-control" name="txtDesig" id="txtDesig" value="<?php echo $profile["user_desig"]?>" >
</div>
</div>
<div class="form-group row">
<div class="col-lg-4">
<div class="row">
<div class="col-lg-6">
<label>Country</label>
<select class="ks-selectpicker form-control" name="selCountry" id="selCountry">
<?php
$cntobj=new MysqliDb(HOST,USER,PWD,DB);
$cntar=$cntobj->get("vf_country",null,"country_id,country_name",null);
foreach($cntar as $country){
$selected=$profile["user_country"]==$country["country_name"]|| $country["country_name"]=="India"?"selected='selected'":"";
echo "<option $selected data-cnt='$country[country_id]' value='$country[country_name]'>$country[country_name]</option>";
}
?>



</select>
</div>
<div class="col-lg-6">
<label>City</label>
<input type="text" class="form-control" name="txtCity" id="txtCity" value="<?php echo $profile["cmp_city"]?>" >
</div>
</div>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-lg-6">
<label>State/Province</label>
<select class="ks-selectpicker form-control" data-live-search="true" name="selState" id="selState">
<?php
$stobj=new MysqliDb(HOST,USER,PWD,DB);
$statar=$stobj->getValue("vf_state","state_name",null);
foreach($statar as $state){
$selected=$profile["user_state"]==$state|| $state=="Karnataka"?"selected='selected'":"";
echo "<option $selected value='$state'>$state</option>";
}
?>
</select>
</div>
<div class="col-lg-6">
<label>Postal Code</label>
<input type="text" class="form-control" value="<?php echo $profile["user_pin"]?>" name="txtPin" id="txtPin" >
</div>
</div>
</div>
</div>
<!-- <div class="form-group row">
<div class="col-lg-8">
<label>Headline</label>
<textarea class="form-control" placeholder="Type something..." rows="3" name="txtHead" id="txtHead"><?php echo $profile["user_head"]?></textarea>
</div>
</div> -->
<div class="form-group row">
<div class="col-lg-8">
<label>Address</label>
<textarea class="form-control" placeholder="Type something..." rows="3" name="txtAddress" id="txtAddress"><?php echo $profile["user_address"]?></textarea>
</div>
</div>
<div class="form-group row">
<div class="col-lg-12">
<button name="btnSave" id="btnSave" type="submit" class="btn btn-success">Save &amp; update</button>
</div>
<div id="profNot"></div>
</div>
</form>
</div>
</div>
<div class="tab-pane <?php echo $_GET["action"]=="pwd"?"active":""?>" id="chPwd" role="tabpanel" aria-expanded="false">
<form name="frmPwd" id="frmPwd">
<input type="hidden" name="action" value="chPwd">
<div class="form-group row">
<label for="default-input" class="col-md-3 form-control-label">Current Password</label>
<div class="col-md-5">
<input type="password" name="txtCurPwd"  class="form-control" id="txtCurPwd"  placeholder="Current Password" >
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-md-3 form-control-label">New Password</label>
<div class="col-md-5">
<input type="password" name="txtNpwd" id="txtNpwd"  class="form-control"  placeholder="New Password" >
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-md-3 form-control-label">Confirm Password</label>
<div class="col-md-5">
<input type="password" name="txtCnPwd" id="txtCnPwd"  class="form-control"  placeholder="Confirm new Password" >
</div>
</div>
<div class="form-group row">

<div class="offset-md-3 col-md-5">
<button class="btn btn-success" id="btnPwd">Change Password</button>
<div id="pwdNot"></div>
</div>
</div>
</form>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
<?php
admin_footer();
