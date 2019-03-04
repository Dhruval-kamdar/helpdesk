<?php
for ($j = 0; $j < count($columnArray); $j++) {
    ?>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $columnArray[$j]['column_name']; ?></label>
        <div class="input-group col-sm-6">
            <input  name="rows[<?php echo $j; ?>][<?php echo $columnArray[$j]['id']; ?>]" placeholder="Enter <?= $columnArray[$j]['column_name'] ?>" class="form-control rows" type="text">
        </div>
    </div>
<?php }
?>
