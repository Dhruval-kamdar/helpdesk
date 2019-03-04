    
<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Estimate List</h5>
                        <div class="ibox-tools">
                            <a href="<?= admin_url(); ?>estimate/add" class="btn btn-primary">
                                <i class="fa fa-plus"></i>Add New
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Estimate</th>
                                        <th>Due Date</th>
                                        <th>Company Name</th>
                                        <th>Amount</th>
                                        <th>Due Amount</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($getEstimate); $i++) {
                                        $estimateId = $getEstimate[$i]->id;
                                        ?>
                                        <tr>
                                            <td>OPEN</td>
                                            <td><a href="<?= admin_url() . 'estimate/view/' . $this->utility->encode($estimateId) ; ?>"><?= $getEstimate[$i]->ref_no; ?></a></td>
                                            <td><?= date('d-m-Y',  strtotime($getEstimate[$i]->due_date)); ?></td>
                                            <td><?= $getEstimate[$i]->companyName; ?></td>
                                            <td><?= number_format($getEstimate[$i]->totalPrice,2); ?></td>
                                            <td><?= number_format(getPaidAmount($estimateId),2); ?></td>
                                            <td class="tooltip-demo">  
                                                <a title="Preview Estimate" data-toggle="tooltip" data-placement="top"  href="<?= admin_url() . 'estimate/view/' . $this->utility->encode($estimateId) ; ?>"> <i class="fa fa-eye text-navy"></i> </a>
                                                <a title="Edit Estimate" data-toggle="tooltip" data-placement="top"  href="<?= admin_url() . 'estimate/edit/' . $this->utility->encode($estimateId); ?>"> <i class="fa fa-edit text-navy"></i> </a>
                                                <a title="Estimate History" data-toggle="tooltip" data-placement="top"  href="<?= admin_url() . 'estimate/history/' . $this->utility->encode($estimateId); ?>"> <i class="fa fa-book text-navy"></i> </a>
                                                <a data-toggle="modal" title="Email Estimate" data-toggle="tooltip" data-placement="top" data-target="#myModal_Invoice_email" data-invoice="Estimate <?= $getEstimate[$i]->ref_no ?>" data-type="INVOICE" data-id="<?php echo $estimateId;?>" class="sendInvoice"> <i class="fa fa-envelope text-navy"></i></a> 
                                                <a data-toggle="modal" title="Email Reminder" data-toggle="tooltip" data-placement="top" data-target="#myModal_reminder" data-id="<?php echo $estimateId;?>" data-type="REMINDER" data-invoice="Estimate <?= $getEstimate[$i]->ref_no ?> Reminder"  class="sendReminder"> <i class="fa fa-bell-o text-navy"></i></a> 
                                                <a title="Pdf" data-toggle="tooltip" data-placement="top" href="<?php echo admin_url('estimate/downloadpdf/') . $this->utility->encode($estimateId); ?>"> <i class="fa fa-file-pdf-o text-navy"></i> </a>
                                                <a title="Expense" data-toggle="tooltip" data-placement="top" href="<?php echo admin_url('estimate/expense/') . $this->utility->encode($estimateId); ?>"> <i class="fa fa-dollar text-navy"></i> </a>
                                                <a title="Report" data-toggle="tooltip" data-placement="top" href="<?php echo admin_url('estimate/report/') . $this->utility->encode($estimateId); ?>"> <i class="fa fa-repeat text-navy"></i> </a>

                                                <a title="Expense Pdf" data-toggle="tooltip" data-placement="top" href="<?php echo admin_url('estimate/expensepdf/') . $this->utility->encode($estimateId); ?>"> <i class="fa fa-dollar text-navy"></i> </a>
                                            </td> 
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal inmodal" id="myModal_autocomplete" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-close modal-icon"></i>
                                    <h4 class="modal-title">Delete</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button  id='btndelete' data-url="" data-id="" type="button" class="btn btn-primary">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal inmodal" id="myModal_interested" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-user modal-icon"></i>
                                    <h4 class="modal-title">Interested User List</h4>
                                </div>
                                <div class="modal-body">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal inmodal" id="myModal_Invoice_email" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Email Estimate</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Subject: </label>
                                        <div class="col-sm-9">
                                            <input type="text" value=""  name="subject" readonly="" class="form-control email_invoice">
                                            <input type="hidden" value=""  name="invoiceId" class="form-control invoiceId">
                                        </div>
                                    </div><br/><br/><br/>
                                    <div style="height: 7px; background-color: #535353;"></div>
                                    <div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">ESTIMATE {REF}</div>
                                        <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><span class="style1"><span style="font-weight:bold;">Hello {CLIENT}</span></span><br><br>Here is the invoice of {CURRENCY} {AMOUNT}.<br><br>You can view the estimate online at:<br><span style="font-size:14px;"><a href="{ESTIMATE_LINK}">{ESTIMATE_LINK}</a></span><br><br>Regards,<br><br>The {SITE_NAME} Team</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary send_estimate"  type="submit">Send Estimate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal inmodal" id="myModal_reminder" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Estimate Reminder</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Subject: </label>
                                        <div class="col-sm-9">
                                            <input type="text" value="" readonly="" name="subject" class="form-control reminser_invoice">
                                            <input type="hidden" value=""  name="invoiceId" class="form-control reminderInvoiceId">
                                        </div>
                                    </div><br/><br/><br/>
                                    <div style="height: 7px; background-color: #535353;"></div>
                                    <div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Estimate Reminder</div>
                                        <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Hello {CLIENT}</p>
                                            <br><p>This is a friendly reminder to pay your estimate of {CURRENCY} {AMOUNT}<br>You can view the estimate online at:<br><big><b><a href="{ESTIMATE_LINK}">View Estimate</a></b></big><br><br>Regards,<br>The {SITE_NAME} Team</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary send_reminder" type="submit">Send Reminder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

