<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="row">

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/320x150" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="<?= base_url(); ?>product/1">First Product</a></h4>
                            <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <input type="button" class="btn btn-success btn-sm" value="Add to cart">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/320x150" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$64.99</h4>
                            <h4><a href="<?= base_url(); ?>product/2">Second Product</a></h4>
                            <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <input type="button" class="btn btn-success btn-sm" value="Add to cart">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/320x150" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$74.99</h4>
                            <h4><a href="<?= base_url(); ?>product/3">Third Product</a></h4>
                            <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <input type="button" class="btn btn-success btn-sm" value="Add to cart">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/320x150" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$84.99</h4>
                            <h4><a href="<?= base_url(); ?>product/4">Fourth Product</a></h4>
                            <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <input type="button" class="btn btn-success btn-sm" value="Add to cart">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/320x150" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$94.99</h4>
                            <h4><a href="product/5">Fifth Product</a></h4>
                            <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <input type="button" class="btn btn-success btn-sm" value="Add to cart">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/320x150" alt="">
                        <div class="caption">
                            <h4 class="pull-right">$94.99</h4>
                            <h4><a href="product/6">Sixth Product</a></h4>
                            <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <input type="button" class="btn btn-success btn-sm" value="Add to cart">
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
<!-- /.container -->

<!-- Cart -->
<div id="cart" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Shopping Cart</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                                Product 1
                            </td>
                            <td>
                                1
                                <div class="btn-group" style="margin-left: 15px;">
                                    <button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                                    <button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                                </div>
                            </td>
                            <td>
                                $19.99
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                                Product 2
                            </td>
                            <td>
                                3
                                <div class="btn-group" style="margin-left: 15px;">
                                    <button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                                    <button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                                </div>
                            </td>
                            <td>
                                $59.97
                            </td>
                        </tr>
                        <tr class="info">
                            <td></td>
                            <td></td>
                            <td>
                                <strong>$79.96</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Checkout</button>
            </div>
        </div>

    </div>
</div>