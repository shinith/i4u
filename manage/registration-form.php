<?php require_once 'template.php';
admin_header("Vyapar| Register");
$ui=$_SESSION['USER'];

$aplicn=$_GET['aplctn'];
//echo "safasf".$ui.$aplicn;
/*$dashobj=new MysqliDb(HOST,USER,PWD,DB);
$dashobj->where("vu.ap_form ",$aplicn);
$dashobj->join( "vf_application vf" ,"vf.ap_form=cf.ap_form ");
$dashobj->join( "vf_frmuser vu" ,"vu.cmp_id=cf.cmp_id ");
$appdata=$dashobj->get("vf_company cf",null,"vu.vf_id,vu.cmp_id,vf.ap_form,vf.ap_service,vf.ap_payment,vf.ap_apstatus,vf.ap_id");*/




?>
<link href="../css/maxcdn.bootstrapcdn.com_bootstrap_3.3.6_css_bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="../css/smart_wizard.min.css" rel="stylesheet" type="text/css" />

<!-- Optional SmartWizard theme -->
<link href="../css/smart_wizard_theme_dots.min.css" rel="stylesheet" type="text/css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

<script type="text/javascript">
var delfile=[];
  
  $(document).on("submit","#myForm",function(evt){
    evt.preventDefault();
    alert("arun");
$.ajax({"url":"<?php echo ROOT?>ajax/account-ajax.php",type:'post',async:false, data:$("#myForm").serialize(),success:function(returnData){
alert(returnData);
try{
jsn=$.parseJSON(returnData);
if(jsn.status=="success"){
location.href=ajax;
$("#frmReg").hide();
$("#frmRegNotify").html("<div class='alert-success'>You have successfully registred in hridayavidya foundation,<br>Please check your inbox to activate your account</div>");
setTimeout(function(){location.reload()}, 5000);
}else{
	alert("");
}
}catch(exp){}

}
});
});

</script>
<div class="container">


<br />
<form  id="myForm" name="myForm" method="post" >

<input type="hidden" name="action" value="frmapp">
<input type="hidden" name="userid" value="<?php echo $ui;?>">

<div id="smartwizard">

<ul> 
<li><a href="#step-1">Step 1<br /><small>Company details</small></a></li>
<li><a href="#step-2">Step 2<br /><small>Director details</small></a></li>
<li><a href="#step-3">Step 3<br /><small>Nature of Business</small></a></li>
<li><a href="#step-4">Step 4<br /><small>Payment</small></a></li>
</ul >

<div>


<div class="" id="step-1">

<div id="form-step-0" role="form" data-toggle="validator">


<div class="clearfix"></div>  
<br/>
<div class="container-fluid">
<div class="row">

<div class="col-lg-8 ks-panels-column-section">

<div class="card ">
<div  class="card-block ">
<h3 class="card-title "> Proposed OPC One Person Company Name and Address </h3>
<div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">OPC Name Preference : (suggestive names of OPC that you want to register)</label>
<div class="col-sm-7">
<input type="text" name="txtcomp1" class="form-control"  placeholder="1 Suggestion" ><br/>
<input type="text" name="txtcomp2" class="form-control"  placeholder="2 Suggestion" ><br/>
<input type="text" name="txtcomp3" class="form-control" placeholder="3 Suggestion" >
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Address of proposed OPC</label>
<div class="col-sm-7">
<input type="text" name="compadrs" class="form-control" id="default-input" placeholder="Enter Address">
</div>
</div>

<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Address Line 1 </label>
<div class="col-sm-7">
<input type="text" name="compadrs1" class="form-control" id="default-input" placeholder="Enter Address Line 1">
</div>
</div>


<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">City</label>
<div class="col-sm-7">
<input type="text" name="city" class="form-control" id="default-input" placeholder="Enter City">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">State  </label>
<div class="col-sm-7">
<input type="text" name="state" class="form-control" id="default-input" placeholder="Enter State">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Country  </label>
<div class="col-sm-7">
<input type="text" name="country" class="form-control" id="default-input" placeholder="Enter Country">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Pincode </label>
<div class="col-sm-7">
<input type="text" name="pin" class="form-control" id="default-input" placeholder="Enter Pincode">
</div>
</div>




