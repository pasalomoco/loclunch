<?php

function subscription_to_localization ($term, $subscription, $localization){
    if( in_array_r($term->description, $subscription[0][$localization])){
        if(isset($_GET["unsubscription"])){
            $key_to_eliminate = array_search($term->description, $subscription[0][$localization]);
            unset($subscription[0][$localization][$key_to_eliminate]);
            $subscription[0][$localization] = array_values($subscription[0][$localization]);
            $keys = ['continent', 'country', 'state', 'city'];
            $values = [ $subscription[0]['continent'],  $subscription[0]['country'], $subscription[0]['state'], $subscription[0]['city']];
            $the_meta_array = array_combine($keys, $values);
            $update = update_user_meta( get_current_user_id(), 'subscriptions', $the_meta_array );
            redirect($term);
        }    
        button_unsubscribe();
    }else{
        if(isset($_GET["subscription"])){

            if(empty($subscription[0][$localization])){
                if($term->taxonomy == "event_listing_type"){
                    $values = [ array ($term->description),  $subscription[0]['country'], $subscription[0]['state'], $subscription[0]['city']];
                }else if($term->taxonomy == "event_listing_category"){
                    $values = [ $subscription[0]['continent'],  array ($term->description), $subscription[0]['state'], $subscription[0]['city']];
                }else if($term->taxonomy == "state"){
                    $values = [ $subscription[0]['continent'], $subscription[0]['country'], array ($term->description), $subscription[0]['city']];
                }else if($term->taxonomy == "city"){
                    $values = [ $subscription[0]['continent'], $subscription[0]['country'], $subscription[0]['state'], array ($term->description)];
                }   
                $keys = ['continent', 'country', 'state', 'city'];
                $the_meta_array = array_combine($keys, $values);
                $update = update_user_meta( get_current_user_id(), "subscriptions",  $the_meta_array );
                redirect($term);
            }else{
                
                if($term->taxonomy == "event_listing_type"){
                    array_push($subscription[0]['continent'], $term->description);
                }else if($term->taxonomy == "event_listing_category"){
                    array_push($subscription[0]['country'], $term->description);
                }else if($term->taxonomy == "state"){
                    array_push($subscription[0]['state'], $term->description);
                }else if($term->taxonomy == "city"){
                    array_push($subscription[0]['city'], $term->description);
                }  
                $keys = ['continent', 'country', 'state', 'city'];
                $values = [ $subscription[0]['continent'],  $subscription[0]['country'], $subscription[0]['state'], $subscription[0]['city']];
                $the_meta_array = array_combine($keys, $values);    
                $update = update_user_meta( get_current_user_id(), "subscriptions",  $the_meta_array );
                redirect($term);
            }
        } 
        button_subscribe($term);
      
    }
}

function button_subscribe ($term){
    ?>
        
    <div> 
        <a href="?subscription=<?php echo $term->slug; ?>" > 
            <button class="">
                <span class="">Subscription to <?php echo get_the_archive_title(); ?></span>
            </button>
        </a>
    </div>
<?php


}

function button_unsubscribe (){
    ?>
    <div>
        <a href="?unsubscription=yes" > 
            <button class="">
                <span class="">Unubscription to <?php echo get_the_archive_title(); ?></span>
            </button>
        </a>
    </div>
<?php  
}


function redirect($term){
    $urlSite= get_site_url();
    if($term->taxonomy == "event_listing_type"){
        $page = $term->slug;
        $URL="$urlSite/continent/$page";
    }else if($term->taxonomy == "event_listing_category"){
        $page = $term->slug;
        $URL="$urlSite/country/$page";
    }else if($term->taxonomy == "state"){
        $page = $term->slug;
        $URL="$urlSite/state/$page";
    }else if($term->taxonomy == "city"){
        $page = $term->slug;
        $URL="$urlSite/city/$page";
    }   
    echo "<script>location.href='$URL'</script>";
}

function in_array_r($needle, $haystack, $strict = false) {
    if(is_array($haystack)){
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
    }
    return false;
}

function form_subscripcion (){

    if(is_user_logged_in(  )){
        //Get the taxonomy
        $term = get_queried_object();  
        $subscription = get_user_meta( get_current_user_id(), "subscriptions", false );
        
        if(empty( $subscription)){
            //User doesn't have any subscription yet
            if(isset($_GET["subscription"])){  
                if($term->taxonomy == "event_listing_type"){
                    $values = [ array ($term->description),  array (), array (), array ()];
                }else if($term->taxonomy == "event_listing_category"){
                    $values = [ array (),  array ($term->description), array (), array ()];
                }else if($term->taxonomy == "state"){
                    $values = [ array (),  array(), array ($term->description), array ()];
                }else if($term->taxonomy == "city"){
                    $values = [ array (),  array(), array (), array ($term->description)];
                }   
                $keys = ['continent', 'country', 'state', 'city'];
                $the_meta_array = array_combine($keys, $values);
                add_user_meta(get_current_user_id(), "subscriptions",  $the_meta_array, true );
                redirect($term);
            }else{
                button_subscribe($term);
            }
        
        }else{
            if($term->taxonomy == "event_listing_type"){
                subscription_to_localization($term, $subscription, "continent");
            }else if($term->taxonomy == "event_listing_category"){
                subscription_to_localization($term, $subscription, "country");
            }else if($term->taxonomy == "state"){
                subscription_to_localization($term, $subscription, "state");
            }else if($term->taxonomy == "city"){
                subscription_to_localization($term, $subscription, "city");
            }             

        } 
    }

}








?>