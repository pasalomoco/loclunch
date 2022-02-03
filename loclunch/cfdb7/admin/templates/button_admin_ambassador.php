<?php   
$urlApprove = "admin.php?page=cfdb7-list.php&fid=$formPostId&ufid=$formId&approve_ambassador=YES";
$urlDissapprove = "admin.php?page=cfdb7-list.php&fid=$formPostId&ufid=$formId&approve_ambassador=NO";
$urlPeding = "admin.php?page=cfdb7-list.php&fid=$formPostId&ufid=$formId&approve_ambassador=PENDING";
?>

<?php if(isset( $_GET['approve_ambassador'] )): ?>
    <h1 style="background-color: <?php echo $color; ?>; padding: 14px 28px; color: white; font-size: 18px;"> 
        <?php echo $approveAmbassador; ?>  
    </h1>
<?php endif ?>

<div class='welcome-panel'>

    <div class="welcome-panel-content">
        <div class="welcome-panel-column-container">
    
            <a href="<?php echo $urlApprove; ?>">
                <button style="padding: 10px 10px; margin: 5px">
                    APPROVE AMBASSADOR
                </button>
            </a>

            <a href="<?php echo $urlDissapprove; ?>">
                <button style="padding: 10px 10px; margin: 5px">
                    DISAPPROVE AMBASSADOR
                </button>   
            </a>

            <a href="<?php echo $urlPeding; ?>">
                <button style="padding: 10px 10px; margin: 5px">
                    LET HIM/HER RESEND THE AMBASSADOR FORM AGAIN
                </button>
            </a>
            
        </div>
    </div>
</div>
