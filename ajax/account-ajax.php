<?php
include("../includes/config.php");
include("../includes/MysqliDb.php");
include("../includes/functions.php");
include_once("../includes/PHPMailerAutoload.php");
ini_set("display_errors",1);
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
die("cheating");
}
$action=$_REQUEST['action'];
switch($action):

case 'frmapp':
//ini_set("display_errors",1);
$userid=$_POST['userid']?$_POST['userid']:$_SESSION["USER"];
$cname1=$_POST['txtcomp'][0];
$cname2=$_POST['txtcomp'][1];
$cname3=$_POST['txtcomp'][2];
$cadrs=$_POST['compadrs'];
$cadrs1=$_POST['compadrs1'];
$ccity=$_POST['city'];
$cstate=$_POST['state'];
$ccountry=$_POST['country'];
$cpin=$_POST['pin'];
$ardname=$_POST['txtdirname'];
$ardmob=$_POST['txtdirmob'];
$ardmail=$_POST['txtdirmail'];
$ardinvest=$_POST['txtdirinvst'];
$ardpan=$_POST['txtdirpan'];
$adhar=$_POST['txtdiradhar'];
$arddin=$_POST['txtdirdin'];
$ardsdrs=$_POST['txtdiradrs'];
$ardadrs1=$_POST['txtdiradrs2'];
$ardcity=$_POST['txtdircity'];
$ardstate=$_POST['txtdirstate'];
$ardcountry=$_POST['txtdircountry'];
$ardpin=$_POST['txtdirpin'];
$ardnom=$_POST['txtdirnominee'];
$dbust=$_POST['btype'];
$dbus=$_POST['txtdirbus'];
$cmpid=$_POST["cmpId"]?$_POST["cmpId"]:$_SESSION["CMP"];
$del=$_POST["del"];
$fromobj=new MysqliDb(HOST,USER,PWD,DB);
$fromobj->startTransaction();
$fromobj->where("cmp_id",$cmpid);
$aryqry=Array("user_id"=>$userid,"cmp_name"=>$cname1,"cmp_name2"=>$cname2,"cmp_name3"=>$cname3,"cmp_type"=>$dbust,"cmp_obj"=>$dbus,"cmp_faddr"=>$cadrs,"cmp_saddr"=>$cadrs1,"cmp_city"=>$ccity,"cmp_state"=>$cstate,"cmp_country"=>$ccountry,"cmp_pin"=>$cpin);

$fromobj->update("vf_company",$aryqry);

//echo $fromobj->getLastError();
if(!$fromobj->getLastError()){
$personsql="INSERT INTO vf_employee(emp_id,cmp_id,emp_name,emp_mob,emp_email,emp_invest,emp_pan,emp_adhar,emp_din,emp_fadrr,emp_saddr,emp_city,emp_state,emp_country,emp_pin,emp_nominee,emp_type)VALUES";
foreach ($ardname as $key => $name) {
$dirid=$_POST["dirid"][$key]?$_POST["dirid"][$key]:"NULL";
$val[]="($dirid,$cmpid,'$ardname[$key]','$ardmob[$key]','$ardmail[$key]','$ardinvest[$key]','$ardpan[$key]','$adhar[$key]','$arddin[$key]','$ardsdrs[$key]','$ardadrs1[$key]','$ardcity[$key]','$ardstate[$key]','$ardcountry[$key]','$ardpin[$key]','$ardnom[$key]',1)";

}
//echo var_dump($val);
$compsql=$personsql.implode(",",$val). "ON DUPLICATE KEY UPDATE cmp_id=VALUES(cmp_id),emp_name=VALUES(emp_name),emp_mob=VALUES(emp_mob),emp_email=VALUES(emp_email),emp_invest=VALUES(emp_invest),emp_pan=VALUES(emp_pan),emp_adhar=VALUES(emp_adhar),emp_din=VALUES(emp_din),emp_fadrr=VALUES(emp_fadrr),emp_saddr=VALUES(emp_saddr),emp_city=VALUES(emp_city),emp_state=VALUES(emp_state),emp_country=VALUES(emp_country),emp_pin=VALUES(emp_pin),emp_nominee=VALUES(emp_nominee)";
//echo $compsql;
$fromobj->rawQuery($compsql);
$fromobj->commit();
echo json_encode(Array("response"=>"success"));
if($del){
$delar=explode(",",$del);
$fromobj->where("emp_id",$delar,"IN");
$fromobj->delete("vf_employee");
}
}
else{
echo json_encode(Array("response"=>"error"));
}
break;

