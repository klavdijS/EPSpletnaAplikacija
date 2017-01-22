<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-sm-12">

            <h1>Orders</h1>

            <table class="table table-striped">
                <thead>
                    <?php if ($user_group['group_id'] == 1): ?>
                    <th>Seller id</th>
                    <th>Buyer id</th>
                    <?php endif; ?>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order):
                        $id = $order['id1'];
                        $qty = $order['qty'];
                        $status = $order['status'];
                        $name = $order['name'];
                        $price = $order['price'];
                        $seller = $order['users_id'];
                        $buyer = $order['users_id1'] ?>
                    <tr>
                        <?php if ($user_group['group_id'] == 1): ?>
                        <td><?= $order["users_id"]; ?></td>
                        <td><?= $order["users_id1"]; ?></td>
                        <?php endif; ?>
                        <td><?= $order["name"]; ?></td>
                        <td><?= $order["qty"]; ?></td>
                        <td>$ <?= $order["price"]; ?></td>
                        <td>
                            <?php if ($order['status'] == 0): ?>
                            <span class="label label-warning">PENDING</span>
                            <?php endif; ?>
                            <?php if ($order['status'] == 1): ?>
                            <span class="label label-success">APPROVED</span>
                            <?php endif; ?>
                            <?php if ($order['status'] == 2): ?>
                            <span class="label label-danger">CANCELED</span>
                            <?php endif; ?></td>
                        <td>
                            <?php if ($user_group['group_id'] == 2 && $order['status'] == 0): ?>
                            <?php 
                            echo form_open('orders/approveOrder');
                            echo form_hidden('id', $id);
                            $btn = array(
                            'class' => 'btn btn-success btn-sm',
                            'value' => 'Approve',
                            'name' => 'action'
                            );
                            echo form_submit($btn);
                            echo form_close();
                            echo form_open('orders/cancelOrder');
                            echo form_hidden('id', $id);
                            $btn = array(
                            'class' => 'btn btn-danger btn-sm',
                            'value' => 'Cancel',
                            'name' => 'action'
                            );
                            echo form_submit($btn);
                            echo form_close();
                            ?>
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