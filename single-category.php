<?php
include("includes/header.php");
include("functions/userfunctions.php")
?>

<div class="py-2 bg-primary">
    <div class="container">
        <h6 class="text-white">Home / Collections</h6>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Our Collections</h1>
                <hr>
                <?php
                $categories = getAllActive("categories");
                if (mysqli_num_rows($categories) > 0) {
                    foreach ($categories as $item) {
                ?>
                        <a href="products.php?category=<?= $item['slug'] ?>">
                            <div class="col-md-3 mb-2">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <img class="w-100" src="uploads/<?= $item['image'] ?>" alt="image">
                                        <h4><?= $item['name'] ?></h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                <?php
                    }
                } else {
                    echo "No Data Found";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>