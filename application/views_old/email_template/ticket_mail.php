<!--<div style="height: 7px; background-color: #535353;"></div>
<div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;">
    <div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Ticket <?php echo $postData['status']; ?></div>
<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">
    <p>Hello <?php echo $client_email; ?>,<br><br></p>
<p>Your ticket has been opened with us.<br><br>Ticket #<?php echo $ticket_code; ?><br>Status : <?= $status ?><br><br>Click on the below link to see the ticket details and post additional comments.<br><br><big><b><a href="<?php echo $link; ?>">View Ticket</a></b></big><br><br>Regards,</p>
<p>Technical Support<br>The <?php echo PROJECT_NAME; ?> Team<br></p>
</div>
</div>-->
<div style="width:100%; margin:0px; padding: 0px;">
    <!-- main -->
    <div style="padding: 48px;">
        <div style="width: 560px; margin: 0 auto; display: block; box-shadow: 0px 0px 14px 0px rgba(142, 140, 140, 0.67); background: #fff; padding: 48px;">
            <!-- wrapper -->
            <p style=""><img src="<?php echo IMAGES.'logo.png'; ?>" style="display: block;margin: 0 auto; text-align: center; width: 200px;padding: 10px;"></p>
            <div style="background: linear-gradient(#fff,rgba(222, 13, 0, 0.16)); box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.33); padding: 16px;">
                <!-- Contnt start -->
                    <p>Hello <?php echo $client_name; ?>,<br><br></p>
                    <p>Your ticket has been opened with us.<br><br>Ticket #<?php echo $ticket_code; ?><br>Status : <?= $status ?><br><br>Click on the below link to see the ticket details and post additional comments.<br><br><big><b><a href="<?php echo $link; ?>">View Ticket</a></b></big><br><br>Regards,</p>
                    <p>Technical Support<br>The <?php echo PROJECT_NAME; ?> Team<br></p>
            </div>
            <!-- content over -->
        </div>
        <!-- wrapper over -->
    </div>
</div>