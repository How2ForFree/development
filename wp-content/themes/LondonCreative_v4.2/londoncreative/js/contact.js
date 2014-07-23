     jQuery(document).ready(function($){
     ///////////////////////
     // Contact Form
     ///////////////////////
     $("#cf_send").click(
     function()
     {
        
        var $continue = true;
        if($("#cf_name").attr("value") == "")
        {
          $("#cf_name").addClass("alert");
          $continue = false;
        }
        else{ $("#cf_name").removeClass("alert"); }
        
        var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
        
        if($("#cf_mail").attr("value") == "")
        {
          $("#cf_mail").addClass("alert");
          $continue = false;
        }
        else if (!filter.test($("#cf_mail").attr("value"))) { $("cf_mail").addClass("alert"); $continue = false; }
        else{ $("#cf_mail").removeClass("alert"); }
        
        if($("#cf_text").attr("value") == "")
        {
          $("#cf_text").addClass("alert");
          $continue = false;
        }
        else{ $("#cf_text").removeClass("alert"); }
        
        if ($continue == false){return false;}
     }
     );
  });
