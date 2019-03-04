<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>


    </head>
    <body>
        <table border="0" cellspacing="0" cellpadding="0" style="margin: auto; width: 645px; font-family: arial;">
            <tr>
                <td colspan="2" style="width: 60%;"><img style="width: 150px" src="public/asset/images/logo.png"/></td>
                <td colspan="2" style="width: 40%;">
                    <table border="0" cellspacing="3" cellpadding="0" style="width: 100%">
                        <tr>
                            <td colspan="2" style="text-align: right; font-size: 22px; padding-bottom: 10px"><b>Report</b></td>
                        </tr>

                    </table>
                </td>
            </tr>
            <tr>
                <?php for ($i = 0; $i < count($documentData); $i++) { ?>
                <table border="0" cellspacing="3" cellpadding="0" style="width: 100%">
                    <tr><th style="border-bottom: 1px solid #CB080E;width: 46%;text-align: left; color: #000;font-size: 13px;font-weight: 600; padding-bottom: 10px; text-transform: uppercase; "><?php echo $documentData[$i]['document_name']; ?></th></tr>
                    <tr>
                        <?php for ($j = 0; $j < count($fullData[$i]['column']); $j++) { ?>
                            <td><?php echo $fullData[$i]['column'][$j]['column_name']; ?></td>
                        <?php } ?>
                    </tr>
                    <?php
                    $rowArray = $fullData[$i]['rowArray'];
                    $rowArr = array();
                    for ($k = 0; $k < count($rowArray); $k++) {
                        // echo $rowArray[$k]->rowcount;
                        $rowcount = $rowArray[$k]->rowcount;
                        $columnId = $rowArray[$k]->id;
                        $rowArr[$rowcount][$columnId] = $rowArray[$k]->row_value;
                        $rowArr[$rowcount]['docs_id'] = $rowArray[$k]->docs_id;
                        $rowArr[$rowcount]['RowCounts'] = $rowcount;
                    }
                    unset($rowArray);
                    ?>
                    <?php
                    foreach ($rowArr as $key => $value) {
                        $deleteId = $value['docs_id'];
                        $RowCounts = $value['RowCounts'];
                        unset($value['docs_id']);
                        unset($value['RowCounts']);
                        ?>
                        <tr class="">
                            <?php foreach ($value as $nkey => $nvalue) {
                                ?>
                                <td style="font-size: 13px;padding:10px;border-bottom: 1px;text-align: center;font-size: 12px;background: #f0f0f0;"><?php echo $nvalue; ?></td>
                            <?php }
                            ?>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </tr>

    </table>
</body>
</html>