case "chPwd":
//print_r($_POST);
$chobj=new MysqliDb(HOST,USER,PWD,DB);
$curpwd=md5($_POST["txtCurPwd"]);
$enpdw=md5($_POST["txtCnPwd"]);
$chobj->where("user_id",$_SESSION["USER"]);
$chobj->where("user_pwd",$curpwd,"LIKE");
$trueusr=$chobj->getValue("tbl_admin","COUNT(user_id)");
if($trueusr>0){
$chobj->where("user_id",$_SESSION["USER"]);
$chobj->update("tbl_admin",Array("user_pwd"=>$enpdw));
//echo $chobj->getLastQuery();
$out["status"]="done";
}
else{
$out["status"]="error";
}
echo json_encode($out);
break;
case "frgtPwd":
//print_r($_POST);
$chobj=new MysqliDb(HOST,USER,PWD,DB);
$email=$_POST["txtuser"];
$str="1234567890asdfghjklzxcvbnmqwertyuiopASDGHJKLZXCVBNMQWERTYUIOP!@#%&*";
  for($i=0;$i<=8;$i++)
  {
    $pwd.=substr($str,rand(0,68),1);
  }

 $enpwd=md5($pwd);
$chobj->where("user_mail",$email,"LIKE");
$trueusr=$chobj->getOne("tbl_admin","user_id,user_fname,user_lname");
if($chobj->count>0){
	$fname=$trueusr["user_fname"]; 
	$lname=$trueusr["user_lname"];
$chobj->where("user_id",$trueusr["user_id"]);
$chobj->update("tbl_admin",Array("user_pwd"=>$enpdw));
//echo $chobj->getLastQuery();
if(!$chobj->getLastError()){
$out["status"]="done";
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
Hello $fname $lname
</div>

<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>
Welcome to Vyapar Formation
</div>

<div style=' width:540px; margin:12px auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666; font-weight:bold; padding-bottom:30px;'>Thank you for registering with us.
Please use below credentials to login Vyapar Formations<a href='".ROOT."login'>".ROOT."</a>
<p>
User name: <strong>$email</strong>
</p>
<p>
Password: <strong>$pwd</strong>
</p>
</div>
</div>
<div style='border-bottom: 4px solid #F05E22; height:60px;'></div>
</html>";
$EMAILOBJ->addAddress($email, $fname." ".$lname);
$EMAILOBJ->Subject = 'Vyapar Formation Reset Password';
$EMAILOBJ->msgHTML($msg);
//$EMAILOBJ->send();
if (!$EMAILOBJ->send()) {
$from_mail = "Vyapar Formation <info@vyaparformation.com>";
$replyto   = "info@vyaparformation.com";
$subject   = "Vyapar Formation Recover password";
$message=$message;

$headers='';
$headers.="Content-type: text/html; charset=UTF-8\r\n";
$headers.="From:info@vyaparformation.com";
mail($email, $subject, $msg, $headers);
}

//$EMAILOBJ->send();
}else{
$out["status"]="empty";
}
}
echo json_encode($out);
break;
case 'setPassword':

$pwd=$_POST['txtpwd'];
$user=$_POST['user'];
$userid=$_POST['up'];
$enpdw=md5($pwd);
$regobj=new MysqliDb(HOST,USER,PWD,DB);
$regobj->where("user_mail",$user);
$regobj->where("user_id",$userid);
$regobj->update("tbl_admin",Array("user_pwd"=>$enpdw,"user_status"=>1));
//echo $regobj->getLastQuery();
if(!$regobj->getLastError()){
$out["status"]="done";
echo json_encode($out);

}else{
$out["status"]="error";
echo json_encode($out);

}

