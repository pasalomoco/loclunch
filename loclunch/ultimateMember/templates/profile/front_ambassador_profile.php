<div class="wpem-main-vmenu-dashboard-wrapper wpem-row">
    
    <div class="wpem-main-vmenu-dashboard-nav-menu wpem-col-md-12">
        <h1 class='ambassador-profile-title'>Ambassador profile</h1>
    </div>
            
            <?php if( isset($meta["continent"])): ?>
                <div class="wpem-main-vmenu-dashboard-nav-menu wpem-col-md-3">
                    <div class='continent-list'> 
                    <h3 class="continent-list-title">Continent</h3>
                        <p class="continent-name"><?php echo get_name_continent_country_state_city_by_id("continent",$meta["continent"][0]); ?></p>
                    </div>
                </div>
            <?php endif; ?> 

            <?php if( isset($meta["country"][0])): ?>
                <div class="wpem-main-vmenu-dashboard-nav-menu wpem-col-md-3">
                    <div class='country-list'> 
                    <h3 class="county-list-title">Country</h3>
                        <p class="country-name"><?php echo get_name_continent_country_state_city_by_id("countries",$meta["country"][0]); ?></p>
                    </div>
                </div>    
            <?php endif; ?>    

            <?php if( isset($meta["state_province"][0]) && isset($meta["city"][0])): ?>
                <div class="wpem-main-vmenu-dashboard-nav-menu wpem-col-md-3">
                    <div class='state-list'> 
                    <h3 class="state-list-title">State / Province </h3>
                        <p class="state-name"><?php echo get_name_continent_country_state_city_by_id("state",$meta["state_province"][0]); ?></p>
                    </div>
                </div>
            <?php endif; ?>  
            
            <?php if(!(empty($meta["city"][0]))): ?>
                <div class="wpem-main-vmenu-dashboard-nav-menu wpem-col-md-3">
                    <div class='city-list'> 
                    <h3 class="city-list-title">City</h3>
                        <p class="city-name"><?php echo get_name_continent_country_state_city_by_id("city",$meta["city"][0]); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(empty($meta["city"][0])): ?>
                <div class="wpem-main-vmenu-dashboard-nav-menu wpem-col-md-3">
                    <div class='city-list'> 
                    <h3 class="city-list-title">City</h3>
                        <p class="city-name"><?php echo get_name_continent_country_state_city_by_id("city",$meta["city"][0]); ?></p>
                    </div>
                </div>
            <?php endif; ?>  
        

</div>    