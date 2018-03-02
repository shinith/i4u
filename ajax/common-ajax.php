<?php
include("../includes/config.php");
include("../includes/MysqliDb.php");
include("../includes/functions.php");
//ini_set("display_errors",1);
include_once("../includes/PHPMailerAutoload.php");
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
die("cheating");
}
$action=$_REQUEST['action'];
switch($action):
case "cmSts":
$id=$_POST["id"];
$sts=$_POST["sts"];
$cmstsobj=new MysqliDb(HOST,USER,PWD,DB);
$cmstsobj->where("cm_id",$id);
$cmstsobj->update("vf_comment",Array("cm_status"=>$sts));
//echo $cmstsobj->getLastQuery();
  echo json_encode(array("status"=>"done"));

break;
case "comment":
//ini_set("display_errors",1);
$cmtype=$_POST["cmtype"]=="replay"?1:0;
$blogid=$_POST["blogid"];
$cmt=addslashes(nl2br($_POST["comment"]));
$prt=$_POST["cmprt"];
 $cmobj=new MysqliDb(HOST,USER,PWD,DB);
$cmobj->insert("vf_comment",Array("blog_id"=>$blogid,"user_id"=>$_SESSION["USER"],"cm_comment"=>$cmt,"cm_parent"=>$prt));
  echo json_encode(array("status"=>"done"));

break;
case "seoPage":

$pageid=$_POST["pageId"];
$title=$_POST["txtTitle"];
$kwd=$_POST["txtKwd"];
$url=$_POST["txtUrl"];
$desc=$_POST["txtDesc"];
$pageobj=new MysqliDb(HOST,USER,PWD,DB);
if($pageid)
$pageobj->where("seo_id",$pageid,"!=");
$pageobj->where("seo_url",$url,"LIKE");
$exist=$pageobj->getvalue("vf_seo","COUNT(seo_id)");
if($exist)
{
echo json_encode(array("status"=>"exist"));
}
else{
 $sql=Array("seo_title"=>$title,"seo_url"=>$url,"seo_kewd"=>$kwd,"seo_desc"=>$desc);
 if($pageid){
  $pageobj->where("seo_id",$pageid);
$pageobj->update("vf_seo",$sql);
 }
  else{
$pageobj->insert("vf_seo",$sql);

  }
  echo json_encode(array("status"=>"done"));
}

break;
case"partnerWithUs":
$cmpname=$_POST["txtCmpName"];
$fname=$_POST["txtPFname"];
$lname=$_POST["txtPLname"];
$email=$_POST["txtPEmail"];
$mobile=$_POST["txtPMobile"];
$tele=$_POST["txtPTele"];
$addr=$_POST["txtPCAdd"];
$city=$_POST["txtPCity"];
$state=$_POST["txtPState"];
$pin=$_POST["txtPPin"];
$prf=$_FILES["txtPProfile"];
  // frmPartner txtCmpName txtPFname  txtPLname txtPEmail txtPMobile txtPTele txtPCAdd  txtPCity txtPState txtPPin txtPProfile btnPart
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


<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>Message from Vyapar Formation Partner with Us
</div>

<div style=' width:540px; margin:12px auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666; font-weight:bold; padding-bottom:30px;'>";
$msg.=$cmpname?"<p>Company name: <strong>$cmpname</strong></p>":"";
$msg.=$fname?"<p>First name: <strong>$fname</strong></p>":"";
$msg.=$lname?"<p>Last name: <strong>$lname</strong></p>":"";
$msg.=$email?"<p>Email: <strong>$email</strong></p>":"";
$msg.=$mobile?"<p>Mobile: <strong>$mobile</strong></p>":"";
$msg.=$tele?"<p>Land line: <strong>$tele</strong></p>":"";
$msg.=$addr?"<p>Address: <strong>$addr</strong></p>":"";
$msg.=$city?"<p>City: <strong>$city</strong></p>":"";
$msg.=$state?"<p>State: <strong>$state</strong></p>":"";
$msg.=$pin?"<p>Pincode: <strong>$pin</strong></p>":"";
$msg.="</div>
</div>
<div style='border-bottom: 4px solid #F05E22; height:60px;'></div>
</html>";
if($prf["tmp_name"]){
$EMAILOBJ->AddAttachment($prf["tmp_name"],$prf["name"]);
}
//$EMAILOBJ->addAddress("shinithet@gmail.com", $fname." ".$lname);
$EMAILOBJ->addAddress("info@vyaparformations.com", "Vyapar Formations");
$EMAILOBJ->Subject = 'Vyapar Formation Partner with Us';
$EMAILOBJ->msgHTML($msg);
//$EMAILOBJ->send();
if (!$EMAILOBJ->send()) {
$from_mail = "Vyapar Formation <$email>";
$replyto   = "";
$subject   = "Vyapar Formation Partner with Us";

$headers='';
$headers.="Content-type: text/html; charset=UTF-8\r\n";
$headers.="From:$email";
mail("info@vyaparformations.com", $subject, $msg, $headers);
}
echo json_encode(Array("status"=>"done"));
break;
case"meetMsg":
$fname=$_POST["txtMeetName"];
$email=$_POST["txtMeetEmail"];
$tele=$_POST["txtMeetPhone"];
$addr=$_POST["txtMeetMsg"];
$subject   = $_POST["txtMeetSub"]?$_POST["txtMeetSub"]:"Vyapar Formation Meet Us";
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


