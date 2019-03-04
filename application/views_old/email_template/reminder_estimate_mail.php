<div style="height: 7px; background-color: #535353;"></div>
<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;">
    <div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Invoice Reminder</div>
    <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Hello <?php echo $client_name; ?></p>
        <br><p>This is a friendly reminder to pay your invoice of <?php echo $totalPrice; ?><br>You can view the invoice online at:<br>
        <big><b><a href="<?php echo $link; ?>">View Invoice</a></b></big>
        <br><br>Regards,<br>The <?php echo PROJECT_NAME; ?> Team</p>
    </div>
</div>