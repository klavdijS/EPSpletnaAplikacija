<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Projekt pri predmetu Elektronsko poslovanje">
    <meta name="author" content="N. Đukić, K. Starman, V. Ribič">

    <title>Elektronsko poslovanje</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url(); ?>">Shop Name</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="login">Login</a>
                    </li>
                    <li>
                        <a href="create_user">Sign up</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container" style="margin-bottom: 40px;">

        <div class="row">

            <div class="col-sm-12">

                <h1><?php echo lang('create_user_heading');?></h1>

                <p><?php echo lang('create_user_subheading');?></p>

                <div id="infoMessage" <?php if(!empty($message)) echo 'class="alert alert-warning"';?>><?php echo $message;?></div>

                <?php echo form_open("auth/create_user");?>

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

                    <?php echo form_submit('submit', lang('create_user_submit_btn'), array("class" => "btn btn-default")); ?>

                <?php echo form_close();?>

            </div>

        </div>

    </div>
    <!-- /.container -->

</body>

</html>