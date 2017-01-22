<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-md-12">

            <div class="row">

                <?php foreach ($products as $product): ?>

                    <?php if ($product["active"]) : ?>

                        <?php
                            // Skrajšaj dolžino opisa na 100 znakov
                            $abstract = $product["description"];
                            if (strlen($abstract) > 100) $abstract = substr($product["description"], 0, strpos($product["description"], ' ', 100)).' ...';
                        ?>

                        <div class="col-sm-6 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <img src="<?= base_url().'uploads/'.$product["image"]; ?>" alt="<?= $product["name"]; ?>">
                                <div class="caption">
                                    <h4 class="pull-right">$<?= $product["price"]; ?></h4>
                                    <h4><a href="<?= base_url().'product/'.$product["id"]; ?>"><?= $product["name"]; ?></a></h4>
                                    <p><?= $abstract; ?></p>
                                </div>
                                <div class="ratings">
                                    <input type="button" class="btn btn-success btn-sm" value="Add to cart">
                                    <p class="pull-right">
                                        Votes: <?= $product["rating"]; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>
<!-- /.container -->