</div>


</div>

</div><!-- card block -->
</div>
<div class="col-lg-4 ks-panels-column-section">

<div class=" pull-right">

<div>
	<div class="card card-outline-primary ">
	<div class="card-header bg-primary "> Message for you !</div>
	<div class="card-block">
	<blockquote class="card-blockquote">
	<h4>Leave it for us. We will do for you.!</h4>
	<a href="<?php echo ADMINROOT?>payment.php" class="btn btn-info-outline ks-solid pull-right" >skip</a>
	</blockquote>
	</div>
	</div>
</div>
</div>

</div>

</div>

</div>
</div>

</div>


<div id="step-2">

<div id="form-step-1" role="form" data-toggle="validator">
<div class="clearfix"></div> <br/> 
<div class="addFrorm">
<div id="direct"  class="card btnrem">
<div class="card-block pull-left col-lg-8">
<h2>Provide details the director of proposed OPC.</h2>
<h4 class="card-title director-count"> </h4>
<div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Name as per PAN Database</label>
<div class="col-sm-7">
<input type="text" name="txtdirname[]" class="form-control" id="default-input" placeholder="Enter Name">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Mobile  </label>
<div class="col-sm-7">
<input type="text" name="txtdirmob[]"  class="form-control" id="default-input" placeholder="Enter Mobile Number">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Email ID  </label>
<div class="col-sm-7">
<input type="text" name="txtdirmail[]"  class="form-control" id="default-input" placeholder="Enter Email Id">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Amount of Investment</label>
<div class="col-sm-7">
<input type="text" name="txtdirinvst[]"  class="form-control" id="default-input" placeholder="Enter Investment Amount">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">PAN No./ Aadhar No. </label>
<div class="col-sm-7">
<input type="text" name="txtdirpan[]"  class="form-control" id="default-input" placeholder="Enter PAN number">
</div>

</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">DIN NO </label>
<div class="col-sm-7">
<input type="text" name="txtdirdin[]" class="form-control" id="default-input" placeholder="Enter DIN number">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Address Line 1</label>
<div class="col-sm-7">
<input type="text" name="txtdiradrs[]"  class="form-control" id="default-input" placeholder="Enter Address">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Address Line 2 </label>
<div class="col-sm-7">
<input type="text" name="txtdiradrs2"  class="form-control" id="default-input" placeholder="Enter Address">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">City</label>
<div class="col-sm-7">
<input type="text" name="txtdircity[]"  class="form-control" id="default-input" placeholder="Enter City">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">State  </label>
<div class="col-sm-7">
<input type="text" name="txtdirstate[]"  class="form-control" id="default-input" placeholder="Enter State">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Country  </label>
<div class="col-sm-7">
<input type="text" name="txtdircountry[]"  class="form-control" id="default-input" placeholder="Enter Country">
</div>
</div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Pincode </label>
<div class="col-sm-7">
<input type="text" name="txtdirpin[]"  class="form-control" id="default-input" placeholder="Enter Pincode">
</div>
</div>


<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Name of Nominee</label>
<div class="col-sm-7">
<input type="text" name="txtdirnominee[]"  class="form-control" id="default-input" placeholder="Enter Nominee Name">
</div>
</div>


</div>

</div>
</div>
</div>
</div>
<button id="addForm" class="btn btn-primary pull-right">ADD</button>
</div>

<div id="step-3">

<div id="form-step-2" role="form" data-toggle="validator">
<div class="clearfix"></div>  <br/>