break;
case 'document':
$docid=$_POST['docid'];
$currfile=$_POST['currfile'];
$dt=$_POST['selDt'];
$dname=$_POST['txtDtitle'];
$docfile=$_FILES['txtDoc'];;
$cmp=$_SESSION["CMP"]?$_SESSION["CMP"]:$_POST["txtCmp"];
$admin=$_SESSION["SUSER"]?$_SESSION["SUSER"]:0;
$user=$_SESSION["USER"]?$_SESSION["USER"]:0;
$docobj=new MysqliDb(HOST,USER,PWD,DB);
$docqry=Array("cmp_id"=>$cmp,"dt_id"=>$dt,"doc_name"=>$dname,"admin_id"=>$admin,"doc_date"=>$docobj->now(),"user_id"=>$user);
if($docfile){
$fileext=substr($docfile["name"], strripos($docfile["name"], '.'));
$newfile=time().$fileext;
$docqry["doc_file"]=$newfile;
$target_file="../uploads/".$newfile;
move_uploaded_file($docfile['tmp_name'],$target_file);
if($currfile){
	unlink("../uploads/".$currfile);
}
}
if($docid){
$docobj->where("doc_id",$docid);
$docobj->update("vf_document",$docqry);}
else{
$docobj->insert("vf_document",$docqry);
}
$out["status"]="done";
echo json_encode($out);

break;
case "userUpdate":
//ini_set("display_errors",1);
//print_r($_FILES);exit;
$fname=$_POST["txtFname"];
$lname=$_POST["txtLname"];
$email=$_POST["txtEmail"];
$phone=$_POST["txtPhone"];
$cmpname=$_POST["txtCname"];
$ctry=$_POST["selCountry"];
$city=$_POST["txtCity"];
$state=$_POST["selState"];
$pin=$_POST["txtPin"];
$imgname = $_POST['curImg'];
$curImg=$_FILES["img"];
$desig=$_POST["txtDesig"]; 
$head=addslashes($_POST["txtHead"]);
$adress=addslashes($_POST["txtAddress"]);
$regobj=new MysqliDb(HOST,USER,PWD,DB);
$regobj->where("user_mail",$email,"LIKE");
$regobj->where("user_id",$_SESSION["USER"],"!=");
$exist=$regobj->getValue("tbl_admin","COUNT(user_id)");
if($exist>0){
$out["status"]="exist";
}
else
{
$uarr=Array("user_fname"=>$fname,"user_lname"=>$lname,"user_mail"=>$email,"user_desig"=>$desig,"user_number"=>$phone,"user_address"=>$adress,"user_city"=>$city,"user_state"=>$state,"user_country"=>$ctry,"user_pin"=>$pin,"user_head"=>$head);

	if($curImg["tmp_name"]){
	$imgname=$imgname?$imgname:time().".jpg";

move_uploaded_file($curImg["tmp_name"],"../uploads/".$imgname);
$uarr["user_img"]=$imgname;
$_SESSION["IMG"]=$imgname;
	}
$regobj->where("user_id",$_SESSION["USER"]);
$regobj->update("tbl_admin",$uarr);
$regobj->where("cmp_id",$_SESSION["CMP"]);
$regobj->update("vf_company",Array("cmp_name"=>$cmpname));
$out["status"]="done";
	}
echo json_encode($out);
break;
case "fbLogin":
$id=$_POST["id"];
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$mailid=$_POST["email"];

$route=$_POST["route"]=="Google"?2:1;

