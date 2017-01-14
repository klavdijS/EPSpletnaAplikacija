<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-md-4">

            <div class="row">

                <div class="col-sm-12">
                    <div class="thumbnail">
                        <img src="<?= base_url().'uploads/'.$product["image"]; ?>" alt="<?= $product["name"]; ?>" class="full-image">
                    </div>
                </div>

            </div>

        </div>

        <div class="col-md-8">

            <div class="row">

                <div class="col-sm-12">
                    <h4 class="pull-right">$<?= $product["price"]; ?></h4>
                    <h4><?= $product["name"]; ?></h4>
                    <p><?= $product["description"]; ?></p>
                    <input type="button" class="btn btn-success btn-sm" value="Add to cart">
                </div>

            </div>

        </div>

    </div>

</div>
<!-- /.container -->