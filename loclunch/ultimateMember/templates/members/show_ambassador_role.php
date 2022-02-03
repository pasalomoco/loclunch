<div>
    Ambassador:
</div>
<div>
    <a href="<?php echo get_site_url().'/country/'.get_name_continent_country_state_city_by_id("countries",$country[0]); ?>">
    <?php echo get_name_continent_country_state_city_by_id("countries",$country[0]); ?></a>
</div>  
<div>
    <?php   echo (empty($city[0]) ? get_name_continent_country_state_city_by_id("state",$state[0]) : get_name_continent_country_state_city_by_id("city",$city[0]));    ?>
</div>