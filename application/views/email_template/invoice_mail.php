<div style="height: 7px; background-color: #535353;"></div>
<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;">
    <div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">INVOICE <?php echo $ref_no; ?></div>
    <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">
        <span class="style1"><span style="font-weight:bold;">Hello <?php echo $client_name; ?></span></span><br><br>Here is the invoice of <?php echo $totalPrice; ?>.
        <br><br>You can view the invoice online at:<br><span style="font-size:14px;"><a href="<?php echo $link; ?>">View Invoice</a></span><br><br>Regards,<br><br>The <?php echo PROJECT_NAME; ?> Team</div>
</div>