<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>Message from Vyapar Formation Partner with Us
</div>

<div style=' width:540px; margin:12px auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666; font-weight:bold; padding-bottom:30px;'>";
$msg.=$fname?"<p>Name: <strong>$fname</strong></p>":"";
$msg.=$email?"<p>Email: <strong>$email</strong></p>":"";
$msg.=$tele?"<p>Contact no: <strong>$tele</strong></p>":"";
$msg.=$subject?"<p>Subect: <strong>$subject</strong></p>":"";
$msg.=$addr?"<p>Message: <strong>$addr</strong></p>":"";
$msg.="</div>
</div>
<div style='border-bottom: 4px solid #F05E22; height:60px;'></div>
</html>";
//$EMAILOBJ->addAddress("shinithet@gmail.com", $fname." ".$lname);
$EMAILOBJ->addAddress("info@vyaparformations.com", "Vyapar Formations");
$EMAILOBJ->Subject = $subject;
$EMAILOBJ->msgHTML($msg);
//$EMAILOBJ->send();
if (!$EMAILOBJ->send()) {
$from_mail = "Vyapar Formation <$email>";
$replyto   = "$email";

$headers='';
$headers.="Content-type: text/html; charset=UTF-8\r\n";
$headers.="From:$email";
mail("info@vyaparformations.com", $subject, $msg, $headers);
}
echo json_encode(Array("status"=>"done"));
break;
case"career":
$fname=$_POST["txtName"];
$email=$_POST["txtEmail"];
$mobile=$_POST["txtMobile"];
$qual=$_POST["txtQualification"];
$desig=$_POST["txtCurrentDesignation"];
$curcmp=$_POST["txtCurrentCompany"];
$city=$_POST["txtLocation"];
$ctc=$_POST["txtCtc"];
$profile=$_POST["txtMessage"];

$prf=$_FILES["txtResume"];
  // frmPartner txtCmpName txtPFname  txtPLname txtPEmail txtPMobile txtPTele txtPCAdd  txtPCity txtPState txtPPin txtPProfile btnPart
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


<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>
Message From Vyapar Formations Careers
</div>

<div style=' width:540px; margin:12px auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666; font-weight:bold; padding-bottom:30px;'>";
$msg.=$fname?"<p>Name: <strong>$fname</strong></p>":"";
$msg.=$email?"<p>Email: <strong>$email</strong></p>":"";
$msg.=$mobile?"<p>Mobile: <strong>$mobile</strong></p>":"";
$msg.=$qual?"<p>Qualification: <strong>$qual</strong></p>":"";
$msg.=$desig?"<p>Designation: <strong>$desig</strong></p>":"";
$msg.=$curcmp?"<p>Current Company: <strong>$curcmp</strong></p>":"";
$msg.=$city?"<p>Location: <strong>$city</strong></p>":"";
$msg.=$ctc?"<p>Expected CTC: <strong>$ctc</strong></p>":"";
$msg.=$profile?"<p>Message: <strong>$profile</strong></p>":"";
$msg.="</div>
</div>
<div style='border-bottom: 4px solid #F05E22; height:60px;'></div>
</html>";
if($prf["tmp_name"]){
$EMAILOBJ->AddAttachment($prf["tmp_name"],$prf["name"]);
}
$EMAILOBJ->addAddress("info@vyaparformations.com", "Vyapar Formations");
//$EMAILOBJ->addAddress("irshad@alityart.in", "Irshad Ansari");
$EMAILOBJ->Subject = 'Vyapar Formation Careers';
$EMAILOBJ->msgHTML($msg);
//$EMAILOBJ->send();
if (!$EMAILOBJ->send()) {
$from_mail = "Vyapar Formation <$email>";
$replyto   = "";
$subject   = "Vyapar Formation careers";

$headers='';
$headers.="Content-type: text/html; charset=UTF-8\r\n";
$headers.="From:$email";
mail("info@vyaparformations.com", $subject, $msg, $headers);
}
echo json_encode(Array("status"=>"done"));
break;
case"quikFrm":
$fname=$_POST["quickName"];
$email=$_POST["quickEmail"];
$mobile=$_POST["quickMobile"];
$ser=$_POST["quickSer"];
$profile=$_POST["quickMsg"];

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


