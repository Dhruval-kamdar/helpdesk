<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <form method="post" class="form-horizontal"  action="<?= admin_url('invoice/edit/').$this->utility->encode($invoiceData[0]->id); ?>" id='invoiceEdit'>
            <div class="form-group headingmain">						
                <h2 class="title" style="margin:10px"> Invoice Details
                    <a href="<?= admin_url() . 'invoice/view/' . $this->utility->encode($invoiceData[0]->id) ?>" style="margin:10px" class="btn btn-sm btn-primary pull-right m-t-n-xs" ><strong><i class="fa fa-tag"></i> View Tickets </strong></a> 
                </h2>								
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Ref No*</label>
                <div class="col-sm-7">
                    <input type="text" readonly="" placeholder="Enter ref no" name="ref_no" value="<?= $invoiceData[0]->ref_no; ?>" class="form-control">
                    <input type="hidden"  name="id" value="<?= $invoiceData[0]->id; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-7">
                    <button class="btn btn-primary recurring" type="button">Recurring</button>
                </div>
            </div>
            <?php
            $recur = (empty($invoiceData[0]->recur_every)) ? 'display: none;' : 'display: block;';
            $startDate = (empty($invoiceData[0]->start_date)) ? 'display: none;' : 'display: block;';
            $endDate = (empty($invoiceData[0]->end_date)) ? 'display: none;' : 'display: block;';
            $discount = ($invoiceData[0]->discount < 0) ? 'display: none;' : 'display: block;';
            ?>
            <div class="form-group showRecurring" style="<?= $recur; ?>">
                <label class="col-sm-3 control-label">Recur every </label>
                <div class="col-sm-7">
                    <?php $priority = json_decode(RECURRING); ?>
                    <select name="recure_every" class="recure_every form-control">
                        <option value="">Select Recur every</option>
                        <?php foreach ($priority as $key => $value) { ?>
                            <option <?php
                            if ($key == $invoiceData[0]->recur_every) {
                                echo "selected='selected'";
                            }
                            ?> value="<?= $key ?>"><?= $value; ?></option>
<?php }
?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="companyId" class="form-control compnayId">
            <input type="hidden" name="companyName" class="form-control compnayName">
            <div class="form-group  showRecurring" style="<?= $startDate; ?>" id="data_1">
                <label class="col-sm-3 control-label">Start Date</label>
                <div class="input-group date col-sm-7 "  style="float: left;padding-right: 14px;padding-left: 14px;">
                    <span class="input-group-addon customDate"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" class="form-control" value="<?= (!empty($invoiceData[0]->start_date)) ?  date('m-d-Y',  strtotime($invoiceData[0]->start_date)) : ''; ?>">
                </div>
            </div>
            <div class="form-group  showRecurring" style="<?= $endDate; ?>" id="data_1">
                <label class="col-sm-3 control-label">End Date</label>
                <div class="input-group date col-sm-7 "  style="float: left;padding-right: 14px;padding-left: 14px;">
                    <span class="input-group-addon customDate"><i class="fa fa-calendar"></i></span><input type="text" name="end_date" class="form-control" value="<?= (!empty($invoiceData[0]->end_date)) ?  date('m-d-Y',  strtotime($invoiceData[0]->end_date)) : ''; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Client *</label>
                <div class="col-sm-7">
                    <select class="form-control m-b client_id" id="client_id" name="client_id">
                        <option value="">Select Reporter</option>
                        <?php for ($i = 0; $i < count($client_list); $i++) {
                            ?>
                            <option <?php
                            if ($client_list[$i]->id == $invoiceData[0]->client_id) {
                                echo "selected='selected'";
                            }
                            ?> value="<?= $client_list[$i]->id; ?>"><?= $client_list[$i]->first_name; ?></option>
<?php } ?>

                    </select>
                </div>
            </div>
            <div class="form-group" id="data_1">
                <label class="col-sm-3 control-label">Due Date</label>
                <div class="input-group date col-sm-7"  style="float: left;padding-right: 14px;padding-left: 14px;">
                    <span class="input-group-addon customDate"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="due_date" value="<?= date('d-m-Y',  strtotime($invoiceData[0]->due_date)); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Default Tax*</label>
                <div class="col-sm-7">
                    <div class="input-group m-b"><span class="input-group-addon">%</span> <input placeholder="Default Tax" name="default_tax" class="form-control" value="<?= $invoiceData[0]->default_tax; ?>" type="text"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-7">
                    <button class="btn btn-primary showDicount" value="show" type="button">Discount</button>
                </div>
            </div>
            <div class="form-group discountDiv" style="<?=  $discount; ?>">
                <label class="col-sm-3 control-label">Discount</label>
                <div class="col-sm-7">
                    <div class="input-group m-b"><span class="input-group-addon">%</span> <input placeholder="Dicount" value="<?= $invoiceData[0]->discount; ?>" class="form-control" name="discount" type="text"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Currency</label>
                <div class="col-sm-7">
                    <input type="text" name="currency" placeholder="Enter Currency" value="<?= $invoiceData[0]->currency; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Notes *</label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="notes" ><?= $invoiceData[0]->note; ?></textarea>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update Invoice</button>
                </div>
            </div>
        </form>
    </div>
</div>
