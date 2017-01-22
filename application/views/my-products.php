<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-sm-12">

            <h1>My products</h1> 

            <table class="table table-striped">

                <thead>
                    <th>Product</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </thead>

                <tbody>
                    <?php foreach($products as $product) : ?>
                        <tr>
                            <td><a href="<?= base_url(); ?>product/<?= $product["id"]; ?>"><?= $product["name"]; ?></a></td>
                            <td><?= $product["date"]; ?></td>
                            <td>$<?= $product["price"]; ?></td>
                            <td><a href="<?= base_url(); ?>my-products/edit/<?= $product["id"]; ?>" class="btn btn-info" role="button">Edit product</a></td>
                            <td>
                                <?php if ($product["active"]): ?>
                                    <a href="<?= base_url(); ?>my-products/deactivate/<?= $product["id"]; ?>" class="btn btn-danger" role="button">Deactivate product</a>
                                <?php else: ?>
                                    <a href="<?= base_url(); ?>my-products/activate/<?= $product["id"]; ?>" class="btn btn-info" role="button">Activate product</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>

    </div>

</div>
<!-- /.container -->