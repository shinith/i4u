<?php require_once 'template.php';
admin_header("Add Services | VyaparFormations");
//ini_set("display_errors",1);
$serobj=new MysqliDb(HOST,USER,PWD,DB);
$typear=$serobj->get("vf_sertype",null,"st_id,st_name");
$serobj->join("vf_sercat cat","cat.sc_id=s.ser_subcat");
$ser=$serobj->get("vf_service s",null,"s.ser_id,s.ser_type,s.ser_min,s.ser_title,s.ser_subcat,cat.sc_name");
//echo $serobj->getLastQuery();
foreach ($ser as $key => $service) {
$subcatar[$service["ser_type"]][$service["ser_subcat"]]=$service["sc_name"];
$servarr[$service["ser_subcat"]][]=Array("id"=>$service["ser_id"],"min"=>$service["ser_min"],"type"=>$service["ser_type"],"name"=>$service["ser_title"]);
}
$serobj->join("vf_service s","s.ser_id=ap.ser_id");
$serobj->where("ap.cmp_id",$_SESSION["CMP"]);
$serobj->where("ap.ap_status",9,"!=");
$myservices=$serobj->get("vf_application ap",null,"ap_id,ap.ap_apstatus,s.ser_title,s.ser_id");
$activecnt=$serobj->count;
//echo $serobj->getLastQuery();
// /print_r($subcatar);exit;
?>
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>libs/sweetalert/sweetalert.css">
<script src="<?php echo ADMINROOT?>libs/sweetalert/sweetalert.js"></script>
<style type="text/css">
.tab-content .disabled{color:#ccc;cursor: not-allowed;}
form .tab-content{margin-top:20px;}	
</style>
<script type="text/javascript">
$(document).ready(function(){
var delids=[]
$(document).on("click",".delCat",function(del){
del.preventDefault();
//id ser title
var tick=$(this).data("id");
var serid=$(this).data("ser");
var sertitle=$(this).data("title");
if($(this).hasClass('disabled')){
	swal({
  title: "Are you sure?",
  text: "Please contact to the administrator to remove this service",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, Confirm request!",
  closeOnConfirm: false
},
function(){
	$.ajax({
		url: '<?php echo ROOT?>ajax/company-ajax.php',
		type: 'POST',
		data: {"action":"delReqServ","tick":tick,"serid":serid,"sertitle":sertitle},
	})
	.done(function() {
		console.log("success");
		swal({
  title: "Success!",
  text: "Your request has been successfully submited,we will contact you soon",
  type: "success",
  showCancelButton: false,
  confirmButtonClass: "btn-success",
  confirmButtonText: "Close",
  closeOnConfirm: true
});
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
  //
});
}
else{
delids.push($(this).data("id"));
$(this).parent().remove();
}

});	

$(".delCat").each(function(index,elmen){
	//console.log($(elmen).data("id"));
$(".chk"+$(elmen).data("ser")).attr({"checked":"checked","disabled":"disabled"})	
});
$(document).on('submit',"#frmService",function(event) {
event.preventDefault();
$("#serNot").html("");
frmval=$(this).serializeArray();
if(delids.length>0){
	frmval.push({ name: "del", value: delids});
}
$("#btnService").html("Processing").attr("disabled","disabled");
$.ajax({
	url: '<?php echo ROOT?>ajax/account-ajax.php',
	type: 'POST',
	data: frmval
})
.done(function(response) {
	//console.log(response);
$("#btnService").html("Update").removeAttr("disabled");
	try{
	jsn=$.parseJSON(response);	
	if(jsn.status=="done"){
	$("#serNot").html("<div class='ks-color-success'>Service appliction list updated</div>");
    setTimeout(function(){location.reload();},500);
	}else{
	$("#serNot").html("<div class='ks-color-danger'>Something went wrong,Please try again</div>");	
	}
	}
	catch(exp){

	}
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
<h3>Select Services</h3>
</section>
</div>

<div class="ks-content">
<div class="ks-body ks-tabs-page-container">
<form name="frmService" id="frmService" method="post">
<input type="hidden" name="action" value="addSerDash">
<ul class="nav ks-nav-tabs ks-tabs-page-default">
<?php $ocls="";foreach ($typear as $key => $stype) { ?>
<li class="nav-item">
<a class="nav-link <?php echo $ocls?>" href="#" data-toggle="tab" data-target="#tab<?php echo $key?>"><?php echo $stype["st_name"]?>
</a>
</li>
<?php $ocls=""; } if($activecnt>0){?>
<li class="nav-item">
<a class="nav-link active" href="#" data-toggle="tab" data-target="#tabselected">
Total Selected
<span class="badge badge-danger-outline badge-pill"><?php echo $activecnt?></span>
</a>
</li>
<?php }?>
</ul>
<div class="tab-content">
<?php $cls=""; foreach($typear as $key => $stype){?>
<div class="col-lg-12 tab-pane ks-column-section <?php echo $cls?>" id="tab<?php echo $key?>" role="tabpanel">

<div class="row">
<div class="col-lg-12">
<div class="ks-tabs-container ks-tabs-default ks-tabs-with-separator ks-tabs-header-default ks-tabs-primary tabs-bordered">
<ul class="nav ks-nav-tabs">
<?php $scls="active";foreach($subcatar[$stype["st_id"]] as $index=>$scat){?>
<li class="nav-item">
<a class="nav-link <?php echo $scls?>" href="#" data-toggle="tab" data-target="#stab<?php echo $index?>"><?php echo $scat?>
</a>
</li>
<?php $scls="";}?>

</ul>
<div class="tab-content">
<?php 
$selected='active';foreach($subcatar[$stype["st_id"]] as $index=>$scat){?>
<div class="tab-pane <?php echo $selected?>" id="<?php echo "stab".$index?>" role="tabpanel">
<div class="col-lg-12">
<?php foreach($servarr[$index] as $service){?>
<label class="custom-control custom-checkbox">
<input  data-id="<?php echo $service["id"]?>" type="checkbox" value="<?php echo $service["type"]."|".$service["name"]."|".$service["min"]?>" name="chk[<?php echo $service["id"]?>]" class="custom-control-input chk<?php echo $service["id"]?>">
<span class="custom-control-indicator"></span>
<span class="custom-control-description"><?php echo $service["name"]?></span>
</label><br>
<?php }?>



</div>

</div>
<?php $selected=''; }?>
</div>
</div>
</div>
</div>

</div>
<?php $cls=""; }if($activecnt>0){?>
<div class="col-lg-12 tab-pane ks-column-section active" id="tabselected" role="tabpanel">

<div class="row">
<div class="col-lg-12">
<div class="ks-tabs-container ks-tabs-default ks-tabs-with-separator ks-tabs-header-default ks-tabs-primary tabs-bordered">
<ul class="nav ks-nav-tabs">
<li class="nav-item">
<a class="nav-link active" href="#" data-toggle="tab" data-target="#stabactive">Active</a>
</li>
</ul>
<div class="tab-content">

<div class="tab-pane active" id="stabactive" role="tabpanel">
<div class="col-lg-12">
<?php foreach($myservices as $service){?>
<p class="">
<a href="#" data-id="<?php echo $service["ap_id"]?>" data-ser="<?php echo $service["ser_id"]?>" data-title="<?php echo $service["ser_title"]?>" class="delCat disabled"><i class="fa fa-trash-o fa-2x"></i></a>
<span class="custom-control-description"><?php echo $service["ser_title"]?></span>
</p>
<?php }?>


</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php }?>
</div>
<div class="col-md-12"><button id="btnService" class="btn btn-primary">Update</button>
<div id="serNot"></div>
</div>
</form>
</div>
</div>
</div>

<?php admin_footer(); ?> 