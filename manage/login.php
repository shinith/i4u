<?php include("../includes/config.php");
if($_SESSION["SUSER"]){
    header("location:".ADMINROOT);
}?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>I4UR Gadget Administrator template </title>

    <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>assets/fonts/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>assets/fonts/open-sans/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>assets/styles/common.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT?>assets/styles/pages/auth.min.css">
</head>
<body>

<div class="ks-page">
    <div class="ks-header">
        <a href="<?php echo ADMINROOT?>#" class="ks-logo">Administrator Profile</a>
    </div>
    <div class="ks-body">
        <div class="ks-logo"><img src="<?php echo ROOT?>images/logo.png"></div>

        <div class="card panel panel-default ks-light ks-panel ks-login">
        <?php if($_GET["action"]=="forget"){?>
           <div class="card-block">
                <form class="form-container" id="frmLogin" method="post" method="post">
                <input type="hidden" name="action" id="action" value="resetPwd">
                    <h4 class="ks-header">
                        Forgot Password
                        <span>Don't worry, this happens sometimes.</span>
                    </h4>

                    <div class="form-group">
                        <div class="input-icon icon-left icon-lg icon-color-primary">
                            <input class="form-control" placeholder="Email" id="txtUser" name="txtUser" type="text">
                        <span class="icon-addon">
                            <span class="la la-at"></span>
                        </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button id="btnReset" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <div class="ks-text-center">
                        <span class="text-muted">Remember It?</span> <a href="<?php echo SU?>login">Login</a>
                    </div>
                    <div id="logNot" class="ks-text-center"></div>

                </form>
            </div> 
        <?php } else{?>
        <div class="card-block">
                <form class="form-container" id="frmLogin" method="post">
                <input type="hidden" name="action" id="action" value="login">
                    <h4 class="ks-header">Login</h4>
                    <div class="form-group">
                        <div class="input-icon icon-left icon-lg icon-color-primary">
                            <input type="text" class="form-control" id="txtUser" name="txtUser" placeholder="Email">
                            <span class="icon-addon">
                                <span class="la la-at"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon icon-left icon-lg icon-color-primary">
                            <input type="password" class="form-control" id="txtPwd" name="txtPwd" placeholder="Password">
                            <span class="icon-addon">
                                <span class="la la-key"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="btnLog" class="btn btn-primary btn-block">Login</button>
                    </div>
                    
                    <div class="ks-text-center">
                        <a href="<?php echo SU?>reset-password">Forgot your password?</a>
                    </div>
                    <div id="logNot" class="ks-text-center"></div>
                    
                </form>
            </div>

        <?php }?>
        </div>
    </div>
    <div class="ks-footer">
        <span class="ks-copyright">&copy; <?php echo date("Y")?> I4UR Gadget</span>
        
    </div>
</div>
<script type="text/javascript" src="<?php echo ROOT?>js/jQuery-2.2.0.min.js"></script>
<script src="<?php echo ADMINROOT?>libs/tether/js/tether.min.js"></script>
<script src="<?php echo ADMINROOT?>libs/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#frmLogin").submit(function(e){
e.preventDefault();
$("#logNot").html("");
btn=$("#btnLog,#btnReset");
valid=true;
$(".has-error").removeClass("has-error");
var mail=$("#txtUser").val();
var pwd=$("#txtPwd").val();
pwd=$.trim(pwd);
if(!pwd && $("#txtPwd").length>0){
valid=false;
$("#txtPwd").closest(".form-group").addClass("has-error"); 
}
if(!mail){
valid=false;
$("#txtUser").parent().attr("class","form-group has-error");
}
if(valid){
btn.attr("disabled","disabled").html("Processing..");
$.ajax({"url":"<?php echo ROOT?>ajax/su-login-ajax.php",type:'POST', data:$("#frmLogin").serialize(),error:function(err,errs,errsss){
},success:function(returnData){
console.log(returnData);
$("#btnLog").removeAttr("disabled").html("LOGIN");
$("#btnReset").removeAttr("disabled").html("Submit");
try{
jsn=$.parseJSON(returnData);
switch(jsn.status){
    case "case-error":
    case "wrong":
    $("#logNot").html("<div class='ks-color-danger'>Please check your credentials</div>");
    break;
    case "login":
    location.href="<?php echo ADMINROOT?>";
    break;
    case "resetnomatch":
    $("#logNot").html("<div class='ks-color-danger'>This email not seems to be registred as I4UR Gadget administrator.</div>");
    break;
    case "reset":
    $("#logNot").html("<div class='ks-color-success'>This email not seems to be registred as I4UR Gadget admiinistrator.</div>");
    setTimeout(function(){location.href="<?php echo $_SESSION['SUTRG']?$_SESSION['SUTRG']:ADMINROOT?>";},500);
    
    break;
    
}

}catch(exp){}

}
});


}
});
});

</script>
</body>
</html>