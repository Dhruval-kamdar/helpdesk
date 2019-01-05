<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th>Date</th>
            <th>Value</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="appendHtml">
        <?php for ($i = 0; $i < count($lableInfo); $i++) { ?>
            <tr>
                <td><?php echo date('d-m-Y', strtotime($lableInfo[$i]['item_date'])); ?></td>
                <td><?php echo $lableInfo[$i]['item_value']; ?></td>
                <td>
                    <a data-toggle="modal" data-target="#myModal_autocomplete" data-url="<?php echo admin_url() . 'label/deleteLabelInfo' ?>" data-id="<?php echo $lableInfo[$i]['id']; ?>" class="deleteItem" href="javascript:;"><i class="fa fa-close text-navy"></i></a>        
                </td>
            </tr>
        <?php
        }
        if (count($lableInfo) == 0) {
            echo '<tr><td colspan="3" style="color: red;" class="error text-center"><b>No record Found</b></td></tr>';
        }
        ?>
    </tbody>
</table>
