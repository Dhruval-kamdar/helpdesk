<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Document</title>
    </head>
    <body>
        <table border="0" cellspacing="5" cellpadding="0" style="margin: auto; width: 645px; font-family: arial;">
            <tr>
                <td style="text-align: center ;color: #CB080E; font-size: 14px;font-weight: 600; padding-bottom: 10px; text-transform: uppercase;"><?php echo $documentData['document_name']  ?></td>
            </tr>
        </table>
        <br/>
        <br/>
        <table border="0" cellspacing="0" cellpadding="0" style="margin: auto; width: 645px; font-family: arial;">
            <tr>
                <?php for ($j = 0; $j < count($columnArray); $j++) { ?>
                    <th style="border-bottom: 1px solid #CB080E;text-align: center; color: #000;font-size: 13px;font-weight: 600; padding-bottom: 10px; text-transform: uppercase; "><?php echo $columnArray[$j]['column_name']; ?></th>
                <?php } ?>
            </tr>
            <?php
            $rowArr = array();
            for ($i = 0; $i < count($rowArray); $i++) {
                $rowcount = $rowArray[$i]->rowcount;
                $columnId = $rowArray[$i]->id;
                $rowArr[$rowcount][$columnId] = $rowArray[$i]->row_value;
                $rowArr[$rowcount]['docs_id'] = $rowArray[$i]->docs_id;
                $rowArr[$rowcount]['RowCounts'] = $rowcount;
            }
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
    </body>
</html>