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
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" data-toggle="modal" data-target="#cart">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge">4</span>
                    </a>
                </li>
                <li>
                    <a href="#">Log out</a>
                </li>
                <!-- if not logged in:
                <li>
                    <a href="#">Login</a>
                </li>
                <li>
                    <a href="#">Sign up</a>
                </li>-->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>