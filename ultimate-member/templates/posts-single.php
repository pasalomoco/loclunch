<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>


    <div class="wpem-event-box-col wpem-col wpem-col-12 wpem-col-md-6 wpem-col-lg-4">
        <div class="um-item">
            <div class="um-item-link">
                <i class="um-faicon-calendar"></i>
                <a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo get_the_title( $post ); ?></a>
            </div>

            <?php if ( has_post_thumbnail( $post->ID ) ) {
                $image_id = get_post_thumbnail_id( $post->ID );
                $image_url = wp_get_attachment_image_src( $image_id, 'full', true ); 
                // var_dump( get_post_meta( $post->ID));
                ?>

                <div class="um-item-img">
                    <a href="<?php echo esc_url( get_permalink( $post ) ); ?>">
                        <?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>
                    </a>
                </div>

            <?php } ?>

            <div class="wpem-dashboard-event-datetime-location">
					<div class="wpem-dashboard-event-date-time">
                        <div class="wpem-dashboard-event-placeholder"><strong><?php _e('Start Date And Time') ?></strong></div> 
							<?php  echo get_post_meta( $post->ID, "_event_start_date")[0]; ?> 
                            <br>
                        <div class="wpem-dashboard-event-placeholder"><strong><?php _e('End Date And Time') ?></strong></div> 
                            <?php  echo get_post_meta( $post->ID, "_event_end_date")[0]; ?> 
						</div>

					<div class="wpem-dashboard-event-location">
						<div class="wpem-dashboard-event-placeholder"><strong><?php _e('Location') ?></strong></div>
					<?php if (get_event_location ( $event ) === 'Online Event') :
						_e( 'Online Event', 'wp-event-manager' );
						else :
					display_event_location ( false, $event );
						endif;
					?>
					</div>
			</div>
        </div>
    </div>


