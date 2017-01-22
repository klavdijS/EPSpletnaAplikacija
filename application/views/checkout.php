<!-- Page Content -->
<div class="container bottom-space">
    <div class="row">
        <div class="col-md-12">
            <h4 class="modal-title">Order summary</h4>
            <div class="row">
                <div class="modal-body">
                <table class="table table-striped">
                    <?php if ($cart = $this->cart->contents()): ?>
                    <thead>
                        <tr id= "main_heading">
                            <th>Serial</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $grand_total = 0;
                    foreach ($cart as $item): ?>
                        <tr>
                            <td>
                                <?php echo $item['id']; ?>
                            </td>
                            <td>
                                <?php echo $item['name']; ?>
                            </td>
                            <td>
                                <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                            </td>
                            <td>
                                $ <?php echo number_format($item['price'], 2); ?>
                            </td>
                            <?php $grand_total = $grand_total + $item['subtotal']; ?>
                        <?php endforeach; ?>
                        </tr>
                        <tr class="info">
                            <td></td>
                            <td></td>
                            <td>Total:</td>
                            <td>
                                <strong>$ <?php echo number_format($grand_total, 2); ?></strong>
                            </td>
                        </tr>
                    </tbody>
                    <?php endif; ?>
                </table>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url(); ?>home/confirmOrder">Confirm order</a>
                </div>
            </div>
        </div>
    </div>
</div>