<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Categories</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $category = getAll("categories");
                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
                            ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><img height="50px" width="50px" src="../uploads/<?= $item['image']; ?>" alt="<?= $item['id'] ?>"></td>
                                        <td><?= $item['status'] == 0 ? "Visible" : "Hidden" ?></td>
                                        <td>
                                            <a href="edit-category.php?id=<?= $item['id'] ?>" class="btn btn-primary">Edit</a>
                                            <form action="code.php" method="post">
                                                <input type="hidden" name="category_id" value="<?= $item['id'] ?>">
                                                <button type="submit" name="delete_category_btn" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?
                                }
                            } else {
                                echo "No Records Found";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>