
<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">

        <form method="post" class="form-horizontal"  enctype="multipart/form-data"  action="<?= admin_url(); ?>setting/general" id='generalSettingForm'>
            
            <div class="form-group headingmain">                        
                <h2 class="title" style="margin:10px"> General Settings</h2>                               
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Company Name *</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Company Name" name="company_name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Contact Person   *</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Contact Person" name="contact_persion" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Company  Message </label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="company_message"></textarea>
                </div>
            </div>  

            <div class="form-group">
                <label class="col-sm-3 control-label">Company Phone </label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Company phone" name="company_phone" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Company Email </label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Company Email" name="company_email" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Company Domain </label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Domain " name="company_domain" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Company VAT </label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Company VAT" name="company_VAT" class="form-control">
                </div>
            </div>

     <div class="form-group">
                <label class="col-sm-3 control-label">Company Logo </label>
                <div class="col-sm-7">
                    <input type="file" name="company_logo"> 
                </div>
            </div>


             <div class="form-group">
                <label class="col-sm-3 control-label">Country</label>
                <div class="col-sm-7">
                      <select class="form-control m-b" name="ticket_prioity">
                            <option value=""> India</option>
                            <option value=""> UK</option>
                    </select>
                </div>
            </div>
    
           <div class="form-group">
                <label class="col-sm-3 control-label">City </label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Contact Person  " name="ticket_subject" class="form-control">
                </div>
            </div> 

         
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <a class="btn btn-white" href="<?= admin_url('setting/general'); ?>" type="button">Cancel</a>
                    <button class="btn btn-primary" type="submit">Save Change</button>
                </div>
            </div>
        </form>
    </div>
</div>
