<?php

function get_event_coambassadors( $post = null ) {
  
    $post = get_post( $post );
    if ( $post->post_type !== 'event_listing' ) 
        return '';
    $event_coambassadors   = $post->_event_coambassadors;
    
    if(!empty($event_coambassadors)){
        return apply_filters( 'display_event_coambassadors', $event_coambassadors, $post );
    }else{
        return false;
    }
   
}
  
function display_event_coambassadors( $before = '', $after = '', $echo = true, $post = null ) {
$event_coambassadors = get_event_coambassadors( $post );
$coambassadors = "";

if (is_array($event_coambassadors)){
    foreach ($event_coambassadors as $value){
        $value = ucwords(str_replace("_"," ",$value)); 
        $coambassadors .= $value."<br>";
    }
}
if ( $echo )
    if(!empty($coambassadors)){
        $coambassadors = $before . $coambassadors . $after;
        echo $coambassadors;
    }
else
    return $coambassadors;
}




?>

