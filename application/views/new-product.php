<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-sm-12">

            <h1>Add New Product</h1>

            <form>
                <!-- Product Name -->
                <div class="form-group">
                    <label for="product">Product:</label>
                    <input type="text" class="form-control" id="product">
                </div>

                <!-- Product Description -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" rows="5" id="description"></textarea>
                </div>

                <!-- Photo -->
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="file" id="photo">
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" id="price">
                </div>

                <button type="submit" class="btn btn-default">Add new product</button>
            </form>

        </div>

    </div>

</div>
<!-- /.container -->