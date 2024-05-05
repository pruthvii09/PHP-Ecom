<?php

include('functions/userfunctions.php');
include("includes/header.php");
include('authenticate.php')
?>


<div class="py-2 bg-primary">
    <div class="container">
        <h6 class="text-white">Home / Checkout</h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="functions/placeorder.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Basic Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Name</label>
                                    <input required type="text" name="name" placeholder="Enter your full name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Email</label>
                                    <input required type="email" name="email" placeholder="Enter your Email" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Phone</label>
                                    <input required type="text" name="phone" placeholder="Enter your Contact No." class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Pin Code</label>
                                    <input required type="text" name="pincode" placeholder="Enter your Pin Code" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Address</label>
                                    <textarea required name="address" placeholder="Enter your Address" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>
                            <div class="my-cart">
                                <?php $items = getCartItems();
                                $total_price = 0;

                                foreach ($items as $citem) {
                                ?>
                                    <div class="mb-1 border">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="uploads/<?= $citem['image'] ?>" alt="Image" width="80px">
                                            </div>
                                            <div class="col-md-4">
                                                <h5 style="font-weight: 500; font-size: 15px;"><?= $citem['name'] ?></h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5 style="font-weight: 500; font-size: 15px;">Rs.<?= $citem['selling_price'] ?></h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5 style="font-weight: 500; font-size: 15px;"><?= $citem['prod_qty'] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                <?
                                    $total_price += $citem['selling_price'] * $citem['prod_qty'];
                                }
                                ?>
                                <hr>
                            </div>
                            <h5 class="w-full">Total Price : <span class=""><?= $total_price ?></span></h5>
                            <div>
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" name="placeOrderBtn" class="btn btn-primary">Confirm and place order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>