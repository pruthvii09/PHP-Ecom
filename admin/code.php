<?php
include("../config/dbcon.php");
include("../functions/myfunctions.php");
if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $slug = $_POST['slug'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    $image = $_FILES['image']['name'];

    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $category_query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image) VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular', '$filename')";

    $category_query_run = mysqli_query($conn, $category_query);
    if ($category_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect("add-category.php", "Category Added Successfully!");
    } else {
        redirect("add-category.php", "Something went wrong!!");
    }
} else if (isset($_POST['update_category_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $slug = $_POST['slug'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['images']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "Category Added Sucessfully");
    } else {
        redirect("edit-category.php?id=$category_id", "Something Went Wrong");
    }
} else if (isset($_POST['delete_category_btn'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    // Prepare and execute SELECT query
    $category_query = "SELECT * FROM categories WHERE id=?";
    $stmt = $conn->prepare($category_query);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $category_query_run = $stmt->get_result();

    if ($category_query_run && $category_data = $category_query_run->fetch_assoc()) {
        // Fetch category image
        $image = $category_data['image'];

        // Prepare and execute DELETE query
        $delete_query = "DELETE FROM categories WHERE id=?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $category_id);
        $delete_query_run = $stmt->execute();

        if ($delete_query_run) {
            // Delete category image file
            $image_path = "../uploads/" . $image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            redirect("category.php", "Deleted Successfully");
        } else {
            redirect("edit-category.php?id=$category_id", "Something Went Wrong");
        }
    } else {
        redirect("category.php", "Category not found");
    }
} else if (isset($_POST['add_product_btn'])) {
    error_log($_POST['category_id']);
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $small_description = $_POST['small_description'];
    $orignal_price = $_POST['orignal_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $product_query = "INSERT INTO products (category_id, name, slug, small_description, description, orignal_price, selling_price, qty, meta_title, meta_description, meta_keywords, status, trending, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($product_query);
    $stmt->bind_param("isssssssssiiis", $category_id, $name, $slug, $small_description, $description, $orignal_price, $selling_price, $qty, $meta_title, $meta_description, $meta_keywords, $status, $trending, $filename);

    if ($stmt->execute()) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);
        redirect('add-product.php', 'Product Added');
    } else {
        redirect('add-product.php', 'Something Went Wrong');
    }
} else if (isset($_POST['update_product_btn'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $small_description = $_POST['small_description'];
    $orignal_price = $_POST['orignal_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $image = $_FILES['image']['name'];
    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $update_query = "UPDATE products SET 
                    name = ?, 
                    slug = ?, 
                    description = ?, 
                    small_description = ?, 
                    orignal_price = ?, 
                    selling_price = ?, 
                    qty = ?, 
                    meta_title = ?, 
                    meta_description = ?, 
                    meta_keywords = ?, 
                    status = ?, 
                    trending = ? 
                WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssssisssiii", $name, $slug, $description, $small_description, $orignal_price, $selling_price, $qty, $meta_title, $meta_description, $meta_keywords, $status, $trending, $product_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-product.php?id=$product_id", "product Added Sucessfully");
    } else {
        redirect("edit-product.php?id=$product_id", "Something Went Wrong");
    }
} else if (isset($_POST['delete_product_btn'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    // Prepare and execute SELECT query
    $product_query = 'SELECT * FROM products WHERE id=?';
    $stmt = $conn->prepare($product_query);
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $product_query_run = $stmt->get_result();

    if ($product_query_run && $product_data = $product_query_run->fetch_assoc()) {
        // Fetch product image
        $image = $product_data['image'];

        // Prepare and execute DELETE query
        $delete_query = "DELETE FROM products WHERE id=?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param('i', $product_id);
        $delete_query_run = $stmt->execute();

        if ($delete_query_run) {
            // Delete category image file
            $image_path = '../uploads/' . $image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            // redirect("product.php", "Deleted Successfully");
            echo 200;
        } else {
            redirect("edit-product.php?id=$product_id", "Something Went Wrong");
            echo 500;
        }
    } else {
        redirect("product.php", "Product not found");
    }
}
