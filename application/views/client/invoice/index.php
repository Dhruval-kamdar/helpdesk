<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Invoice List</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Invoice</th>
                                        <th>Due Date</th>
                                        <th>Company Name</th>
                                        <th>Amount</th>
                                        <th>Due Amount</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($getInvoice); $i++) {
                                        $invoiceId = $getInvoice[$i]->id;
                                        ?>
                                        <tr class="tooltip-demo">
                                            <td>OPEN</td>
                                            <td><a href="<?= admin_url() . 'invoice/view/' . $this->utility->encode($invoiceId) ; ?>"><?= $getInvoice[$i]->ref_no; ?></a></td>
                                            <td><?= date('d-m-Y',  strtotime($getInvoice[$i]->due_date)); ?></td>
                                            <td><?= $getInvoice[$i]->companyName; ?></td>
                                            <td><?= number_format($getInvoice[$i]->totalPrice,2); ?></td>
                                            <td><?= number_format(getPaidAmount($invoiceId),2); ?></td>
                                            <td>   
                                                <a title="Preview Invoice" data-toggle="tooltip" data-placement="top" href="<?= client_url() . 'invoice/view/' . $this->utility->encode($invoiceId) ; ?>"> <i class="fa fa-eye text-navy"></i> </a>
                                                <a title="Pdf" data-toggle="tooltip" data-placement="top" href="<?php echo client_url('invoice/downloadpdf/') . $this->utility->encode($invoiceId); ?>"> <i class="fa fa-file-pdf-o text-navy"></i> </a>
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
