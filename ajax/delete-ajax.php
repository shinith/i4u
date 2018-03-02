<?php
include("../includes/config.php");
include("../includes/functions.php");
include("../includes/MysqliDb.php");
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die("cheating");
	}
$action=$_POST['action'];
switch ($action):

// case "delCmt":
// $csid=$_POST['delid'];
// $drobj=new MysqliDb(HOST,USER,PWD,DB);
// $drobj->where("cm_id",$csid);
// $drobj->delete("vf_comment");
// if($drobj->getLastError())
// {$res["status"]="Error";}
// else {
// $res["status"]="done";
// }
// echo json_encode($res);
// break;
case "delUder":
$csid=$_POST['delid'];
$drobj=new MysqliDb(HOST,USER,PWD,DB);
$drobj->where("admin_id",$csid);
$drobj->delete("tbl_admin");
if($drobj->getLastError())
{$res["status"]="Error";}
else {
$res["status"]="done";
}
echo json_encode($res);
break;

case "delBrand":
$brid=$_POST['delid'];
$drobj=new MysqliDb(HOST,USER,PWD,DB);
$drobj->where("br_id",$brid);
$drobj->delete("tbl_brand");
if($drobj->getLastError())
{$res["status"]="Error";}
else {
$res["status"]="done";
}
echo json_encode($res);
break;

case "delItem":
$itemid=$_POST['delid'];
$drobj=new MysqliDb(HOST,USER,PWD,DB);
$drobj->where("item_id",$itemid);
$drobj->delete("tbl_item");
$drobj->where("item_id",$itemid);
$drobj->delete("item_repair");
if($drobj->getLastError())
{$res["status"]="Error";}
else {
$res["status"]="done";
}
echo json_encode($res);
break;


endswitch;
?>