$fblogobj=new MysqliDb(HOST,USER,PWD,DB);
//$fblogobj->where("user_socid",$id);
$fblogobj->where("user_mail",$mailid,"LIKE");
//$fblogobj->where("user_status",1);
$loginarray=$fblogobj->getOne("tbl_admin","user_mail,user_fname,user_id,user_img");
if($fblogobj->count >0)
{

$fblogobj->where("user_id",$loginarray["user_id"]);
$_SESSION["CMP"]=$fblogobj->getValue("vf_company","cmp_id");
$_SESSION["USER"]=  $loginarray["user_id"];
$_SESSION["USERNAME"]=  $loginarray["user_fname"];
$_SESSION["USEREMAIL"]=  $loginarray["user_mail"];
$_SESSION["IMG"]=$loginarray["user_img"];
$out["status"]="done";

}
else
{
	$str="1234567890asdfghjklzxcvbnmqwertyuiopASDGHJKLZXCVBNMQWERTYUIOP";
  for($i=0;$i<=5;$i++)
  {
    $pwd.=substr($str,rand(0,62),1);
  }

 $enpwd=md5($pwd);
$regarry=Array("user_fname"=>$fname,"user_lname"=>$lname,"user_mail"=>$mailid,"user_pwd"=>$enpwd,"user_socid"=>$id,"user_route"=>$route,"user_status"=>"1");
$fblogobj->insert("tbl_admin",$regarry);
//print_r($_POST);
$userid=$fblogobj->getInsertId();
$fblogobj->insert("vf_company",Array("user_id"=>$userid));
$cmpid=$fblogobj->getInsertId();
if(!$fblogobj->getLastError()){
$_SESSION["USER"]=  $userid;
$_SESSION["USERNAME"]=  $fname;
$_SESSION["USEREMAIL"]=  $mailid;
$_SESSION["CMP"]=$cmpid;
$out["status"]="done";
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
Hello $fname $lname
</div>

<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>
Welcome to Vyapar Formation
</div>

<div style=' width:540px; margin:12px auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666; font-weight:bold; padding-bottom:30px;'>Thank you for registering with us.
Please use below credentials to login Vyapar Formations<a href='".ROOT."login'>".ROOT."</a>
<p>
User name: <strong>$mailid</strong>
</p>
<p>
Password: <strong>$pwd</strong>
</p>
</div>
</div>
<div style='border-bottom: 4px solid #F05E22; height:60px;'></div>
</html>";
$EMAILOBJ->addAddress($mailid, $fname." ".$lname);
$EMAILOBJ->Subject = 'Welcome to Vyapar Formation';
$EMAILOBJ->msgHTML($msg);
//$EMAILOBJ->send();
if (!$EMAILOBJ->send()) {
$from_mail = "Vyapar Formation <info@vyaparformation.com>";
$replyto   = "info@vyaparformation.com";
$subject   = "Welcome to Vyapar Formation";
$message=$message;

$headers='';
$headers.="Content-type: text/html; charset=UTF-8\r\n";
$headers.="From:info@vyaparformation.com";
mail($mailid, $subject, $msg, $headers);
}

//$EMAILOBJ->send();
}else{
$out["status"]="error";
}

}

echo json_encode($out);
break;
case 'register':
//print_r($_POST);
//ini_set("display_errors",1);
$process="direct";
$fname=$_POST['txtFname'];
$lname=$_POST['txtLname'];
$mail=$_POST['txtMail'];
$number=$_POST['txtNumber'];
$pwd=$_POST['txtPwd'];
$address=$_POST['txtAddress'];
$code=time();
$enpwd=md5("123456");
$out["status"]="error";
$regobj=new MysqliDb(HOST,USER,PWD,DB);
$regobj->where("user_mail",$mail,"LIKE");
$exist=$regobj->getValue("tbl_admin","COUNT(user_id)");
if($exist>0){
$out["status"]="exist";
}
else
{
$regarry=Array("user_fname"=>$fname,"user_lname"=>$lname,"user_mail"=>$mail,"user_number"=>$number,"user_pwd"=>$enpwd,"user_address"=>$address,"user_ucode"=>$code);
$regobj->insert("tbl_admin",$regarry);
//print_r($_POST);
$userid=$regobj->getInsertId();
$regobj->insert("vf_company",Array("user_id"=>$userid));
$cmpid=$regobj->getInsertId();
if(!$regobj->getLastError()){
$out["status"]="done";
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
Hello $fname $lname
</div>

<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>
Welcome to Vyapar Formation
</div>

<div style=' width:540px; margin:12px auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666; font-weight:bold; padding-bottom:30px;'>Thank you for registering with us.
Please click on below <a href='".ROOT."activate/$code/$mail'>link</a>link</a> to activate your account
<p>
Continue service by activte the account.
</p>
</div>
</div>
<div style='border-bottom: 4px solid #F05E22; height:60px;'></div>
</html>";
$EMAILOBJ->addAddress($mail, $fname." ".$lname);
$EMAILOBJ->Subject = 'Welcome to Vyapar Formation';
$EMAILOBJ->msgHTML($msg);
//$EMAILOBJ->send();
if (!$EMAILOBJ->send()) {
$from_mail = "Vyapar Formation <info@vyaparformation.com>";
$replyto   = "info@vyaparformation.com";
$subject   = "Welcome to Vyapar Formation";
$message=$message;

$headers='';
$headers.="Content-type: text/html; charset=UTF-8\r\n";
$headers.="From:info@vyaparformation.com";
mail($mail, $subject, $msg, $headers);
}

//$EMAILOBJ->send();
}else{
$out["status"]="error";
}
}
echo json_encode($out);
break;

