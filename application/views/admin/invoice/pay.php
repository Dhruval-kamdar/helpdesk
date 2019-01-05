<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <form method="post" class="form-horizontal"  enctype="multipart/form-data"  action="<?= admin_url('invoice/pay/') . $invoiceId; ?>" id='invoicePayment'>
            <div class="form-group headingmain">						
                <h2 class="title" style="margin:10px"> Payment Details</h2>								
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Trans ID *</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Trans ID " readonly="" name="trans_id" value="<?= $tranNos; ?>" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Payment Method *</label>
                <div class="col-sm-7">
                    <?php $paymentMethod = json_decode(PAYMENT_METOHD); ?>
                    <select class="payment_method form-control" name="payment_method">
                        <?php foreach ($paymentMethod as $key => $value) { ?>
                            <option value="<?= $key ?>"><?= $value; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group" id="data_1">
                <label class="col-sm-3 control-label">Payment Date</label>
                <div class="input-group date col-sm-7"  style="float: left;padding-right: 14px;padding-left: 14px;">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="payment_date" value="">
                </div>
            </div>
            <?php
            $paidAmount = getPaidAmount($invoicepaymentData[0]->id);
            $subTotal = $invoicepaymentData[0]->totalPrice;
            $defaultTax = ($subTotal * $invoicepaymentData[0]->default_tax) / 100;
            $discount = ($subTotal * $invoicepaymentData[0]->discount) / 100;
            $total2 = $subTotal + $defaultTax;
            $total1 = ($paidAmount + $discount);
            $total = $total2 - $total1;
                                
//            $total = $invoicepaymentData[0]->totalPrice - $paidAmount;
            ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">Amount (CAD) *</label>
                <div class="col-sm-7">
                    <input type="text" name="amount" placeholder="Enter Amount (CAD)" value="<?= $total ?>" class="form-control amount">
                    <input type="hidden" name="hidAmount" value="<?= $total ?>" class="totalAmount">
                    <input type="hidden" name="invoiceId" value="<?= $invoicepaymentData[0]->id ?>" class="">
                    <input type="hidden" name="ref_no" value="<?= $invoicepaymentData[0]->ref_no; ?>" class="">
                    <input type="hidden" name="currency" value="<?= $invoicepaymentData[0]->currency; ?>" class="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Notes *</label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="notes"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Send Email</label>
                <div class="col-sm-1">
                    <input type="checkbox" name="send_mail" class="js-switch" checked />
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <a href="<?= admin_url('invoice/view/') . $this->utility->encode($invoicepaymentData[0]->id); ?>" class="btn btn-white" type="button">Cancel</a>
                    <?php if($total > 0){
                        echo '<button class="btn btn-primary submitBtn" type="submit">Add Payment</button>';
                    } ?>
                    
                </div>
            </div>
        </form>
    </div>
</div>
