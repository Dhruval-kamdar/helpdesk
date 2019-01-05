<div class="wrapper wrapper-content m-t">
    <div class=" animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!--<span class="label label-success pull-right">Monthly</span>-->
                        <h5>Owed</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=  number_format($getAmount[0]->total, 2, '.', '');  ?></h1>
                        <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                        <small>Total Owed</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!--<span class="label label-info pull-right">Annual</span>-->
                        <h5>Paid</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=  number_format($getPaidAmount[0]->totalPaidAmount, 2, '.', '');  ?></h1>
                        <!--<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>-->
                        <small>Total Paid</small>
                    </div>
                </div>
            </div>


            <!--            <div class="col-lg-3">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-primary pull-right">Today</span>
                                    <h5>Expenses</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?=  number_format($getExpAmount[0]->totalExpense, 2, '.', '');  ?></h1>
                                    <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                                    <small>Total expenses</small>
                                </div>
                            </div>
                        </div>-->
<!--            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Today</span>
                        <h5> Invoice</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($getLastInvoice[0]->ref_no == "") ? 'Not Found' : $getLastInvoice[0]->ref_no; ?></h1>
                        <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                        <small>Last Invoice</small>
                    </div>
                </div>
            </div>-->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!--<span class="label label-info pull-right">Annual</span>-->
                        <h5>Last Invoice :<?php echo $lastInvoiceData['invoiceNumber']; ?> </h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=  $lastInvoiceData['totalAmount'];  ?></h1>
                        <small>Total Amount</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!--<span class="label label-info pull-right">Annual</span>-->
                        <h5>Last Invoice :<?php echo $lastInvoiceData['invoiceNumber']; ?> </h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=  $lastInvoiceData['paidAMount'];  ?></h1>
                        <small>paid Amount</small>
                    </div>
                </div>
            </div>
            <?php
            for ($i = 0; $i < count($getLabelinfo); $i++) {
                ?>

                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <!--<span class="label label-primary pull-right">Today</span>-->
                            <h5> <?= $getLabelinfo[$i]['title'] ?></h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?= $getLabelinfo[$i]['item_value'] ?></h1>
                            <!--<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>-->
                            <small><?= date('d M Y',strtotime($getLabelinfo[$i]['item_date'])) ?></small>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row white-bg">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tickets List</h5>
                        <div class="ibox-tools">
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Ticket Code</th>
                                        <th>Subject</th>
                                        <th>Department</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($getTicket); $i++) { ?>
                                        <tr>
                                            <td><?= $getTicket[$i]->companyName; ?></td>
                                            <td><?= $getTicket[$i]->ticket_code; ?></td>
                                            <td><?= $getTicket[$i]->subject; ?></td>
                                            <td><?= $getTicket[$i]->name; ?></td>
                                            <td><?= $getTicket[$i]->priority; ?></td>
                                            <td>
                                                <?php
                                                if (getStatus($getTicket[$i]->status) == 'New') {
                                                    $color = 'background-color:#999999;color:white;';
                                                } else if (getStatus($getTicket[$i]->status) == 'Answered') {
                                                    $color = 'background-color:#1a7bb9;color:white;';
                                                } else if (getStatus($getTicket[$i]->status) == 'Closed') {
                                                    $color = 'background-color:#999999;color:white;';
                                                } else if (getStatus($getTicket[$i]->status) == 'Open') {
                                                    $color = 'background-color:red;color:white;';
                                                } else if (getStatus($getTicket[$i]->status) == 'In Progress') {
                                                    $color = 'background-color:green;color:white;';
                                                }
                                                ?>
                                                <span class="btn btn-xs" style="<?php echo $color; ?>">  <?php echo getStatus($getTicket[$i]->status); ?> </span>
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
                                    <!--<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>-->
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
                                    <!--<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>-->
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <!--<button  id='btndelete' data-url="{{ route('muck-delete')}}" data-id="" type="button" class="btn btn-primary">Delete</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
