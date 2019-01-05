<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <form method="post" class="form-horizontal"  enctype="multipart/form-data"  action="<?= admin_url(); ?>invoice/add" id='invoiceAdd'>
            <div class="form-group headingmain">						
                <h2 class="title" style="margin:10px"> Invoice Details</h2>								
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Ref No*</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter ref no" readonly="" name="ref_no" value="<?= $invoiceNo ?> " class="form-control">
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Client *</label>
                <div class="col-sm-7">
                      <select class="form-control m-b reporter" id="client_id" name="client_id">
                           <option value="">Select Client</option>
                        <?php for($i=0; $i<count($client_list); $i++){
                        ?>
                            <option data-email="<?= $client_list[$i]->email;?>" value="<?= $client_list[$i]->id;?>"><?= $client_list[$i]->first_name;?> ( <?= $client_list[$i]->companyName;?> )</option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="form-group" id="data_1">
                <label class="col-sm-3 control-label">Due Date</label>
                <div class="input-group date col-sm-7" style="float: left;padding-right: 14px;padding-left: 14px;">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="due_date" value="<?php echo date("d/m/Y", strtotime("+1 month")); ?>">
                </div>
            </div>
          
            <div class="form-group">
                <label class="col-sm-3 control-label">Default Tax*</label>
                <div class="col-sm-7">
                    <div class="input-group m-b"><span class="input-group-addon">%</span> <input placeholder="Default Tax" name="default_tax" class="form-control" type="text"></div>
                </div>
            </div>
         
              <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-7">
                    <button class="btn btn-primary showDicount" type="button">Discount</button>
                </div>
            </div>
            <div class="form-group discountDiv" style="display: none;">
                <label class="col-sm-3 control-label">Discount</label>
                <div class="col-sm-7">
                    <div class="input-group m-b"><span class="input-group-addon">%</span> <input placeholder="Dicount" class="form-control" name="discount" type="text"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Currency</label>
                <div class="col-sm-7">
                    <input type="text" name="currency" placeholder="Enter Currency" class="form-control">
                    <input type="hidden" name="companyId" class="form-control compnayId">
                    <input type="hidden" name="companyName" class="form-control compnayName">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Notes *</label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="notes"></textarea>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Create Invoice</button>
                </div>
            </div>
        </form>
    </div>
</div>
