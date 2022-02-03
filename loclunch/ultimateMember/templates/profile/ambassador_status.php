<?php if($ambasadorStatus[0] == "pending") : ?>
    <div>
        You´re ambassador application is in approval status 
    </div>
<?php endif; ?>
<?php if($ambasadorStatus[0] == "not approved") : ?>
    <div>
    You´re ambassador application is not approved
    </div>
<?php endif; ?>