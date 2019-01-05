
<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">

        <form method="post" class="form-horizontal"  enctype="multipart/form-data"  action="<?= admin_url(); ?>setting/general" id='emailSettingForm'>

            <div class="form-group headingmain">                        
                <h2 class="title" style="margin:10px"> Email Settings</h2>                       
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Company Email *</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Company Name" name="company_email" class="form-control">
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label">Use Postmark</label>
                <div class="col-sm-7">
                  <select class="form-control m-b" name="use_tradmark">
                    <option value=""> Use Current</option>
                    <option value=""> TRUE</option>
                    <option value=""> FALSE</option>
                </select>
                <span class="help-block m-b-none">If TRUE,set config here application/config/postmark.php</span>
            </div>

        </div> 
     
       <div class="form-group">
        <label class="col-sm-3 control-label">Email Protocol *</label>
        <div class="col-sm-7">
                  <select class="form-control m-b" name="email_protocol">
                    <option value=""> Use Current</option>
                    <option value=""> MAIL</option>
                    <option value=""> SMTP</option>
                </select>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-sm-3 control-label">SMTP HOST  </label>
        <div class="col-sm-7">
            <input type="text" placeholder="Enter SMTP HOST" name="smtp_host" class="form-control">
             <span class="help-block m-b-none">SMTP Server Address.</span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">SMTP USER</label>
        <div class="col-sm-7">
            <input type="text" placeholder="Enter SMTP USER" name="smtp_user" class="form-control">
        </div>
    </div>
<div class="form-group">
    <label class="col-sm-3 control-label">SMTP PASSWORD </label>
    <div class="col-sm-7">
        <input type="text" placeholder="Enter SMTP PASSWORD" name="smtp_password" class="form-control">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">SMTP PORT </label>
    <div class="col-sm-7">
        <input type="text" placeholder="Enter SMTP PORT" name="smtp_post" class="form-control">
    </div>
</div> 


<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <a class="btn btn-white" href="<?= admin_url('setting/email_setting'); ?>" type="button">Cancel</a>
        <button class="btn btn-primary" type="submit">Save Change</button>
    </div>
</div>
</form>
</div>
</div>
