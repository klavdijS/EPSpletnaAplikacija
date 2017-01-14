<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="row">

                <?php foreach ($products as $product): ?>

                    <div class="col-sm-6 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="<?= base_url().'uploads/'.$product["image"]; ?>" alt="<?= $product["name"]; ?>">
                            <div class="caption">
                                <h4 class="pull-right">$<?= $product["price"]; ?></h4>
                                <h4><a href="<?= base_url().'product/'.$product["slug"]; ?>"><?= $product["name"]; ?></a></h4>
                                <p><?= $product["description"]; ?></p>
                                <input type="button" class="btn btn-success btn-sm" value="Add to cart">
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>
<!-- /.container -->