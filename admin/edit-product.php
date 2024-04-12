<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $product = getById("products", $id);
                if (mysqli_num_rows($product) > 0) {
                    $data = mysqli_fetch_array($product);
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Select Category</label>
                                        <select name="category_id" class="form-select mb-2" aria-label="Default select example">
                                            <option selected>Select Category</option>
                                            <?php
                                            $categories = getAll("categories");
                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $item) {
                                            ?>
                                                    <option value="<?= $item['id'] ?>" <?= $data['category_id'] == $item['id'] ? "selected" : "" ?>><?= $item['name'] ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "No categories Avaliable";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" name="product_id" value="<?= $data['id'] ?>">
                                        <label class="mb-0" for="">Name</label>
                                        <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name" class="form-control mb-2 ">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0" for="">Slug</label>
                                        <input type="text" value="<?= $data['slug'] ?>" name="slug" placeholder="Enter Slug" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Description</label>
                                        <textarea name="description" placeholder="Enter Description" rows="3" class="form-control mb-2"><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Small Description</label>
                                        <textarea name="small_description" placeholder="Enter Small Description" rows="3" class="form-control mb-2"><?= $data['small_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0" for="">Orignal Price</label>
                                        <input type="text" value="<?= $data['orignal_price'] ?>" name="orignal_price" placeholder="Enter Original Price" class="form-control mb-2 ">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0" for="">Selling Price</label>
                                        <input type="text" value="<?= $data['selling_price'] ?>" name="selling_price" placeholder="Enter Selling Price" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control mb-2">
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                        <label for="">Current Image</label>
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                        <img src="../uploads/<?= $data['image'] ?>" height="50px" width="50px" alt="<?= $data['image'] ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-0" for="">Quantity</label>
                                            <input type="number" value="<?= $data['qty'] ?>" name="qty" placeholder="Enter Quantity" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0" for="">Status</label>
                                            <input type="checkbox" <?= $data['status'] ? "checked" : "" ?> name="status">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0" for="">Trending</label>
                                            <input type="checkbox" <?= $data['trending'] ? "checked" : "" ?> name="popular">
                                        </div>
                                        <!-- <div class="col-md-3">
                            <label class="mb-0" for="">Popular</label>
                            <input type="checkbox" name="popular">
                        </div> -->
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Meta Title</label>
                                        <input type="text" value="<?= $data['meta_title'] ?>" name="meta_title" placeholder="Enter Meta Title" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Meta Description</label>
                                        <textarea name="meta_description" placeholder="Enter Meta Description" rows="3" class="form-control mb-2"> <?= $data['meta_description'] ?> </textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Meta Keywords</label>
                                        <textarea name="meta_keywords" placeholder="Enter Meta Keywords" rows="3" class="form-control mb-2"><?= $data['meta_keywords'] ?></textarea>
                                    </div>


                                    <div class="col-md-12 mt-4">
                                        <button type="submit" name="update_product_btn" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    echo "No Product data Found";
                }
            } else {
                echo "Id is Missing...";
            }
            ?>
        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>