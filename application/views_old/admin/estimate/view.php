<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="col-sm-5 displaylable">
                            <a  href="<?= admin_url('estimate/pay/') . $this->utility->encode($estimateData[0]->id); ?>"  style="margin:5px 5px 5px -6px"  data-original-title="Pay Invoice" class="btn btn-primary btn-sm "><strong><i class="fa fa-google-wallet"></i> Pay Estimate</strong></a>
                            <a href="javascript:;" data-href="<?php echo admin_url('invoice/pdf/') . $this->utility->encode($estimateData[0]->id); ?>" style="margin:5px" class="btn btn-sm btn-primary  pdfmail m-t-n-xs" ><strong><i class="fa fa-file-pdf-o" > PDF</i></strong></a>
                            <?php $ticketMoreAction = json_decode(TICKETESTIMATEACTIONS); ?>
                            <div class="btn-group">
                                <button data-toggle="dropdown" id="moreAction" class="btn btn-primary dropdown-toggle">More Action <span class="caret"></span></button>
                                <ul class="dropdown-menu moreAction">
                                    <?php foreach ($ticketMoreAction as $key => $value) { ?>
                                        <li><a href="#" data-value="<?= $key ?>" class="font-bold"><?= $value; ?></a></li>
                                    <?php }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="encodeUrl" value="<?= $this->utility->encode($estimateData[0]->id); ?>" class="encodeUrl">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" class="form-horizontal" action="<?= admin_url('estimate/view/') . $this->utility->encode($estimateData[0]->id); ?>" id='invoiceDetail'>
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <img src="<?= IMAGES . 'logo.png'; ?>" style="width: auto;height: 120px;margin-top: -45px !important;">
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Estimate No. <?= $estimateData[0]->ref_no; ?></h4>
                                    <h4>Estimate Date: <?= date('M d, Y', strtotime($estimateData[0]->dt_created)); ?>    </h4>
                                    <h4>Due Date: <?= date('M d, Y', strtotime($estimateData[0]->due_date)); ?> </h4>
                                    <h4>Payment Status: 
                                        <?php
                                        $totalPaid = getEstimatePaidAmount($estimateData[0]->id);
                                        $totalAmount = getTotalEstimateAmount($estimateData[0]->id);
                                        
                                        if ($totalPaid <= 0) {
                                            echo '<button type="button" class="btn btn-danger btn-xs">Not paid</button>';
                                        } else if ($totalPaid >= $totalAmount && $totalPaid > 0) {
                                            echo '<button type="button" class="btn btn-success btn-xs">Fully paid</button>';
                                        } else {
                                            echo '<button style="background-color: black !important;color: white !important;" type="button" class="btn btn-outline black btn-xs"><b>Partially Paid</b></button>';
                                        }
                                        ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="row well m-t">
                                <div class="col-md-6">
                                    <h4>Received From:</h4>
                                    <h4>Expert Tech | Justin Govan</h4>
                                    <h4>142 Brier Park Rd Brantford, ON N3R 5T7 Canada</h4>
                                    <h4>Phone: 519-719-7586</h4>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Bill To:</h4>
                                    <h4><?= $estimateData[0]->companyName; ?></h4>
                                    <h4><?= $estimateData[0]->companyAddress .', ' .$estimateData[0]->companyCity .', ' .$estimateData[0]->countryName ?></h4>
                                    <h4>Phone : <?= $estimateData[0]->companyPhone  ?></h4>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 16% !important; ">Item Name </th>
                                            <th style='text-align: left;'>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subTotal = 0;
                                        for ($i = 0; $i < count($estimatepaymentData); $i++) {
                                            if (!empty($estimatepaymentData[$i]->price)) {
                                                $itemTotal = $estimatepaymentData[$i]->quentity * $estimatepaymentData[$i]->price;
                                                $subTotal += $itemTotal;
                                                ?>
                                                <tr>
                                                    <td><?= date('M d', strtotime($estimateData[0]->dt_created)); ?> | <?= $estimatepaymentData[$i]->item_name ?> </td>
                                                    <td style='text-align: left;'> <?= $estimatepaymentData[$i]->item_desc ?></td>
                                                    <td> <?= $estimatepaymentData[$i]->quentity ?></td>
                                                    <td> <?= $estimateData[0]->currency . $estimatepaymentData[$i]->price ?></td>
                                                    <td>
                                                        <?= $estimateData[0]->currency . $itemTotal; ?> 
                                                        <a data-toggle="modal" data-target="#myModal_autocomplete" data-href="<?= admin_url() . 'estimate/paymentDelete' ?>" data-id="<?php echo $estimatepaymentData[$i]->paymentId; ?>" class="deletePayment">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><input type="text" placeholder="Item Name" name="item_name" class="form-control"></td>
                                            <td><input type="text" placeholder="Item Description" name="item_desc" class="form-control"></td>
                                            <td><input type="text" placeholder="1" name="quentity" class="form-control"></td>
                                            <td><input type="text" placeholder="56.12" name="price" class="form-control"></td>
                                    <input type="hidden" name="id" id="invoiceId" value="<?= $estimateData[0]->id; ?>" class="form-control">
                                    <td>
                                        <div class="text-right">
                                            <button  class="btn btn-success "><i class="fa fa-check"></i> Save</button>
                                        </div>
                                    </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->
                            <?php
                            if (count($estimatepaymentData) > 0) {
                                $defaultTax = ($subTotal * $estimateData[0]->default_tax) / 100;
                                
                                $discount = ($subTotal * $estimateData[0]->discount) / 100;
                                $totalPaid = getEstimatePaidAmount($estimateData[0]->id);
                                $total2 = $subTotal + $defaultTax;
                                $total1 = ($totalPaid + $discount);
                                $finalTotal = $total2 - $total1;
                                $finalTotal = ($finalTotal > 0) ? $finalTotal : '0.00';
                                ?>
                                <table class="table invoice-total">
                                    <tbody>
                                        <tr>
                                            <td><strong>Sub Total :</strong></td>
                                            <td><?= $estimateData[0]->currency . number_format($subTotal, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tax - <?= $estimateData[0]->default_tax ?>% :</strong></td>
                                            <td><?php echo $estimateData[0]->currency . number_format($defaultTax, 2); ?></td>
                                        </tr>
                                        <?php
                                        if ($estimateData[0]->discount > 0) {
                                            ?>
                                            <tr>
                                                <td><strong>Discount - <?= $estimateData[0]->discount ?>%:</strong></td>
                                                <td><?= $estimateData[0]->currency . number_format($discount, 2) ?></td>
                                            </tr>
                                        <?php } ?>

                                        <tr>
                                            <td><strong>Payment Made:</strong></td>
                                            <td><?php echo $estimateData[0]->currency . number_format($totalPaid, 2); ?></td>
                                        </tr>

                                        <tr>
                                            <td><strong>TOTAL :</strong></td>
                                            <td><?= $estimateData[0]->currency . number_format($finalTotal, 2) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <div class="well m-t">
                                <p>Thank you for your business!</p>
                                <p>Customers who fall over 90 days behind in payments to Expert Tech. (from any source such as development,
consulting, hardware,etc.) will automatically lose all privileges, and will no longer receive technical support until such
time as their accounts are current.</p>
                                <?php //$estimateData[0]->note; ?>
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
                                                <input type="text" value="Estimate <?= $estimateData[0]->ref_no; ?>"  name="subject" readonly="" class="form-control email_invoice">
                                                <input type="hidden" value="<?= $estimateData[0]->id ?>"  name="invoiceId" class="form-control invoiceId">
                                            </div>
                                        </div><br/><br/><br/>
                                        <div style="height: 7px; background-color: #535353;"></div>
                                        <div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">ESTIMATE {REF}</div>
                                            <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><span class="style1"><span style="font-weight:bold;">Hello {CLIENT}</span></span><br><br>Here is the estimate of {CURRENCY} {AMOUNT}.<br><br>You can view the estimate online at:<br><span style="font-size:14px;"><a href="{ESTIMATE_LINK}">{ESTIMATE_LINK}</a></span><br><br>Regards,<br><br>The {SITE_NAME} Team</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary send_estimate "  type="submit">Send Estimate</button>
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
                                                <input type="text" value="Estimate <?= $estimateData[0]->ref_no; ?> Reminder" readonly="" name="subject" class="form-control reminser_invoice">
                                                <input type="hidden" value="<?= $estimateData[0]->id ?>"  name="invoiceId" class="form-control reminderInvoiceId">
                                            </div>
                                        </div><br/><br/><br/>
                                        <div style="height: 7px; background-color: #535353;"></div>
                                        <div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Estimate Reminder</div>
                                            <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Hello {CLIENT}</p>
                                                <br><p>This is a friendly reminder to pay your Estimate of {CURRENCY} {AMOUNT}<br>You can view the estimate online at:<br><big><b><a href="{ESTIMATE_LINK}">View Estimate</a></b></big><br><br>Regards,<br>The {SITE_NAME} Team</p>
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
                </form>
            </div>
        </div>
    </div>
</div>
