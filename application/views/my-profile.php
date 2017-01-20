<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-sm-12">

            <h1>My Profile</h1> 

            <div <?php if( validation_errors() ) echo 'class="alert alert-warning"'; ?>><?= validation_errors(); ?></div>
            <div <?php if( $this->session->flashdata('success') ) echo 'class="alert alert-success"'; ?>><?= $this->session->flashdata('success'); ?></div>

            <?php echo form_open("my-profile");?>

                <!-- First Name / Last Name -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <?php echo form_input($first_name); ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <?php echo form_input($last_name); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <?php echo form_input($email); ?>
                </div>

                <!-- Address -->
                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="street">Street:</label>
                            <?php echo form_input($street); ?>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="street_number">Street Number:</label>
                            <?php echo form_input($street_number); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="postcode">Postcode:</label>
                            <?php echo form_input($postcode); ?>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="city">City:</label>
                            <?php echo form_input($city); ?>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <?php echo form_input($country); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <?php echo form_input($phone); ?>
                </div>

                <?php echo form_submit('submit', "Update", array("class" => "btn btn-default")); ?>

            <?php echo form_close();?>

            <p style="margin-top: 15px;"><a href="auth/change_password" class="text-danger">Change Password</a></p>

        </div>

    </div>

</div>
<!-- /.container -->