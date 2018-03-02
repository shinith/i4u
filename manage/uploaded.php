<?php require_once 'template.php';
admin_header("upload");
$dashobj=new MysqliDb(HOST,USER,PWD,DB);
$dashobj->where("doc_status","9","!=");
$dashobj->where("user_id ",$_SESSION["USER"]);
$docdata=$dashobj->get("vf_document",null,"doc_id,user_id,dt_id,doc_name,doc_status");
//echo var_dump($docdata);
$arraygroup=array();
foreach ($docdata as $key => $value) {

    $arraygroup[$value['doc_status']][$key]=$value['doc_name'];
    # code...
}
$result = array_unique($docdata);






?>
<script type="text/javascript" src="<?php echo ROOT?>js/jquery.form.min.js"></script>

<script type="text/javascript">
var delfile=[];
$(document).ready(function(){
filevalid=true;    
$(document).on("change",".imptfile",function(fle) {
wrpr=$(this).closest(".form-group");
lbl=$(wrpr).find(".form-control-label") ; 
$(wrpr).removeClass("has-danger");

fname=$(this).val().toLowerCase();

    if(fname.length>0)
    {
        if ( /\.(jpe?g|png|gif|bmp|pdf|doc|docx|odt)$/i.test(fname) ) {
            //console.log(this.files[0].size);
        if(this.files[0].size>3000000){
            $(lbl).find(".fileNot").html("File must be less than 3 MB").appendTo(lbl);
            $(wrpr).addClass("has-danger"); 
            filevalid=false;

        }
        else{
            $(lbl).find(".fileNot").html(fname.replace(/\\/g,'/').replace(/.*\//, ''));
        }
        }
        else{
            $(lbl).find(".fileNot").html("Only image or document ").appendTo(lbl);
            $(wrpr).addClass("has-danger"); 
            filevalid=false;
        }
       
        

    }
});

$(document).on("submit","#frmAplctn",function(evt){
evt.preventDefault();
    
$("#errMsg,#sucMsg").hide();

$("#btnSave").attr({"disabled":"disabled"}).html("Processing....");
if(filevalid){
$("#frmAplctn").ajaxSubmit({"url":"../ajax/account-ajax.php",data:{"action":"applcation","deleteimg":delfile},type:"POST",
success:function(response){
//alert(response);
try{
$("#btnSave").removeAttr("disabled").html("Save"); 
resparray=$.parseJSON(response);
if(resparray.status=="done")
{
  window.location.reload(true);
$("#sucMsg"). fadeIn();
$(document).scrollTop();
//window.location="uploaded.php";

}
else
{
$("#errMsg").fadeIn();
}

}
catch(err){}
//alert(response)
}
});
}else{
    //NOT VALID
}
});
});

</script>


<div class="ks-column ks-page  ">
<div class="ks-header">
<section class="ks-title ">
<h3>Documents</h3>
</section>
</div>

<div class="ks-content">
<div class="ks-body">
<?php if($docdata){

    ?>
<form id="frmAplctn" name="frmAplctn" method="post" enctype="multipart/form-data">
<input type="hidden" name="txtform" value="<?php echo $formno?>">
<input type="hidden" name="txtuserid" value="<?php echo $userid?>">

<div class="container-fluid">
<div class="row ">
<div class="col-lg-10 ks-panels-column-section">

<div class="card text-center">
<div class="card-block">
<h5 class="card-title">Document upload</h5>

<div class="form-group row">
<label for="default-input-rounded" class="col-sm-6 form-control-label"><h5>Other Supporting Documents</h5>
<div class="fileNot"> </div>
<p><?php foreach($docdata as $key => $val){
     if($val['doc_type']==0){
        //echo "string";?>
    <a href="<?php echo ROOT."download.php?file=".$val['doc_name'];  ?>">Supporting file</a>
        

    
<?php }} ?></p>
</label>
<div class="col-sm-6">
<label class="btn btn-primary ks-btn-file">
<span class="fa fa-cloud-upload ks-icon"></span>
<span class="ks-text">Choose file</span>
<input type="file" class="imptfile"  name="doc[0]">
</label>
</div>
</div>

<div class="form-group row">
<label for="default-input-rounded" class="col-sm-6 form-control-label"><h5>Utility Bill (less than 30 days old)</h5>
<div class="fileNot"></div>
<p><?php foreach($docdata as $key => $val){
     if($val['doc_type']==1){
        //echo "string";?>
    <a href="<?php echo ROOT."download.php?file=".$val['doc_name'];  ?>">Utility bill </a>
        

    
<?php }} ?></p></label>
<div class="col-sm-6">
<label class="btn btn-primary ks-btn-file">
<span class="fa fa-cloud-upload ks-icon"></span>
<span class="ks-text">Choose file</span>
<input type="file" class="imptfile"  name="doc[1]">
</label>
</div>
</div>
<div class="form-group row">
<label for="default-input-rounded" class="col-sm-6 form-control-label"><h5>Sale Deed / Rental Agreement</h5>
<div class="fileNot"></div>
<p><?php foreach($docdata as $key => $val){
     if($val['doc_type']==2){
        //echo "string";?>
    <a href="<?php echo ROOT."download.php?file=".$val['doc_name'];  ?>">Rental agreement </a>
        

    
<?php }} ?></p></label>
<div class="col-sm-6">
<label class="btn btn-primary ks-btn-file">
<span class="fa fa-cloud-upload ks-icon"></span>
<span class="ks-text">Choose file</span>
<input type="file" class="imptfile"  name="doc[2]">
</label>
</div>
</div>

<div class="form-group row">
<label for="default-input-rounded" class="col-sm-6 form-control-label"><h5>PAN Card copy</h5>
<div class="fileNot"></div>
<p><?php foreach($docdata as $key => $val){
     if($val['doc_type']==3){
        //echo "string";?>
    <a href="<?php echo ROOT."download.php?file=".$val['doc_name'];  ?>">Pan Card </a>
        

    
<?php }} ?></p></label>
<div class="col-sm-6">
<label class="btn btn-primary ks-btn-file">
<span class="fa fa-cloud-upload ks-icon"></span>
<span class="ks-text">Choose file</span>
<input type="file" class="imptfile"  name="doc[3]">
</label>
</div>
</div>
<div class="col-lg-12">
<div class="card-block">

<?php foreach ($result as $key => $value) {?>
<input type="hidden" name="docid" value="<?php echo $value['doc_id']?>">
<?php
if($value["doc_status"]==4){
//echo "string";?>
<div class="col-lg-4 pull-right">
<div class="alert alert-primary ks-solid" role="alert">
<strong>Well done!</strong> Your document proceeded.
</div>

</div>


<?php }else{?>

    <div class='pull-right'><button class='btn btn-primary' id='btnSave' > Save</button></div>

       <?php }
        }?>


</div>

</div>
</div>


</div>
</div>

</div>
</div>
</div>
</form>
    
<?php 
}else{?>
<form id="frmAplctn" name="frmAplctn" method="post" enctype="multipart/form-data">
<input type="hidden" name="txtform" value="<?php echo $formno?>">
<input type="hidden" name="txtuserid" value="<?php echo $userid?>">

<div class="container-fluid">
<div class="row ">
<div class="col-lg-10 ks-panels-column-section">

<div class="card text-center">
<div class="card-block">
<h5 class="card-title">Document upload</h5>

<div class="form-group row">
<label for="default-input-rounded" class="col-sm-6 form-control-label"><h5>Other Supporting Documents</h5>
<div class="fileNot"> </div>
<p></p>
</label>
<div class="col-sm-6">
<label class="btn btn-primary ks-btn-file">
<span class="fa fa-cloud-upload ks-icon"></span>
<span class="ks-text">Choose file</span>
<input type="file" class="imptfile"  name="doc[0]">
</label>
</div>
</div>

<div class="form-group row">
<label for="default-input-rounded" class="col-sm-6 form-control-label"><h5>Utility Bill (less than 30 days old)</h5>
<div class="fileNot"></div>
<p>Electricity Bill/Landline Bill</p></label>
<div class="col-sm-6">
<label class="btn btn-primary ks-btn-file">
<span class="fa fa-cloud-upload ks-icon"></span>
<span class="ks-text">Choose file</span>
<input type="file" class="imptfile"  name="doc[1]">
</label>
</div>
</div>
<div class="form-group row">
<label for="default-input-rounded" class="col-sm-6 form-control-label"><h5>Sale Deed / Rental Agreement</h5>
<div class="fileNot"></div>
<p>Sale Deed / Rental Agreement</p></label>
<div class="col-sm-6">
<label class="btn btn-primary ks-btn-file">
<span class="fa fa-cloud-upload ks-icon"></span>
<span class="ks-text">Choose file</span>
<input type="file" class="imptfile"  name="doc[2]">
</label>
</div>
</div>

<div class="form-group row">
<label for="default-input-rounded" class="col-sm-6 form-control-label"><h5>PAN Card copy</h5>
<div class="fileNot"></div>
<p></p></label>
<div class="col-sm-6">
<label class="btn btn-primary ks-btn-file">
<span class="fa fa-cloud-upload ks-icon"></span>
<span class="ks-text">Choose file</span>
<input type="file" class="imptfile"  name="doc[3]">
</label>
</div>
</div>
<div class="col-lg-12">
<div class="card-block">


<div class="pull-right"><button class="btn btn-primary" id="btnSave" > Save</button></div>

</div>

</div>
</div>


</div>
</div>

</div>
</div>
</div>
</form>
<?php }?>
</div>
</div>
</div>


<?php admin_footer(); ?> 