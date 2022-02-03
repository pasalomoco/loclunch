<?php  if(is_user_logged_in(  )) :  ?>
    <div class="wpem-event-details">
        <i class=" icon-user" aria-hidden="true" role="img"></i>
        <a href="<?php echo esc_html("/user/"); echo esc_html($ambassadorName."/") ; ?>">
            <?php echo $ambassadorName ; ?>
        </a>
    </div>
<?php endif ?>    