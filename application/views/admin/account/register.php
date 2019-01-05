<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">IN+</h1>

        </div>
        <h3>Register to IN+</h3>
        <p>Create account to see it in action.</p>
        <form class="m-t" role="form" id="signUp" method="post" action="register">
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" placeholder="First Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="mobile" placeholder="Mobile">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control"  name="cpassword" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="company_name" placeholder="Company Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="address_line_1" placeholder="Address Line 1">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="address_line_2" placeholder="Address Line 2">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="city" placeholder="City">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="postcode" placeholder="Postal Code">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="country" placeholder="Country">
            </div>
            <div class="form-group">
                <div class="checkbox i-checks">
                    <label> 
                        <input name="agree" type="checkbox"><i></i> Agree the terms and policy 
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

            <p class="text-muted text-center"><small>Already have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="<?php echo base_url();?>">Login</a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>
