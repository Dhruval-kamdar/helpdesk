
<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <?php
        if($department_detail && $department_detail[0]->id != ''){
            $url = admin_url().'setting/department_edit/'.$this->utility->encode($department_detail[0]->id);
        }else{
            $url = admin_url().'setting/department_add/';
        }
        ?>
        <form method="post" class="form-horizontal" action="<?= $url; ?>" id='addDepartmentForm'>
            
            <div class="form-group headingmain">						
                <h2 class="title" style="margin:10px"> <i class="fa fa-gears"></i> Departments</h2>								
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Department Name *</label>
                <div class="col-sm-7">
                    <input type="text" placeholder="Enter Department Name" name="department_name" class="form-control" value="<?= $department_detail[0]->name;?>">
                </div>
            </div>
         
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
