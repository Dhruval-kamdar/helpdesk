
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name"><img src="<?php echo IMAGES.'logo.png'; ?>" style="display: block;margin: 0 auto; text-align: center; width: 200px;padding: 10px;"></h1>
        </div>
        <h3>Welcome To Our Support Help Desk</h3>
        <!--<p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.-->
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <!--<p>Login in. To see it in action.</p>-->
        <form class="m-t" role="form" id="login" action="<?= base_url_index().'account/login'?>" method="post">

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="<?php echo base_url().'account/forgot_password'; ?>"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small> Contact: <a href="mailto:helpdesk@experttech.ca">helpdesk@experttech.ca</a></small></p>
            <!--<a class="btn btn-sm btn-white btn-block" href="register">Create an account</a>-->
        </form>
        <!--<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>-->
    </div>
</div>
