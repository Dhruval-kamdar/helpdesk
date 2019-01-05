<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <?php
        ?>
        <input type="hidden" name="encodeUrl" value="<?= $this->utility->encode($invoiceData[0]->id); ?>" class="encodeUrl">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" class="form-horizontal" action="<?= client_url('invoice/view/') . $this->utility->encode($invoiceData[0]->id); ?>" id='invoiceDetail'>
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <img src="<?= IMAGES . 'logo.png'; ?>" style="width: auto;height: 150px;margin-top: -45px !important;">
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Invoice No. <?= $invoiceData[0]->ref_no; ?></h4>
                                    <h4>Invoice Date: <?= date('M d, Y', strtotime($invoiceData[0]->dt_created)); ?>    </h4>
                                    <h4>Due Date: <?= date('M d, Y', strtotime($invoiceData[0]->due_date)); ?> </h4>
                                    <h4>Payment Status: 
                                        <?php 
                                        $totalPaid = getPaidAmount($invoiceData[0]->id);
                                        $totalAmount = getTotalAmount($invoiceData[0]->id);
                                        if($totalPaid <= 0){
                                            echo '<button type="button" class="btn btn-danger btn-xs">Not paid</button>';
                                        }else if($totalPaid >= $totalAmount && $totalPaid > 0){
                                            echo '<button type="button" class="btn btn-success btn-xs">Fully paid</button>';
                                        }else{
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
                                    <h4><?= $invoiceData[0]->companyName; ?></h4>
                                    <h4><?= $invoiceData[0]->companyAddress .', ' .$invoiceData[0]->companyCity .', ' .$invoiceData[0]->countryName ?></h4>
                                    <h4>Phone : <?= $invoiceData[0]->companyPhone  ?></h4>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                        <tr>
                                            <th>Item Name </th>
                                            <th style='text-align: left;'>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subTotal = 0;
                                        for ($i = 0; $i < count($invoicepaymentData); $i++) {
                                            if (!empty($invoicepaymentData[$i]->price)) {
                                                $itemTotal = $invoicepaymentData[$i]->quentity * $invoicepaymentData[$i]->price;
                                                $subTotal += $itemTotal;
                                                ?>
                                                <tr>
                                                    <td><?= date('M d', strtotime($invoiceData[0]->dt_created)); ?> | <?= $invoicepaymentData[$i]->item_name ?> </td>
                                                    <td style='text-align: left;'> <?= $invoicepaymentData[$i]->item_desc ?></td>
                                                    <td> <?= $invoicepaymentData[$i]->quentity ?></td>
                                                    <td> <?= $invoiceData[0]->currency . $invoicepaymentData[$i]->price ?></td>
                                                    <td>
                                                        <?= $invoiceData[0]->currency . $itemTotal; ?> 
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
<!--                                            <td><input type="text" placeholder="Item Name" name="item_name" class="form-control"></td>
                                            <td><input type="text" placeholder="Item Description" name="item_desc" class="form-control"></td>
                                            <td><input type="text" placeholder="1" name="quentity" class="form-control"></td>
                                            <td><input type="text" placeholder="56.12" name="price" class="form-control"></td>
                                    <input type="hidden" name="id" id="invoiceId" value="<?= $invoiceData[0]->id; ?>" class="form-control">
                                    <td>
                                        <div class="text-right">
                                            <button  class="btn btn-success "><i class="fa fa-check"></i> Save</button>
                                        </div>
                                    </td>-->

                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->
                            <?php
                            if (count($invoicepaymentData) > 0) {
                                $defaultTax = ($subTotal * $invoiceData[0]->default_tax) / 100;
                                $discount = ($subTotal * $invoiceData[0]->discount) / 100;
                                $totalPaid = getPaidAmount($invoiceData[0]->id);
                                $total2 = $subTotal + $defaultTax;
                                $total1 = ($totalPaid + $discount);
                                $finalTotal = $total2 - $total1;
                                $finalTotal = ($finalTotal > 0) ?$finalTotal : '0.00';
                                ?>
                                <table class="table invoice-total">
                                    <tbody>
                                        <tr>
                                            <td><strong>Sub Total :</strong></td>
                                            <td><?= $invoiceData[0]->currency . number_format($subTotal, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tax - <?= $invoiceData[0]->default_tax ?>% :</strong></td>
                                            <td><?php echo $invoiceData[0]->currency . number_format($defaultTax, 2); ?></td>
                                        </tr>
                                        <?php
                                        if ($invoiceData[0]->discount > 0) {
                                            ?>
                                            <tr>
                                                <td><strong>Discount - <?= $invoiceData[0]->discount ?>%:</strong></td>
                                                <td><?= $invoiceData[0]->currency . number_format($discount, 2) ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><strong>Payment Made:</strong></td>
                                            <td><?php echo $invoiceData[0]->currency . number_format($totalPaid, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>TOTAL :</strong></td>
                                            <td><?= $invoiceData[0]->currency . number_format($finalTotal, 2) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <div class="well m-t"><?= $invoiceData[0]->note; ?>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
