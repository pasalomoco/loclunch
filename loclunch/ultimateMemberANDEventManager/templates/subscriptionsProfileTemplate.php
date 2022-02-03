<div class="wpem-main-vmenu-dashboard-content-wrap wpem-col-md-12">
    <div class="wpem-row wpem-event-dashboard-information-table-row">
        <div class="wpem-col-md-3">
            <h3>Continents</h3>
                <?php
                    if(!empty($subscription[0]['continent'])){
                        foreach($subscription[0]['continent'] as $value){
                            $arr_params = array( 'localizationId' => $value, 'localizationType' => 'continent' );
                            $url = esc_url( add_query_arg( $arr_params ) );
                            echo get_name_continent_country_state_city_by_id("continent", $value)."  <a href='$url'>&#128473;</a><br>";
                        }

                    }else{
                        echo "<p>Without continents</p>";
                    }
                ?>
        </div>
        <div class="wpem-col-md-3">
            <h3>Countries</h3>
            <?php
                if(!empty($subscription[0]['country'])){
                    foreach($subscription[0]['country'] as $value){
                          $arr_params = array( 'localizationId' => $value, 'localizationType' => 'country' );
                          $url = esc_url( add_query_arg( $arr_params ) );  
                          echo get_name_continent_country_state_city_by_id("countries", $value)."  <a href='$url'>&#128473;</a><br>";
                    }

                }else{
                    echo "<p>Without countries</p>";
                }
            ?>
        </div>
        <div class="wpem-col-md-3">
            <h3>States/Provinces</h3>
            <?php
                if(!empty($subscription[0]['state'])){
                    foreach($subscription[0]['state'] as $value){
                        $arr_params = array( 'localizationId' => $value, 'localizationType' => 'state' );
                          $url = esc_url( add_query_arg( $arr_params ) );  
                          echo get_name_continent_country_state_city_by_id("state", $value)."  <a href='$url'>&#128473;</a><br>";
                    }

                }else{
                    echo "<p>Without states</p>";
                }
            ?>
        </div>
        <div class="wpem-col-md-3">
            <h3>Cities</h3>
            <?php
                if(!empty($subscription[0]['city'])){
                    foreach($subscription[0]['city'] as $value){
                        $arr_params = array( 'localizationId' => $value, 'localizationType' => 'city' );
                          $url = esc_url( add_query_arg( $arr_params ) );  
                          echo get_name_continent_country_state_city_by_id("city", $value)."  <a href='$url'>&#128473;</a><br>";
                    }

                }else{
                    echo "<p>Without cities</p>";
                }
            ?>
        </div>
    </div>
</div>
