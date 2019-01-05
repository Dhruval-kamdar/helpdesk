<table class="table table-striped table-bordered table-hover label-dataTables dataTable no-footer">
    <thead>
        <tr>
            <?php for ($j = 0; $j < count($columnArray); $j++) { ?>
            <th><?php echo $columnArray[$j]['column_name']; ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            $rowArr = array();
            for($i=0;$i<count($rowArray);$i++){
                $rowcount = $rowArray[$i]->rowcount;
                $columnId = $rowArray[$i]->id;
                $rowArr[$rowcount][$columnId] = $rowArray[$i]->row_value;
            }
        ?>
        <?php foreach ($rowArr as $key => $value) { ?>
        <tr>
            <?php foreach ($value as $nkey => $nvalue) { ?>
            <td><?php echo $nvalue;?></td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>