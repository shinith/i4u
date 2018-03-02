<?php 
require_once  'su-template.php';
admin_header("Vyapar Formations | Pages","<button type='button' class='btn btn-info btnPage' href='#' data-id='' data-dt='' data-title='' data-desc='' data-url='' data-kwd=''>Create New Page</button>");
$pgobj=new MysqliDb(HOST,USER,PWD,DB);

$pagearr=$pgobj->get("vf_seo",null,"seo_id,seo_title,seo_date,seo_type,seo_url,seo_desc,seo_kewd");

//print_r($pagearr);exit;
?>
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>libs/bootstrap-datepicker/css/bootstrap-datepicker.css">
<script type="text/javascript" src="<?php echo ADMINROOT?>libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/jquery.form.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$(".dp").datepicker({"format":"dd-mm-yyyy"});    
$(document).on('click', '.btnPage', function(event) {
event.preventDefault();
$(document).scrollTop(0);
$this=$(this);
$(document).scrollTop();
$("#docPnl").show();	
$("#pageId").val($this.data("id"));	
$("#txtKwd").val($this.data("kwd"));	
$("#txtTitle").val($this.data("title"));	
$("#txtDesc").val($this.data("desc"));	
$("#txtUrl").val($this.data("url")); 
$("#docPnTitle").html($this.data("id")?"Update Page Details":"Create New Page")   
});	


$(document).on("submit","#frmPage",function(evt){
evt.preventDefault();
filevalid=true;    
msg="";
$("#frmPage .form-control").each(function(index,element){
	if(!$(element).val()){
	filevalid=false;	
	}
});
if(filevalid){
$("#btnSave").attr({"disabled":"disabled"}).html("Processing....");

$("#frmPage").ajaxSubmit({"url":"<?php echo ROOT?>ajax/common-ajax.php",type:"POST",
success:function(response){
console.log(response);	
try{
$("#btnSave").removeAttr("disabled").html("Save"); 
resparray=$.parseJSON(response);
if(resparray.status=="done")
{
$("#usrNot").html("<div class='ks-color-success'>Page details updated successfully</div>");
window.location.reload(true);
}
else if(resparray.status=="exist")
{
$("#usrNot").html("<div class='ks-color-danger'>Specified URL is registered.Please try with other URL</div>");
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
<h3>Vyapar Formations Website Pages</h3>
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
<h5 class="card-header" id="docPnTitle">Create new page</h5>
<div class="card-block">
<form name="frmPage" id="frmPage">
<input type="hidden" name="action" value="seoPage">
<input type="hidden" name="currfile" id="currfile" value="">
<input type="hidden" name="pageId" id="pageId" value="">
<div class="form-group row">

<div class="col-lg-6">
<label>Title</label>
<input name="txtTitle" id="txtTitle" class="form-control" placeholder="" type="text">
</div>
<div class="col-lg-6">
<label>URL</label>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3"><?php echo ROOT?></span>
  <input name="txtUrl" id="txtUrl" class="form-control" placeholder="" type="text">
</div>

</div>
</div>
<div class="form-group row">
<div class="col-lg-6">
<label>Keywords</label>
<textarea name="txtKwd" id="txtKwd" class="form-control" type="text"></textarea>
</div>
<div class="col-lg-6">
<label>Description</label>
<textarea  name="txtDesc" id="txtDesc" class="form-control" ></textarea>
</div>


</div>
<div class="form-group row">
<div class="col-lg-4">
<button class="btn btn-info" id="btnSave">Save</button>
</div>
</div>
<div id="usrNot"></div>
</div>
</div>
<div class="card panel panel-default panel-table">
<div class="card-block">
<table class="table table-bordered">
<thead>
<tr>
<th width="1">#</th>
<th>Title</th>
<th>URL</th>
<th>KeyWords</th>
<th>Last Updated</th>
<th>Option</th>

</tr>
</thead>
<tbody>
<?php 
foreach ($pagearr as $page){ 
$count++;
?>
<tr>
<td scope="row"><?php echo $count; ?></td>
<td> <?php echo $page['seo_title']?></td>
<td> <?php echo ROOT.$page['seo_url'];?></td>
<td>  <?php echo strlen($page["seo_kewd"])>80?substr(0,80,$page["seo_kewd"])."....":$page["seo_kewd"]?></td>
<td><?php echo date("h:i:a d M,Y",strtotime($page['seo_date']))?></td>
<td>

<a class='btnPage' href='#' data-id="<?php echo $page['seo_id']?>" data-dt="<?php echo date("d-m-Y",strtotime($page['seo_date']))?>" data-title="<?php echo $page['seo_title']?>" data-desc="<?php echo $page['seo_desc']?>" data-url="<?php echo $page["seo_url"]?>" data-kwd="<?php echo $page["seo_kewd"]?>">Edit</a>
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