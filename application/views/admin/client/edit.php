
<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">

        <form method="post" class="form-horizontal"  action="<?= admin_url(); ?>client/edit/<?php echo $this->utility->encode($companyDeatail[0]->companyId)?>" id='clientEdit'>
            
            <div class="form-group headingmain">						
                <h2 class="title" style="margin:10px">Company Detail</h2>								
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Company Name*</label>
                <div class="col-sm-7">
                    
                    <input type="text" placeholder="Enter Company Name*" name="company_name" value="<?= $companyDeatail[0]->companyName?>" class="form-control">
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Company Email *</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Company Email" name="company_email" value="<?= $companyDeatail[0]->companyEmail?>" class="form-control" readonly="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Company Phone*</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Company Phone" name="company_phone" value="<?= $companyDeatail[0]->companyPhone?>" class="form-control">
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Address *</label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="additional_information"><?= $companyDeatail[0]->companyAddress; ?></textarea>
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">City</label>
                <div class="col-sm-7">
                    <input type="text" name="company_city" placeholder="Enter City" class="form-control" value="<?= $companyDeatail[0]->city; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Country</label>
                <div class="col-sm-7">
                     <select class="form-control m-b" name="country_id">
                        <option value="">- Select Country -</option>
                        <?php for($i=0; $i<count($country); $i++) { ?>
                            <option value="<?= $country[$i]->id;?>"
                                    <?php
                                    if($country[$i]->id == $companyDeatail[0]->country_id){
                                        echo "selected = 'selected'";
                                    } ?>
                                    ><?= $country[$i]->name;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
<!--            <div class="form-group headingmain" >						
                <h2 class="title" style="margin:10px">Company User Detail</h2>								
            </div>
            <div class="form-group">
                <p style="">Enter company contact person detail. Username and password would be sent to register email id.</p>     
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Person first name </label>
                <div class="col-sm-7">
                    <input type="text" name="person_fname" placeholder="Enter Person first name" value="<?= $companyDeatail[0]->first_name;?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Person last name</label>
                <div class="col-sm-7">
                    <input type="text" name="person_lname" placeholder="Enter Person last name" value="<?= $companyDeatail[0]->last_name;?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-7">
                    <input type="text" name="person_email" placeholder="Enter Email" class="form-control" value="<?= $companyDeatail[0]->email;?>" readonly="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Phone</label>
                <div class="col-sm-7">
                    <input type="text" name="company_password" placeholder="Enter Phone" value="<?= $companyDeatail[0]->phone_no;?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Address</label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="address"><?= $companyDeatail[0]->userAddress;?></textarea>
                </div>
            </div>-->
            
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update Client</button>
                </div>
            </div>
        </form>
    </div>
</div>
