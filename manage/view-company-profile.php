<?php require_once 'template.php';
//ini_set("display_errors",1);
$cmp=$_SESSION["CMP"];
$probj=new MysqliDb(HOST,USER,PWD,DB);
$probj->where("cmp_id",$cmp);
$cmpres=$probj->getOne("vf_company cf","cmp_name, cmp_name2, cmp_name3, cmp_type, cmp_obj, cmp_capital, cmp_pcapital, cmp_vshare, cmp_tshare, cmp_poname, cmp_faddr, cmp_saddr, cmp_city, cmp_state, cmp_country, cmp_pin, cmp_nps, cmp_onoc, cmp_adstatus, cmp_update, cmp_status");
//print_r($cmpres);


$probj->where("cmp_id",$cmp);
$dirres=$probj->get( "vf_employee" ,null,"emp_id, cmp_id, emp_desg, emp_namehead, emp_name, emp_mob, emp_email, emp_dob, emp_invest, emp_pan,emp_adhar, emp_din, emp_occupation, emp_edu, emp_fadrr, emp_saddr, emp_city, emp_state, emp_country, emp_pin, emp_staydur, emp_dirpin, emp_nominee, emp_entity, emp_date, emp_status");
admin_header("Vyapar formations company profile");
?>

<link rel="stylesheet" type="text/css" href="<?php echo ROOT?>css/wizard.css">

<div class="ks-column ks-page ">
<div class="ks-header">
<section class="ks-title">
<h3>Business Profile</h3>
</section>
</div>
<div class="ks-content">
<div class="ks-body">
<div class="container-fluid ks-rows-section">

<div class="ks-content">
<div class="ks-body tables-page">
<form  id="frmProfile" name="frmProfile" method="post" >

<input type="hidden" name="action" value="frmapp">
<div class="row setup-content" id="step-1">
<div class="col-lg-12 col-md-12 ks-panels-column-section pull-left">
<h5 class="card-title ">Primary Informations </h5>

<div class="card ">
<div  class="card-block col-lg-8">
<div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Company/Firm/LLP/Entity : (suggestive names of Company)</label>
<div class="col-sm-7 capitalize">
<?php echo $cmpres["cmp_name"]?$cmpres["cmp_name"]:"--"?>
</div>
</div>
<?php if($cmpres["cmp_name2"]){?>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Company Name choice :2 </label>
<div class="col-sm-7 capitalize">
<?php echo $cmpres["cmp_name2"];?>
</div>
</div>
<?php } if($cmpres["cmp_name3"]){?>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Company Name choice :3 </label>
<div class="col-sm-7 capitalize">
<?php echo $cmpres["cmp_name3"]?$cmpres["cmp_name3"]:"--"?>
</div>
</div>
<?php }?>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Address of Company</label>
<div class="col-sm-7">
<?php echo $cmpres["cmp_faddr"]?$cmpres["cmp_faddr"]:"--"?>

</div>
</div>

<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Address Line 2 </label>
<div class="col-sm-7">
<?php echo $cmpres["cmp_saddr"]?$cmpres["cmp_saddr"]:"--"?>
</div>
</div>


