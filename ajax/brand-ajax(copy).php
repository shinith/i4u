<?php
include("../includes/config.php");
include("../includes/functions.php");
include("../includes/MysqliDb.php");
ini_set(display_errors, 1);
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		//die("cheating");
	}
$action=$_POST['action'];
// echo $action; 

switch($action):
	
	case "service":
	 // echo "no action";
	// //ini_set("display_errors",1);
	$data=$_POST['dataid'];
	$obj=new MysqliDb(HOST,USER,PWD,DB);
	$obj->where("cat_id",$data);
	$repair['result']=$obj->get("tbl_repairbkp",null,"rep_id,cat_id,rep_name,rep_amount,rep_lpos,rep_tpos");
	$repair['count']=count($repair['result']);
	echo json_encode($repair);

	 break;
	

case "crtItem":
$itmid=$_POST["itemid"];
$img=$_POST['curImg'];
$brid=$_POST['txtbrand'];
$catid=$_POST['txtcategory'];
$item=$_POST['txtitem'];

$snamear=$_POST['service_name'];
$sratear=$_POST['service_rate'];
$slposar=$_POST['service_lpos'];
$stposar=$_POST['service_tpos'];
$sqlar=Array("cat_id"=>$catid,"br_id"=>$brid,"item_name"=>$item);
$curImg=$_FILES["img"];
if($curImg["tmp_name"]){
$imgname=$imgname?$imgname:time().".jpg";

move_uploaded_file($curImg["tmp_name"],"../uploads/".$imgname);
$sqlar["item_fimg"]=$imgname;
$imgproperty = getimagesize("../uploads/".$imgname);
	$imwidth=$imgproperty[0];
	$imheight=$imgproperty[1];

	$medwidth=$imwidth*(0.75);
	$medheight=$imheight*(0.75);

	$twidth=$imwidth*(0.25);
	$theight=$imheight*(0.25);

	$img_id = imagecreatefromjpeg("../uploads/".$imgname);
	fn_resize($img_id,$imwidth,$imheight,"../uploads/medium/" .$imgname,$medwidth,$medheight);
	fn_resize($img_id,$imwidth,$imheight,"../uploads/thumb/" .$imgname,$twidth,$theight);

  }
$obj=new MysqliDb(HOST,USER,PWD,DB);
if($itmid){
	$obj->where("item_id",$itmid);
$obj->update("tbl_item",$sqlar);
}else{
$obj->insert("tbl_item",$sqlar);
$itmid=$obj->getInsertId();	
}
$sidar=$_POST['service_id'];
$snamear=$_POST['service_name'];
$sratear=$_POST['service_rate'];
$slposar=$_POST['service_lpos'];
$stposar=$_POST['service_tpos'];
foreach ($snamear as $key => $sname) {
$itid=$sidar[$key]>0?$sidar[$key]:"NULL";	
$svqry[]="($itid,$itmid,'$sname','$sratear[$key]','$slposar[$key]','$stposar[$key]')";
}
$srvsql="INSERT INTO item_repair(ir_id,item_id,ir_name,ir_amount,ir_lpos,ir_tpos)".implode(",",$svqry)."ON DUPLICATE KEY UPDATE ir_name=VALUES(ir_name),ir_amount=VALUES(ir_amount),ir_lpos=VALUES(ir_lpos),ir_tpos=VALUES(ir_tpos)";
// echo $srvsql;
$obj->rawQuery($srvsql);
$out["status"]="done";
  

echo json_encode(array("status"=>"done"));

break;

endswitch;



?>