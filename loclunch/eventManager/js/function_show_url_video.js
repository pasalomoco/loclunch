(function($) {
    $(document).ready(function() {

      $("#attendee_information_fields option[value='attendee_name']").attr("selected", true);
      $("#attendee_information_fields option[value='attendee_email']").attr("selected", true);
     
      $("input[value*='no']").click(function(){
        $(".fieldset-url_meeting").hide();
        $("input[type*='url']").prop('required',false);
      });
      $("input[value*='yes']").click(function(){
        $(".fieldset-url_meeting").show();
        $("input[type*='url']").prop('required',true);
 
      });
        
    });
})( jQuery );



   