<div class="form-group row">
<label for="default-input" class="col-sm-5 ">City</label>
<div class="col-sm-7">
<?php echo $cmpres["cmp_city"]?$cmpres["cmp_city"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">State  </label>
<div class="col-sm-7">
<?php echo $cmpres["cmp_state"]?$cmpres["cmp_state"]:"Karnataka"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Country  </label>
<div class="col-sm-7">
<?php echo $cmpres["cmp_country"]?$cmpres["cmp_country"]:"India"?>

</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Pincode </label>
<div class="col-sm-7">
<?php echo $cmpres["cmp_pin"]?$cmpres["cmp_pin"]:"--"?>
</div>
</div>




</div>


</div>

</div><!-- card block -->
</div>


      
</div>
<?php if($dirres[0])
{?>
<div class="row setup-content" id="step-2">
<div class="col-lg-12 col-md-12" id="dirWraper">
<h5 class="card-title ">Directors</h5>
<?php 

foreach($dirres as $dindex=>$dir){
?><div class="card dirBlock" >
<div class="card-block pull-left col-lg-8">
<h5 class="card-title director-count">Director -<?php echo $dindex+1?> </h5>
<div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Name as per PAN Database</label>
<div class="col-sm-7">
<?php echo $dir["emp_name"]?$dir["emp_name"]:"--"?>

</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Mobile  </label>
<div class="col-sm-7">
<?php echo $dir["emp_mob"]?$dir["emp_mob"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Email ID  </label>
<div class="col-sm-7">
<?php echo $dir["emp_email"]?$dir["emp_email"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Amount of Investment</label>
<div class="col-sm-7">
<?php echo $dir["emp_invest"]?$dir["emp_invest"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Aadhar No. </label>
<div class="col-sm-7">
<?php echo $dir["emp_adhar"]?$dir["emp_adhar"]:"--"?>
</div>

</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">PAN No.</label>
<div class="col-sm-7">
<?php echo $dir["emp_pan"]?$dir["emp_pan"]:"--"?>
</div>

</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">DIN NO </label>
<div class="col-sm-7">
<?php echo $dir["emp_din"]?$dir["emp_din"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Address Line 1</label>
<div class="col-sm-7">
<?php echo $dir["emp_fadrr"]?$dir["emp_fadrr"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Address Line 2 </label>
<div class="col-sm-7">
<?php echo $dir["emp_saddr"]?$dir["emp_saddr"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">City</label>
<div class="col-sm-7">
<?php echo $dir["emp_city"]?$dir["emp_city"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">State  </label>
<div class="col-sm-7">
<?php echo $dir["emp_state"]?$dir["emp_state"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Country  </label>
<div class="col-sm-7">
<?php echo $dir["emp_country"]?$dir["emp_country"]:"--"?>
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Pincode </label>
<div class="col-sm-7">
<?php echo $dir["emp_pin"]?$dir["emp_pin"]:"--"?>
</div>
</div>


<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Name of Nominee</label>
<div class="col-sm-7">
<?php echo $dir["emp_nominee"]?$dir["emp_nominee"]:"--"?>
</div>
</div>


</div>

</div>
</div>
<?php }?>
</div>

</div> 
<?php }?>
<div class="row setup-content" id="step-3">
<div class="col-lg-12 col-md-12">
<h5 class="card-title ">Nature of business</h5>
<div class="card">
<div class="card-block pull-left col-lg-8">
<div>

<div class="form-group row">
<label for="default-input" class="col-sm-5 ">Category of Business</label>
<div class="col-sm-7">
<?php echo ($emp["cmp_type"]?$emp["cmp_type"]:"--")."<br>".$cmpres["cmp_obj"]?>


</div>
</div>

</div>
</div>
</div>


</div>
</div>
<?php
$docobj=new MysqliDb(HOST,USER,PWD,DB);
$docobj->where("d.cmp_id",$cmp);
$docobj->join("vf_doctype dt","dt.dt_id=d.dt_id");
$docobj->orderBy("d.dt_id");
$docobj->orderBy("d.doc_id");
$docarr=$docobj->get("vf_document d",null,"d.doc_id,d.doc_name,d.dt_id,d.dt_id,d.doc_date,d.doc_file,d.doc_date,d.admin_id,d.user_id,dt.dt_name");
$docount=$docobj->count;

?>
<div class="row setup-content" id="step-4">
<div class="col-lg-12 col-md-12">
<h5 class="card-title ">Business documents</h5>
<div class="card">
<div class="card-block pull-left col-lg-12">
<?php if($docount>0){?>
<table class="table table-bordered">
<thead>
<tr>
<th width="1">#</th>
<th>Title.</th>
<th>Type</th>
<th>Uploaded By</th>
<th>Date</th>
<th>Option</th>

</tr>
</thead>
<tbody>
<?php 
foreach ($docarr as $doc){ 
$count++;
?>
<tr>
<td scope="row"><?php echo $count; ?></td>
<td> <?php echo $doc['doc_name']?></td>
<td> <?php echo $doc['dt_name']?></td>
<td> <?php echo $doc["admin_id"]?"Administrtor":"Myself";?></td>
<td> <?php echo date("d M,Y h:i a",strtotime($doc['doc_date']))?></td>
<td>
<a href="<?php echo ADMINROOT;?>downloader/<?php echo $doc['doc_id']?>" target="_blank">download</a>
</td>

</tr>
<?php }?>
</tbody>
</table>
<a class="btn btn-sm btn-success" href="<?php echo ADMINROOT?>my-documents">Update documents</a>
<?php } else echo "<div class='ks-color-danger'>No documents uploaded yet.Click <a href='".ADMINROOT."my-documents'>here</a> to upload now</div>";?>
<div>
</div>
</div>
</div>


</div>
</div>

<?php
$serobj=new MysqliDb(HOST,USER,PWD,DB);
$serobj->orderBy("ap.ap_id");
$serobj->where("ap.cmp_id",$cmp);
$serobj->where("ap.ap_status",9,"!=");
$servicearr=$serobj->get("vf_application ap",null,"ap_id,ap.ap_apstatus,ap.ap_updateby,ap.ap_service,ap.ap_lastupdate_date");
//echo $serobj->getLastQuery();
$sercnt=$serobj->count;

?>
<div class="row setup-content" id="step-4">
<div class="col-lg-12 col-md-12">
<h5 class="card-title ">Active Services</h5>
<div class="card">
<div class="card-block pull-left col-lg-12">
<?php if($sercnt>0){?>
<table class="table table-bordered">
<thead>
<tr>
<th width="1">Ticket No</th>
<th>Service</th>
<th>Assigned to</th>
<th>Last updated</th>
<th>Status</th>

</tr>
</thead>
<tbody>
<?php 
foreach ($servicearr as $service){ 
$ticket="VF-".str_pad($service['ap_id'], 5,"0",STR_PAD_LEFT);
?>
<tr>
<td scope="row"><?php echo $ticket; ?></td>
<td> <?php echo $service['ap_service']?></td>
<td> <?php echo $service["ap_updateby"]?></td>
<td> <?php echo date("d M,Y h:i a",strtotime($service['ap_lastupdate_date']))?></td>
<td> <?php echo $APSTATUS[$service["ap_apstatus"]];?></td>
</tr>
<?php }?>
</tbody>
</table>
<?php } else echo "<div class='ks-color-danger'>Active services.Click <a href='".ADMINROOT."add-service'>here</a> to upload now</div>";?>
<div>
</div>
</div>
</div>


</div>
</div>
<ul class="wizardbtnwrpr pager wizard">
<li class="pull-left">

<a href="<?php echo ADMINROOT?>update-business-profile" class="btn-wizard btn btn-success"> Edit Details </a>
</li>

</ul>
</form>
</div>
</div>
</div>
</div>
</div>
</div>            
  
<?php admin_footer(); ?> 

