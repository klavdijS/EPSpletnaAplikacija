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
            <?php if ( $logged_in ) : ?>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?= base_url(); ?>new-product">Add new product</a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>orders">Orders</a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>my-profile">My profile</a>
                    </li>
                    <li>
                        <a href="#">Edit users</a>
                    </li>
                </ul>
            <?php endif; ?>
            <ul class="nav navbar-nav navbar-right">
                <?php if ( $logged_in ) : ?>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#cart">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('auth/logout'); ?>">Log out</a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="auth/login">Login</a>
                    </li>
                    <li>
                        <a href="auth/create_user">Sign up</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>