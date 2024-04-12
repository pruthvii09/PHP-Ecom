<?php

include('functions/userfunctions.php');
include('includes/header.php');
if (isset($_GET['product'])) {
    $product_slug = $_GET['product'];
    $product_data = getSlugActive('products', $product_slug);
    $product = mysqli_fetch_array($product_data);

    if ($product) {
?>
        <div class="py-2 bg-primary">
            <div class="container">
                <h6 class="text-white"><a class="text-white" href="index.php">Home</a> / <a class="text-white" href="categories.php">Collections</a> / <?= $product['name'] ?></h6>
            </div>
        </div>
        <div class="bg-light py-4">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="uploads/<?= $product['image'] ?>" alt="" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold"><?= $product['name'] ?>
                            <span style="font-size: 13px;" class="<?php echo $product['trending'] ? 'text-danger' : ''; ?>">
                                <?php
                                if ($product['trending']) {
                                    echo 'Trending';
                                }
                                ?>
                            </span>
                        </h4>
                        <hr>
                        <p><?= $product['small_description'] ?></p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="fw-bold text-success">Rs. <?= $product['selling_price'] ?></h5>
                            </div>
                            <div class="col-md-6">
                                <h5>Rs. <s><?= $product['orignal_price'] ?></s></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width: 130px;">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control text-center bg-white input-qty" disabled value="1">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary px-4"><i class="fa fa-shopping-cart me-2"></i>Add to Cart</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger px-4"><i class="fa fa-heart me-2"></i>Add to Wishlist</button>
                            </div>
                        </div>
                        <h6>Product Description:</h6>
                        <p><?= $product['description'] ?></p>
                    </div>
                </div>
            </div>
        </div>
<?

    } else {
        echo 'Product Not Found';
    }
    include("includes/footer.php");
} else {
    echo 'Something went wrongss';
}
