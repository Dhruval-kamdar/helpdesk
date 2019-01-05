<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Example 2</title>
        <link rel="stylesheet" href="style.css" media="all" />
        <style>
            @font-face {
                font-family: SourceSansPro;
                src: url(SourceSansPro-Regular.ttf);
            }

            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #0087C3;
                text-decoration: none;
            }

            body {
                position: relative;
                width: 100%;  
                height: 29.7cm; 
                margin: 0 auto; 
                color: #555555;
                background: #FFFFFF; 
                font-family: Arial, sans-serif; 
                font-size: 14px; 
                font-family: SourceSansPro;
            }

            header {
                padding: 10px 0;
                margin-bottom: 20px;
                border-bottom: 1px solid #AAAAAA;
            }

            #logo {
                float: left;
                margin-top: 8px;
            }

            #logo img {
                height: 70px;
            }

            #company {
                float: right;
                text-align: right;
            }


            #details {
                margin-bottom: 50px;
            }

            #client {
                padding-left: 6px;
                border-left: 6px solid #0087C3;
                float: left;
            }

            #client .to {
                color: #777777;
            }

            h2.name {
                font-size: 1.4em;
                font-weight: normal;
                margin: 0;
            }

            #invoice {
                float: right;
                text-align: right;
            }

            #invoice h1 {
                color: #0087C3;
                font-size: 2.4em;
                line-height: 1em;
                font-weight: normal;
                margin: 0  0 10px 0;
            }

            #invoice .date {
                font-size: 1.1em;
                color: #777777;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table th,
            table td {
                padding: 20px;
                background: #EEEEEE;
                text-align: center;
                border-bottom: 1px solid #FFFFFF;
            }

            table th {
                white-space: nowrap;        
                font-weight: normal;
            }

            table td {
                text-align: right;
            }

            table td h3{
                color: #57B223;
                font-size: 1.2em;
                font-weight: normal;
                margin: 0 0 0.2em 0;
            }

            table .no {
                color: #FFFFFF;
                font-size: 1.6em;
                background: #57B223;
            }

            table .desc {
                text-align: left;
            }

            table .unit {
                background: #DDDDDD;
            }

            table .qty {
            }

            table .total {
                background: #57B223;
                color: #FFFFFF;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table tbody tr:last-child td {
                border: none;
            }

            table tfoot td {
                padding: 10px 20px;
                background: #FFFFFF;
                border-bottom: none;
                font-size: 1.2em;
                white-space: nowrap; 
                border-top: 1px solid #AAAAAA; 
            }

            table tfoot tr:first-child td {
                border-top: none; 
            }

            table tfoot tr:last-child td {
                color: #57B223;
                font-size: 1.4em;
                border-top: 1px solid #57B223; 

            }

            table tfoot tr td:first-child {
                border: none;
            }

            #thanks{
                font-size: 2em;
                margin-bottom: 50px;
            }

            #notices{
                padding-left: 6px;
                border-left: 6px solid #0087C3;  
            }

            #notices .notice {
                font-size: 1.2em;
            }

            footer {
                color: #777777;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #AAAAAA;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="public/asset/images/logo.png">
            </div>
            <div id="company">
                <h2 class="name"><?= $invoiceData[0]->companyName; ?></h2>
                <div><?= $invoiceData[0]->companyAddress .', ' .$invoiceData[0]->companyCity .', ' .$invoiceData[0]->countryName ?></div>
                <div><?= $invoiceData[0]->companyPhone  ?></div>
                <div><a href="mailto:company@example.com">company@example.com</a></div>
            </div>
<!--            <div id="company">
                <h2 class="name">Company Name</h2>
                <div>455 Foggy Heights, AZ 85004, US</div>
                <div>(602) 519-0450</div>
                <div><a href="mailto:company@example.com">company@example.com</a></div>
            </div>-->
        </div>
    </header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">INVOICE TO:</div>
            <h2 class="name">John Doe</h2>
            <div class="address">796 Silver Harbour, TX 79273, US</div>
            <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
        </div>
        <div id="invoice">
            <h1><?= $invoiceData[0]->ref_no; ?></h1>
            <div class="date">Date of Invoice: <?= date('d/m/Y', strtotime($invoiceData[0]->dt_created)); ?></div>
            <div class="date">Due Date: <?= date('d/m/Y', strtotime($invoiceData[0]->due_date)); ?> </div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th class="no">#</th>
                <th class="desc">DESCRIPTION</th>
                <th class="unit">UNIT PRICE</th>
                <th class="qty">QUANTITY</th>
                <th class="total">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $subTotal = 0;
            $cnt = 1;
            for ($i = 0; $i < count($invoicePaymentData); $i++) {
//                echo '<pre/>';
//                print_r($invoicePaymentData[$i]->price);exit;
                if (!empty($invoicePaymentData[$i]->price)) {
                    $itemTotal = $invoicePaymentData[$i]->quentity * $invoicePaymentData[$i]->price;
                    $subTotal += $itemTotal;
                    ?>
                    <tr>
                        <td class="no"><?php echo $cnt; ?></td>
                        <td class="desc"><?= $invoicePaymentData[$i]->item_desc ?></td>
                        <td class="unit"><?= $invoicePaymentData[$i]->price ?></td>
                        <td class="unit"><?= $invoicePaymentData[$i]->quentity ?></td>
                        <td class="total"><?= $invoiceData[0]->currency . $itemTotal; ?></td>
                    </tr>
                    <?php
                }
                $cnt++;
            }
            ?>
        </tbody>

        <?php
        if (count($invoicePaymentData) > 0) {
            $defaultTax = ($subTotal * $invoiceData[0]->default_tax) / 100;
            $discount = ($subTotal * $invoiceData[0]->discount) / 100;
            $totalPaid = getPaidAmount($invoiceData[0]->id);
            $total2 = $subTotal + $defaultTax;
            $total1 = ($totalPaid + $discount);
            $finalTotal = $total2 - $total1;
            $finalTotal = ($finalTotal > 0) ? $finalTotal : '0.00';
            ?>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td><?= $invoiceData[0]->currency . number_format($subTotal, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">TAX 25%</td>
                    <td><?php echo $invoiceData[0]->currency . number_format($defaultTax, 2); ?></td>
                </tr>
                <?php
                if ($invoiceData[0]->discount > 0) {
                    ?>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Discount - <?= $invoiceData[0]->discount ?>%:</td>
                        <td><?= $invoiceData[0]->currency . number_format($discount, 2) ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2"><strong>Payment Made:</strong></td>
                    <td colspan=""><?php echo $invoiceData[0]->currency . number_format($totalPaid, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td><?= $invoiceData[0]->currency . number_format($finalTotal, 2) ?></td>
                </tr>
            </tfoot>
        <?php } ?>
    </table>
    <div id="thanks">Thank you!</div>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice"><?= $invoiceData[0]->note; ?></div>
    </div>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>