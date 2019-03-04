
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name"><img src="<?php echo IMAGES.'logo.png'; ?>" style="display: block;margin: 0 auto; text-align: center; width: 200px;padding: 10px;"></h1>
        </div>
        <h3>Welcome To Our Support Help Desk</h3>
        </p>
        <form class="m-t" role="form" id="forgot_pass" action="<?= base_url_index().'account/forgot_password'?>" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Forgot Password</button>
             <a class="btn btn-sm btn-white btn-block" href="login">Login</a>
        </form>
    </div>
</div>
