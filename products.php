<?php
include("includes/header.php");
include("functions/userfunctions.php");
if (isset($_GET['category'])) {

    $category_slug = $_GET['category'];
    $category_data = getSlugActive("categories", $category_slug);
    $category = mysqli_fetch_array($category_data);
    if ($category) {

        $cid = $category['id'];
?>

        <div class="py-2 bg-primary">
            <div class="container">
                <h6 class="text-white"><a class="text-white" href="index.php">Home</a> / <a class="text-white" href="categories.php">Collections</a> / <?= $category['name'] ?></h6>
            </div>
        </div>
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><?= $category['name'] ?></h1>
                        <hr>
                        <?php
                        $products = getAllProdBycategory($cid);
                        if (mysqli_num_rows($products) > 0) {
                            foreach ($products as $item) {
                        ?>
                                <a href="product-view.php?product=<?= $item['slug'] ?>">
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

<?php
    } else {
        echo "Something went wrongss";
    }
    include("includes/footer.php");
} else {
    echo "Something went wrong";
}
?>