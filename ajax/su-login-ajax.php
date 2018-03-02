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
case "resetPwd":
$email=$_POST["txtUser"];
$loginobj=new MysqliDb(HOST,USER,PWD,DB);
$loginobj->where("admin_email",$email,"LIKE");
$loginarray=$loginobj->getOne("tbl_admin","admin_email,admin_name,admin_id,admin_pwd");
if($loginobj->count >0)
{
$str="1234567890asdfghjklzxcvbnmqwertyuiopASDGHJKLZXCVBNMQWERTYUIOP";
  for($i=0;$i<=5;$i++)
  {
    $pwd.=substr($str,rand(0,62),1);
  }
  //echo $pwd;
$encpwd=md5($pwd);
$loginobj->where("admin_id",$loginarray["admin_id"]);
$loginobj->update("tbl_admin",Array("admin_pwd"=>$encpwd));
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
Hello $loginarray[admin_name]
</div>

<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>

<table>
<tr>
    <td colspan='2' style='font-size:14px; font-family:Myriad Pro; text-align:left;color:#fff; background:#f47c48; padding:10px;'> Greetings From Vyapar Formations,Your profile password has been reset</td>
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
$EMAILOBJ->addAddress($email, $loginarray["admin_name"]);
$EMAILOBJ->Subject = 'Vyapar Formation Administrator profile password recovery';
$EMAILOBJ->msgHTML($msg);
//$EMAILOBJ->send();
echo json_encode(array("status"=>"reset"));
$EMAILOBJ->send();
}else{
echo json_encode(array("status"=>"resetnomatch"));
}
break;
case "login":
$email=$_POST["txtUser"];
$pwd=$_POST["txtPwd"];
$encpwd=md5($pwd);
$loginobj=new MysqliDb(HOST,USER,PWD,DB);

$loginobj->where("admin_pwd",$encpwd);
$loginobj->where("admin_email",$email);
$loginarray=$loginobj->getOne("tbl_admin","admin_email,admin_name,admin_id,admin_pwd,admin_img,admin_type");
if($loginobj->count >0)
{
if($loginarray["admin_pwd"]==$encpwd)
{
$_SESSION["SUSER"]=  $loginarray["admin_id"];
$_SESSION["SUTYPE"]=  $loginarray["admin_type"];
$_SESSION["SUSERNAME"]=  $loginarray["admin_name"];
$_SESSION["SUSEREMAIL"]=  $loginarray["admin_email"];
$_SESSION["IMG"]=  $loginarray["admin_img"];
$loginobj->insert("tbl_adminlog",Array("admin_id"=>$loginarray["admin_id"]));
$_SESSION["LOGIN"]=$loginobj->getInsertId();
echo json_encode(array("status"=>"login"));
}
else
{
echo json_encode(array("status"=>"case-error"));
}
}
else
{
echo json_encode(array("status"=>"wrong"));
}
break;
endswitch;

// print_r($_POST); 
?>