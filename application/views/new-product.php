<!-- Page Content -->
<div class="container bottom-space">

    <div class="row">

        <div class="col-sm-12">

            <h1><?= $title; ?></h1>

            <!-- Polje za sporočanje napake, če je do njih pri nalaganju prišlo. -->
            <?php if ( validation_errors() OR $upload_errors ): ?>
                <div class="alert alert-warning">
                    <?= validation_errors().$upload_errors; ?>
                </div>
            <?php endif; ?>

            <?php echo form_open_multipart($action); ?>
                <!-- Product Name -->
                <div class="form-group">
                    <label for="name">Product:</label>
                    <?= form_input($name); ?>
                </div>

                <!-- Product Description -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <?= form_textarea($description); ?>
                </div>

                <!-- Photo -->
                <div class="form-group">
                    <label for="featuredImage">Photo:</label>
                    <?= form_upload($featuredImage); ?>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label for="price">Price:</label>
                    <?= form_input($price); ?>
                </div>

                <div class="form-group">
                    <label for="photo">Additional photos:</label>
                    <div class="row">
                        <!-- Ce so fotografije ze nalozene, jih lahko uporabnik zamenja. -->
                        <?php if(isset($photos) && $photos) : ?>
                            <?php for($i = 0; $i < 3; $i++): if (isset($photos[$i])): ?>
                                <!-- Stara fotografija -->
                                <div class="col-sm-4">
                                    <?= $photos[$i]["filename"]; ?> 
                                    <a id="uploadImage<?= $i; ?>" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>

                                <!-- Nova fotografija -->
                                <div class="col-sm-4" id="upload<?= $i; ?>" style="display:none">
                                    <?= form_upload('image'.($i+1)); ?>
                                    <?= form_hidden('imageId'.($i+1), $photos[$i]["id"]); ?>
                                </div>
                            
                            <?php else: ?>
                                <!-- Ce ni stare fotografije, lahko uporabnik normalno nalozi sliko. -->
                                <div class="col-sm-4">
                                    <?= form_upload('image'.($i+1)); ?>
                                </div>
                            <?php endif; endfor; ?>

                        <!-- V nasprotnem lahko nalozi poljubne tri fotografije. -->
                        <?php else : ?>
                            <div class="col-sm-4"><?= form_upload($image1); ?></div>
                            <div class="col-sm-4"><?= form_upload($image2); ?></div>
                            <div class="col-sm-4"><?= form_upload($image3); ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-default"><?= $btn; ?></button>
            </form>

        </div>

    </div>

</div>
<!-- /.container -->