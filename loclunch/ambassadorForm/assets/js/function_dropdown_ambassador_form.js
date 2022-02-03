/* --------------------- GET CONTRIES FROM CONTINENT ID ------------------------ */	
jQuery(function($){

    $("select.continent_auto").change(function(){
        if($("select.country_auto").length>0)
        {
        var continent=$("select.continent_auto").children("option:selected").attr('data-id');
        $("select.country_auto").html('<option value="0">Select Country</option>');	
            $("select.state_auto").html('<option value="0">Select State</option>');	
         jQuery.ajax({
                    url : tc_csca_auto_ajax.ajax_url,
                    type : 'post',
                    dataType : "json",
                    data : {action: "tc_csca_get_countries",nonce_ajax : tc_csca_auto_ajax.nonce,continent:continent},
                    success : function( response ) {
                   
                        for(i=0;i<response.length;i++)
                            {
                        var st_id=response[i]['id'];
                        var st_name=response[i]['name'];
                        var opt="<option data-id='"+st_id+"' value='"+st_name+"'>"+st_name+"</option>";				
                        $("select.country_auto").append(opt);		
                            }
                    }
                });
        }
        });
/* --------------------- GET STATES FROM COUNTRY ID ------------------------ */	

    $("select.country_auto").change(function(){
    if($("select.state_auto").length>0)
    {
    var cnt=$("select.country_auto").children("option:selected").attr('data-id');
    $("select.state_auto").html('<option value="0">Select State</option>');	
        $("select.city_auto").html('<option value="0">Select City</option>');	
     jQuery.ajax({
                url : tc_csca_auto_ajax.ajax_url,
                type : 'post',
                dataType : "json",
                data : {action: "tc_csca_get_states",nonce_ajax : tc_csca_auto_ajax.nonce,cnt:cnt},
                success : function( response ) {
               // console.log(response);
                    for(i=0;i<response.length;i++)
                        {
                    var st_id=response[i]['id'];
                    var st_name=response[i]['name'];
                    var opt="<option data-id='"+st_id+"' value='"+st_name+"'>"+st_name+"</option>";				
                    $("select.state_auto").append(opt);		
                        }
                }
            });
    }
    });
        
    /* --------------------- GET CITIES ------------------------ */	
        
    $("select.state_auto").change(function(){
    if($("select.city_auto").length>0)
    {	
    var sid=$(this).children("option:selected").attr('data-id');
        //console.log(sid);
    $("select.city_auto").html('<option value="0">Select City</option>');	
     jQuery.ajax({
                url : tc_csca_auto_ajax.ajax_url,
                type : 'post',
                dataType : "json",
                data : {action: "tc_csca_get_cities",nonce_ajax : tc_csca_auto_ajax.nonce,sid:sid},
                success : function( response ) {
                    for(i=0;i<response.length;i++)
                        {
                    var ct_id=response[i]['id'];
                    var ct_name=response[i]['name'];
                    var opt="<option value='"+ct_name+"' data-id='"+ct_id+"'>"+ct_name+"</option>";
                            
                    $("select.city_auto").append(opt);		
                        }
                }
            });
    }
    });		
    });