<div class="clearfix">&nbsp;</div>
<ul><?php echo get_the_term_list( $postID, 'state', '<li class="jobs_item">', ', ', '</li>' ) ?></ul> 
<?php if( isset($metaData["state_province"][0]) && isset($metaData["city"][0])): ?>
    <h3 class="wpem-heading-text">
    State/Province
    </h3>    
    <?php echo $metaData['state_province'][0]; ?>
<?php endif; ?> 

<div class="clearfix">&nbsp;</div>
<?php if( isset($metaData["city"][0])): ?>
    <h3 class="wpem-heading-text">
    City
    </h3>    
    <?php echo $metaData['city'][0]; ?>
<?php endif; ?>

<?php if(! (isset($metaData["city"][0]))): ?>
    <h3 class="wpem-heading-text">
    City
    </h3>    
    <?php echo $metaData['state_province'][0]; ?>
<?php endif; ?>


