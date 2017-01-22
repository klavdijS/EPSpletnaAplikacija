<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-sm-12">

            <h1><?php echo lang('login_heading');?></h1>

            <p><?php echo lang('login_subheading');?></p>

            <div id="infoMessage" <?php if(!empty($message)) echo 'class="alert alert-warning"';?>><?php echo $message;?></div>

            <?php echo form_open("auth/login");?>

                <div class="form-group">
                    <?php echo lang('login_identity_label', 'identity') ;?>
                    <?php echo form_input($identity); ?>
                </div>

                <div class="form-group">
                    <?php echo lang('login_password_label', 'password'); ?>
                    <?php echo form_input($password); ?>
                </div>

                <div class="form-group">
                    <?php echo lang('login_remember_label', 'remember'); ?>
                    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                </div>

                <?php echo form_submit('submit', lang('login_submit_btn'), array("class" => "btn btn-default")); ?>

            <?php echo form_close();?>

        </div>

    </div>

</div>
<!-- /.container -->