<div class="card ">
<div   class="card-block pull-left col-lg-8">
<h3 class="card-title "> Nature of Business</h3>
<div>
<div class="form-group row">
<label for="default-input" class="col-sm-5 form-control-label">Select Business  </label>
<div class="col-sm-7">
<select id="if-user" name="btype" class="form-control ks-selectpicker">
<option>Accommodations</option>
<option>Construction</option>
<option>Consulting</option>
<option>Entertainment</option>
<option>Finance</option>
<option>Food Service</option>
<option>Health Care</option>
<option>Insurance</option>
<option>Manufacturing</option>
<option>Professional</option>
<option>Real Estate</option>
<option>Rental & Leasing</option>
<option>Retail</option>
<option>Social Assistance</option>
<option>Technology</option>
<option>Transportation</option>
<option>Warehousing </option>
<option>Wholesale</option>

<option>Others</option>
</select></br>
<textarea name="txtdirbus" class="form-control" placeholder="Please explaine if your business is not listed" cols="10" rows="6"></textarea>
</div>
</div>


</div>

</div>
</div>
</div>
</div>
<div id="step-4" class="">

<div id="form-step-3" role="form" data-toggle="validator">
<div class="clearfix"></div>  <br/>

<div class="card ">
<div   class="card-block pull-left col-lg-8">
<h3 class="card-title "> Payment</h3>
<div>
<h5>Terms and conditions: Keep your smile :) </h5>
<div class="form-group">
<input type="checkbox" id="terms" data-error="Please accept the Terms and Conditions" required> 
<label for="terms">I agree with the T&C</label>

<div class="help-block with-errors"></div>
</div>
</div>
</div>
</div>

</div>


</div>
</div>
</div>

</form>
</div>
<!-- 
<div class="help-block with-errors"></div> -->
<script type="text/javascript" src="../js/jquery.smartWizard.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/jquery.form.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){


// Toolbar extra buttons
var btnFinish = $('<button></button>').text('Finish')
.addClass('btn btn-info btnSubmit')
.on('click', function(e){ 

if( !$(this).hasClass('disabled')){ 
var elmForm = $("#myForm");
if(elmForm){
elmForm.validator('validate'); 
var elmErr = elmForm.find('.has-error');
if(elmErr && elmErr.length > 0){
alert('Oops we still have error in the form');
return false;    
}

}
}
});

  



/*elmForm.submit();*/
//return false;

var btnCancel = $('<button></button>').text('Cancel')
.addClass('btn btn-danger')
.on('click', function(){ 
$('#smartwizard').smartWizard("reset"); 
$('#myForm').find("input, textarea").val(""); 
});                         



// Smart Wizard
$('#smartwizard').smartWizard({ 
selected: 0, 
theme: 'dots',
transitionEffect:'fade',
toolbarSettings: {toolbarPosition: 'bottom',
toolbarExtraButtons: [btnFinish, btnCancel]
},
anchorSettings: {
markDoneStep: true, // add done css
markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
}
});

$("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
var elmForm = $("#form-step-" + stepNumber);
// stepDirection === 'forward' :- this condition allows to do the form validation 
// only on forward navigation, that makes easy navigation on backwards still do the validation when going next
if(stepDirection === 'forward' && elmForm){
elmForm.validator('validate'); 
var elmErr = elmForm.children('.has-error');
if(elmErr && elmErr.length > 0){
// Form validation failed
return false;    
}
}
return true;
});

$("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
// Enable finish button only on last step
if(stepNumber == 3){ 
$('.btn-finish').removeClass('disabled');  
}else{
$('.btn-finish').addClass('disabled');
}
});

var director=15;
var count=1;

var c=$('.director-count').length;
//alert(c);

$('.director-count').html("Directors and Shareholders : "+count);
$("#addForm").on("click",function(e) {
	e.preventDefault();
count++;
$('#direct').clone().append('<button class="pull-right btn-danger col-lg-2 btnRemove" style="padding-top:10px;"id="">REMOVE</button>').appendTo('.addFrorm');

$('.director-count:last').html("Directors and Shareholders : "+count);

});    
$('.addFrorm').on('click', '.btnRemove', function(e) {
e.preventDefault();
count--;
$('.director-count:last').html("Directors and Shareholders : "+count);
$(this).parent().remove();
});
});   
</script>  
<?php admin_footer(); ?> 

