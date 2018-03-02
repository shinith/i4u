<?php
session_start();
ob_start();
ini_set("display_errors",0);
define("ROOT",'http://localhost/i4u/');
define("HOST", "localhost");
define("USER","root");
define("DB","i4u");
define("PWD","tiger");
define("FILESIZE", "2048000");
define("DIR", $_SERVER["DOCUMENT_ROOT"]."/mobile/");
define("ADMINROOT","http://localhost/i4u/manage/");

define("IMGDIR","http://localhost/i4u/uploads/");
define("MERCHANT","");
define("PAYURL","https://www.sandbox.paypal.com/cgi-bin/webscr");
define("PAGESIZE", "10");
$APSTATUS=Array("1"=>"In progress","2"=>"Pending for documents","3"=>"Pending for Information","4"=>"Pending with Department","5"=>"Completed");