<div style=' width:540px; margin:12px auto 15px auto; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#666;'>
Message From Vyapar Formations Quick Contact
</div>

<div style=' width:540px; margin:12px auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666; font-weight:bold; padding-bottom:30px;'>";
$msg.=$fname?"<p>Name: <strong>$fname</strong></p>":"";
$msg.=$email?"<p>Email: <strong>$email</strong></p>":"";
$msg.=$mobile?"<p>Mobile: <strong>$mobile</strong></p>":"";
$msg.=$ser?"<p>Service: <strong>$ser</strong></p>":"";
$msg.=$profile?"<p>Message: <strong>$profile</strong></p>":"";
$msg.="</div>
</div>
<div style='border-bottom: 4px solid #F05E22; height:60px;'></div>
</html>";

$EMAILOBJ->addAddress("info@vyaparformations.com", "Vyapar Formations");
//$EMAILOBJ->addAddress("irshad@alityart.in", "Irshad Ansari");
//$EMAILOBJ->addAddress("shinithet@gmail.com", "Irshad Ansari");
$EMAILOBJ->Subject = 'Vyapar Formations Quick Contact';
$EMAILOBJ->msgHTML($msg);
//$EMAILOBJ->send();
if (!$EMAILOBJ->send()) {
$from_mail = "Vyapar Formation <$email>";
$replyto   = "";
$subject   = "Vyapar Formations Quick Contact";

$headers='';
$headers.="Content-type: text/html; charset=UTF-8\r\n";
$headers.="From:$email";
}
echo json_encode(Array("status"=>"done"));
break;
case "adminBlog":
$blgid=$_POST["blgid"];
$ttl=addslashes($_POST["txtBlgttl"]);
$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $ttl);
$slug=strtolower($slug);
$cprsn=addslashes($_POST["txtBlgauth"]);
$shrtblg=addslashes($_POST["txtShrtBlog"]);
$blog=($_POST["txtBlog"]);
$dt=date("Y-m-d",$_POST["txtDate"]?strtotime($_POST["txtDate"]):time());

$delimg=$_POST["delimg"];
$imgar = $_FILES['crimage-data'];
//print_r($_POST);exit;
$out["sts"]="error";
$dir="../uploads/";
$carobj=new MysqliDb(HOST,USER,PWD,DB);
$carobj->startTransaction();
$indarry=Array("blog_title"=>$ttl, "blog_auth"=>$cprsn, "blog_desc"=>$shrtblg,"blog_date"=>$dt);

if($blgid)
{
$carobj->where("blog_id",$blgid);
$carobj->update("vf_blog",$indarry);
}
else{
$indarry["blog_slug"]=$slug ;
$carobj->insert("vf_blog",$indarry);
$blgid=$carobj->getInsertId();
}
//print_r($delimg);exit;
if(sizeof($imgar)>0){
	foreach($imgar["tmp_name"] as $imnm=>$img){
	$file =  strpos($imnm,".")?$imnm:time() . "$imnm.jpg";
	if(!strpos($imnm,"jpg")){
	$imsql[]="('$blgid','$file')";
	}
  $enhndle=fopen("../blogs/{$blgid}.txt","w");
   fwrite($enhndle,$blog);
   fclose($enhndle);
	//echo $img;
	$success = move_uploaded_file($img,$dir .$file);
	$imgproperty = getimagesize($dir .$file);
	$imwidth=$imgproperty[0];
	$imheight=$imgproperty[1];

	$medwidth=$imwidth*(0.75);
	$medheight=$imheight*(0.75);

	$twidth=$imwidth*(0.25);
	$theight=$imheight*(0.25);

	$img_id = imagecreatefromjpeg($dir .$file);
	fn_resize($img_id,$imwidth,$imheight,$dir."medium/" .$file,$medwidth,$medheight);
	fn_resize($img_id,$imwidth,$imheight,$dir."thumb/" .$file,$twidth,$theight);
	}

}
if(sizeof($imsql)>0){
$carobj->rawQuery("INSERT INTO vf_blogimg (blog_id,bi_blgimg)VALUES ".implode(",",$imsql));
}
//echo $carobj->getLastQuery();
if(sizeof($delimg)>0){

foreach($delimg as $del){
	unlink("../uploads/$del");
	unlink("../uploads/medium/$del");
	unlink("../uploads/tile/$del");
	unlink("../uploads/thumb/$del");
}
$carobj->where("bi_blgimg",$delimg,"IN");
$carobj->delete("vf_blogimg");
//echo $carobj->getLastQuery();
}
//echo $carobj->getLastError();
if(!$carobj->getLastError()){
$carobj->commit();
$out["sts"]="done";
}
echo json_encode($out);
break;
endswitch;
?>
