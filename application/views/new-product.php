<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-sm-12">

            <h1>Add New Product</h1>

            <!-- Polje za sporočanje napake, če je do njih pri nalaganju prišlo. -->
            <?php if ( validation_errors() OR $upload_errors ): ?>
                <div class="alert alert-warning">
                    <?= validation_errors().$upload_errors; ?>
                </div>
            <?php endif; ?>

            <?php echo form_open_multipart('new-product'); ?>
                <!-- Product Name -->
                <div class="form-group">
                    <label for="product">Product:</label>
                    <?= form_input($product); ?>
                </div>

                <!-- Product Description -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <?= form_textarea($description); ?>
                </div>

                <!-- Photo -->
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <?= form_upload($photo); ?>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label for="price">Price:</label>
                    <?= form_input($price); ?>
                </div>

                <button type="submit" class="btn btn-default">Add new product</button>
            </form>

        </div>

    </div>

</div>
<!-- /.container -->