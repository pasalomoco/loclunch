<?php

function function_extract_countries(){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'X-Parse-Application-Id: AaBS9Mj62IB4FKJwlnDbJISFggFN9xE4JONQ8KHC', // This is your app's application id
        'X-Parse-REST-API-Key: Fjip9qH9YfUu3GLVSKz32470DIXVcoqTNSZE6MBk' // This is your app's REST API key
    ));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL,"https://parseapi.back4app.com/classes/Continentscountriescities_Country?limit=255");
    $result=curl_exec($curl);
    curl_close($curl);
    $countries = json_decode($result, true);
    return $countries;
    
  }

function function_extract_continents(){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'X-Parse-Application-Id: AaBS9Mj62IB4FKJwlnDbJISFggFN9xE4JONQ8KHC', // This is your app's application id
        'X-Parse-REST-API-Key: Fjip9qH9YfUu3GLVSKz32470DIXVcoqTNSZE6MBk' // This is your app's REST API key
    ));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL,"https://parseapi.back4app.com/classes/Continentscountriescities_Continent?limit=10");
    $result=curl_exec($curl);

    curl_close($curl);
    $continents = json_decode($result, true);
    return $continents;
    
  }

  function init_world_data_base_function(){
    global $wpdb;
    $table_countries = $wpdb->prefix.'countries';
    $result = $wpdb->get_results("SELECT id,name FROM `$table_countries`", ARRAY_A);
    $countries = function_extract_countries();
    $arrayFinal = array();
    $id = 0;
    $contador = 0;
    for ($x = 0 ; $x < count($countries["results"]) ; $x++){
        $match  = false;
        for ($i = 0; $i < count($result) ; $i++){
            
            
            if($countries["results"][$x]["name"] == $result[$i]["name"]){
                $id = $result[$i]["id"];
                $contador = $i;
                $match = true;
                break;
            }
        }

        if ($match){
            // $continentID = (string) $countries["results"][$x]["continent"]["objectId"];
            // if ($continentID == "28HX8qDZHw"){
            //     $continentID = 3;  
            // }else if($continentID == "E6LHZzkHr6"){
            //     $continentID = 5;  
            // }else if($continentID == "ISPUD93Or8"){
            //     $continentID = 1;  
            // }else if($continentID == "mSxk54vkg6"){
            //     $continentID = 2;  
            // }else if($continentID == "vZNZcahFvu"){
            //     $continentID = 6;  
            // }else if($continentID == "X2rEcTJnsE"){
            //     $continentID = 7;  
            // }else if($continentID == "xwS5b1G6tn"){
            //     $continentID = 4;  
            // }
            // $query = "UPDATE `wp_countries` SET `continent_id` = '$continentID' WHERE `wp_countries`.`id` = '$id'";
            // require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            // dbDelta($query);
        }else{
            // si no hay match
            // array_push($arrayFinal, $countries["results"][$x]["name"]);
            // error_log(print_r($arrayFinal, true));
            // error_log(print_r($result[$contador]["name"], true));
        }

    }

    
  }

    
//    add_action( 'admin_menu', 'init_world_data_base_function', 1 );
   





?>