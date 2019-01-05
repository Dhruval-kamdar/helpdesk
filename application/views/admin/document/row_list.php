<table class="table table-striped table-bordered table-hover label-dataTables dataTable no-footer">
    <thead>
        <tr>
            <?php for ($j = 0; $j < count($columnArray); $j++) { ?>
                <th><?php echo $columnArray[$j]['column_name']; ?></th>
            <?php } ?>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
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
        <tr class="hide_<?php echo $RowCounts; ?>">
                <?php foreach ($value as $nkey => $nvalue) {
                    ?>
                    <td><?php echo $nvalue; ?></td>
                <?php }
                if (!empty($value)) {
                    ?>
                    <td><a title="Delete"  class="deleteRow" data-url="<?php echo admin_url() . 'document/deleteRow' ?>" data-count="<?php echo $RowCounts; ?>" data-id="<?php echo $deleteId; ?>" ><i class="fa fa-close text-navy"></i></a></td>
            <?php } ?>  
            </tr>
<?php } ?>
    </tbody>
</table>