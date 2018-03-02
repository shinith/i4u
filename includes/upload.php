<?php
require("config.php");
require("resize.class.php");
//print_r($_FILES);exit;
$big=$_POST["bg"]=="undefined"?null:$_POST["bg"];
        $md=$_POST["md"]=="undefined"?null:$_POST["md"];
        $thumb=$_POST["thumb"]=="undefined"?null:$_POST["thumb"];
        $big=$_POST["large"]=="undefined"?null:$_POST["large"];
        $tszarray=$thumb?explode("|",$thumb):"";
        $mszarray=$md?explode("|",$md):"";
        $szarray=$big?explode("|",$big):"";
        $twidth = $tszarray[0];
        $theight = $tszarray[1];
        $mwidth	= $mszarray[0];
        $mheight= $mszarray[1];
	   $lwidth= $szarray[0];
        $lheight= $szarray[1];
        $allowd=$_POST["allowed"];
        $file_to_upload=$_FILES[$_POST["fld"]];
        $dir= "../temp/";
        $mdir= "../temp/medium/";
        $tdir= "../temp/thumb/";
        $ldir= "../temp/large/";
        $filename= strtolower($file_to_upload['name']);
        $flext = substr($filename, strrpos($filename, '.'));
        $flext = str_replace('.','',$flext);
        $RandomNumber   = time();//rand(0, 9999999999); 
        $fname="$RandomNumber.$flext";
        $curtype=$file_to_upload['type'];
        $allowdarray=$allowd?$allowd:array("image/jpg","image/jpeg","image/png","image/gif","image/pjpeg");

        $imgtype=array("image/jpg","image/jpeg","image/png","image/gif","image/pjpeg");
       //echo$curtype. in_array($curtype, $allowdarray);
        if(in_array($curtype, $allowdarray))
        {
        if(in_array($curtype, $imgtype))
        {
        
	$path="";//manageDir($_POST['imgfolder'],"student",'link');//to get http path
	
        //echo "$lwidth, $lheight, $dir.$fname";exit;
        
        
        if($file_to_upload['size'] <= FILESIZE)
            {
        
        $upobj=new resizer($file_to_upload,100);
        if($szarray){
        
         if($thmbres=$upobj->resizeImage($lwidth, $lheight, $ldir.$fname))
         {
        $result["path"]="temp/large/";
        $result["name"]=$fname;
         }
        }
        if($mszarray){
         if($thmbres=$upobj->resizeImage($mwidth, $mheight, $mdir.$fname))
         {$result["path"]="temp/medium";
         $result["name"]=$fname;
         }
        }
        if($tszarray){
        if($thmbres=$upobj->resizeImage($twidth, $theight, $tdir.$fname))
        {$result["path"]="temp/thumb/";
        $result["name"]=$fname;
        }
        }
        if ($large) {
           move_uploaded_file($file_to_upload['tmp_name'],"../temp/large/$fname");
           

        }
        
            }
            else
            {
             $result["err"]="File size should be less than 1 MB.";   
            }    
        }

        else 
        {
        move_uploaded_file($file_to_upload['tmp_name'],"../temp/$fname");
        $result["path"]="temp/";
        $result["name"]=$fname;
        $result["type"]=$file_to_upload['type'];
        }
    }
    else 
        {
        $result["err"]="Check the file type .";
        }
        echo json_encode($result);

