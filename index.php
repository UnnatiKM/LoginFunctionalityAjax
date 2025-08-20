<form class="wpcf7-form" action="" method="POST" id="login">
     <input type="hidden" name="action" value="ajax_login">
    <div class="login-msg">
    </div>
    <div class="row">
        <div class="col-sm-12 form-block clearleft">
            <div class="form-group">
                <span class="wpcf7-form-control-wrap username">
                    <input type="text" placeholder="Email Address" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-username" size="40" value="" name="username">
                </span>
            </div>
            <div class="form-group">
                <span class="wpcf7-form-control-wrap password">
                    <input type="password" placeholder="Password" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-password" size="40" value="" name="password" id="password">
                </span>
            </div> 
            <div class="form-group">
                <input class="button green" type="submit" name="registration" value="Login">
            </div>
                <a href="<?php echo get_permalink(get_page_by_path('forgot-password')); ?>">Lost Your Password ?</a>
        </div>         
    </div>
</form>
