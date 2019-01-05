
<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
<div class="ibox-title">
    <h5>Reset Password</h5>
</div>
        <div class="ibox-content">
            <form method="post" class="form-horizontal"  action="<?php admin_url() . 'reset_password' ?>" id = 'changePassword' method="post" accept-charset="utf-8">

<!--            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="form-group col-md-4">
                    <label for="pwd">Current Password:</label>
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Current Password">
                    
                </div>
            </div>-->
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="form-group col-md-4">
                    <label for="pwd">New Password:</label>
                    <input type="password" class="form-control" name="newpwd" id="newpwd" placeholder="New Password">
                    
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="form-group col-md-4">
                    <label for="pwd">Retype New Password:</label>
                    <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" placeholder="Retype New Password">
                    
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <a class="btn btn-white" href="<?= admin_url('reset_password'); ?>" type="button">Cancel</a>
                    <button class="btn btn-primary" type="submit">Reset Password</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
