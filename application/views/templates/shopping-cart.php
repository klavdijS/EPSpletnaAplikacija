<!-- Cart -->
<div id="cart" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Shopping Cart</h4>
            </div>
            <div id="text">
            <?php $cart_check = $this->cart->contents();
            if(empty($cart_check)) {
            echo 'To add products to your shopping cart click on "Add to Cart" Button';
            } ?> </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <?php
                    // All values of cart store in "$cart".
                    if ($cart = $this->cart->contents()): ?>
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
                    // Create form and send all values in "shopping/update_cart" function.
                    echo form_open('home/updateCart');
                    $grand_total = 0;

                    foreach ($cart as $item):
                    // echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                    // Will produce the following output.
                    // <input type="hidden" name="cart[1][id]" value="1" />

                    echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                    echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                    ?>
                        <tr>
                            <td>
                                <?php echo $item['id']; ?>
                            </td>
                            <td>
                               <?php
                                $buton = "<img src='https://d30y9cdsu7xlg0.cloudfront.net/png/2910-200.png' width='15px' height='15px'>";
                                echo anchor('home/removeCart/' . $item['rowid'], $buton); ?>
                                <?php echo $item['name']; ?>
                            </td>
                            <td>
                                <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                                <div class="btn-group" style="margin-left: 15px;">
                                    <?php $buton3 = "<img src='http://www.iconsdb.com/icons/preview/black/minus-7-xxl.png' width='15px' height='15px'>";
                                        echo anchor('home/minusQty/' . $item['rowid'] . '/' . $item['qty'], $buton3); ?>
                                    <?php $buton2 = "<img src='http://plainicon.com/download-icons/39433/plainicon.com-39433-673f-512px.png' width='15px' height='15px'>";
                                        echo anchor('home/plusQty/' . $item['rowid'] . '/' . $item['qty'], $buton2); ?>
                                    
                                </div>
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
                            <td></td>
                            <td>
                                <strong>$ <?php echo number_format($grand_total, 2); ?></strong>
                            </td>
                        </tr>
                    </tbody>
                        <?php echo form_close(); ?>
                   
                <?php endif; ?>
                </table>
                
            </div>
            <div class="modal-footer">
                <a href="<?= base_url(); ?>home/checkoutOpen">Checkout</a>
            </div>
        </div>

    </div>
</div>