
<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">

        <form method="post" class="form-horizontal"  enctype="multipart/form-data"  action="<?= client_url(); ?>tickets/add" id='ticketsAddForm'>
            
            <div class="form-group headingmain">						
                <h2 class="title" style="margin:10px">Ticket Details</h2>								
            </div>
           
            <div class="form-group">
                <label class="col-sm-3 control-label">Company Name</label>
                <div class="col-sm-7">
                     <label class="control-label"><?=  $company_details[0]->name; ?></label>
                     <input type="hidden" value="<?= $this->session->userdata['client_login']['companyId']; ?>"  name="company_id" class="form-control compnayId">
                     <input type="hidden" value="<?= $this->session->userdata['client_login']['email']; ?>"  name="client_email" class="form-control client_email">
                     <input type="hidden" value="<?= $this->session->userdata['client_login']['firstname'] . ' ' . $this->session->userdata['client_login']['lastname']; ?>"  name="client_name" class="form-control client_email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Department *</label>
                <div class="col-sm-7">
                      <select class="form-control m-b changeDepartment" name="department_id">
                          <option value="">Select Department</option>
                        <?php for($i=0; $i<count($department_detail); $i++){ ?>
                            <option value="<?= $department_detail[$i]->id;?>"><?= $department_detail[$i]->name;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Ticket Code *</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Ticket Code" name="ticket_code" class="form-control ticketCode">
                    <input type="hidden" value="<?= $this->session->userdata['client_login']['id']; ?>" placeholder="Enter Ticket Code" name="client_id" class="form-control">
                    <input type="hidden" value="NEW" placeholder="Enter Ticket Code" name="status" class="form-control">
                </div>
            </div>
          
            <div class="form-group">
                <label class="col-sm-3 control-label">Subject  *</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Subject " name="subject" class="form-control">
                </div>
            </div>
            <?php $priority = json_decode(PRIORITY);?>
             <div class="form-group">
                <label class="col-sm-3 control-label">Priority *</label>
                <div class="col-sm-7">
                      <select class="form-control m-b" name="priority">
                            <option value="">Select Priority</option>
                            <?php
                            foreach ($priority as $key => $value){ ?>
                                <option value="<?= $key ?>"><?= $value; ?></option>
                            <?php }
                             ?>
                            
                    </select>
                </div>
            </div>
    
            <div class="form-group">
                <label class="col-sm-3 control-label">Ticket Message </label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="ticket_message"></textarea>
                </div>
            </div>   

            <div class="form-group">
                <label class="col-sm-3 control-label">Attachment </label>
                <div class="col-sm-7">

                    <input type="file" name="ticket_attachment"> 
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <a class="btn btn-white" href="<?= client_url('tickets'); ?>" type="button">Cancel</a>
                    <button class="btn btn-primary" type="submit">Create Ticket</button>
                </div>
            </div>
        </form>
    </div>
</div>
