<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-sm-12">

            <h1><?php echo lang('create_user_heading');?></h1>

            <p><?php echo lang('create_user_subheading');?></p>

            <div id="infoMessage" <?php if(!empty($message)) echo 'class="alert alert-warning"';?>><?php echo $message;?></div>

            <?php if ( $logged_in ) echo form_open("create-users"); else echo form_open("auth/create_user");?>

                <!-- First Name / Last Name -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo lang('create_user_fname_label', 'first_name'); ?>
                            <?php echo form_input($first_name); ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo lang('create_user_lname_label', 'last_name'); ?>
                            <?php echo form_input($last_name); ?>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo lang('create_user_identity_label', 'identity'); ?>
                    <?php echo form_input($identity); ?>
                </div>

                <div class="form-group">
                    <?php echo lang('create_user_email_label', 'email'); ?>
                    <?php echo form_input($email); ?>
                </div>

                <!-- Address -->
                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-group">
                            <?php echo lang('create_user_address_street_label', 'street'); ?>
                            <?php echo form_input($street); ?>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <?php echo lang('create_user_address_street_number_label', 'street_number'); ?>
                            <?php echo form_input($street_number); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <?php echo lang('create_user_address_postcode_label', 'postcode'); ?>
                            <?php echo form_input($postcode); ?>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group">
                            <?php echo lang('create_user_address_city_label', 'city'); ?>
                            <?php echo form_input($city); ?>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group">
                            <?php echo lang('create_user_address_country_label', 'country'); ?>
                            <?php echo form_input($country); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo lang('create_user_phone_label', 'phone'); ?>
                    <?php echo form_input($phone); ?>
                </div>

                <div class="form-group">
                    <?php echo lang('create_user_password_label', 'password'); ?>
                    <?php echo form_input($password); ?>
                </div>

                <div class="form-group">
                    <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?>
                    <?php echo form_input($password_confirm); ?>
                </div>
                <div>
                <?php echo $recaptcha_html; ?>
                </div>
                <?php echo form_submit('submit', lang('create_user_submit_btn'), array("class" => "btn btn-default")); ?>

            <?php echo form_close();?>

        </div>

    </div>

</div>
<!-- /.container -->