case "validateMail":
//print_r($_POST);
$mailid=$_POST["email"];
$emailobj=new MysqliDb(HOST,USER,PWD,DB);
$emailobj->where("user_mail",$mailid);

$cnt=$emailobj->getValue ("tbl_admin", "count(user_id)");
//echo $emailobj->getLastQuery();
echo $cnt;
break;
case 'addSerDash':
$service=$_POST['chk'];
$del=$_POST["del"];
foreach($service as $index=> $item){
$arr=explode("|",$item);
$qry[]="('$index','$arr[0]','$arr[1]','$arr[2]','$_SESSION[USER]','$_SESSION[CMP]','$_SESSION[USERNAME]','".date("Y-m-d H:i:s")."')";
}
$sql="INSERT INTO vf_application(ser_id,ser_type,ap_service,ser_amt,user_id,cmp_id,ap_updateby,ap_date) VALUES ";

$out["status"]="error";
$regobj=new MysqliDb(HOST,USER,PWD,DB);
/*$regobj->startTransaction();
$regobj->where("ser_id",$serid);
$regobj->where("cmp_id",$_SESSION["CMP"]);
$regobj->where("ap_status",1);
$exist=$regobj->getValue("vf_application","COUNT(ap_id)");
if($exist>0){
$out["status"]="applied";
}
else*/
{
if($qry[0]){
$regobj->rawQuery($sql.implode(",",$qry)."ON DUPLICATE KEY UPDATE user_id='$_SESSION[USER]'");
//echo $regobj->getLastQuery();
}
if($del){
$delar=explode(",",$del);
$regobj->where("ap_id",$delar,"IN");
$regobj->delete("vf_application");
}
//echo $regobj->getLastError();
if(!$regobj->getLastError()){
$regobj->commit();
$out["status"]="done";
}
}
echo json_encode($out);
break;
case 'addService':
$service=$_POST['service'];
$stype=$_POST["sertype"];
$serid=$_POST["serid"];
$amt=$_POST["seramt"];
$out["status"]="error";
$regobj=new MysqliDb(HOST,USER,PWD,DB);
$regobj->startTransaction();
$regobj->where("ser_id",$serid);
$regobj->where("cmp_id",$_SESSION["CMP"]);
$regobj->where("ap_status",1);
$exist=$regobj->getValue("vf_application","COUNT(ap_id)");
if($exist>0){
$out["status"]="applied";
}
else{
$apparry=Array("user_id"=>$_SESSION["USER"],"cmp_id"=>$_SESSION["CMP"],"ap_service"=>$service,"ser_id"=>$serid,"ser_type"=>$stype,"ser_amt"=>$amt,"ap_date"=>$regobj->now(),"ap_updateby"=>$_SESSION["USERNAME"]);
$regobj->insert("vf_application",$apparry);
//echo $regobj->getLastError();
if(!$regobj->getLastError()){

$regobj->commit();
$out["status"]="done";
}
}
echo json_encode($out);
break;
case 'frmQuickSmt':
$fname=$_POST['txtname'];
$mail=$_POST['txtemail'];
$number=$_POST['txtmobile'];
$service=$_POST['service'];
$stype=$_POST["sertype"];
$serid=$_POST["serid"];
$amt=$_POST["seramt"];
$code=time();

