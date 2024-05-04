<?php

include('functions/userfunctions.php');
include("includes/header.php");
include('authenticate.php')
?>


<div class="py-2 bg-primary">
    <div class="container">
        <h6 class="text-white">Home / Cart</h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <h6>Product</h6>
                        </div>
                        <div class="col-md-3">
                            <h6>Price</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Quantity</h6>
                        </div>
                        <div class="col-md-2">
                            <div>Action</div>
                        </div>
                    </div>
                    <?php $items = getCartItems();

                    foreach ($items as $citem) {
                    ?>
                        <div class="card product_data shadow-sm py-1 mb-2">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="uploads/<?= $citem['image'] ?>" alt="Image" width="80px">
                                </div>
                                <div class="col-md-3">
                                    <h5><?= $citem['name'] ?></h5>
                                </div>
                                <div class="col-md-3">
                                    <h5>Rs.<?= $citem['selling_price'] ?></h5>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
                                    <div class="input-group mb-3" style="width: 130px;">
                                        <button class="input-group-text decrement-btn updateQty">-</button>
                                        <input type="text" class="form-control text-center bg-white input-qty" disabled value="<?= $citem['prod_qty'] ?>">
                                        <button class="input-group-text increment-btn updateQty">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger btn-sm deleteItem" value="<?= $citem['cid'] ?>">
                                        <i class="fa fa-trash m-2"></i>Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?
                    }
                    ?>
                </div>
            </div>
            <div class="float-end">
                <a href="checkout.php" class="btn btn-outline-primary">Checkout</a>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>