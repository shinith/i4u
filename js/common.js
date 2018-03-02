/*
 * Author  : Shinith ET,Rejeesh K, Mohammed Irshad Ansari, Vikram Sahni
 * Project : I4UR Gadget
 * Company : AlityArt
 
 **/
  jQuery(document).ready(function() {
   var delid="";
  var delElm="";
    var deltype="";
    jQuery('#delConfirm').on('show.bs.modal', function(e) {
            
            deltype=jQuery(e.relatedTarget).data('title');
            jQuery("#delType").html(deltype);
            delaction=jQuery(e.relatedTarget).data('action');
            delid=jQuery(e.relatedTarget).data('delid');
            elm=jQuery(e.relatedTarget).data('rmv');
            delElm=jQuery(e.relatedTarget).closest(elm);
            
             });
        
        jQuery(document).on("click","#btnDelete",function(){
          

        jQuery.ajax({"url":AJAX+"delete-ajax.php",type:'POST',data:{"action":delaction,"delid":delid,"chk":"chk"},success:function(returnData){
             //alert(returnData); 
             try{
                
             resparray=jQuery.parseJSON(returnData)    
             if(resparray.status=="done")
             {
              if(jQuery(delElm).length>0)
              {
                jQuery(delElm).remove();
              }
           else{
            location.reload();}
             }
             
         }catch(err){}
             
          }
      });
        }); 
  }); 
  
         
 /*ALLOW ONLY NUMERIC CONTENTS*/    
jQuery(".numeric").on("blur , keyup",function(){
    val=this.value.replace("+","").replace(/[^0-9jQuery.,]/g, '');
        this.value=val;
        
        
    });
/*ALLOW ONLY NUMERIC CONTENTS*/   
/*COOKIE*/
 getCookie=function(Name){
       var re=new RegExp(Name+"=[^;]+", "i"); //construct RE to search for target name/value pair
       if (document.cookie.match(re)) //if cookie found
               return document.cookie.match(re)[0].split("=")[1] //return its value
       return ""
}

setCookie=function(name, value){
       document.cookie = name+"="+value+";path=/" //cookie value is domain wide (path=/)
}

jQuery(document).on("blur",".valid-mail",function(){
//alert("inside");
validateMail(this);
});
jQuery(".valid-mail,.valid-reg,.valid-gend").each(function(index,fld){
        trgid="not"+jQuery(fld).attr("id");
        jQuery(fld).after(jQuery("<small></small>").attr({"id":trgid}));
    });
 
function validateMail(obj,scope)
{
    
    exclude=jQuery(obj).data("exclude")==undefined?"":jQuery(obj).data("exclude");
    scope=jQuery(obj).data("scope")==undefined?scope:jQuery(obj).data("scope");
    //alert("inside");
    msgidid="#not"+jQuery(obj).attr("id");
    jQuery(msgidid).removeClass("text-danger").html("");
var eml = /^([A-Za-z0-9_\\.])+\@([A-Za-z0-9_\\.])+\.([A-Za-z]{2,4})jQuery/;
if (eml.test(jQuery.trim(jQuery(obj).val())))
{
    
    if(scope=="client")
    {   validmail=true;
        return true;
    }else{
    jQuery.ajax({"url":AJAX+"common-ajax.php",type:'post',async: false, data:{"action":"validateMail","email":jQuery(obj).val(),"exclude":exclude},success:function(returnData){
            //alert(returnData)
            if(returnData>0){
                
               jQuery(msgidid).addClass("text-danger").html("This email id already in use");
            validmail=false;
            return false;
        }
        else{
            jQuery(msgidid).addClass("text-success").html("Email id available");
            validmail=true;
            return true;
            
            
        }
            
          },error:function(){
              return "errr";
          }
      });
      //alert(valid);
     /// return valid;
}
}
else
{

jQuery(msgidid).addClass("text-danger").html("Please enter a valid email id");
return false;
//return jQuery.trim(jQuery(obj).val());
}}

function validatePhone(number)
  {
    var phnmatch=/^(\s*)?((0091(\s*[\ -]\s*)?)|(\+91(\s*[\ -]\s*)?)|0?)[4-9]{1}((\d{1}(\s*[\ -]\s*)?\d{8})|(\d{2}(\s*[\ -]\s*)?\d{7}))(,(\s*)?((0091(\s*[\ -]\s*)?)|(\+91(\s*[\ -]\s*)?)|0?)[4-9]{1}((\d{1}(\s*[\ -]\s*)?\d{8})|(\d{2}(\s*[\ -]\s*)?\d{7})))*jQuery/;
    return phnmatch.test(number);
  }

  function validateMobile(mob)
  {
    var mobmatch=/^((0091(\s*[\ -]\s*)?)|(\+91(\s*[\ -]\s*)?)|0?)[7-9]{1}\d{9}jQuery/;
    return mobmatch.test(mob);
  }

function validateName(Name)
{
  var namreg=/^([A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,})*jQuery/;
  return namreg.test(Name);
}


jQuery(document).on('click',".paginate_button", function(){
jQuery('html, body').animate({scrollTop: 0}, 500);
});