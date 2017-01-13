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
    <div class="container">

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

</body>

</html>