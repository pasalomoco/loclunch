<?php foreach ($additional_fields as $name => $field) : ?>
   <?php
         $field_key = '_'.$name;
         $field_value = $post->$field_key;
   ?>
   
   <div class="wpem-col-12 wpem-additional-info-block">
      <h3 class="wpem-heading-text"><?php echo $field["label"]; ?></h3>
   </div>

   <div class="wpem-col-12 wpem-additional-info-block-textarea">
      <div class="wpem-additional-info-block-details-content-items">
         <h1 class="wpem-additional-info-block-textarea-text">
            <a href="<?php if (isset($field_value)) echo $field_value; ?>">
               <?php echo "&#x1F517;"; ?>
            </a>
         </h1>
      </div>
   </div>

<?php endforeach; ?>
