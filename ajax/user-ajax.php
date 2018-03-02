<?php
include("../includes/config.php");
include("../includes/MysqliDb.php");
include("../includes/functions.php");
include_once("../includes/PHPMailerAutoload.php");
//ini_set("display_errors",1);
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
die("cheating");
}
$action=$_REQUEST['action'];

switch($action):
case "adminUser":

//ini_set("display_errors",1);
$userid=$_POST["userid"];
$utype=$_POST["selUtype"];
$username=$_POST["txtFname"];
$lname=$_POST["txtLname"];
$mob=$_POST["txtPhone"];
$address=$_POST["txtAddress"];
$email=$_POST["txtEmail"];
//txtUpwd  txtUCpwd
$adhar=$_POST["txtAdhar"];
$panno=$_POST["txtPan"];

$pwd=$_POST["txtUpwd"];
$imgname = $_POST['curImg'];
$curImg=$_FILES["img"];
$doj=date("Y-m-d H:i:s",strtotime($_POST["txtDoj"]));
$userobj=new MysqliDb(HOST,USER,PWD,DB);
if($userid)
$userobj->where("admin_id",$userid,"!=");
$userobj->where("admin_email",$email,"LIKE");
$exist=$userobj->getvalue("tbl_admin","COUNT(admin_id)");
if($exist)
{
echo json_encode(array("status"=>"exist"));
}
else{
$encpwd=md5($pwd);
$sqlar=Array("admin_name"=>$username,"admin_email"=>$email,"admin_lname"=>$lname,"admin_mobile"=>$mob,"admin_date"=>$doj,"admin_type"=>$utype,"admin_address"=>$address,"admin_pan"=>$panno,"admin_adhar"=>$adhar);
if($curImg["tmp_name"]){
$imgname=$imgname?$imgname:time().".jpg";

move_uploaded_file($curImg["tmp_name"],"../uploads/".$imgname);
$sqlar["admin_img"]=$imgname;
if($_SESSION["SUSER"]==$userid)
$_SESSION["IMG"]=$imgname;
}
if($userid){
$userobj->where("admin_id",$userid);
$userobj->update("tbl_admin",$sqlar);
$sendmail=false;
$emailmsg="Your Admin account has been updated";
}
else{
$sendmail=false;

$sqlar["admin_pwd"]=$encpwd;
$userobj->insert("tbl_admin",$sqlar);
$emailmsg="New account has been created for Vyapar formations";
$userid=$userobj->getInsertId();
}
// echo $userobj->getLastError();

$msg="<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Vyapar Formation</title>
</head>

<body style='width:100%; margin:0 auto; background:#F9F6DB;'>
<table width='100%' border='0' cellspacing='0' cellpadding='0'>

<tr>
<td><div style='background:url(".ROOT."images/logo.png) no-repeat; height:135px; width:500px; margin:15px auto; '></div></td>
</tr>
<tr>
<td><div style='border-top: 4px solid #F05E22;'></div></td>
</tr>

</table>
<div style=' width:540px; margin:27px auto 0 auto; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#F05E22; padding-top:30px;'>
Hello $username
</div>

<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>

<table>
<tr>
    <td colspan='2' style='font-size:14px; font-family:Myriad Pro; text-align:left;color:#fff; background:#f47c48; padding:10px;'> Greetings From Vyapar Formations,$emailmsg</td>
  </tr>
  <tr>
    <td style='padding:10px; background:#e3e3e4; border-bottom:1px solid #ccc;'>Your user name:</td>
    <td style='padding:10px; background:#e3e3e4;border-bottom:1px solid #ccc; border-left:1px solid #ccc;'> ".$email."</td>
  </tr>
  <tr>
    <td style='padding:10px; background:#e3e3e4;'>Password:</td>
    <td style='padding:10px; background:#e3e3e4; border-left:1px solid #ccc;'>".$pwd." </td>
  </tr>
</table>
</div>


<div style='border-bottom: 4px solid #F05E22; height:60px;'></div>
</html>";
$EMAILOBJ->addAddress($email, $username);
$EMAILOBJ->Subject = 'Vyapar Formation User profile'.($userid?" updation":"creation");
$EMAILOBJ->msgHTML($msg);
//$EMAILOBJ->send();
echo json_encode(array("status"=>"done"));
if($sendmail){
$EMAILOBJ->send();

}
}
break;

case "adminUpdate":

$fname=$_POST["txtFname"];
$lname=$_POST["txtLname"];
$email=$_POST["txtEmail"];
$phone=$_POST["txtPhone"];
$imgname = $_POST['curImg'];
$curImg=$_FILES["img"];
$adress=addslashes($_POST["txtAddress"]);
$regobj=new MysqliDb(HOST,USER,PWD,DB);
$regobj->where("admin_email",$email,"LIKE");
$regobj->where("admin_id",$_SESSION["SUSER"],"!=");
$exist=$regobj->getValue("tbl_admin","COUNT(admin_id)");
if($exist>0){
$out["status"]="exist";
}
else
{
$uarr=Array("admin_name"=>$fname,"admin_lname"=>$lname,"admin_email"=>$email,"admin_mobile"=>$phone,"admin_address"=>$adress);

  if($curImg["tmp_name"]){
  $imgname=$imgname?$imgname:time().".jpg";

move_uploaded_file($curImg["tmp_name"],"../uploads/".$imgname);
$uarr["admin_img"]=$imgname;
$_SESSION["IMG"]=$imgname;
  }
$regobj->where("admin_id",$_SESSION["SUSER"]);
$regobj->update("tbl_admin",$uarr);
$out["status"]="done";
  }
echo json_encode($out);
break;
case "chPwd":
//print_r($_POST);
$chobj=new MysqliDb(HOST,USER,PWD,DB);
$curpwd=md5($_POST["txtCurPwd"]);
$enpdw=md5($_POST["txtCnPwd"]);
$chobj->where("admin_id",$_SESSION["USER"]);
$chobj->where("admin_pwd",$curpwd,"LIKE");
$trueusr=$chobj->getValue("tbl_admin","COUNT(admin_id)");
if($trueusr>0){
$chobj->where("admin_id",$_SESSION["SUSER"]);
$chobj->update("tbl_admin",Array("admin_pwd"=>$enpdw));
echo $chobj->getLastQuery();
$out["status"]="done";
}
else{
$out["status"]="error";
}
echo json_encode($out);
break;
endswitch;

// print_r($_POST);
?>
