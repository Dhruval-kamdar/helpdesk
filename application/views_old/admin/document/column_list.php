<table class="table table-striped table-bordered table-hover label-dataTables" >
    <thead>
        <tr>
            <th>Column Name</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($columnArray); $i++) {
            ?>
        <tr class="hide_<?php echo $columnArray[$i]['id']; ?>">
                <td><?php echo $columnArray[$i]['column_name']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($columnArray[$i]['dt_created'])); ?></td>
                    <td><a title="Delete"  class="deleteColumn" data-url="<?php echo admin_url() . 'document/deleteColumn' ?>" data-id="<?php echo $columnArray[$i]['id']; ?>" ><i class="fa fa-close text-navy"></i></a></td>
            </tr>
        <?php
        }
        if (count($columnArray) == 0) {
            echo '<tr><td colspan="2" style="text-align: center">No Record Found</td></tr>';
        }
        ?>
    </tbody>
</table>
