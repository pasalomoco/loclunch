<?php
add_filter("um_submit_form_register","um_120321_linkedin_field", 10, 2);
function um_120321_linkedin_field( $array_form ){
    
    if( isset( UM()->form()->post_form["linkedin"]  ) && ! empty( UM()->form()->post_form["linkedin"]  ) ){
        if( strpos( UM()->form()->post_form["linkedin"] , "https://linkedin.com/in/linkedin.com" ) > -1 ){
            $linkedin_url = explode("/in/",UM()->form()->post_form["linkedin"] );
            $linkedin_url = str_replace("linkedin.com/","linkedin.com/in/", $linkedin_url[1]);
            UM()->form()->post_form["linkedin"] = $linkedin_url;
        }
    }

}

?>