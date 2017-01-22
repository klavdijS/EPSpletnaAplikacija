<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-md-4">
            <div class="row">
                <!-- Prikazna slika produkta -->
                <div class="col-sm-12">
                    <div class="thumbnail">
                        <img src="<?= base_url().'uploads/'.$product["image"]; ?>" alt="<?= $product["name"]; ?>" class="full-image">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <!-- Ime, cena in opis produkta -->
                <div class="col-sm-12">
                    <h4 class="pull-right">$<?= $product["price"]; ?></h4>
                    <h4><?= $product["name"]; ?></h4>
                    <p><?= $product["description"]; ?></p>
                    <?php
                        $id = $productId;
                        $name = $product['name'];
                        $price = $product['price'];
                        echo form_open('home/addCart');
                        echo form_hidden('id', $id);
                        echo form_hidden('name', $name);
                        echo form_hidden('price', $price);
                        ?>
                        <div >
                        <?php $btn = array(
                        'class' => 'btn btn-success btn-sml',
                        'value' => 'Add to Cart',
                        'name' => 'action'
                        );
                        echo form_submit($btn);
                        echo form_close();
                        ?>
                        </div>
                    <p class="pull-right">
                        Votes: <span id="votes"><?= $product["rating"]; ?></span>
                        <?php if ( ! isset($_SESSION["voted"]) ) : ?>
                            <span class="glyphicon glyphicon-thumbs-up" id="<?= $product["id"]; ?>"></span>
                            <span class="glyphicon glyphicon-thumbs-down" id="<?= $product["id"]; ?>"></span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <!-- Dodatne slike produkta -->
    <?php if (count($productGallery) > 0) : ?>
        <div class="row">
            <div class="col-sm-12">
                <h3>Images of <?= $product["name"]; ?></h3>
            </div>
        </div>

        <div class="row">
            <?php foreach($productGallery as $image): ?>
                <div class="col-sm-4 col-md-3 col-lg-3">
                    <img src="<?= base_url().'uploads/'.$image["filename"]; ?>" alt="" class="img-responsive">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
<!-- /.container -->

<script src="<?= base_url(); ?>js/rating.js"></script>