<?php



function function_pending_ambassador ($form_data){
    global $wpdb;
    $table_user_directions = $wpdb->prefix.'users_directions';
    $cfdb = apply_filters( 'cfdb7_database', $wpdb );
    $table_db7_forms = $cfdb->prefix.'db7_forms'; 
    $formId = isset( $_GET['ufid'] ) ? (int) $_GET['ufid'] : 0;
    $approveAmbassador= "Ambassador pending";
    $form_data["approve_ambassador"] = "PENDING";
    $color = "#008CBA";
    $user = get_user_by('id', $form_data['user_id']);
    $continent  = get_user_meta($user->ID,'continent',true);
    $country  = get_user_meta($user->ID,'country',true);
    $state  = get_user_meta($user->ID,'state_province',true);
    $city  = get_user_meta($user->ID,'city',true);
    $ambassadorStatus  = get_user_meta($user->ID,'ambassador_status',true);
    if(isset($continent)){
        delete_user_meta($user->ID, 'continent');
    }
    if(isset($country)){
        delete_user_meta($user->ID, 'country');
    }
    if(isset($state)){
        delete_user_meta($user->ID, 'state_province');
    }
    if(isset($city)){
        delete_user_meta($user->ID, 'city');
    }
    if(isset($ambassadorStatus)){
        update_user_meta( $user->ID, 'ambassador_status', "pending");
    }
    send_email_with_ambassador_yes_no_notification($form_data["approve_ambassador"], $form_data["your-email"], $form_data["Continent"],$form_data["Country"], $form_data["State_Province"], $form_data["City"]);
    $form_data = serialize( $form_data );
    $test = $cfdb->query( "UPDATE $table_db7_forms SET form_value =
     '$form_data' WHERE form_id = '$formId' LIMIT 1"
    );
    if(in_array("ambassadorformalreadysent", $user->roles)){
        $u = new WP_User( $user->ID );  
        $u->remove_role( 'ambassadorformalreadysent' );  
    }
    if(in_array("ambassador", $user->roles)){
        $u->remove_role( 'ambassador' );
        // $wpdb->query( "UPDATE $table_user_directions SET `active`=0 WHERE user_id=$user->ID LIMIT 1;");
    }
    return $color;

}

function function_approve_ambassador ($form_data){
    global $wpdb;
    $table_user_directions = $wpdb->prefix.'users_directions';
    $cfdb = apply_filters( 'cfdb7_database', $wpdb );
    $table_db7_forms = $cfdb->prefix.'db7_forms'; 
    $formId = isset( $_GET['ufid'] ) ? (int) $_GET['ufid'] : 0;
    $approveAmbassador= "Ambassador approve";
    $form_data["approve_ambassador"] = "YES";
    $color = "#04AA6D";
    $user = get_user_by('id', $form_data['user_id']);

    if(! (in_array("ambassador", $user->roles))){

        $u = new WP_User( $user->ID );  
        $u->add_role( 'ambassador' );
        $u->add_role( 'ambassadorformalreadysent' ); 
        $continent  = get_user_meta($user->ID,'continent',true);
        $country  = get_user_meta($user->ID,'country',true);
        $state  = get_user_meta($user->ID,'state_province',true);
        $city  = get_user_meta($user->ID,'city',true);
        $ambassadorStatus  = get_user_meta($user->ID,'ambassador_status',true);
        if(empty($continent)){
            $continent = get_id_continent_country_state_city("continent", $form_data["Continent"]);
            add_user_meta( $user->ID, 'continent', (int) $continent );
        }
        if(empty($country)){
            $country = get_id_continent_country_state_city("countries", $form_data["Country"]);
            add_user_meta( $user->ID, 'country', (int) $country);
        }
        if(empty($state)){
            $state = get_id_continent_country_state_city("state", $form_data["State_Province"]);
            add_user_meta( $user->ID, 'state_province', (int) $state);
        }
        if(empty($city)){
            $city = get_id_continent_country_state_city("city", $form_data["City"]);
            add_user_meta( $user->ID, 'city', (int) $city);
        }
        if(empty($ambassadorStatus)){
            add_user_meta( $user->ID, 'ambassador_status', "approved");
        }else{
            update_user_meta( $user->ID, 'ambassador_status', "approved");
        }
        send_email_with_ambassador_yes_no_notification($form_data["approve_ambassador"], $form_data["your-email"], $form_data["Continent"],$form_data["Country"], $form_data["State_Province"], $form_data["City"]);
        $form_data = serialize( $form_data );
        $cfdb->query( "UPDATE $table_db7_forms SET form_value =
         '$form_data' WHERE form_id = '$formId' LIMIT 1"
        );

    }   

    return $color;

}

