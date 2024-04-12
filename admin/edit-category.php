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
                $category = getById("categories", $id);
                if (mysqli_num_rows($category) > 0) {
                    $data = mysqli_fetch_array($category);
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                        <label for="">Name</label>
                                        <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name" class="form-control ">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Slug</label>
                                        <input type="text" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter Slug" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Description</label>
                                        <textarea name="description" placeholder="Enter Description" rows="3" class="form-control"><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <label for="">Current Image</label>
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                        <img src="../uploads/<?= $data['image'] ?>" height="50px" width="50px" alt="<?= $data['image'] ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Title</label>
                                        <input type="text" name="meta_title" value="<?= $data['meta_title'] ?>" placeholder="Enter Meta Title" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Description</label>
                                        <textarea name="meta_description" placeholder="Enter Meta Description" rows="3" class="form-control"><?= $data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Keywords</label>
                                        <textarea name="meta_keywords" placeholder="Enter Meta Keywords" rows="3" class="form-control"><?= $data['meta_keywords'] ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Status</label>
                                        <input type="checkbox" <?= $data['status'] ? "checked" : "" ?> name="status">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Popular</label>
                                        <input type="checkbox" <?= $data['popular'] ? "checked" : "" ?> name="popular">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" name="update_category_btn" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?
                } else {
                    echo "Category Not Found";
                }
            } else {
                echo "Something went Wrong...";
            }
            ?>

        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>