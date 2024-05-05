<?php
include('functions/userfunctions.php');
include("includes/header.php");
include('authenticate.php');
?>

<div class="py-2 bg-primary">
    <div class="container">
        <h6 class="text-white">Home / My Orders</h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tracking No</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getOrders();
                            if (mysqli_num_rows($orders) > 0) {
                                while ($order = mysqli_fetch_assoc($orders)) {
                            ?>
                                    <tr>
                                        <td><?= $order['id'] ?></td>
                                        <td><?= $order['tracking_no'] ?></td>
                                        <td><?= $order['total_price'] ?></td>
                                        <td><?= $order['created_at'] ?></td>
                                        <td>
                                            <a href="#" class="btn btn-primary">View Details</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "No data available";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>