function function_not_approve_ambassador ($form_data){
    global $wpdb;
    $table_user_directions = $wpdb->prefix.'users_directions';
    $cfdb = apply_filters( 'cfdb7_database', $wpdb );
    $table_db7_forms = $cfdb->prefix.'db7_forms'; 
    $formId = isset( $_GET['ufid'] ) ? (int) $_GET['ufid'] : 0;
    $approveAmbassador= "Ambassador not approved";
    $form_data["approve_ambassador"] = "NO";
    $color = "#f44336";    
    $user = get_user_by('id', $form_data['user_id']);
    $continent  = get_user_meta($user->ID,'continent',true);
    $country  = get_user_meta($user->ID,'country',true);
    $state  = get_user_meta($user->ID,'state_province',true);
    $city  = get_user_meta($user->ID,'city',true);
    $ambassadorStatus  = get_user_meta($user->ID,'ambassador_status',true);
    if(isset($continent)){
        delete_user_meta($user->ID, 'continent');
    }
    if(isset($country)){
        delete_user_meta($user->ID, 'country');
    }
    if(isset($state)){
        delete_user_meta($user->ID, 'state_province');
    }
    if(isset($city)){
        delete_user_meta($user->ID, 'city');
    }
    if(isset($ambassadorStatus)){
        update_user_meta( $user->ID, 'ambassador_status', "not approved");
    }
    if(in_array("ambassador", $user->roles)){
        $u = new WP_User( $user->ID );  
        $u->remove_role(  'ambassador' );  
        $u->add_role( 'ambassadorformalreadysent' );   
        // $wpdb->query( "UPDATE $table_user_directions SET `active`=0 WHERE user_id=$user->ID LIMIT 1;");
        send_email_with_ambassador_yes_no_notification($form_data["approve_ambassador"], $form_data["your-email"], $form_data["Continent"],$form_data["Country"], $form_data["State_Province"], $form_data["City"]);
        $form_data = serialize( $form_data );
        $cfdb->query( "UPDATE $table_db7_forms SET form_value =
         '$form_data' WHERE form_id = '$formId' LIMIT 1"
        );
    } else{
        $u = new WP_User( $user->ID );  
        $u->add_role( 'ambassadorformalreadysent' );   
        // $wpdb->query( "UPDATE $table_user_directions SET `active`=0 WHERE user_id=$user->ID LIMIT 1;");
        send_email_with_ambassador_yes_no_notification($form_data["approve_ambassador"], $form_data["your-email"], $form_data["Continent"],$form_data["Country"], $form_data["State_Province"], $form_data["City"]);
        $form_data = serialize( $form_data );
        $cfdb->query( "UPDATE $table_db7_forms SET form_value =
         '$form_data' WHERE form_id = '$formId' LIMIT 1"
        );
    }

    return $color;
}

function function_admin_ambassador($formPostId) {

    global $wpdb;
    $formId = isset( $_GET['ufid'] ) ? (int) $_GET['ufid'] : 0;
    $cfdb = apply_filters( 'cfdb7_database', $wpdb );
    $table_db7_forms = $cfdb->prefix.'db7_forms'; 
    $results = $cfdb->get_results( "SELECT form_value FROM $table_db7_forms WHERE form_post_id = $formPostId AND form_id = $formId LIMIT 1", OBJECT );
    $form_data  = unserialize( $results[0]->form_value);
    $color = "";
    if(isset( $_GET['approve_ambassador'] )){
        $approveAmbassador = $_GET['approve_ambassador'];

        if($approveAmbassador == "NO"){

            $color = function_not_approve_ambassador($form_data);
          
        }else if ($approveAmbassador == "YES") {
            
            $color = function_approve_ambassador($form_data);
  
        }else if ($approveAmbassador == "PENDING"){
            
            $color = function_pending_ambassador($form_data);

        }
    }
    
    include_once("templates/button_admin_ambassador.php");
    if(isset( $_GET['approve_ambassador'] )){
        echo "<script> location.href='admin.php?page=cfdb7-list.php&fid=$formPostId&ufid=$formId';</script>";
    }

}

function send_email_with_ambassador_yes_no_notification ($notification, $email, $continent, $country, $state, $city){

    if($notification === "NO"){
        $from = "testloclunch@gmail.com";
        $to = $email;
        $subject = "Ambassador form";
        $message = "<h1>Sorry, your ambassador request have been denied</h1>";
        $headers = "From:" . $from;
        wp_mail($to,$subject,$message, $headers);        
    }else if ($notification === "YES"){
        $from = "testloclunch@gmail.com";
        $to = $email;
        $subject = "Ambassador form";
        $message = "<h1>Congratulations ! you are now an ambassador from LocLunch:</h1>
                    <p>Continent: $continent </p> 
                    <p>Country: $country </p> 
                    <p>State/Province: $state </p> 
                    <p>City: $city </p> ";
        $headers = "From:" . $from;
        wp_mail($to,$subject,$message, $headers);  
    } else if ($notification === "PENDING"){
        $from = "testloclunch@gmail.com";
        $to = $email;
        $subject = "Ambassador form";
        $message = "<h1>You can fill in the ambassador form again</h1>";
        $headers = "From:" . $from;
        wp_mail($to,$subject,$message, $headers); 
    }

}

function wpse27856_set_content_type(){
    return "text/html";
}

add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );


add_action('cfdb7_after_formdetails', 'function_admin_ambassador');

?>