$regobj=new MysqliDb(HOST,USER,PWD,DB);
$regobj->startTransaction();
$regobj->where("user_mail",$mail,"LIKE");
$exist=$regobj->getValue("tbl_admin","COUNT(user_id)");
if($exist>0){
$out["status"]="exist";
}
else
{
$regarry=Array("user_fname"=>$fname,"user_mail"=>$mail,"user_number"=>$number,"user_ucode"=>$code);
$regobj->insert("tbl_admin",$regarry);
$userid=$regobj->getInsertId();
$regobj->insert("vf_company",Array("user_id"=>$userid));
$cmpid=$regobj->getInsertId();
$apparry=Array("user_id"=>$userid,"cmp_id"=>$cmpid,"ap_service"=>$service,"ap_date"=>$regobj->now(),"ser_id"=>$serid,"ser_type"=>$stype,"ser_amt"=>$amt,"ap_updateby"=>$fname);
$regobj->insert("vf_application",$apparry);
//echo $regobj->getLastError();
if(!$regobj->getLastError()){
$regobj->commit();
$out["status"]="done";
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
Hello $fname $lname
</div>

<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>
Welcome to Vyapar Formation
</div>

<div style=' width:540px; margin:12px auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666; font-weight:bold; padding-bottom:30px;'>Thank you for registering with us.
Please click on below <a href='".ROOT."activate/$code/$mail'>link</a> to activate your account
<p>
This link is only valid for 24 hours.
</p>
</div>

</div>
<div style='border-bottom: 4px solid #F05E22; height:60px;'></div>
</html>";
$EMAILOBJ->addAddress($mail, $fname." ".$lname);
$EMAILOBJ->Subject = 'Welcome to Vyapar Formation';
$EMAILOBJ->msgHTML($msg);
if (!$EMAILOBJ->send()) {
$from_mail = "Vyapar Formation <info@vyaparformation.com>";
$replyto   = "info@vyaparformation.com";
$subject   = "Welcome to Vyapar Formation";
$message=$message;

$headers='';
$headers.="Content-type: text/html; charset=UTF-8\r\n";
$headers.="From:info@vyaparformation.com";
mail($mail, $subject, $msg, $headers);
}
}else{
$out["status"]="error";
}

}
echo json_encode($out);

break;
case "login":
//ini_set("display_errors",1);
$email=$_REQUEST["txtuser"];
$pwd=$_REQUEST["txtpwd"];
$encpwd=md5($pwd);
$loginobj=new MysqliDb(HOST,USER,PWD,DB);

$loginobj->where("user_pwd",$encpwd);
$loginobj->where("user_mail",$email);
$loginobj->where("user_status",1);
$loginarray=$loginobj->getOne("tbl_admin","user_mail,user_fname,user_id,user_pwd,user_img");
if($loginobj->count >0)
{
if($loginarray["user_pwd"]==$encpwd)
{
$loginobj->where("user_id",$loginarray["user_id"]);
$_SESSION["CMP"]=$loginobj->getValue("vf_company","cmp_id");
$_SESSION["USER"]=  $loginarray["user_id"];
$_SESSION["USERNAME"]=  $loginarray["user_fname"];
$_SESSION["USEREMAIL"]=  $loginarray["user_mail"];
$_SESSION["IMG"]=$loginarray["user_img"];
echo json_encode(array("status"=>"done"));
}
else
{
echo json_encode(array("msg"=>"case-error"));
}
}
else
{
echo json_encode(array("msg"=>"wrong"));
}
break;
endswitch;

// print_r($_POST);
?>
